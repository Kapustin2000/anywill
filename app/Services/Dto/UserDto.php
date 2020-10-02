<?php
namespace App\Services\Dto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $classifications, $coordinates, $options, $media, $contacts, $addresses;

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'name' => 'required',
            'user_id' => 'sometimes|exists:users,id',
            'email' => 'email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
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
            'parent_id' => $data['user_id'] ?? null,
            'username' => $data['username'],
            'password'=> Hash::make($data['password'])
        ];

        $this->contacts = $data['contacts'];
        $this->addresses = $data['addresses'];


        return true;
    }
}