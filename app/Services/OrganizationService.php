<?php

namespace App\Services;
 
use App\Models\Organization; 
use App\Services\Dto\OrganizationDto;
use App\Services\Interfaces\CemeteryServiceInterface;

Class OrganizationService extends AbstractService
{

    public function __construct(Organization $organization)
    {
        $this->model = $organization;
    }

    public function persist($dto) : Organization
    {
        //$this->organization->cemeteries()->sync($dto->cemeteries);
        //$this->organization->laboratories()->sync($dto->laboratories);
        //$this->organization->funeral_homes()->sync($dto->funeral_homes);
        //$this->organization->cremations()->sync($dto->cremations);
        $this->persistRelation($this->organization->addresses(), $dto->addresses);

        //$this->organization->managers()->sync($dto->managers);
        $this->model->media()->sync($dto->media);

        if($dto->comments) {
            $this->persistRelation($this->model->comments(), $dto->comments);
        }
        
//        $this->persistRelation($this->organization->managers(), $dto->managers);
//        $this->persistRelation($this->organization->media(), $dto->media);


        return $this->model->load($this->model->with);
    }

} 