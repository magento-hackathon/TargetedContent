<?php

namespace Firegento\TargetedContent\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\DB\Ddl\Table;
use Zend\Log\Logger;

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

        if (version_compare($context->getVersion(), '1.2.0') < 0) {
            $interface->startSetup();

            $interface->getConnection()->addColumn(
                $interface->getTable('cms_page'),
                'location_id',
                array(
                    'type' => Table::TYPE_INTEGER,
                    'nullable' => true,
                    'comment' => 'Location ID'
                )
            );

            $interface->endSetup();
        }

        if (version_compare($context->getVersion(), '1.3.2') < 0) {
            $interface->startSetup();


            /**
             * Create table 'firegento_targeted_content_locations'
             */
            $table = $interface->getConnection()->newTable(
                $interface->getTable('firegento_targeted_content_locations')
            )->addColumn(
                'location_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Location ID'
            )->addColumn(
                'address',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Address'
            )->addColumn(
                'lat',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Latitude'
            )->addColumn(
                'lon',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Longitude'
            )->addColumn(
                'creation_time',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default'  => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT
                ],
                'Location Creation Time'
            )->addColumn(
                'update_time',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                [
                    'nullable' => false,
                    'default'  => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE
                ],
                'Location Modification Time'
            )->addColumn(
                'is_active',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Is Active'
            )->addColumn(
                'radius',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false],
                'Radius in km'
            )->setComment(
                'Targeted Content Location Table'
            );

            $interface->getConnection()->createTable($table);
            $interface->endSetup();
        }
    }
}