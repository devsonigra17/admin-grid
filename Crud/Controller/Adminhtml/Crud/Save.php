<?php

namespace Dev\Crud\Controller\Adminhtml\Crud;

use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;

class Save extends \Magento\Backend\App\Action
{

    protected $customFactory;
    protected $adapterFactory;
    protected $messageManager;
    protected $filesystem;
    protected $uploaderFactory;
 
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Dev\Crud\Model\CustomFactory $customFactory,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem,
        \Magento\Framework\Message\ManagerInterface $messageManager
    )
    {
        parent::__construct($context);
        $this->customFactory = $customFactory;
        $this->messageManager = $messageManager;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
    }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Dev_Crud::save');
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $url = $this->getUrl('admin/cache/index');
        // echo $url;exit;
        echo '<pre>';print_r($data);exit;
        if($data['id']!=NULL)
        {
            if($data['image']==true)
            {
                $image = $data['image'];
            }
            if($data['image']==NULL)
            {
                $image = NULL;
            }
        }
        if($data['id']==NULL)
        {

            if($data['image']['0']['image_url']!=NULL)
            {
                $image = $data['image']['0']['image_url'];
            }
            if($data['image']['0']['image_url']==NULL)
            {
                $image = NULL;
            }
        }
        $model = $this->customFactory->create();
        $id = $data['id'];        

        try {

            $arrayHobby = $data['hobby'];
            if($arrayHobby!=NULL){
                $hobby = implode(" , ",$arrayHobby);
            }else{
                $hobby = NULL;
            }

            if($data['contact']!=NULL){
                $contact = $data['contact'];
            }else{
                $contact = NULL;
            }

            if($data['gender']!=NULL)
            {
                $gender = $data['gender'];
            }
            else{
                $gender = NULL;
            }

            if($id!=NULL)
            {
                $model->addData([

                    'id' => $data['id'],
                    'fname' => $data['fname'],
                    'lname' => $data['lname'],
                    'gender' => $gender,
                    'dob' => $data['dob'],
                    'image' => $image,
                    'contact' => $contact,
                    'email' => $data['email'],
                    'hobby' => $hobby,
                    'status' => $data['status'],
        
                ]);
            }
            if($id==null)
            {
                $model->addData([

                    'fname' => $data['fname'],
                    'lname' => $data['lname'],
                    'gender' => $gender,
                    'dob' => $data['dob'],
                    'image' => $image,
                    'contact' => $contact,
                    'email' => $data['email'],
                    'hobby' => $hobby,
                    'status' => $data['status'],
        
                ]);
            }
            $saveData = $model->save();
    
            if($saveData)
            {
                if($id==null)
                {
                    $this->messageManager->addNotice(__('Please go to Cache Management and refresh cache types.'));
                    $this->messageManager->addSuccess( __('<br/>Data Inserted Successfully !') );
                }
                if($id!=null)
                {
                    $this->messageManager->addSuccess( __('Data Updated Successfully !') );
                }

            }
        }catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('*/*/index');
    }
 
}