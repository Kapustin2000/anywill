<?php
namespace App\Services\Dto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $classifications, $coordinates, $options, $permissions, $media, $contacts, $addresses, $comments;

    /* @return array */
    protected function configureValidatorRules(): array
    {
        return [
            'id' => 'sometimes|exists:users',
            'name' => 'required',
            'email' => [
                'email',
                Rule::unique('users')->ignore(request('id')),
            ],
            'username' => [
                'string',
                Rule::unique('users')->ignore(request('id')),
            ],
            'password' => 'required_without:id|min:6|confirmed',
            'password_confirmation' => 'required_without:id|min:6'
        ];
    }


    protected function beforeValidation($data) {

        if(isset($data['password']) && !$data['password']) {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        return $data;
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
            'role' => $data['role'] ?? null,
            'username' => $data['username'],
        ];

        if(isset($data['password'])) {
            $this->data['password'] = Hash::make($data['password']);
        }

        $this->contacts = $data['contacts'];
        $this->addresses = $data['addresses'];

        $this->media = $data['media'] ?? null;
        $this->comments = $data['comments'] ?? null;
        $this->permissions = $data['permissions'] ?? [];

        return true;
    }
}