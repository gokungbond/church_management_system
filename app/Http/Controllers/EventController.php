<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Church;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    

    public function index() {
;
        $churches = Church::get();
        
        return view('event.event', compact('churches'));
    }

    public function show() {

        return response()->json([
            'data' => Event::select('events.*', DB::raw("(CASE WHEN churches.name IS NULL THEN 'ALL CHURCHES' ELSE churches.name END) as church"))
                ->leftJoin('churches', 'churches.id', 'events.church_id')
                ->get()
        ]);

    }

    public function store(EventRequest $request) {

        $data = $request->id ? Event::where('id', $request->id)->first() : new Event(); 
        $data->name = $request->name;
        $data->description = $request->description;
        $data->from = $request->from;
        $data->to = $request->to;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->church_id = $request->church_id;
        $data->day = $request->day;
        $data->is_regular_event = $request->is_regular_event;
        
        if($data->save()) {

            if(!$request->id) {
                Event::where('id', $data->id)->update(['event_id' => str_pad($data->id, 10, '0', STR_PAD_LEFT)]);
            }

            return response()->json(['message' => 'Data Successfully Saved!'], 200);
        }

     

        return response()->json(['err_message' => 'Something when wrong'], 200);

    }


    public function edit(Event $event) {
        return response()->json(['data' => $event], 200);
    }

    public function destroy(Event $event) {

        return $event->delete() 
        ? response()->json(['message' => 'Data Successfully Deleted!'], 200) 
        : response()->json(['err_message' => 'Something when wrong'], 200);

    } 



}
