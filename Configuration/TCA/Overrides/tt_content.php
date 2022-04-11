<?php

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
    'tt_content',
    'CType',
    [
        'LLL:EXT:piwik_consent_manager/Resources/Private/Language/locallang.xlf:piwikconsentmanager_youtube',
        'piwikconsentmanager_youtube',
        'content-image',
    ],
    'textmedia',
    'after'
);

$GLOBALS['TCA']['tt_content']['types']['piwikconsentmanager_youtube'] = [
    'columnsOverrides' => [
        'bullets_type' => [
            'label' => 'LLL:EXT:piwik_consent_manager/Resources/Private/Language/locallang.xlf:consent_type',
            'config' => [
                'itemsProcFunc' => MEDIENGARAGE\Piwikconsentmanager\Utility\ConsentSelectItems::class . '->getConsentSelectItems',
                'default' => 'custom_consent'
            ]
        ],
    ],
    'showitem' => '
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
            bullets_type,
            --palette--;;general,
            bodytext;LLL:EXT:piwik_consent_manager/Resources/Private/Language/locallang.xlf:youtube_embed_label,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
            --palette--;;language,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
            --palette--;;hidden,
            --palette--;;access,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
            categories,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
            rowDescription,
        --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
    '
];
