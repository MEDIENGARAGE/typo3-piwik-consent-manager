<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// TODO: remove from non-cachable?
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'PiwikConsentManager',
    'Pi1',
    array(
        \MEDIENGARAGE\Piwikconsentmanager\Controller\ConsentManagerController::class => 'consentManager, privacyContentElements',
    ),
    // non-cacheable actions
    array(
        \MEDIENGARAGE\Piwikconsentmanager\Controller\ConsentManagerController::class => 'consentManager, privacyContentElements'
    )
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:piwik_consent_manager/Configuration/TsConfig/Page/ContentElement/All.tsconfig">'
);
