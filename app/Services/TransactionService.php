<?php

namespace App\Services;

use App\Models\Cemetery;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Dto\CemeteryDto;
use App\Services\Dto\TransactionDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use Illuminate\Support\Facades\DB;

Class TransactionService
{

    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function save(TransactionDto $dto) : Transaction
    {
        $this->updateBalance($dto->transaction_from['from_user_id'], $dto->transaction_from['amount']);

        $this->transaction = $this->createTransaction($dto->transaction_from);


        if($dto->transaction_from['type'] === "transfer") {
            $this->updateBalance($dto->transaction_to['to_user_id'], $dto->transaction_to['amount']);
            $this->createTransaction($dto->transaction_to);
        }

        return $this->transaction;
    }

    protected function updateBalance($userId, $amount)
    {
        return User::find($userId)->update(['balance' => DB::raw('`balance` + '.$amount)]);
    }

    protected function createTransaction($transaction)
    {
        return Transaction::create($transaction);
    }

} 