<?php

namespace MEDIENGARAGE\Piwikconsentmanager\ExpressionLanguage;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\ExpressionLanguage\AbstractProvider;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException;

/**
 * Use like this:
 *
 * [custom_consent === 1]
 * # Evaluated when custom consent was accepted.
 * [GLOBAL]
 *
 * [analytics === 0]
 * # Evaluated when analytics consent was declined.
 * [GLOBAL]
 *
 * Check consentsAvailable in ext_typoscript_setup.typoscript for all available consent types.
 * Official documentation:
 * https://docs.typo3.org/m/typo3/reference-coreapi/10.4/en-us/ApiOverview/SymfonyExpressionLanguage/Index.html#sel-within-typoscript-conditions
 */
class ConsentAspectConditionProvider extends AbstractProvider
{
    /**
     * @throws InvalidConfigurationTypeException
     * @throws AspectNotFoundException
     */
    public function __construct()
    {
        $configurationManager = GeneralUtility::makeInstance(ConfigurationManager::class);
        $settings = $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'piwik_consent_manager'
        );

        $consentsAvailable = GeneralUtility::trimExplode(',', $settings['consentsAvailable']);
        $context = GeneralUtility::makeInstance(Context::class);
        $this->expressionLanguageVariables = [];

        if (!$context->hasAspect('piwik.consent')) return;

        foreach ($consentsAvailable as $consentType) {
            $value = $context->getPropertyFromAspect('piwik.consent', $consentType);
            $this->expressionLanguageVariables[$consentType] = $value;
        }
    }
}