<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

// TODO: remove from non-cachable
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'PiwikConsentManager',
    'PiwikConsentManager',
    array(
        \MEDIENGARAGE\Piwikconsentmanager\Controller\ConsentManagerController::class => 'consentManager',
    ),
    // non-cacheable actions
    array(
        \MEDIENGARAGE\Piwikconsentmanager\Controller\ConsentManagerController::class => 'consentManager',
    )
);