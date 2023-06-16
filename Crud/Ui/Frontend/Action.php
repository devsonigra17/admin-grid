<?php

namespace Dev\Crud\Ui\Frontend;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Action extends Column
{
    const ROW_VIEW_URL = 'crud/index/view';
  
    protected $_urlBuilder;
    private $escaper;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) 
    {
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    // $title = $this->getEscaper()->escapeHtml($item['id']);
                    $item[$name]['delete'] = [
                        'href' => $this->_urlBuilder->getUrl(self::ROW_VIEW_URL, ['id' => $item['id']]),
                        'label' => __('View'),
                    ];
                }
            }
        }

        return $dataSource;
    }
}