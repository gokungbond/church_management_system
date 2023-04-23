<?php

namespace App\Services;

use App\Contractors\ChurchInterface;
use App\Models\Church;


class ChurchService implements ChurchInterface {


    public function store(array $churchData) {

        $data = isset($churchData['id']) 
            ? Church::where('id', $churchData['id'])->first() 
            : new Church();

        $data->name = $churchData['name'];
        $data->address = $churchData['address'];
        return $data->save();

    } 


    public function delete(array $churchData) {

        return Church::where('id', $churchData['id'])->delete();

    }


}