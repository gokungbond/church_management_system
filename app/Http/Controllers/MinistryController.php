<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contractors\MinistryInterface;
use App\Http\Requests\MinistryRequest;

class MinistryController extends Controller
{

    private $ministryService;

    public function __construct(MinistryInterface $ministryService) 
    {
        $this->ministryService = $ministryService;
    }
    

    public function index() {

        return view('ministry.ministry');

    }

    public function show() {

        return jsonResponse(200, Ministry::get());

    }

    public function store(MinistryRequest $request)
    {   
        return jsonResponse($this->ministryService->store($request->validated()) ? 200 : 400);
    }


    public function edit(Ministry $ministry) 
    {
        return jsonResponse(200, $ministry);
    }


    public function destroy(Ministry $ministry) 
    {
        return jsonResponse($this->ministryService->store($ministry->toArray) ? 200 : 400);
    } 


}
