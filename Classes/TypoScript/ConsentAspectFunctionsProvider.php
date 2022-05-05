<?php

namespace MEDIENGARAGE\Piwikconsentmanager\TypoScript;

use MEDIENGARAGE\Piwikconsentmanager\Controller\ConsentManagerController;
use Symfony\Component\ExpressionLanguage\ExpressionFunction;
use Symfony\Component\ExpressionLanguage\ExpressionFunctionProviderInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ConsentAspectFunctionsProvider implements ExpressionFunctionProviderInterface
{
    public function getFunctions()
    {
        return [
            $this->getConsentAspect(),
        ];
    }

    /**
     * Allowed consent
     * Example [ConsentAspect('custom_consent')]
     * @return ExpressionFunction
     */
    protected function getConsentAspect(): ExpressionFunction
    {
        return new ExpressionFunction('ConsentAspect', function () {
            // Not implemented, we only use the evaluator
        }, function (array $arguments, string $consentType) {
            $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)
                ->get('piwik_consent_manager');
            $cookieName = 'ppms_privacy_' . $extensionConfiguration[ConsentManagerController::$CM_KEY];
            $cookies = $arguments['request']->getCookieParams();
            if (array_key_exists($cookieName, $cookies)) {
                $cookieData = json_decode($cookies[$cookieName], true);
                if ($cookieData['consents'][$consentType]['status'] === 1) {
                    return true;
                }
            }
            return false;
        });
    }
}