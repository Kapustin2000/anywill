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
            'services.*' => 'required'
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