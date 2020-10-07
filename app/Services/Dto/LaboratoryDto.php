<?php
namespace App\Services\Dto;
use App\Models\Cemetery;
use App\Models\Organization;
use App\Models\User;

class LaboratoryDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $options, $addresses, $comments; 

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'user_id' => 'sometimes|exists:users,id',
            'organization_id' => 'sometimes|exists:organizations,id',
            'name' => 'required',
            'description' => 'required'
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
        } elseif($data['cemetery_id']) {
            $owner_type = Cemetery::class;
            $owner_id = (int) $data['cemetery_id'];
        }
        
        $this->data = [
            'name' => $data['name'],
            'owner_type' => $owner_type ?? User::class,
            'owner_id' => $owner_id ?? auth()->user()->id,
            'description' => $data['description']
        ];

        $this->options = compactOptions($data['options']);

        $this->addresses = $data['addresses'];
        $this->comments = $data['comments'] ?? null;

        return true;
    }
}