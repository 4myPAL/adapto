<?Adapto_Session_phpAdapto_Session_
/**
 * Adapto_Session_ThisAdapto_Session_ Adapto_Session_fileAdapto_Session_ Adapto_Session_isAdapto_Session_ Adapto_Session_partAdapto_Session_ Adapto_Session_ofAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_AchievoAdapto_Session_ Adapto_Session_ATKAdapto_Session_ Adapto_Session_distributionAdapto_Session_.
 * Adapto_Session_DetailedAdapto_Session_ Adapto_Session_copyrightAdapto_Session_ Adapto_Session_andAdapto_Session_ Adapto_Session_licensingAdapto_Session_ Adapto_Session_informationAdapto_Session_ Adapto_Session_canAdapto_Session_ Adapto_Session_beAdapto_Session_ Adapto_Session_foundAdapto_Session_
 * Adapto_Session_inAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_docAdapto_Session_/Adapto_Session_COPYRIGHTAdapto_Session_ Adapto_Session_andAdapto_Session_ Adapto_Session_docAdapto_Session_/Adapto_Session_LICENSEAdapto_Session_ Adapto_Session_filesAdapto_Session_ Adapto_Session_whichAdapto_Session_ Adapto_Session_shouldAdapto_Session_ Adapto_Session_beAdapto_Session_
 * Adapto_Session_includedAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_distributionAdapto_Session_.
 *
 * @Adapto_Session_packageAdapto_Session_ Adapto_Session_atkAdapto_Session_
 * @Adapto_Session_subpackageAdapto_Session_ Adapto_Session_sessionAdapto_Session_
 *
 * @Adapto_Session_copyrightAdapto_Session_ (Adapto_Session_cAdapto_Session_)Adapto_Session_2000Adapto_Session_-Adapto_Session_2007Adapto_Session_ Adapto_Session_IvoAdapto_Session_ Adapto_Session_JanschAdapto_Session_
 * @Adapto_Session_licenseAdapto_Session_ Adapto_Session_httpAdapto_Session_://Adapto_Session_wwwAdapto_Session_.Adapto_Session_achievoAdapto_Session_.Adapto_Session_orgAdapto_Session_/Adapto_Session_atkAdapto_Session_/Adapto_Session_licensingAdapto_Session_ Adapto_Session_ATKAdapto_Session_ Adapto_Session_OpenAdapto_Session_ Adapto_Session_SourceAdapto_Session_ Adapto_Session_LicenseAdapto_Session_
 *
 * @Adapto_Session_versionAdapto_Session_ $Adapto_Session_RevisionAdapto_Session_: Adapto_Session_6320Adapto_Session_ $
 * $Adapto_Session_IdAdapto_Session_: Adapto_Session_classAdapto_Session_.Adapto_Session_atkstateAdapto_Session_.Adapto_Session_incAdapto_Session_ Adapto_Session_6354Adapto_Session_ Adapto_Session_2009Adapto_Session_-Adapto_Session_04Adapto_Session_-Adapto_Session_15Adapto_Session_ Adapto_Session_02Adapto_Session_:Adapto_Session_41Adapto_Session_:Adapto_Session_21ZAdapto_Session_ Adapto_Session_mvdamAdapto_Session_ $
 */

/**
 * Adapto_Session_TheAdapto_Session_ Adapto_Session_atkstateAdapto_Session_ Adapto_Session_managerAdapto_Session_.
 *
 * Adapto_Session_ThisAdapto_Session_ Adapto_Session_classAdapto_Session_ Adapto_Session_isAdapto_Session_ Adapto_Session_usedAdapto_Session_ Adapto_Session_toAdapto_Session_ Adapto_Session_saveAdapto_Session_ Adapto_Session_andAdapto_Session_ Adapto_Session_retrieveAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_stateAdapto_Session_ Adapto_Session_ofAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_sectionsAdapto_Session_, Adapto_Session_butAdapto_Session_
 * Adapto_Session_inAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_futureAdapto_Session_ Adapto_Session_probablyAdapto_Session_ Adapto_Session_alsoAdapto_Session_ Adapto_Session_forAdapto_Session_ Adapto_Session_otherAdapto_Session_ Adapto_Session_stuffAdapto_Session_ (Adapto_Session_IAdapto_Session_ Adapto_Session_wantAdapto_Session_ Adapto_Session_toAdapto_Session_ Adapto_Session_moveAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_tabAdapto_Session_ Adapto_Session_stateAdapto_Session_
 * Adapto_Session_alsoAdapto_Session_ Adapto_Session_toAdapto_Session_ Adapto_Session_thisAdapto_Session_ Adapto_Session_classAdapto_Session_ Adapto_Session_laterAdapto_Session_ Adapto_Session_onAdapto_Session_). Adapto_Session_NowAdapto_Session_ Adapto_Session_stateAdapto_Session_ Adapto_Session_canAdapto_Session_ Adapto_Session_saveAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_cookieAdapto_Session_ (Adapto_Session_defaultAdapto_Session_) Adapto_Session_andAdapto_Session_ Adapto_Session_inAdapto_Session_
 * Adapto_Session_globalAdapto_Session_! Adapto_Session_sessionAdapto_Session_.
 *
 * @Adapto_Session_authorAdapto_Session_ Adapto_Session_YuryAdapto_Session_ Adapto_Session_GolovnyaAdapto_Session_ <Adapto_Session_ygolovnyaAdapto_Session_@Adapto_Session_gmainAdapto_Session_.Adapto_Session_comAdapto_Session_>
 * @Adapto_Session_packageAdapto_Session_ Adapto_Session_atkAdapto_Session_
 * @Adapto_Session_subpackageAdapto_Session_ Adapto_Session_sessionAdapto_Session_
 *
 */

Adapto_Session_classAdapto_Session_ Adapto_Session_atkStateAdapto_Session_
{

  /**
   * Adapto_Session_ThisAdapto_Session_ Adapto_Session_methodAdapto_Session_ Adapto_Session_retrievesAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_stateAdapto_Session_ Adapto_Session_valueAdapto_Session_. Adapto_Session_ThisAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_canAdapto_Session_ Adapto_Session_eitherAdapto_Session_ Adapto_Session_beAdapto_Session_ Adapto_Session_retrievedAdapto_Session_
   * Adapto_Session_fromAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_cookieAdapto_Session_ Adapto_Session_whichAdapto_Session_ Adapto_Session_isAdapto_Session_ Adapto_Session_savedAdapto_Session_ Adapto_Session_acrossAdapto_Session_ Adapto_Session_sessionsAdapto_Session_ Adapto_Session_orAdapto_Session_ Adapto_Session_fromAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_currentAdapto_Session_ Adapto_Session_sessionAdapto_Session_, 
   * Adapto_Session_dependingAdapto_Session_ Adapto_Session_whereAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_originalAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_wasAdapto_Session_ Adapto_Session_savedAdapto_Session_. Adapto_Session_SoAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_methodAdapto_Session_ Adapto_Session_firstAdapto_Session_ Adapto_Session_looksAdapto_Session_ 
   * Adapto_Session_inAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_stateAdapto_Session_ Adapto_Session_cookieAdapto_Session_ Adapto_Session_ifAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_keyAdapto_Session_ Adapto_Session_existsAdapto_Session_, Adapto_Session_ifAdapto_Session_ Adapto_Session_notAdapto_Session_ Adapto_Session_itAdapto_Session_ Adapto_Session_looksAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_sessionAdapto_Session_ Adapto_Session_andAdapto_Session_
   * Adapto_Session_ifAdapto_Session_ Adapto_Session_itAdapto_Session_ Adapto_Session_existsAdapto_Session_ Adapto_Session_returnsAdapto_Session_ Adapto_Session_itAdapto_Session_'Adapto_Session_sAdapto_Session_ Adapto_Session_valueAdapto_Session_. Adapto_Session_IfAdapto_Session_ Adapto_Session_notAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_ofAdapto_Session_ Adapto_Session_NULLAdapto_Session_ Adapto_Session_isAdapto_Session_ Adapto_Session_returnedAdapto_Session_.
   * 
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_MixedAdapto_Session_ $Adapto_Session_keyAdapto_Session_     Adapto_Session_TheAdapto_Session_ Adapto_Session_keyAdapto_Session_
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_MixedAdapto_Session_ $Adapto_Session_defaultAdapto_Session_ Adapto_Session_defaultAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_fallbackAdapto_Session_ Adapto_Session_isAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_retrievedAdapto_Session_ Adapto_Session_valueAdapto_Session_ === Adapto_Session_nullAdapto_Session_
   * 
   * @Adapto_Session_returnAdapto_Session_ Adapto_Session_mixedAdapto_Session_ Adapto_Session_TheAdapto_Session_ Adapto_Session_retrievedAdapto_Session_ Adapto_Session_valueAdapto_Session_.
   */
  Adapto_Session_publicAdapto_Session_ Adapto_Session_staticAdapto_Session_ Adapto_Session_functionAdapto_Session_ Adapto_Session_getAdapto_Session_($Adapto_Session_keyAdapto_Session_, $Adapto_Session_defaultAdapto_Session_=Adapto_Session_nullAdapto_Session_)
  {
    $Adapto_Session_keyAdapto_Session_ = Adapto_Session_selfAdapto_Session_::Adapto_Session_getKeyAdapto_Session_($Adapto_Session_keyAdapto_Session_);

    $Adapto_Session_valueAdapto_Session_ = Adapto_Session_selfAdapto_Session_::Adapto_Session__getFromCookieAdapto_Session_($Adapto_Session_keyAdapto_Session_);
    Adapto_Session_ifAdapto_Session_ ($Adapto_Session_valueAdapto_Session_ === Adapto_Session_nullAdapto_Session_)
    {
      $Adapto_Session_valueAdapto_Session_ = Adapto_Session_selfAdapto_Session_::Adapto_Session__getFromSessionAdapto_Session_($Adapto_Session_keyAdapto_Session_);
    }
    
    Adapto_Session_ifAdapto_Session_ ($Adapto_Session_valueAdapto_Session_ === Adapto_Session_nullAdapto_Session_)
    {
      $Adapto_Session_valueAdapto_Session_ = $Adapto_Session_defaultAdapto_Session_;
    }
    
    Adapto_Session_returnAdapto_Session_ $Adapto_Session_valueAdapto_Session_;
  }
  
  /**
   * Adapto_Session_GetAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_fromAdapto_Session_ Adapto_Session_cookieAdapto_Session_
   *
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_mixedAdapto_Session_ $Adapto_Session_keyAdapto_Session_ Adapto_Session_TheAdapto_Session_ Adapto_Session_keynameAdapto_Session_
   * @Adapto_Session_returnAdapto_Session_ Adapto_Session_stringAdapto_Session_ Adapto_Session_TheAdapto_Session_ Adapto_Session_valueAdapto_Session_
   */
  Adapto_Session_protectedAdapto_Session_ Adapto_Session_staticAdapto_Session_ Adapto_Session_functionAdapto_Session_ Adapto_Session__getFromCookieAdapto_Session_($Adapto_Session_keyAdapto_Session_)
  {
    Adapto_Session_ifAdapto_Session_(Adapto_Session_issetAdapto_Session_($Adapto_Session__COOKIEAdapto_Session_[$Adapto_Session_keyAdapto_Session_]))
    {
      Adapto_Session_returnAdapto_Session_ $Adapto_Session__COOKIEAdapto_Session_[$Adapto_Session_keyAdapto_Session_];
    }
    Adapto_Session_elseAdapto_Session_
    {
      Adapto_Session_returnAdapto_Session_ Adapto_Session_nullAdapto_Session_;
    }
  }
  
  /**
   * Adapto_Session_GetAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_fromAdapto_Session_ Adapto_Session_sessionAdapto_Session_
   *
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_mixedAdapto_Session_ $Adapto_Session_keyAdapto_Session_ Adapto_Session_TheAdapto_Session_ Adapto_Session_keynameAdapto_Session_
   * @Adapto_Session_returnAdapto_Session_ Adapto_Session_stringAdapto_Session_ Adapto_Session_TheAdapto_Session_ Adapto_Session_valueAdapto_Session_
   */
  Adapto_Session_protectedAdapto_Session_ Adapto_Session_staticAdapto_Session_ Adapto_Session_functionAdapto_Session_ Adapto_Session__getFromSessionAdapto_Session_($Adapto_Session_keyAdapto_Session_)
  {
    Adapto_Session_ifAdapto_Session_(Adapto_Session_issetAdapto_Session_($Adapto_Session__SESSIONAdapto_Session_[$Adapto_Session_keyAdapto_Session_]))
    {
      Adapto_Session_returnAdapto_Session_ $Adapto_Session__SESSIONAdapto_Session_[$Adapto_Session_keyAdapto_Session_];
    }
    Adapto_Session_elseAdapto_Session_ 
    {
      Adapto_Session_returnAdapto_Session_ Adapto_Session_nullAdapto_Session_;
    }
  }
  /**
   * Adapto_Session_ThisAdapto_Session_ Adapto_Session_methodAdapto_Session_ Adapto_Session_setsAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_stateAdapto_Session_ Adapto_Session_valueAdapto_Session_. Adapto_Session_AAdapto_Session_ Adapto_Session_stateAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_canAdapto_Session_ Adapto_Session_eitherAdapto_Session_ Adapto_Session_beAdapto_Session_ Adapto_Session_savedAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_theAdapto_Session_
   * Adapto_Session_currentAdapto_Session_ Adapto_Session_userAdapto_Session_'Adapto_Session_sAdapto_Session_ Adapto_Session_sessionAdapto_Session_ (Adapto_Session_inAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_globalAdapto_Session_ Adapto_Session_sessionAdapto_Session_, Adapto_Session_soAdapto_Session_ Adapto_Session_notAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_specificAdapto_Session_ Adapto_Session_stackAdapto_Session_!)
   * Adapto_Session_orAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_cookieAdapto_Session_ (Adapto_Session_byAdapto_Session_ Adapto_Session_defaultAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_cookieAdapto_Session_), Adapto_Session_theAdapto_Session_ Adapto_Session_atkAdapto_Session_ Adapto_Session_stateAdapto_Session_ Adapto_Session_cookieAdapto_Session_. Adapto_Session_WhateverAdapto_Session_
   * Adapto_Session_mechanismAdapto_Session_ Adapto_Session_isAdapto_Session_ Adapto_Session_usedAdapto_Session_ Adapto_Session_dependsAdapto_Session_ Adapto_Session_onAdapto_Session_ Adapto_Session_theAdapto_Session_ $Adapto_Session_typeAdapto_Session_ Adapto_Session_parameterAdapto_Session_. Adapto_Session_TheAdapto_Session_ Adapto_Session_keyAdapto_Session_ Adapto_Session_doesnAdapto_Session_'Adapto_Session_tAdapto_Session_ Adapto_Session_necessarilyAdapto_Session_
   * Adapto_Session_haveAdapto_Session_ Adapto_Session_toAdapto_Session_ Adapto_Session_beAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_stringAdapto_Session_ (Adapto_Session_thisAdapto_Session_ Adapto_Session_isAdapto_Session_ Adapto_Session_alsoAdapto_Session_ Adapto_Session_trueAdapto_Session_ Adapto_Session_forAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_getAdapto_Session_ Adapto_Session_methodAdapto_Session_). Adapto_Session_ThisAdapto_Session_ Adapto_Session_meansAdapto_Session_ Adapto_Session_thatAdapto_Session_
   * Adapto_Session_ifAdapto_Session_ Adapto_Session_youAdapto_Session_ Adapto_Session_getAdapto_Session_ Adapto_Session_anAdapto_Session_ Adapto_Session_arrayAdapto_Session_ Adapto_Session_asAdapto_Session_ Adapto_Session_keyAdapto_Session_ Adapto_Session_youAdapto_Session_ Adapto_Session_probablyAdapto_Session_ Adapto_Session_haveAdapto_Session_ Adapto_Session_toAdapto_Session_ Adapto_Session_flattenAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_keyAdapto_Session_ Adapto_Session_toAdapto_Session_ Adapto_Session_somethingAdapto_Session_
   * Adapto_Session_usefulAdapto_Session_ Adapto_Session_becauseAdapto_Session_ Adapto_Session_ifAdapto_Session_ Adapto_Session_youAdapto_Session_ Adapto_Session_wantAdapto_Session_ Adapto_Session_toAdapto_Session_ Adapto_Session_saveAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_sessionAdapto_Session_ Adapto_Session_orAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_cookieAdapto_Session_
   * Adapto_Session_theAdapto_Session_ Adapto_Session_keyAdapto_Session_ Adapto_Session_needsAdapto_Session_ Adapto_Session_toAdapto_Session_ Adapto_Session_beAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_simpleAdapto_Session_ Adapto_Session_stringAdapto_Session_. Adapto_Session_YouAdapto_Session_ Adapto_Session_couldAdapto_Session_ Adapto_Session_useAdapto_Session_, Adapto_Session_forAdapto_Session_ Adapto_Session_exampleAdapto_Session_ 
   * Adapto_Session_print_rAdapto_Session_($Adapto_Session_keyAdapto_Session_, Adapto_Session_trueAdapto_Session_) Adapto_Session_toAdapto_Session_ Adapto_Session_getAdapto_Session_ Adapto_Session_aAdapto_Session_ Adapto_Session_niceAdapto_Session_ Adapto_Session_stringAdapto_Session_ Adapto_Session_representationAdapto_Session_. Adapto_Session_ForAdapto_Session_ Adapto_Session_cookiesAdapto_Session_ Adapto_Session_itAdapto_Session_ Adapto_Session_mightAdapto_Session_
   * Adapto_Session_beAdapto_Session_ Adapto_Session_evenAdapto_Session_ Adapto_Session_moreAdapto_Session_ Adapto_Session_safeAdapto_Session_ Adapto_Session_toAdapto_Session_ Adapto_Session_md5Adapto_Session_ Adapto_Session_thisAdapto_Session_ Adapto_Session_stringAdapto_Session_ Adapto_Session_soAdapto_Session_ Adapto_Session_thatAdapto_Session_ Adapto_Session_theyAdapto_Session_ Adapto_Session_keyAdapto_Session_ Adapto_Session_doesnAdapto_Session_'Adapto_Session_tAdapto_Session_ Adapto_Session_sayAdapto_Session_ Adapto_Session_anythingAdapto_Session_ Adapto_Session_toAdapto_Session_
   * Adapto_Session_theAdapto_Session_ Adapto_Session_userAdapto_Session_ Adapto_Session_andAdapto_Session_ Adapto_Session_doesnAdapto_Session_'Adapto_Session_tAdapto_Session_ Adapto_Session_getAdapto_Session_ Adapto_Session_tooAdapto_Session_ Adapto_Session_bigAdapto_Session_.
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_mixedAdapto_Session_ $Adapto_Session_keyAdapto_Session_ Adapto_Session_TheAdapto_Session_ Adapto_Session_keyAdapto_Session_ Adapto_Session_nameAdapto_Session_
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_StringAdapto_Session_ $Adapto_Session_valueAdapto_Session_ Adapto_Session_TheAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_ofAdapto_Session_ Adapto_Session_keyAdapto_Session_
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_StringAdapto_Session_ $Adapto_Session_typeAdapto_Session_ Adapto_Session_TheAdapto_Session_ Adapto_Session_namespaceAdapto_Session_ Adapto_Session_fromAdapto_Session_ Adapto_Session_whichAdapto_Session_ Adapto_Session_toAdapto_Session_ Adapto_Session_retrieveAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_valueAdapto_Session_
   * @Adapto_Session_returnAdapto_Session_ Adapto_Session_mixedAdapto_Session_ Adapto_Session_TheAdapto_Session_ Adapto_Session_storageAdapto_Session_ Adapto_Session_methodAdapto_Session_ Adapto_Session_typeAdapto_Session_.
   */
  Adapto_Session_publicAdapto_Session_ Adapto_Session_staticAdapto_Session_ Adapto_Session_functionAdapto_Session_ Adapto_Session_setAdapto_Session_($Adapto_Session_keyAdapto_Session_, $Adapto_Session_valueAdapto_Session_, $Adapto_Session_typeAdapto_Session_='Adapto_Session_cookieAdapto_Session_')
  {
    $Adapto_Session_keyAdapto_Session_ = Adapto_Session_atkStateAdapto_Session_::Adapto_Session_getKeyAdapto_Session_($Adapto_Session_keyAdapto_Session_);

    Adapto_Session_switchAdapto_Session_($Adapto_Session_typeAdapto_Session_)
    {
      Adapto_Session_caseAdapto_Session_ 'Adapto_Session_cookieAdapto_Session_':
        Adapto_Session_selfAdapto_Session_::Adapto_Session__set_using_cookieAdapto_Session_($Adapto_Session_keyAdapto_Session_,$Adapto_Session_valueAdapto_Session_);
        Adapto_Session_breakAdapto_Session_;
      Adapto_Session_caseAdapto_Session_ 'Adapto_Session_sessionAdapto_Session_':
        Adapto_Session_selfAdapto_Session_::Adapto_Session__set_using_sessionAdapto_Session_($Adapto_Session_keyAdapto_Session_,$Adapto_Session_valueAdapto_Session_);
        Adapto_Session_breakAdapto_Session_;
      Adapto_Session_defaultAdapto_Session_:
        Adapto_Session_atkerrorAdapto_Session_("Adapto_Session_setAdapto_Session_ Adapto_Session_methodAdapto_Session_ Adapto_Session_donAdapto_Session_'Adapto_Session_tAdapto_Session_ Adapto_Session_existsAdapto_Session_");
    }
  }
  
  /**
   * Adapto_Session_SetAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_cookieAdapto_Session_
   *
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_mixedAdapto_Session_ $Adapto_Session_keyAdapto_Session_
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_stringAdapto_Session_ $Adapto_Session_valueAdapto_Session_
   */
  Adapto_Session_protectedAdapto_Session_ Adapto_Session_staticAdapto_Session_ Adapto_Session_functionAdapto_Session_ Adapto_Session__set_using_cookieAdapto_Session_($Adapto_Session_keyAdapto_Session_,$Adapto_Session_valueAdapto_Session_)
  {
    Adapto_Session_setcookieAdapto_Session_($Adapto_Session_keyAdapto_Session_, $Adapto_Session_valueAdapto_Session_, Adapto_Session_timeAdapto_Session_()+Adapto_Session_60Adapto_Session_*(Adapto_Session_atkconfigAdapto_Session_("Adapto_Session_state_cookie_expireAdapto_Session_")));
  }

  /**
   * Adapto_Session_SetAdapto_Session_ Adapto_Session_valueAdapto_Session_ Adapto_Session_inAdapto_Session_ Adapto_Session_sessionAdapto_Session_
   *
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_mixedAdapto_Session_ $Adapto_Session_keyAdapto_Session_
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_stringAdapto_Session_ $Adapto_Session_valueAdapto_Session_
   */
  Adapto_Session_protectedAdapto_Session_ Adapto_Session_staticAdapto_Session_ Adapto_Session_functionAdapto_Session_ Adapto_Session__set_using_sessionAdapto_Session_($Adapto_Session_keyAdapto_Session_,$Adapto_Session_valueAdapto_Session_)
  {
    $Adapto_Session__SESSIONAdapto_Session_[$Adapto_Session_keyAdapto_Session_] = $Adapto_Session_valueAdapto_Session_;
  }
  
  /**
   * Adapto_Session_GetAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_keyAdapto_Session_
   *
   * @Adapto_Session_paramAdapto_Session_ Adapto_Session_stringAdapto_Session_ $Adapto_Session_keyAdapto_Session_
   * @Adapto_Session_returnAdapto_Session_ Adapto_Session_stringAdapto_Session_ Adapto_Session_AnAdapto_Session_ Adapto_Session_md5Adapto_Session_ Adapto_Session_hashAdapto_Session_ Adapto_Session_ofAdapto_Session_ Adapto_Session_theAdapto_Session_ Adapto_Session_keyAdapto_Session_
   */
  Adapto_Session_protectedAdapto_Session_ Adapto_Session_staticAdapto_Session_ Adapto_Session_functionAdapto_Session_ Adapto_Session_getKeyAdapto_Session_($Adapto_Session_keyAdapto_Session_)
  {
    Adapto_Session_returnAdapto_Session_ Adapto_Session_md5Adapto_Session_(Adapto_Session_print_rAdapto_Session_($Adapto_Session_keyAdapto_Session_,Adapto_Session_trueAdapto_Session_));
  }
}
?>