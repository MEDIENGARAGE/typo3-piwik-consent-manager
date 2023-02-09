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
     * [ConsentAspect('PIWIK_TAG_NAME','PIWIK_KEY')]
     * Example [ConsentAspect('custom_consent','f93b6a45-0815-1337-0815-1337a19a0995')]
     * @return ExpressionFunction
     */
    protected function getConsentAspect(): ExpressionFunction
    {
        return new ExpressionFunction('ConsentAspect', function () {
            // Not implemented, we only use the evaluator
        }, function (array $arguments, string $consentType, string $key) {
            $cookieName = 'ppms_privacy_' . $key;
            $cookies = $arguments['request']->getCookieParams();
            if(empty($cookies)) {
                return false;
            }
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