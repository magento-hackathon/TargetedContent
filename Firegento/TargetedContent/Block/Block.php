<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

namespace Firegento\TargetedContent\Block;

/**
 * Cms block content block
 */
class Block extends \Magento\Cms\Block\Block
{
    /**
     * Prepare Content HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $blockId = $this->getBlockId();
        $html = '';
        if ($blockId) {
            $storeId = $this->_storeManager->getStore()->getId();
            /** @var \Magento\Cms\Model\Block $block */
            $block = $this->_blockFactory->create();
            $currentBlock = $block->load($blockId);
            $locationId = $currentBlock->getData('location_id');
            if($locationId == 2) {
                $block->setStoreId($storeId)->load($blockId);
                if ($block->isActive()) {
                    $html = $this->_filterProvider->getBlockFilter()->setStoreId($storeId)->filter($block->getContent());
                }
            }

        }
        return $html;
    }

}