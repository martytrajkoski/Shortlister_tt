<?php

namespace App\Repositories\Person;

use App\Models\Person;

class PersonRepository implements PersonRepositoryInterface
{
    public function getAllPeople($pagination){
        return Person::orderByDesc('created_at')->paginate($pagination);
    }

    public function store(array $person){
        return Person::create($person);
    }
}