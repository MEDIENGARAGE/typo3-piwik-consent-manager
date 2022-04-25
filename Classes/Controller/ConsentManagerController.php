<?php

namespace MEDIENGARAGE\Piwikconsentmanager\Controller;

use Doctrine\DBAL\Connection as ConnectionAlias;
use Doctrine\DBAL\Driver\Statement;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationExtensionNotConfiguredException;
use TYPO3\CMS\Core\Configuration\Exception\ExtensionConfigurationPathDoesNotExistException;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Database\Connection;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
class ConsentManagerController extends ActionController
{
    public static $CM_KEY = 'consentManagerKey';
    public static $ASPECT_NAME = 'piwik.consent';

    // Keys are content types and values are templates.
    private $cTypeToTemplateMapping = [
        'piwikconsentmanager_youtube' => 'YouTube'
    ];

    /**
     * Displays the consent manager.
     *
     * @return void
     * @throws ExtensionConfigurationExtensionNotConfiguredException
     * @throws ExtensionConfigurationPathDoesNotExistException
     */
    public function consentManagerAction()
    {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)
            ->get('piwik_consent_manager');

        $this->view->assign(self::$CM_KEY, $extensionConfiguration[self::$CM_KEY]);
    }

    /**
     * @return false|string
     */
    public function privacyContentElementsAction()
    {
        $pageId = $GLOBALS['TSFE']->id;

        /** @var QueryBuilder $qb */
        $qb = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('tt_content');

        /** @var Statement $statement */
        $statement = $qb->select('*')
            ->from('tt_content')
            ->where(
                $qb->expr()->andX(
                    $qb->expr()
                        ->eq('pid', $qb->createNamedParameter($pageId, Connection::PARAM_INT)),
                    $qb->expr()
                        ->in('CType', $qb->createNamedParameter(
                            array_keys($this->cTypeToTemplateMapping),
                            ConnectionAlias::PARAM_STR_ARRAY)
                        )
                )
            )
            ->execute();

        $renderedCes = [];

        foreach ($statement->fetchAll() as $ce) {
            /** @var StandaloneView $view */
            $view = GeneralUtility::makeInstance(StandaloneView::class);

            $view->setLayoutRootPaths([GeneralUtility::getFileAbsFileName('EXT:piwik_consent_manager/Resources/Private/Layouts')]);
            $view->setPartialRootPaths([GeneralUtility::getFileAbsFileName('EXT:piwik_consent_manager/Resources/Private/Partials')]);
            $view->setTemplateRootPaths([GeneralUtility::getFileAbsFileName('EXT:piwik_consent_manager/Resources/Private/Templates')]);
            // TODO: template must be dynamic.
            $view->setTemplate('YouTube.html');

            $view->assign('data', $ce);

            // Push rendered content element.
            $renderedCes[] = trim($view->render());
        }

        return json_encode($renderedCes);
    }
}
