<?php

namespace App\Http\Controllers;

use App\Models\Church;
use Illuminate\Http\Request;
use App\Contractors\ChurchInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChurchRequest;

class ChurchController extends Controller
{

    private $churchService;


    public function __construct(ChurchInterface $churchService) 
    {
        $this->churchService = $churchService;
    }
    

    public function index() 
    {
        return view('church.church');
    }


    public function show() 
    {
        return jsonResponse(200, Church::get());
    }


    public function store(ChurchRequest $request)
    {   
        return jsonResponse($this->churchService->store( $request->validated()) ? 200 : 400);
    }


    public function edit(Church $church) 
    {
        return jsonResponse(200, $church);
    }


    public function destroy(Church $church) 
    { 
        return jsonResponse($this->churchService->delete($church->toArray()) ? 200 : 400);
    } 




}
