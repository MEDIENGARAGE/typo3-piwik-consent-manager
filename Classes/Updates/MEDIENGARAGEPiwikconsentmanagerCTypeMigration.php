<?php

declare(strict_types=1);

namespace MEDIENGARAGE\Piwikconsentmanager\Updates;

use TYPO3\CMS\Install\Attribute\UpgradeWizard;
use TYPO3\CMS\Install\Updates\AbstractListTypeToCTypeUpdate;

#[UpgradeWizard('mediengaragePiwikconsentmanagerCTypeMigration')]
final class MEDIENGARAGEPiwikconsentmanagerCTypeMigration extends AbstractListTypeToCTypeUpdate
{
    public function getTitle(): string
    {
        return 'Migrate "MEDIENGARAGE Piwikconsentmanager" plugins to content elements.';
    }

    public function getDescription(): string
    {
        return 'The "MEDIENGARAGE Piwikconsentmanager" plugins are now registered as content element. Update migrates existing records and backend user permissions.';
    }

    /**
     * This must return an array containing the "list_type" to "CType" mapping
     *
     *  Example:
     *
     *  [
     *      'pi_plugin1' => 'pi_plugin1',
     *      'pi_plugin2' => 'new_content_element',
     *  ]
     *
     * @return array<string, string>
     */
    protected function getListTypeToCTypeMapping(): array
    {
        return [
            // TODO: Add this mapping yourself!
        ];
    }
}
