<?php

namespace Dev\Crud\Model;

use Dev\Crud\Api\Data;
use Dev\Crud\Api\CustomRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Dev\Crud\Model\ResourceModel\Custom as ResourceCustom;
use Dev\Crud\Model\ResourceModel\Custom\CollectionFactory as CustomCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class CustomRepository implements CustomRepositoryInterface
{
    protected $resource;

    protected $customFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataCustomFactory;

    private $storeManager;

    public function __construct(
        ResourceCustom $resource,
        CustomFactory $customFactory,
        Data\CustomInterfaceFactory $dataCustomFactory,
        DataObjectHelper $dataObjectHelper,
		DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
		$this->customFactory = $customFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCustomFactory = $dataCustomFactory;
		$this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    public function save(\Dev\Crud\Api\Data\CustomInterface $rows)
    {
        if ($rows->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $rows->setStoreId($storeId);
        }
        try {
            $this->resource->save($rows);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the news: %1', $exception->getMessage()),
                $exception
            );
        }
        return $rows;
    }

    public function getById($id)
    {
		$model = $this->customFactory->create();
        $model->load($id);
        if (!$model->getId()) {
            throw new NoSuchEntityException(__('News with id "%1" does not exist.', $id));
        }
        return $model;
    }
	
    public function delete(\Dev\Crud\Api\Data\CustomInterface $rows)
    {
        try {
            $this->resource->delete($rows);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the news: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}
