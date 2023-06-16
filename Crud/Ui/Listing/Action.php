<?php

namespace Dev\Crud\Ui\Listing;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

class Action extends Column
{
    
    const ROW_EDIT_URL = 'crud/crud/add';
    const ROW_DELETE_URL = 'crud/crud/delete';
    const ROW_VIEW_URL = 'crud/index/view';
  
    protected $_urlBuilder;
    private $_editUrl;
    private $_deleteUrl;
    private $escaper;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = [],
        $editUrl = self::ROW_EDIT_URL,
        $deleteUrl = self::ROW_DELETE_URL
    ) 
    {
        $this->_urlBuilder = $urlBuilder;
        $this->_editUrl = $editUrl;
        $this->_deleteUrl = $deleteUrl;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->_urlBuilder->getUrl(
                            $this->_editUrl, 
                            ['id' => $item['id']]
                        ),
                        'label' => __('Edit'),
                    ];
                    $title = $this->getEscaper()->escapeHtml($item['id']);
                    $item[$name]['delete'] = [
                        'href' => $this->_urlBuilder->getUrl(self::ROW_DELETE_URL, ['id' => $item['id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete %1', $title),
                            'message' => __('Are you sure you want to delete id %1?', $title)
                        ]
                    ];
                    $item[$name]['view'] = [
                        'href' => $this->_urlBuilder->getBaseUrl().self::ROW_VIEW_URL.'?id='.$item['id'],
                        'label' => __('View'),
                        'target' => '_blank'
                    ];
                }
            }
        }

        return $dataSource;
    }

    private function getEscaper()
    {
        if (!$this->escaper) {
            $this->escaper = ObjectManager::getInstance()->get(Escaper::class);
        }
        return $this->escaper;
    }
}