<?php
namespace App\Services\Dto;
use App\Models\Organization;
use App\Models\User;

class TransactionDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $transaction_from, $transaction_to;

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'from_user_id' => 'exists:users,id',
            'to_user_id' => 'exists:users,id',
            'from_user_balance_after_operation' => 'required|numeric|min:0'
        ];
    }

    /**
     * @inheritDoc
     */

    protected function beforeValidation($data) {

        if(isset($data['from_user_id'])) {
            $data['from_user_balance'] = (int) User::findOrFail($data['from_user_id'])->balance;

            if($data['type']  === 1) $data['from_user_balance_after_operation'] = ($data['from_user_balance'] - (int) $data['size']);

            if($data['type']  ===  2) $data['from_user_balance_after_operation'] = ($data['from_user_balance'] + (int) $data['size']);

            if($data['type']  === 3) $data['from_user_balance_after_operation'] = ($data['from_user_balance'] + (int) $data['size']);

            $data['details']['user_balance_before_operation'] = $data['from_user_balance'];
        }

        if($data['type'] === 2 || $data['type'] === 3) {
            $data['to_user_id']  = $data['from_user_id'];
        }
        
        return $data;

    }


    protected function map(array $data): bool
    {
        $this->transaction_from = [
            'size' => $data['size'],
            'from_user_id' => $data['from_user_id'] ?? null,
            'to_user_id' =>  $data['to_user_id'] ?? null,
            'provider' => $data['provider'] ?? null,
            'details' => $data['details'],
            'type' => (int) $data['type']
        ];

        if($this->transaction_from['type'] === 1) {
            
            $this->transaction_to = $this->transaction_from;

            $this->transaction_to['details']['user_balance_before_operation'] = (int) User::findOrFail($data['to_user_id'])->balance;
        }

        if($this->transaction_from['type'] === 1 || $this->transaction_from['type'] === 3) $this->transaction_from['size'] *=-1;
        
        return true;
    }
}