<?php
namespace App\Services\Dto;
class FuneralHomeDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $options = [];

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
        $total_capacity = array_sum(array_column($data['rooms'], 'capacity'));

        $this->data = [
            'name' => $data['name'],
            'total_capacity' => $total_capacity
        ];

        $this->rooms = $data['rooms'];

        foreach($data['options'] as $option) {
            $this->options[(int) $option['option_id']] = array('commission' => $option['commission']);
        }
        
        return true;
    }
}