<?php
namespace App\Services\Dto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $permissions, $contacts;

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'user_id' => 'sometimes|exists:users,id',
            'name' => 'required',
            'email' => 'email|unique:users',
            'password' => 'min:8|confirmed|required'
        ];
    }

    /**
     * @inheritDoc
     */
    protected function map(array $data): bool
    {
         $this->data = [
             'name' => $data['name'],
             'email'=> $data['email'],
             'password'=> Hash::make($data['password']),
             'user_id' => $data['user_id'] ?? auth()->user()->id,
        ];

       $this->permissions = $data['permissions'];
        $this->contacts = $data['contacts'];


        return true;
    }
}