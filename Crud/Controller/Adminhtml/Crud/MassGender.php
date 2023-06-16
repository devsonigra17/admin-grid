<?php

namespace Dev\Crud\Controller\Adminhtml\Crud;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Dev\Crud\Model\ResourceModel\Custom\CollectionFactory;

class MassGender extends \Magento\Backend\App\Action
{
    protected $_filter;

    protected $_collectionFactory;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {

        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->_filter->getCollection($this->_collectionFactory->create());
        $countChangeGender = 0;
        foreach ($collection as $record) {
            $record->setGender($this->getRequest()->getParam('gender'))->save();
            $countChangeGender++;
        }
 
        if ($countChangeGender) {
            $this->messageManager->addSuccess(__('A total of %1 record(s) were updated.', $countChangeGender));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('*/*/index');
 
        return $resultRedirect;
    }

    /**
     * Check Category Map recode delete Permission.
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dev_Crud::row_data_gender');
    }
}
