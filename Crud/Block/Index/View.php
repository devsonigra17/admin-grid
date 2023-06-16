<?php
namespace Dev\Crud\Block\Index;

class View extends \Magento\Framework\View\Element\Template
{
  protected $model;  

  public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Dev\Crud\Model\CustomFactory $model

    ) {


        $this->model = $model;
        parent::__construct($context);
    }
    public function getDataById($id)
    {
        return $this->model->create()->load($id);
    }
}