<?php
if (!defined('TYPO3')) {
    die('Access denied.');
}

// TODO: remove from non-cachable?
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'PiwikConsentManager',
    'Pi1',
    [\MEDIENGARAGE\Piwikconsentmanager\Controller\ConsentManagerController::class => 'consentManager, privacyContentElements'],
    // non-cacheable actions
    [\MEDIENGARAGE\Piwikconsentmanager\Controller\ConsentManagerController::class => 'consentManager, privacyContentElements'],
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

