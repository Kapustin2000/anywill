<?php
namespace App\Services\Dto;
class OrderDto extends AbstractDto implements DtoInterface
{

    /* @var string */

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'cemetery' => 'required_without:laboratory,crematory,funeral_home,general',
            'laboratory'  => 'required_without:cemetery,crematory,funeral_home,general',
            'crematory'  => 'required_without:laboratory,cemetery,funeral_home,general',
            'funeral_home'  => 'required_without:laboratory,crematory,cemetery,general',
            'general' => 'required_without:laboratory,crematory,funeral_home,cemetery',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        return true;
    }
}