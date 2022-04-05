<?php
/**
 * An array consisting of implementations of middlewares for a middleware stack to be registered
 *
 *  'stackname' => [
 *      'middleware-identifier' => [
 *         'target' => classname or callable
 *         'before/after' => array of dependencies
 *      ]
 *   ]
 */
return [
    'backend' => [
        'mediengarage/consent/set' => [
            'target' => \MEDIENGARAGE\Piwikconsentmanager\Middleware\SetConsents::class,
//            'before' => [
//                'typo3/cms-frontend/authentication',
//            ],
            'after' => [
                'typo3/cms-backend/site-resolver',
            ],
        ],
    ]
];