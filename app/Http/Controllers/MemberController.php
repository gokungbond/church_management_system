<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\Models\Church;
use App\Models\Family;
use App\Models\Member;
use App\Models\Ministry;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    
    public function index() {

        $families = Family::get();
        $churches = Church::get();
        $ministries = Ministry::get();

        return view('member.member', compact('families', 'churches', 'ministries'));
    }

    public function show() {

        return response()->json([
            'data' => Member::select('members.*', 'churches.name as church', 'families.name as family')
                ->leftJoin('churches', 'churches.id', 'members.church_id')
                ->leftJoin('families', 'families.id', 'members.family_id')
                ->get()
        ]);

    }

    public function store(MemberRequest $request) {

        $data = $request->id ? Member::where('id', $request->id)->first() : new Member(); 
        $data->last_name = $request->last_name;
        $data->first_name = $request->first_name;
        $data->middle_name = $request->middle_name;
        $data->full_name = "{$request->last_name}, {$request->first_name} {$request->middle}";
        $data->dob = $request->dob;
        $data->address = $request->address;
        $data->family_id = $request->family_id;
        $data->church_id = $request->church_id;
        $data->member_category = $request->member_category;
        
        if($data->save()) {

            if(!$request->id) {
                Member::where('id', $data->id)->update(['member_id' => str_pad($data->id, 10, '0', STR_PAD_LEFT)]);
            }

            return response()->json(['message' => 'Data Successfully Saved!'], 200);
        }

     

        return response()->json(['err_message' => 'Something when wrong'], 200);

    }


    public function edit(Member $member) {
        return response()->json(['data' => $member], 200);
    }

    public function destroy(Member $member) {

        return $member->delete() 
        ? response()->json(['message' => 'Data Successfully Deleted!'], 200) 
        : response()->json(['err_message' => 'Something when wrong'], 200);

    } 


}
