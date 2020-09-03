<?php
namespace App\Services\Dto;
class CemeteryDto extends AbstractDto implements DtoInterface
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
            'user_id' => $data['user_id'] ?? 1,
            'media' => json_encode($data['media'])
        ];

        $this->classifications = $data['classifications'];
        $this->coordinates = ['coordinates' => json_encode($data['coordinates'])];
        $this->options = compactOptions($data['options']);


        return true;
    }
}