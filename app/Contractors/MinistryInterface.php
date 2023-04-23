<?php

namespace App\Contractors;

use App\Models\Ministry;

interface MinistryInterface {

    public function store(array $ministryData);

    public function delete(array $ministryData);

    
}