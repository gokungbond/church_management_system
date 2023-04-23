<?php


namespace App\Services;
use App\Contractors\MinistryInterface;
use App\Models\Ministry;

class MinistryService implements MinistryInterface {
    

    public function store(array $dataMinistry) 
    {
        $data = isset($dataMinistry['id']) ? Ministry::where('id', $dataMinistry['id'])->first() : new Ministry();
        $data->name = $dataMinistry['name'];
        return $data->save();
    }

    public function delete(array $dataMinistry) 
    {
        return Ministry::where('id', $dataMinistry['id'])->delete();
    }


}
