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
            'name' => 'required'
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
            'username' => $data['username'],
            'password'=> Hash::make($data['password'])
        ];

        $this->contacts = $data['contacts'];
        $this->addresses = $data['addresses'];


        return true;
    }
}