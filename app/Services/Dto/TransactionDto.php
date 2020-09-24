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
            'name' => 'required',
//            'from_user_id' => 'exists:users,id',
//            'to_user_id' => 'exists:users,id',
//            'from_user_id_balance_after_operation' => 'required|numeric|min:0'
        ];
    }

    /**
     * @inheritDoc
     */

    protected function beforeValidation($data) {

        if(isset($data['from_user_id'])) {
            $data['from_user_id_balance'] = User::findOrFail($data['from_user_id'])->balance;

            if($data['type']  === 'transfer') $data['from_user_id_balance_after_operation'] = (int) ($data['from_user_id_balance'] - (int) $data['size']);

            if($data['type']  === 'deposit') $data['from_user_id_balance_after_operation'] = (int) ($data['from_user_id_balance'] + (int) $data['size']);

            if($data['type']  === 'withdrawal') $data['from_user_id_balance_after_operation'] = (int) ($data['from_user_id_balance'] + (int) $data['size']);

        }

        if($data['type'] === 'deposit' || $data['type'] === 'withdrawal') {
            $data['to_user_id']  = $data['from_user_id'];
        }
        
        return $data;

    }


    protected function map(array $data): bool
    {
        $this->data = [
            'size' => $data['size'],
            'user_id' => $data['user_id'] ?? null,
            'user_to' =>  $data['to_user_id'] ?? null,
            'details' => json_encode($data['details']),
            'type' => $data['type']
        ];
        

        return true;
    }
}