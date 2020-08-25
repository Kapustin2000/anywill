<?php
namespace App\Services\Dto;
use Illuminate\Validation\Rule;

class OrderDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public $order, $count_options = 0;
    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'cemetery' => 'required_without_all:laboratory,crematory,funeral_home,general|array',
            'cemetery.options' => 'required_with:cemetery|array',
            'cemetery.options.*' => 'required_with:cemetery.options',
            'cemetery.options.*.id' => 'required_with:cemetery.options.*|exists:service_options',


            'laboratory'  => 'required_without_all:cemetery,crematory,funeral_home,general',
            'laboratory.options' => 'required_with:laboratory|array',
            'laboratory.options.*' => 'required_with:laboratory.options|array',
            'laboratory.options.*.id' => 'required_with:laboratory.options.*|exists:service_options',


            'crematory'  => 'required_without_all:laboratory,cemetery,funeral_home,general',
            'crematory.options' => 'required_with:crematory|array',
            'crematory.options.*' => 'required_with:crematory.options',
            'crematory.options.*.id' => 'required_with:crematory.options.*|exists:service_options',

            'funeral_home'  => 'required_without_all:laboratory,crematory,cemetery,general',
            'funeral_home.options' => 'required_with:funeral_home|array',
            'funeral_home.options.*' => 'required_with:funeral_home.options',
            'funeral_home.options.*.id' => 'required_with:funeral_home.options.*|exists:service_options',


            'general' => 'required_without_all:laboratory,crematory,funeral_home,cemetery',
            'general.options' => 'required_with:general|array',
            'general.options.*' => 'required_with:general.options',
            'general.options.*.id' => 'required_with:general.options.*|exists:service_options',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        foreach (config('entities') as $entity) {
            if(isset($this->data[$entity]['options'])) $this->count_options+= count($this->data[$entity]['options']);
        }
        
        $this->order = array(
            'data' => json_encode($this->data),
            'count_options' => $this->count_options
        );
        
        return true;
    }
}