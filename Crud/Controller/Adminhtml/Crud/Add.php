<?php

namespace Dev\Crud\Controller\Adminhtml\Crud;

use Magento\Backend\App\Action;

class Add extends \Magento\Backend\App\Action
{
    protected $_coreRegistry;

    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }
    protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Dev_Crud::index');
	}

    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $model = $this->_objectManager->create(\Dev\Crud\Model\Custom::class);

        if ($id) 
        {
            $model->load($id);

            if (!$model->getId()) 
            {
                $this->messageManager->addError(__('This row no longer exists.'));
    
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('crud_crud', $model);

        $resultPage = $this->_initAction();

        $resultPage->getConfig()->getTitle()->prepend(__('Crud'));
        $resultPage->getConfig()->getTitle()
            ->prepend($id ? __('Edit Row'): __('Add Row'));

        return $resultPage;
    }
}
