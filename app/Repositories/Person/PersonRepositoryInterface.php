<?php

namespace App\Repositories\Person;

interface PersonRepositoryInterface
{
    public function getAllPeople($pagination);
    public function store(array $person);
}