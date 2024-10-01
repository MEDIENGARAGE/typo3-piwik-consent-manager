<?php

namespace MEDIENGARAGE\Piwikconsentmanager\Context;

use TYPO3\CMS\Core\Context\AspectInterface;
use TYPO3\CMS\Core\Context\Exception\AspectPropertyNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException;

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
     * @throws InvalidConfigurationTypeException
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
            $this->consents[$consent] = !empty($consents[$consent]) && $consents[$consent]['status'] === 1;
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

        throw new AspectPropertyNotFoundException('Property "' . $name . '" not found in Aspect "' . self::class . '".', 1529996567);
    }
}
