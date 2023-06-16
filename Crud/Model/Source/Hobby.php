<?php

namespace Dev\Crud\Model\Source;

use Magento\Framework\Option\ArrayInterface;

class Hobby implements ArrayInterface
{
    public function toOptionArray()
    {
        $options = [
            0 => [
                'value' => 'Cricket',
                'label' => 'Cricket'
            ],
            1 => [
                'value' => 'Chess',
                'label' => 'Chess'
            ],
            2 => [
                'value' => 'Football',
                'label' => 'Football'
            ],
            3 => [
                'value' => 'Dancing',
                'label' => 'Dancing'
            ],
            4 => [
                'value' => 'Singing',
                'label' => 'Singing'
            ]

        ];

        return $options;
    }
}