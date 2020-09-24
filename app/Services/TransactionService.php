<?php

namespace App\Services;

use App\Models\Cemetery;
use App\Models\Transaction;
use App\Models\User;
use App\Services\Dto\CemeteryDto;
use App\Services\Dto\TransactionDto;
use App\Services\Interfaces\CemeteryServiceInterface;
use Illuminate\Support\Facades\DB;

Class TransactionService extends AbstractService
{

    protected $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function save(TransactionDto $dto) : Transaction
    {
        if($dto->data['type'] === 'transfer') {

            $this->updateBalance($dto->data['from_user_id'], $dto->data['size'], '-');
            $this->createTransaction($dto->data['from_user_id'], 'transfer', $dto->data['size'], $dto->data['details']);

            $this->updateBalance($dto->data['to_user_id'], $dto->data['size'], '+');
            $this->createTransaction($dto->data['from_user_id'], 'transfer', $dto->data['size'], $dto->data['details']);

        }else if($dto->data['type'] === 'withdrawal') {

            $this->updateBalance($dto->data['from_user_id'], $dto->data['size'], '-');
            $this->createTransaction($dto->data['from_user_id'], 'transfer', $dto->data['size'], $dto->data['details']);

        }else if($dto->data['type'] === 'deposit') {

            $this->updateBalance($dto->data['from_user_id'], $dto->data['size'], '+');
            $this->createTransaction($dto->data['from_user_id'], 'deposit', $dto->data['size'], $dto->data['details']);
            
        }

        return $this->transaction;
    }

    protected function updateBalance($userId, $size, $action = '+')
    {
        return User::find($userId)->update(['balance' => DB::raw('`balance`'.$action.$size)]);
    }

    protected function createTransaction($userId, $type, $size, $details)
    {
        return Transaction::create(['user_id' => $userId, 'type' => $type, 'size' => $size, 'details' => $details]);
    }

} 