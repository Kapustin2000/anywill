<?php
namespace App\Services\Dto;
use App\Models\User;

class ManagerDto extends AbstractDto implements DtoInterface
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
            'type' => $data['type'],
            'owner_type' => User::class,
            'owner_id' => 1,
            'media' => $data['media'] ?? null
        ];

        $this->classifications = $data['classifications'];
        $this->coordinates = ['coordinates' => json_encode($data['coordinates'])];
        $this->options = compactOptions($data['options']);


        return true;
    }
}