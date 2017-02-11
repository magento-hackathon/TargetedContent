<?php
namespace Firegento\TargetedContent\Ui\Component\Form;


use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Ui\Component\Form\FieldFactory;
use Magento\Ui\Component\Form\Fieldset as BaseFieldset;

class Fieldset extends BaseFieldset
{
    /**
     * @var FieldFactory
     */
    private $fieldFactory;

    public function __construct(
        ContextInterface $context,
        array $components = [],
        array $data = [],
        FieldFactory $fieldFactory)
    {
        parent::__construct($context, $components, $data);
        $this->fieldFactory = $fieldFactory;
    }

    /**
     * Get components
     *
     * @return UiComponentInterface[]
     */
    public function getChildComponents()
    {
        $fields = [
            [
                'label' => __('Locations'),
                'value' => __('locations'),
                'formElement' => 'multiselect',
            ]
        ];

        foreach ($fields as $k => $fieldConfig) {
            $fieldInstance = $this->fieldFactory->create();
            $name = 'locations';

            $fieldInstance->setData(
                [
                    'config' => $fieldConfig,
                    'name' => $name
                ]
            );

            $fieldInstance->prepare();
            $this->addComponent($name, $fieldInstance);
        }

        return parent::getChildComponents();
    }
}