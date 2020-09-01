<?php
namespace App\Services\Dto;
class CremationDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public $user_id , $options; 

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'user_id' => 'sometimes'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    { 
        $this->user_id = $data['user_id'] ?? null;
        $this->options = compactOptions($data['options']);


        return true;
    }
}