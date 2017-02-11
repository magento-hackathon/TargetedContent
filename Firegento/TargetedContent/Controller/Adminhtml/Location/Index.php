<?php
namespace Firegento\TargetedContent\Controller\Adminhtml\Location;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Firegento_TargetedContent::location';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Firegento_TargetedContent::location');
        $resultPage->addBreadcrumb(__('Targeted Content'), __('Preferred Locations'));
        $resultPage->addBreadcrumb(__('Preferred Locations'), __('Preferred Locations'));
        $resultPage->getConfig()->getTitle()->prepend(__('Preferred Locations'));

        $dataPersistor = $this->_objectManager->get('Magento\Framework\App\Request\DataPersistorInterface');
        $dataPersistor->clear('firgento_targetedcontent_location');

        return $resultPage;
    }
}
