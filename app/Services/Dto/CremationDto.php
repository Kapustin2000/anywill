<?php
namespace App\Services\Dto;
use App\User;

class CremationDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public $user_id , $options; 

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'user_id' => 'sometimes',
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
            'description' => $data['description'],
            'owner_type' => User::class,
            'owner_id' => 1
        ];
        
        $this->options = compactOptions($data['options']);


        return true;
    }
}