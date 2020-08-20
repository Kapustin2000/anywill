<?php
namespace App\Services\Dto;
class OrderDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public $order;
    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'cemetery' => 'required_without_all:laboratory,crematory,funeral_home,general|array',
            'cemetery.options' => 'required_with:cemetery|array',
            'cemetery.options.*' => 'required',



            'laboratory'  => 'required_without_all:cemetery,crematory,funeral_home,general',
            'laboratory.options' => 'required_with:laboratory|array',
            'laboratory.options.*' => 'required_with:laboratory.options|array',


            'crematory'  => 'required_without_all:laboratory,cemetery,funeral_home,general',
            'crematory.options' => 'required_with:crematory|array',
            'crematory.options.*' => 'required_with:crematory.options',

            'funeral_home'  => 'required_without_all:laboratory,crematory,cemetery,general',
            'funeral_home.options' => 'required_with:funeral_home|array',
            'funeral_home.options.*' => 'required_with:funeral_home.options',


            'general' => 'required_without_all:laboratory,crematory,funeral_home,cemetery',
            'general.options' => 'required_with:general|array',
            'general.options.*' => 'required_with:general.options',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        $this->order = array('order' => json_encode($this->data));
        return true;
    }
}