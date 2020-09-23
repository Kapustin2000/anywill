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

    public function save(TransactionDto $dto) : Transaction
    {
        $this->transaction = $transaction = Transaction::create($dto->data);

        return $this->persistTransaction($dto);
    }

    protected function persistTransaction(TransactionDto $dto) : Transaction
    {
        if($dto->data['type'] === 'transaction'){
            User::find($dto->data['user_to'])->update(['balance' => DB::raw('balance + 10')]);
        }
        return $this->transaction;
    }

} 