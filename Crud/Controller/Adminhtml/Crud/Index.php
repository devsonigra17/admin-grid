<?php

namespace Dev\Crud\Controller\Adminhtml\Crud;

class Index extends \Magento\Framework\App\Action\Action
{

     protected $resultPageFactory;
     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $resultPageFactory
     ) {
          $this->resultPageFactory = $resultPageFactory;
          parent::__construct($context);
     }

     public function execute()
     {
     return $this->resultPageFactory->create();
     }
     protected function _isAllowed()
     {
          return $this->_authorization->isAllowed('Dev_Crud::masscancel');
     }
}