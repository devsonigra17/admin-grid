<?php

namespace Dev\Crud\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class Gender implements ArrayInterface
{
    public function toOptionArray()
    {
        $options = [
            0 =>[
                'label' => ' ',
                'value' => NULL
            ],
            1 => [
                'label' => 'Male',
                'value' => '1'
            ],
            2 => [
                'label' => 'Female',
                'value' => '2'
            ],
            3 => [
                'label' => 'Others',
                'value' => '3'
            ]
        ];

        return $options;
    }
}