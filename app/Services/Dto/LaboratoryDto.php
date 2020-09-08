<?php
namespace App\Services\Dto;
use App\Models\User;

class LaboratoryDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $options; 

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        $this->data = [
            'name' => $data['name'],
            'owner_type' => User::class,
            'owner_id' => 1,
            'description' => $data['description']
        ];

        $this->options = compactOptions($data['options']);
        
        return true;
    }
}