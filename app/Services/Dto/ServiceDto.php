<?php
namespace App\Services\Dto;
class ServiceDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public $services;
    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'services.*.id' => 'sometimes|exists:services',
            'services.*.name' => 'string|required',
            'services.*.options' => 'required_without:services.*.id',
            'services.*.options.*' => 'required_with:services.*.options',
            'services.*.options.*.id' => 'sometimes|exists:service_options'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        $this->services = $data['services'];
        return true;
    }
}