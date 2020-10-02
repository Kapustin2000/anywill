<?php
namespace App\Services;
use App\Services\Dto\AbstractDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class TransactionAbstractService
{
    public $model;
    
    public function transaction(AbstractDto $dto, Model $entity = null)
    {
        return DB::transaction(function () use ($dto, $entity){
            if($entity) {
                $this->model = tap($entity)->update($dto->data);
            } else {
                $this->model = $this->model->create($dto->data);
            }

            return $this->persist($dto);
        });
    }

    abstract function persist($dto) : Model;
}