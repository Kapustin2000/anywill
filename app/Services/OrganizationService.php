<?php

namespace App\Services;
 
use App\Models\Organization; 
use App\Services\Dto\OrganizationDto;
use App\Services\Interfaces\CemeteryServiceInterface;

Class OrganizationService extends TransactionAbstractService
{

    protected $organization;

    public function save(OrganizationDto $dto) : Organization
    {
        return $this->organization = $organization = Organization::create($dto->data);
    }

    public function update(OrganizationDto $dto, Organization $organization) : Organization
    {
        return $this->organization = $organization->update($dto->data);

    }

} 