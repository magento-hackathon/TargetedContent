<?php
namespace Firegento\TargetedContent\Model\Source;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Location extends AbstractSource {

    public function getAllOptions()
    {
        // ToDo: Load über eigenes Table Location
        return [
            'option1' => [
                'label' => 'Munich',
                'value' => '1'
            ],
            'option2' => [
                'label' => 'Berlin',
                'value' => '2'
            ],
            'option3' => [
                'label' => 'Augsburg',
                'value' => '3'
            ],
            'option4' => [
                'label' => 'Frankfurt',
                'value' => '4'
            ]
        ];
    }
}