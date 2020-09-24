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
        if($dto->data['type_id'] === 'transfer') {
            $this->updateBalance($dto->data['user_id'], '-', $dto->data['size']);
            $this->updateBalance($dto->data['user_to'], '+', $dto->data['size']);
        }else if($dto->data['type_id'] === 'withdrawal') {
            $this->updateBalance($dto->data['user_id'], '-', $dto->data['size']);
        }else if($dto->data['type_id'] === 'deposit') {
            $this->updateBalance($dto->data['user_id'], '+', $dto->data['size']);
        }

        return $this->transaction;
    }

    protected function updateBalance($userId, $size, $action = '+')
    {
        return User::find($userId)->update(['balance' => DB::raw('balance '.$action.$size)]);
    }

} 