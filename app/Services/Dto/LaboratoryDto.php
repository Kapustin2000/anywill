<?php
namespace App\Services\Dto;
class LaboratoryDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $options; 

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [

        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    { 
        $this->options = $data['options'];
        
        return true;
    }
}