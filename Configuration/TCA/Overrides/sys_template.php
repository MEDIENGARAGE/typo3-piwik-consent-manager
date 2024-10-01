<?php
defined('TYPO3') || die();

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'piwik_consent_manager',
    'Configuration/TypoScript',
    'TYPO3 PIWIK Consent Manager'
);

// Content Elements
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    'piwik_consent_manager',
    'Configuration/TsConfig/Page/All.tsconfig',
    'PIWIK Consent Manager Content Elements'
);