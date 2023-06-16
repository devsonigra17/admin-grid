<?php
namespace Dev\Crud\Api;

interface CustomRepositoryInterface
{
	public function save(\Dev\Crud\Api\Data\CustomInterface $rows);

    public function getById($id);

    public function delete(\Dev\Crud\Api\Data\CustomInterface $rows);

    public function deleteById($id);
}
