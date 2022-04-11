<?php

namespace MEDIENGARAGE\Piwikconsentmanager\Context;

use TYPO3\CMS\Core\Context\AspectInterface;
use TYPO3\CMS\Core\Context\Exception\AspectPropertyNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * The aspect contains information about a visitor's data privacy consents
 */
class ConsentAspect implements AspectInterface
{
    /**
     * @var array<bool>
     */
    protected $consents = [];

    /**
     * @param array $consents
     */
    public function __construct(array $consents = [])
    {
        $configurationManager = GeneralUtility::makeInstance(ConfigurationManager::class);
        $settings = $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'piwik_consent_manager'
        );

        $consentsAvailable = GeneralUtility::trimExplode(',', $settings['consentsAvailable']);

        foreach ($consentsAvailable as $consent) {
            // TODO: Instead of not equals -1 better equals 1 or whatever positiv value is
            $this->consents[$consent] = !empty($consents[$consent]) && $consents[$consent]['status'] !== -1;
        }
    }

    /**
     * Fetch status of different consents.
     *
     * @param string $name
     * @return bool
     * @throws AspectPropertyNotFoundException
     */
    public function get(string $name): bool
    {
        if (array_key_exists($name, $this->consents)) {
            return $this->consents[$name];
        }

        throw new AspectPropertyNotFoundException('Property "' . $name . '" not found in Aspect "' . __CLASS__ . '".', 1529996567);
    }
}
