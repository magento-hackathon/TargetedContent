<?php

namespace Firegento\TargetedContent\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $interface, ModuleContextInterface $context)
    {

        if (version_compare($context->getVersion(), '1.1.0') < 0) {
            $interface->startSetup();


            $interface->getConnection()->addColumn(
                $interface->getTable('cms_block'),
                'location_id',
                array(
                    'type' => Table::TYPE_INTEGER,
                    'nullable' => true,
                    'comment' => 'Location ID'
                )
            );

            $interface->endSetup();
        }
    }
}