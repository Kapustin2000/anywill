<?php
namespace App\Services\Dto;
use App\Models\User;

class OrganizationDto extends AbstractDto implements DtoInterface
{

    /* @var string */
    public  $cemeteries, $laboratories, $funeral_homes, $cremations, $address, $media;

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
            'owner_id' => $data['user_id'] ?? auth()->user()->id,
            'description' => $data['description'] ?? null
        ];


        $this->cemeteries = $data['cemeteries'];
        $this->laboratories = $data['laboratories'];
        $this->funeral_homes = $data['funeral_homes'];
        $this->cremations = $data['cremations'];
        $this->address = $data['address'];
        $this->media = $data['media'];

        return true;
    }
}