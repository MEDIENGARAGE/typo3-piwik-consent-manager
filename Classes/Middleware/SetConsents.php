<?php

namespace MEDIENGARAGE\Piwikconsentmanager\Middleware;

use MEDIENGARAGE\Piwikconsentmanager\Controller\ConsentManagerController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use MEDIENGARAGE\Piwikconsentmanager\Context\ConsentAspect;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
     * @throws ExtensionConfigurationExtensionNotConfiguredException
     * @throws ExtensionConfigurationPathDoesNotExistException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)
            ->get('piwik_consent_manager');

        $cookies = $request->getCookieParams();
        $cookieName = 'ppms_privacy_' . $extensionConfiguration[ConsentManagerController::$CM_KEY];

        $context = GeneralUtility::makeInstance(Context::class);

        if (array_key_exists($cookieName, $cookies)) {
            $cookieData = json_decode($cookies[$cookieName], true);
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