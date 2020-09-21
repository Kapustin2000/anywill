<?php
namespace App\Services\Dto;
use App\Models\User;

class OrganizationDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $classifications, $coordinates, $options, $media;

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'name' => 'required'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
         $this->data = [
            'name' => $data['name'],
        ];

        return true;
    }
}