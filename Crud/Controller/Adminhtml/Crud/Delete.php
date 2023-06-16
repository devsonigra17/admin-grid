<?php

namespace Dev\Crud\Controller\Adminhtml\Crud;

class Delete extends \Magento\Backend\App\Action
{
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        // print_r($id);exit;
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                $model = $this->_objectManager->create(\Dev\Crud\Model\Custom::class);
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                $this->messageManager->addSuccess(__('Id %1 has been deleted.',$id));
                $this->_eventManager->dispatch(
                    'adminhtml_crud_on_delete',
                    ['title' => $title, 'status' => 'success']
                );
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->_eventManager->dispatch(
                    'adminhtml_crud_on_delete',
                    ['title' => $title, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a row to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
    protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('Dev_Crud::masscancel');
	}
}
