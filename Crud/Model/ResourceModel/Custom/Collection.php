<?php
 
namespace Dev\Crud\Model\ResourceModel\Custom;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
 
class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Dev\Crud\Model\Custom','Dev\Crud\Model\ResourceModel\Custom');
    }
}