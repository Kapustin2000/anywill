<?php
namespace App\Services\Dto;
use App\Models\Organization;
use App\Models\User;

class TransactionDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $options = [];

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'user_id' => 'sometimes|exists:users,id'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
        $this->data = [
            'name' => $data['type'],
            'user_id' => $data['user_id'] ?? null,
            'to_user_id' =>  $data['to_user_id'] ?? null
        ];
        

        return true;
    }
}