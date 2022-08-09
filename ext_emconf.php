<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 PIWIK Consent Manager',
    'description' => '',
    'category' => 'plugin',
    'author' => 'Florian Fassing',
    'author_email' => 'ffassing@mediengarage.de',
    'state' => 'beta',
    'clearCacheOnLoad' => 0,
    'version' => '0.2.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
