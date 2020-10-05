<?php
namespace App\Services\Dto;
use App\Models\User;

class OrganizationDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $addresses, $media, $comments;

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
            'owner_type' => User::class,
            'user_id' => $data['user_id'] ?? auth()->user()->id,
            'description' => $data['description'] ?? null
        ];


//        $this->cemeteries = $data['cemeteries'];
//        $this->laboratories = $data['laboratories'];
//        $this->funeral_homes = $data['funeral_homes'];
//        $this->cremations = $data['cremations'];
        $this->addresses = $data['addresses'];
        $this->media = $data['media'];
        $this->comments = $data['comments'] ?? null;

        return true;
    }
}