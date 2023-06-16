<?php
 
namespace Dev\Crud\Model\ResourceModel;
 
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class Custom extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('dev_crud', 'id');
    }
}