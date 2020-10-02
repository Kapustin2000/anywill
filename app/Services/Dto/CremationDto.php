<?php
namespace App\Services\Dto;
use App\Models\Organization;
use App\Models\User;

class CremationDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public $user_id , $options, $addresses; 

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'user_id' => 'sometimes|exists:users,id',
            'organization_id' => 'sometimes|exists:organizations,id',
            'name' => 'required'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        if($data['user_id']) {
            $owner_id = (int) $data['user_id'];
        } elseif($data['organization_id']) {
            $owner_type = Organization::class;
            $owner_id = (int) $data['organization_id'];
        }
        
        
        $this->data = [
            'name' => $data['name'],
            'description' => $data['description'],
            'owner_type' => $owner_type ?? User::class,
            'owner_id' => $owner_id ?? auth()->user()->id,
        ];
        
        $this->options = compactOptions($data['options']);
        $this->addresses = $data['addresses'];


        return true;
    }
}