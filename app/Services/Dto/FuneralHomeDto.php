<?php
namespace App\Services\Dto;
use App\Models\User;

class FuneralHomeDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $options = [];

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
        }
        
        $total_capacity = array_sum(array_column($data['rooms'], 'capacity'));

        $this->data = [
            'name' => $data['name'],
            'total_capacity' => $total_capacity,
            'owner_type' => $owner_type ?? User::class,
            'owner_id' => $owner_id ?? auth()->user()->id,
            'description' => $data['description']
        ];

        $this->rooms = $data['rooms'];

        $this->options = compactOptions($data['options']);

        return true;
    }
}