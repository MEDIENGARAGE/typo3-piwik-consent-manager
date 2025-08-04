<?php

namespace MEDIENGARAGE\Piwikconsentmanager\Middleware;

use MEDIENGARAGE\Piwikconsentmanager\Controller\ConsentManagerController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use MEDIENGARAGE\Piwikconsentmanager\Context\ConsentAspect;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * Middleware to add consent cookie information into TYPO3 context in order to make it available for views.
 */
class SetConsents implements MiddlewareInterface
{
    /**
     * Get consent information from Cookie.
     *
     * @param ServerRequestInterface  $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(ConfigurationManager::class);
        $extensionConfiguration = $configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);
        $settings = $extensionConfiguration['plugin.']['tx_piwik_consent_manager.']['settings.'];

        $cookies = $request->getCookieParams();
        $cookieName = 'ppms_privacy_' . $settings[ConsentManagerController::$CM_KEY];

        $context = GeneralUtility::makeInstance(Context::class);

        if (array_key_exists($cookieName, $cookies)) {
            $cookieData = json_decode((string) $cookies[$cookieName], true);
            $consents = $cookieData['consents'];

            // Temporarily store consent information in context so views can read it for conditional rendering.
            $context->setAspect(
                ConsentManagerController::$ASPECT_NAME,
                GeneralUtility::makeInstance(ConsentAspect::class, $consents)
            );
        } else {
            // If no cookie was sent, set all consents to false.
            $context->setAspect(
                ConsentManagerController::$ASPECT_NAME,
                GeneralUtility::makeInstance(ConsentAspect::class, [])
            );
        }

        return $handler->handle($request);
    }
}