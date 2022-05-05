<?php

namespace MEDIENGARAGE\Piwikconsentmanager\ExpressionLanguage;

use MEDIENGARAGE\Piwikconsentmanager\TypoScript\ConsentAspectFunctionsProvider;
use TYPO3\CMS\Core\ExpressionLanguage\AbstractProvider;

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
    public function __construct()
    {
        $this->expressionLanguageProviders = [
            \MEDIENGARAGE\Piwikconsentmanager\TypoScript\ConsentAspectFunctionsProvider::class,
        ];
    }
}