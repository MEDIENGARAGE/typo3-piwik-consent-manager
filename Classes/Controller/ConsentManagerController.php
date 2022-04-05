<?php

namespace MEDIENGARAGE\Piwikconsentmanager\Controller;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

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

class ConsentManagerController extends ActionController {

    public static $CM_KEY = 'consentManagerKey';

    public function consentManagerAction() {
        $extensionConfiguration = GeneralUtility::makeInstance(ExtensionConfiguration::class)
            ->get('piwik_consent_manager');

        $this->view->assign(self::$CM_KEY, $extensionConfiguration[self::$CM_KEY]);
    }
}
