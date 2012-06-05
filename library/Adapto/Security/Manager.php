<?php

/**
 * This file is part of the Adapto Toolkit.
 * Detailed copyright and licensing information can be found
 * in the doc/COPYRIGHT and doc/LICENSE files which should be
 * included in the distribution.
 *
 * @package adapto
 * @subpackage security
 *
 * @copyright (c)2000-2004 Ivo Jansch
 * @copyright (c)2000-2004 Ibuildings.nl BV
 * @license http://www.achievo.org/atk/licensing ATK Open Source License
 *

 */

/**
 * @internal includes and definitions
 */

// Some result defines
define("AUTH_UNVERIFIED", 0); // initial value.
define("AUTH_SUCCESS", 1);
define("AUTH_LOCKED", 2);
define("AUTH_MISMATCH", 3);
define("AUTH_PASSWORDSENT", 4);
define("AUTH_MISSINGUSERNAME", 5);
define("AUTH_ERROR", -1);

/**
 * The security manager for ATK applications.
 *
 * Don't instantiate this class yourself, use the global instance
 * that is returned by atkGetSecurityManager() instead.
 *
 * @todo Make a real singleton with a getInstance class.
 *
 * @author ijansch
 * @package adapto
 * @subpackage security
 */
class Adapto_Security_Manager
{
    public $m_authentication = ""; // defaulted to public
    public $m_authorization = 0; // defaulted to public
    public $m_scheme = "none"; // defaulted to public
    public $m_user = array(); // defaulted to public
    public $m_listeners = array(); // defaulted to public

    // If login really fails (no relogin box, but an errormessage), the
    // error message that caused the fatal error is put in this variable.
    public $m_fatalError = ""; // defaulted to public

    /**
     * Can we use password retrieving/recreating in current configuration
     */
    protected $m_enablepasswordmailer = false;

    /**
     * Register a new listener.
     *
     * @param atkSecurityListener $listener
     */
    function addListener(&$listener)
    {
        $this->m_listeners[] = $listener;
    }

    /**
     * Notify listeners of a certain event.
     *
     * @param string $event name
     * @param string $username (might be null)
     */
    function notifyListeners($event, $username)
    {
        for ($i = 0, $_i = count($this->m_listeners); $i < $_i; $i++)
            $this->m_listeners[$i]->handleEvent($event, $username);
    }

    /**
     * returns the full classname for use with 
     *
     * @param string $type
     * @return string full classname
     */
    function _getclassname($type)
    {
        // assume that when a type includes a dot, the fullclassname is used.
        if (!stristr($type, ".")) {
            $cls = "atk.security.auth_$type";
        } else
            $cls = $type;
        return $cls;
    }

    /**
     * returns an array of authentication types
     * authentication_type is a comma delimeted string with
     * native atk auth types like 'db' or 'none' or it can be a
     * full classname like module.mymodule.myauthtype
     *
     * @param string $authentication_type
     * @return array authentication types
     */
    function _getAuthTypes($authentication_type)
    {
        $authentication = explode(",", trim($authentication_type));
        $types = array();
        if (!is_array($authentication)) {
            array_push($types, $this->_getclassname(trim($authentication)));
        } else {
            foreach ($authentication as $type) {
                array_push($types, $this->_getclassname(trim($type)));
            }
        }
        return $types;
    }

    /**
     * Constructor
     * @access private
     *
     * @param string $authentication_type The type of authentication (user/password verification) to use
     * @param string $authorization_type The type of authorization (mostly the same as the authentication_type)
     * @param string $securityscheme The security scheme that will be used to determine who is allowed to do what
     */

    public function __construct($authentication_type = "none", $authorization_type = "none", $securityscheme = "none")
    {
        Adapto_Util_Debugger::debug("creating securityManager (authenticationtype: $authentication_type, authorizationtype: $authorization_type, scheme: $securityscheme)");

        // required interface;

        $authentication = $this->_getAuthTypes($authentication_type);
        foreach ($authentication as $class) {
            if (!$obj = Adapto_ClassLoader::create($class)) {
                Adapto_Util_Debugger::debug("Adapto_Security_Manager() unsupported authentication type or type no found for $class");
            } else
                $this->m_authentication[$class] = $obj;
        }

        /* authorization class */
        $clsname = $this->_getclassname($authorization_type);
        $this->m_authorization = &Adapto_ClassLoader::create($clsname);

        /* security scheme */
        $this->m_scheme = $securityscheme;

        /**
         * Check, can we use password retrieving/recreating.
         * We take into account configuration var auth_enablepasswordmailer
         * and authentication methid, that we use
         *
         */
        if (Adapto_Config::getGlobal("auth_enablepasswordmailer", false)) {
            foreach ($this->m_authentication as $auth) {
                if (in_array($auth->getPasswordPolicy(), array(PASSWORD_RETRIEVABLE, PASSWORD_RECREATE))) {
                    $this->m_enablepasswordmailer = true;
                }
            }
        }
    }

    /**
     * Regenerates a user password and sends it to his e-mail address
     *
     * @param string $username User for which the password should be regenerated
     */
    function mailPassword($username)
    {
        // Query the database for user records having the given username and return if not found
        $userentity = &atkGetEntity(Adapto_Config::getGlobal("auth_userentity"));
        $selector = sprintf("%s.%s = '%s'", Adapto_Config::getGlobal("auth_usertable"), Adapto_Config::getGlobal("auth_userfield"), $username);
        $userrecords = $userentity
                ->selectDb($selector, "", "", "", array(Adapto_Config::getGlobal("auth_userpk"), Adapto_Config::getGlobal("auth_emailfield"), Adapto_Config::getGlobal("auth_passwordfield")), "edit");
        if (count($userrecords) != 1) {
            Adapto_Util_Debugger::debug("User '$username' not found.");
            return false;
        }

        // Retrieve the email address
        $email = $userrecords[0][Adapto_Config::getGlobal("auth_emailfield")];
        if (empty($email)) {
            Adapto_Util_Debugger::debug("Email address for '$username' not available.");
            return false;
        }

        // Regenerate the password
        $passwordattr = &$userentity->getAttribute(Adapto_Config::getGlobal("auth_passwordfield"));
        $newpassword = $passwordattr->generatePassword();

        // Update the record in the database
        $userrecords[0][Adapto_Config::getGlobal("auth_passwordfield")]["hash"] = md5($newpassword);
        $userentity->updateDb($userrecords[0], true, "", array(Adapto_Config::getGlobal("auth_passwordfield")));

        $db = &$userentity->getDB();
        $db->commit();

        // Send an email containing the new password to user
        $subject = atktext("auth_passwordmail_subjectnew_password", "atk");
        $body = atktext("auth_passwordmail_explanation", "atk") . "\n\n";
        $body .= atktext(Adapto_Config::getGlobal("auth_userfield")) . ": " . $username . "\n";
        $body .= atktext(Adapto_Config::getGlobal("auth_passwordfield")) . ": " . $newpassword . "\n";
        mail($email, $subject, $body);

        // Return true
        return true;
    }

    /**
     * Perform user authentication.
     *
     * Called by the framework, it should not be necessary to call this method
     * directly.
     */
    function authenticate()
    {
        global $g_sessionManager, $Adapto_VARS;
        $session = &atkSessionManager::getSession();

        $response = AUTH_UNVERIFIED;

        if (Adapto_Config::getGlobal("auth_loginform") == true) // form login
 {
            $auth_user = isset($Adapto_VARS["auth_user"]) ? $Adapto_VARS["auth_user"] : null;
            $auth_pw = isset($Adapto_VARS["auth_pw"]) ? $Adapto_VARS["auth_pw"] : null;
        } else // HTTP login
 {
            $auth_user = isset($_SERVER["PHP_AUTH_USER"]) ? $_SERVER["PHP_AUTH_USER"] : null;
            $auth_pw = isset($_SERVER["PHP_AUTH_PW"]) ? $_SERVER["PHP_AUTH_PW"] : null;
        }

        // throw post login event?
        $throwPostLoginEvent = false;

        $md5 = false; // PHP_AUTH_PW is plain text..
        // first check if we want to logout
        if (isset($Adapto_VARS["atklogout"]) && (!isset($session["relogin"]) || $session["relogin"] != 1)) {
            $this->notifyListeners("preLogout", $auth_user);
            $currentUser = &atkGetUser();

            // Let the authentication plugin know about logout too.
            foreach ($this->m_authentication as $auth) {
                $auth->logout($currentUser);
            }
            $session = array();
            $session["relogin"] = 1;

            // destroy cookie
            if (Adapto_Config::getGlobal("authentication_cookie") && $auth_user != "administrator") {
                $cookiename = $this->_getAuthCookieName();
                if (!empty($_COOKIE[$cookiename]))
                    setcookie($cookiename, "", 0);
            }

            $this->notifyListeners("postLogout", $auth_user);

            if ($Adapto_VARS["atklogout"] > 1) {
                header("Location: logout.php");
                exit;
            }
        }
        // do we need to login?
 else if ((!isset($session["login"])) || ($session["login"] != 1)) {
            // authenticated?
            $authenticated = false;

            // sometimes we manually have to set the PHP_AUTH vars
            // old style http_authorization
            if (empty($auth_user) && empty($auth_pw) && array_key_exists("HTTP_AUTHORIZATION", $_SERVER) && ereg("^Basic ", $_SERVER["HTTP_AUTHORIZATION"])) {
                list($auth_user, $auth_pw) = explode(":", base64_decode(substr($_SERVER["HTTP_AUTHORIZATION"], 6)));
            }
            // external authentication
 elseif (empty($auth_user) && empty($auth_pw) && !empty($_SERVER["PHP_AUTH_USER"])) {
                $auth_user = $_SERVER["PHP_AUTH_USER"];
                $auth_pw = $_SERVER["PHP_AUTH_PW"];
            }

            // check previous sessions..
            if (Adapto_Config::getGlobal("authentication_cookie")) {
                // Cookiename is based on the app_title, for there may be more than 1 atk app running,
                // each with their own cookie..
                $cookiename = $this->_getAuthCookieName();
                list($enc, $user, $passwd) = explode(".", base64_decode(atkArrayNvl($_COOKIE, $cookiename, "Li4=")));

                // for security reasons administrator will never be cookied..
                if ($auth_user == "" && $user != "" && $user != "administrator") {
                    Adapto_Util_Debugger::debug("Using cookie to retrieve previously used userid/password");
                    $auth_user = $user;
                    $auth_pw = $passwd;
                    $md5 = ($enc == "MD5"); // cookie may already be md5;
                }
            }

            $authenticated = false;

            // Check if a username was entered
            if ((atkArrayNvl($Adapto_VARS, "login", "") != "") && empty($auth_user) && !strstr(Adapto_Config::getGlobal("authentication"), "none")) {
                $response = AUTH_MISSINGUSERNAME;
            }
            // Email password if password forgotten and passwordmailer enabled
 else if ((!empty($auth_user)) && (Adapto_Config::getGlobal("auth_loginform") == true) && $this->get_enablepasswordmailer()
                    && (atkArrayNvl($Adapto_VARS, "login", "") == atktext('password_forgotten'))) {
                $this->mailPassword($auth_user);
                $response = AUTH_PASSWORDSENT;
            } else {
                $throwPostLoginEvent = true;
                $this->notifyListeners("preLogin", $auth_user);

                // check administrator and guest user
                if ($auth_user == "administrator" || $auth_user == "guest") {
                    $config_pw = Adapto_Config::getGlobal($auth_user . "password");
                    if (!empty($config_pw) && (($auth_pw == $config_pw) || (Adapto_Config::getGlobal("authentication_md5") && (md5($auth_pw) == strtolower($config_pw))))) {
                        $authenticated = true;
                        $response = AUTH_SUCCESS;
                        if ($auth_user == "administrator")
                            $this->m_user = array("name" => "administrator", "level" => -1, "access_level" => 9999999);
                        else
                            $this->m_user = array("name" => "guest", "level" => -2, "access_level" => 0);
                    } else {
                        $response = AUTH_MISMATCH;
                    }
                }
                // other users
                // we must first explicitly check that we are not trying to login as administrator or guest.
                // these accounts have been validated above. If we don't check this, an account could be
                // created in the database that provides administrator access.
 else if ($auth_user != "administrator" && $auth_user != "guest") {
                    if (is_array($this->m_authentication)) {
                        // We have a username, which we must now validate against several
                        // checks. If all of these fail, we have a status of AUTH_MISMATCH.
                        foreach ($this->m_authentication as $name => $obj) {
                            $obj->canMd5() && !$md5 ? $tmp_pw = md5($auth_pw) : $tmp_pw = $auth_pw;
                            $response = $obj->validateUser($auth_user, $tmp_pw);
                            if ($response == AUTH_SUCCESS) {
                                Adapto_Util_Debugger::debug("Adapto_Security_Manager::authenticate() using $name authentication");
                                $authname = $name;
                                break;
                            }
                        }
                    }
                    if ($response == AUTH_SUCCESS) // succesful login
 {
                        // We store the username + securitylevel of the logged in user.
                        $this->m_user = $this->m_authorization->getUser($auth_user);
                        $this->m_user['AUTH'] = $authname; // something to see wich auth scheme is used
                        if (Adapto_Config::getGlobal("enable_ssl_encryption"))
                            $this->m_user['PASS'] = $auth_pw;
                        // used by aktsecurerelation to decrypt an linkpass
                        // for convenience, we also store the user as a global variable.
                        (is_array($this->m_user['level'])) ? $dbg = implode(",", $this->m_user['level']) : $dbg = $this->m_user['level'];
                        Adapto_Util_Debugger::debug("Logged in user: " . $this->m_user["name"] . " (level: " . $dbg . ")");
                        $authenticated = true;

                        // Remember that we are logged in..
                        //$g_sessionManager->globalVar("authentication",array("authenticated"=>1, "user"=>$this->m_user), true);

                        // write cookie
                        if (Adapto_Config::getGlobal("authentication_cookie") && $auth_user != "administrator") {
                            // if the authentication scheme supports md5 passwords, we can safely store
                            // the password as md5 in the cookie.
                            if ($md5) // Password is already md5 encoded
 {
                                $tmppw = $auth_pw;
                                $enc = "MD5";
                            } else // password is not md5 encoded
 {
                                if ($this->m_authentication[$authname]->canMd5()) // we can encode it
 {
                                    $tmppw = md5($auth_pw);
                                    $enc = "MD5";
                                } else // authentication scheme does not support md5 encoding.
                                // our only choice is to store the password plain text
                                // :-(
                                // NOTE: If you use a non-md5 enabled authentication
                                // scheme then, for security reasons, you shouldn't use
                                // $config_authentication_cookie at all.
 {
                                    $tmppw = $auth_pw;
                                    $enc = "PLAIN";
                                }
                            }
                            setcookie($cookiename, base64_encode($enc . "." . $auth_user . "." . $tmppw), time()
                                    + 60 * (Adapto_Config::getGlobal("authentication_cookie_expire")));
                        }
                    } else {
                        // login was incorrect. Either the supplied username/password combination is
                        // incorrect (we just try again) or there was an error (we display an error
                        // message)
                        if ($response == AUTH_ERROR) {
                            $this->m_fatalError = $this->m_authentication->m_fatalError;
                        }
                        $authenticated = false;
                    }
                }

                // we are logged in
                if ($authenticated)
                    $session["login"] = 1;
            }
        } else {
            // using session for authentication, because "login" was registered.
            // but we double check with some more data from the session to see
            // if the login is really valid.
            $session_auth = $g_sessionManager->getValue("authentication", "globals");

            if (Adapto_Config::getGlobal("authentication_session") && $session["login"] == 1 && $session_auth["authenticated"] == 1 && !empty($session_auth["user"])) {
                $this->m_user = $session_auth["user"];
                Adapto_Util_Debugger::debug("Using session for authentication / user = " . $this->m_user["name"]);
            } else {
                // Invalid session
                $authenticated = false;
            }
        }

        // if there was an error, drop out.
        if ($this->m_fatalError != "") {
            return false;
        }
        // still not logged in?!
        if (!isset($session["login"]) || $session["login"] != 1) {
            $location = Adapto_Config::getGlobal('auth_loginpage', '');
            if ($location) {
                $location .= (strpos($location, '?') === false) ? '?' : '&';
                $location .= 'login=' . $auth_user . '&error=' . $response;

                if (Adapto_Config::getGlobal("debug") >= 2) {
                    $debugger = Adapto_ClassLoader::getInstance('atk.utils.Adapto_Util_Debugger::debugger');
                    $debugger->setRedirectUrl($location);
                    Adapto_Util_Debugger::debug('Non-debug version would have redirected to <a href="' . $location . '">' . $location . '</a>');
                    $output = &atkOutput::getInstance();
                    $output->outputFlush();
                    exit();
                } else {
                    header('Location: ' . $location);
                    exit();
                }
            } elseif (Adapto_Config::getGlobal("auth_loginform")) {
                $this->loginForm($auth_user, $response);
                $output = &atkOutput::getInstance();
                $output->outputFlush();
                exit();
            } else {
                header('WWW-Authenticate: Basic realm="' . atktext("app_title") . (Adapto_Config::getGlobal("auth_changerealm", true) ? ' - ' . strftime("%c", time()) : "")
                        . '"');
                if (ereg("Microsoft", $_SERVER['SERVER_SOFTWARE']))
                    header("Status: 401 Unauthorized");
                else
                    header("HTTP/1.0 401 Unauthorized");
                return false;
            }
        }
        // we are authenticated, but atklogout is still active, let's get rid of it!
 else if (isset($Adapto_VARS["atklogout"]))
            header("Location: " . atkSelf() . "?");

        // we keep the relogin state until the atklogout variable isn't set anymore
        else if (!isset($Adapto_VARS["atklogout"]) && isset($session["relogin"]) && $session["relogin"] == 1)
            $session["relogin"] = 0;

        // return
        // g_user always lowercase
        $this->m_user["name"] = $this->m_user["name"];
        //Send the username with the header
        //This way we can always retrieve the user from apache logs
        header('user: ' . $this->m_user["name"]);
        $GLOBALS["g_user"] = $this->m_user;
        $g_sessionManager->globalVar("authentication", array("authenticated" => 1, "user" => $this->m_user), true);
        sessionStore('loginattempts', ''); //reset maxloginattempts

        if ($throwPostLoginEvent)
            $this->notifyListeners("postLogin", $auth_user);

        return true;
    }

    /**
     * Reload the current user data.
     * This method should be called if userdata, for example name or other
     * fields, have been updated for the currently logged in user.
     *
     * The method will make sure that $g_securityManager->m_user, $g_user and
     * the authenticated user in the session are refreshed.
     */
    function reloadUser()
    {
        global $g_user, $g_sessionManager;
        $user = getUser();
        $this->m_user = $this->m_authorization->getUser($user[Adapto_Config::getGlobal('auth_userfield')]);
        $g_user = &$this->m_user;
        $old_auth = $g_sessionManager->getValue("authentication", "globals");
        $old_auth["user"] = $g_user;
        $g_sessionManager->globalVar("authentication", $old_auth, true);
    }

    /**
     * Display a login form.
     * @access private
     *
     * @param string $defaultname The username that might already be known
     * @param int    $lastresponse The lastresponse when trying to login
     *                              possible values: AUTH_MISMATCH, AUTH_LOCKED, AUTH_MISSINGUSERNAME, AUTH_PASSWORDSENT
     */
    function loginForm($defaultname, $lastresponse)
    {
        $loginattempts = sessionLoad('loginattempts'); // Note: not actually how many authentication attempts, but how many times the login form has been displayed.
        if ($loginattempts == "")
            $loginattempts = 0;

        if ($loginattempts == "") {
            $loginattempts = 1;
        } else {
            $loginattempts++;
        }

        sessionStore('loginattempts', $loginattempts);

        Adapto_Util_Debugger::debug('LoginAttempts: ' . $loginattempts);

        $page = Adapto_ClassLoader::getInstance("atk.ui.atkpage", true);
        $ui = Adapto_ClassLoader::getInstance("atk.ui.atkui");

        $page->register_style($ui->stylePath("style.css"));
        $page->register_style($ui->stylePath("login.css"));

        $page->register_script(Adapto_Config::getGlobal('atkroot') . "atk/javascript/tools.js");

        $tplvars = Array();
        $output = '<form action="' . atkSelf() . '" method="post">';
        $output .= makeHiddenPostVars(array("atklogout", "loginattempts"));
        $output .= '<br><br><table border="0" cellspacing="2" cellpadding="0" align="center">';

        $tplvars["atksessionformvars"] = makeHiddenPostVars(array("atklogout", "loginattempts"));
        $tplvars["formurl"] = atkSelf();

        // max_loginattempts of 0 means no maximum.
        if (Adapto_Config::getGlobal('max_loginattempts') > 0 && $loginattempts > Adapto_Config::getGlobal('max_loginattempts')) {
            $output .= "<tr><td class=table>" . atktext('auth_max_loginattempts_exceeded') . "<br><br></td></tr>";
            $tplvars["auth_max_loginattempts_exceeded"] = atktext('auth_max_loginattempts_exceeded');
        } else {
            $page->register_script(Adapto_Config::getGlobal('atkroot') . "atk/javascript/formfocus.js");
            $page->register_loadscript("placeFocus(false);");

            // generate the username input field
            // based upon the config_authdropdown and auth. method
            $userField = $this->auth_userField($defaultname);
            $tplvars["username"] = atktext("username");
            $tplvars["password"] = atktext("password");
            $tplvars["userfield"] = $userField;
            $tplvars["passwordfield"] = '<input class="loginform" type="password" size="15" name="auth_pw" value="" />';
            $tplvars["submitbutton"] = '<input name="login" class="button" type="submit" value="' . atktext('login') . '" />';
            $tplvars["title"] = atktext('login_form');

            if ($lastresponse == AUTH_LOCKED) {
                $output .= "<tr><td colspan=3 class=error>" . atktext('auth_account_locked') . "<br><br></td></tr>";
                $tplvars["auth_account_locked"] = atktext('auth_account_locked');
                $tplvars["error"] = atktext('auth_account_locked');
            } else if ($lastresponse == AUTH_MISMATCH) {
                $output .= '<tr><td colspan=3 class=error>' . atktext('auth_mismatch') . '<br><br></td></tr>';
                $tplvars["auth_mismatch"] = atktext('auth_mismatch');
                $tplvars["error"] = atktext('auth_mismatch');
            } else if ($lastresponse == AUTH_MISSINGUSERNAME) {
                $output .= '<tr><td colspan="3" class=error>' . atktext('auth_missingusername') . '<br /><br /></td></tr>';
                $tplvars["auth_mismatch"] = atktext('auth_missingusername');
                $tplvars["error"] = atktext('auth_missingusername');
            } else if ($lastresponse == AUTH_PASSWORDSENT) {
                $output .= '<tr><td colspan="3">' . atktext('auth_passwordmail_sent') . '<br /><br /></td></tr>';
                $tplvars["auth_mismatch"] = atktext('auth_passwordmail_sent');
            }

            // generate the form
            $output .= "<tr><td valign=top>" . atktext('username') . "</td><td>:</td><td>" . $userField . "</td></tr>";
            $output .= "<tr><td colspan=3 height=6></td></tr>";
            $output .= "<tr><td valign=top>" . atktext('password') . "</td><td>:</td><td><input type=password size=15 name=auth_pw value='' /></td></tr>";
            $output .= '<tr><td colspan="3" align="center" height="50" valign="middle">';
            $output .= '<input name="login" class="button" type="submit" value="' . atktext('login') . '">';
            $tplvars["auth_enablepasswordmailer"] = $this->get_enablepasswordmailer();
            if ($this->get_enablepasswordmailer()) {
                $output .= '&nbsp;&nbsp;<input name="login" class="button" type="submit" value="' . atktext('password_forgotten') . '">';
                $tplvars["forgotpasswordbutton"] = '<input name="login" class="button" type="submit" value="' . atktext('password_forgotten') . '">';
            }
            $output .= '</td></tr>';

        }

        $output .= '</table></form>';

        $tplvars["content"] = $output;
        $page->addContent($ui->render("login.tpl", $tplvars));
        $o = &atkOutput::getInstance();
        $o->output($page->render(atktext("app_title"), HTML_STRICT, "", $ui->render("login_meta.tpl")));
    }

    /**
     * Generate field for entering the username (dropdown or input box,
     * depending on settings.
     * @access private
     *
     * @param string $defaultname The username that might already be known
     */
    function auth_userField($defaultname)
    {
        if (Adapto_Config::getGlobal("auth_dropdown") == true) {
            $auth_types = $this->m_authentication;
            $userlist = array();

            // Administrator and guest user may be present.
            if (Adapto_Config::getGlobal("administratorpassword") != "") {
                $userlist[] = array("userid" => "administrator", "username" => "Administrator");
            }
            if (Adapto_Config::getGlobal("guestpassword") != "") {
                $userlist[] = array("userid" => "guest", "username" => "Guest");
            }

            foreach ($auth_types as $type => $obj) {
                $userlist = array_merge($userlist, $obj->getUserList());
            }

            $userField = '<select name="auth_user">' . "\n";

            for ($i = 0, $_i = count($userlist); $i < $_i; $i++) {
                $selected = "";
                if (trim(strtolower($defaultname)) == strtolower(trim($userlist[$i]["userid"]))) {
                    $selected = " selected";
                }
                $userField .= "<option value='" . $userlist[$i]["userid"] . "'" . $selected . ">" . $userlist[$i]["username"] . "</option>\n";
            }
            $userField .= "</SELECT>\n";

            return $userField;
        } else {
            return '<input class="loginform" type="text" size="15" name="auth_user" value="' . Adapto_htmlentities($defaultname) . '" />';
        }
    }

    /**
     * Check if the currently logged-in user has a certain privilege on a
     * entity.
     * @param String $entity The full entityname of the entity for which to check
     *                     access privileges. (modulename.entityname notation).
     * @param String $privilege The privilege to check (atkaction).
     * @return boolean True if the user has the privilege, false if not.
     */
    function allowed($entity, $privilege)
    {
        static $_cache = array();

        if (!isset($_cache[$entity][$privilege])) {
            // ask authorization instance
            $allowed = $this->m_authorization->allowed($this, $entity, $privilege);
            $_cache[$entity][$privilege] = $allowed;
        }
        return $_cache[$entity][$privilege];
    }

    /**
     * Check if the currently logged-in user has the right to view, edit etc.
     * an attribute of an entity.
     *
     * @param atkAttribute $attr    attribute reference
     * @param string       $mode    mode (add, edit, view etc.)
     * @param array        $record  record data
     *
     * @return boolean true if access is granted, false if not.
     */
    function attribAllowed(&$attr, $mode, $record = NULL)
    {
        return $this->m_authorization->attribAllowed($this, $attr, $mode, $record);
    }

    /**
     * Check if the currently logged in user has the requested level.
     * @param int $level The level to check.
     * @return boolean True if the user has the required level, false if not.
     */
    function hasLevel($level)
    {
        if (is_array($level)) {
            if (is_array($this->m_user["level"])) {
                return (count(array_intersect($this->m_user["level"], $level)) >= 1);
            } else {
                return in_array($this->m_user["level"], $level);
            }
        } else {
            if (is_array($this->m_user["level"])) {
                return in_array($level, $this->m_user["level"]);
            } else {
                return $this->m_user["level"] == $level;
            }
        }
    }

    /**
     * Write an access entry in the logfile.
     * @param String $entity The full name of the entity that is being accessed.
     * @param String $action The action that has been performed.
     */
    function logAction($entity, $action)
    {
        $this->log(2, "Performing $entity.$action");
    }

    /**
     * Write a logentry in the logfile.
     * The entry is only written to the file, if the level of the message is
     * equal or higher than the setting of $config_logging.
     *
     * @todo Logging should be moved to a separate atkLogger class.
     * @param int $level The loglevel.
     * @param String $message The message to log.
     */
    function log($level, $message)
    {

        if (Adapto_Config::getGlobal("logging") > 0 && Adapto_Config::getGlobal("logging") >= $level) {
            $fp = @fopen(Adapto_Config::getGlobal("logfile"), "a");
            if ($fp) {
                $logstamp = "[" . date("d-m-Y H:i:s") . "] [" . $_SERVER["REMOTE_ADDR"] . "] " . $this->m_user["name"] . " | ";
                @fwrite($fp, $logstamp . $message . "\n");
                @fclose($fp);
            } else {
                Adapto_Util_Debugger::debug("error opening logfile");
            }
        }
    }

    /**
     * If we are using cookies to store the login information this function will generate
     * the cookiename
     *
     * @return cookiename based on the application title
     */
    function _getAuthCookieName()
    {
        return "atkauth_3" . str_replace(" ", "_", atktext("app_title"));
    }

    /**
     * Getter for m_enablepasswordmailer
     *
     * @return bool
     */

    public function get_enablepasswordmailer()
    {
        return $this->m_enablepasswordmailer;
    }
}

?>
