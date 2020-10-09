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
            'to_user_id' => 'sometimes|exists:users,id',
            'from_user_balance_after_operation' => 'required|numeric|min:0'
        ];
    }

    /**
     * @inheritDoc
     */

    protected function beforeValidation($data) {

        if(isset($data['from_user_id'])) {
            $data['from_user_balance'] = (int) User::findOrFail($data['from_user_id'])->balance;

            if($data['type']  === "transfer") $data['from_user_balance_after_operation'] = ($data['from_user_balance'] - (int) $data['amount']);

            if($data['type']  ===  "deposit") $data['from_user_balance_after_operation'] = ($data['from_user_balance'] + (int) $data['amount']);

            if($data['type']  === "withdrawal") $data['from_user_balance_after_operation'] = ($data['from_user_balance'] - (int) $data['amount']);

            $data['details']['user_balance_before_operation'] = $data['from_user_balance'];
        }

        return $data;

    }


    protected function map(array $data): bool
    {
        $this->transaction_from = [
            'amount' => $data['amount'],
            'from_user_id' => $data['from_user_id'],
            'to_user_id' =>  $data['to_user_id'] ?? null,
            'provider' => $data['provider'] ?? null,
            'details' => $data['details'],
            'type' =>  $data['type']
        ];

        if(isset($data['currency_id'])) {
            $this->transaction_from['currency_id'] = $data['currency_id'];
        }

        if($this->transaction_from['type'] === "transfer") {
            
            $this->transaction_to = $this->transaction_from;

            $this->transaction_to['details']['user_balance_before_operation'] = (int) User::findOrFail($data['to_user_id'])->balance;
        }

        if($this->transaction_from['type'] === "transfer" || $this->transaction_from['type'] === "withdrawal") $this->transaction_from['amount'] *=-1;
        
        return true;
    }
}