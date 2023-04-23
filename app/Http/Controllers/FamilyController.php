<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FamilyRequest;

class FamilyController extends Controller
{


    public function index() {

        return view('family.family');

    }


    public function show() {

        return response()->json([
            'data' => Family::get()->map(function($item) {
                $item->member_count = Member::where('family_id', $item->id)->count();
                return $item;
            })
        ]);

    }



    public function store(FamilyRequest $request) {

        $data = $request->id ? Family::where('id', $request->first)->first() : new Family(); 
        $data->name = $request->name;
        
        return $data->save() 
        ? response()->json(['message' => 'Data Successfully Saved!'], 200) 
        : response()->json(['err_message' => 'Something when wrong'], 200);

    }


    public function edit(Family $family) {

        return response()->json(['data' => $family], 200);

    }


    public function delete(Family $family) {

        return $family->delete()
        ? response()->json(['message' => 'Data Successfully Deleted!'], 200) 
        : response()->json(['err_message' => 'Something when wrong'], 200);


    }

}
