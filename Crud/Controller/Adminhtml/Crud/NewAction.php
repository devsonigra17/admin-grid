<?php
namespace Dev\Crud\Controller\Adminhtml\Crud;

class NewAction extends \Magento\Backend\App\Action
{
    protected $resultForwardFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Dev_Crud::save');
	}

    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('add');
    }
}
