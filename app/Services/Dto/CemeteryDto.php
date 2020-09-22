<?php
namespace App\Services\Dto;
use App\Models\Organization;
use App\Models\User;

class CemeteryDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $classifications, $coordinates, $options, $media, $managers;

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'name' => 'required',
            'user_id' => 'sometimes|exists:users,id',
            'organization_id' => 'sometimes|exists:organizations,id',
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
            'type' => $data['type'],
            'owner_type' => $owner_type ?? User::class,
            'owner_id' => $owner_id ?? auth()->user()->id,
        ];

        $this->classifications = $data['classifications'];
        $this->coordinates = ['coordinates' => json_encode($data['coordinates'])];
        $this->options = compactOptions($data['options']);
        $this->media = $data['media'];
        $this->managers = $data['managers'];

        return true;
    }
}