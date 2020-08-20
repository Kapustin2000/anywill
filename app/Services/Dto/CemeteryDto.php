<?php
namespace App\Services\Dto;
class CemeteryDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $name, $type, $user_id , $classifications, $coordinates, $options; 

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
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->user_id = $data['user_id'] ?? 123;
        $this->classifications = $data['classifications'];
        $this->coordinates = ['coordinates' => json_encode($data['coordinates'])];
        $this->options = $data['options'];


        return true;
    }
}