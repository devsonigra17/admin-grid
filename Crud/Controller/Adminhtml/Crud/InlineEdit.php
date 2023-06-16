<?php
 
namespace Dev\Crud\Controller\Adminhtml\Crud;
 
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Dev\Crud\Model\Custom;
 
class InlineEdit extends Action
{
    protected $jsonFactory;
    protected $model;
 
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        Custom $model
    )
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->model = $model;
    }
 
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (empty($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $id) {
                    $modelData = $this->model->load($id);
                    try {
                        $modelData->setData(array_merge($modelData->getData(), $postItems[$id]));
                        $modelData->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }
 
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}