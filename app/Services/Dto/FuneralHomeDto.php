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
            'name' => 'required',
            'description' => 'required'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        $total_capacity = array_sum(array_column($data['rooms'], 'capacity'));

        $this->data = [
            'name' => $data['name'],
            'total_capacity' => $total_capacity,
            'owner_type' => User::class,
            'owner_id' => 1,
            'description' => $data['description']
        ];

        $this->rooms = $data['rooms'];

        $this->options = compactOptions($data['options']);

        return true;
    }
}