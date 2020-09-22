<?php

namespace App\Services;
 
use App\Models\Organization; 
use App\Services\Dto\OrganizationDto;
use App\Services\Interfaces\CemeteryServiceInterface;

Class OrganizationService extends AbstractService
{

    protected $organization;

    public function save(OrganizationDto $dto) : Organization
    {
         $this->organization = Organization::create($dto->data);

        return $this->persistOrganization($dto);
    }

    public function update(OrganizationDto $dto, Organization $organization) : Organization
    {
        $this->organization = $organization->update($dto->data);

        return $this->persistOrganization($dto);
    }

    protected function persistOrganization(OrganizationDto $dto)
    {
        $this->organization->cemeteries()->sync($dto->cemeteries);
        $this->organization->laboratories()->sync($dto->laboratories);
        $this->organization->funeral_homes()->sync($dto->funeral_homes);
        $this->organization->cremations()->sync($dto->cremations);
        $this->organization->address()->updateOrCreate($dto->address);
        $this->persistRelation($this->organization->managers(), $dto->managers);
        $this->persistRelation($this->organization->media(), $dto->media);


        return $this->organization;
    }

} 