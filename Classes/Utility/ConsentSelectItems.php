<?php

namespace MEDIENGARAGE\Piwikconsentmanager\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class ConsentSelectItems
{
    /**
     *
     *
     * @param array $configuration Current field configuration
     * @throws InvalidConfigurationTypeException
     */
    public function getConsentSelectItems(array &$configuration)
    {
        $configuration['items'] = [];

        $label = LocalizationUtility::translate(
            'choose_consent_type',
            'piwik_consent_manager'
        );
        $configuration['items'][] = [$label, '0'];

        $configurationManager = GeneralUtility::makeInstance(ConfigurationManager::class);
        $settings = $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT
        );

        $consentsAvailable = GeneralUtility::trimExplode(
            ',',
            $settings['plugin.']['tx_piwik_consent_manager.']['settings.']['consentsAvailable']
        );

        foreach ($consentsAvailable as $consent) {
            $label = LocalizationUtility::translate(
                'consent_type_' . $consent,
                'piwik_consent_manager'
            );

            $configuration['items'][] = [$label ?? $consent, $consent];
        }
    }
}