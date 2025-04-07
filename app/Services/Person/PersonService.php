<?php

namespace App\Services\Person;

use App\Repositories\Person\PersonRepositoryInterface;

class PersonService
{
    protected $personRepository;

    public function __construct(PersonRepositoryInterface $personRepositoryInterface) {
        $this->personRepository = $personRepositoryInterface;
    }

    public function listPeople($pagination){
        return $this->personRepository->getAllPeople($pagination);
    }

    public function storePerson($person){
        return $this->personRepository->store($person);
    }
}