<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;

class MissionController extends Controller
{
    //
    public function store(Request $request)
{
    $this->validate($request, [
        'date' => 'required|date',
        'description' => 'required',
        'number_of_ninjas' => 'required|integer',
        'pay' => 'required',
        'client_id'=> 'required|exists:clients,id',
        'state'=> 'required'
    ]);

        $client = Client::find($request->input('client_id'));
        $client_id = $client->id;
        $priority = $client->preference == 'VIP';
        $mision = new Mission;
        $mision->date = $request->input('date');
        $mision->description = $request->input('description');
        $mision->number_of_ninjas = $request->input('number_of_ninjas');
        $mision->pay = $request->input('pay');
        $mision->client_id =$client_id;
        $mision->priority = $priority;
        $mision->state=$request->input('state');
        $mision->save();

        return $mision;
    }    
    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required|date',
            'description' => 'required',
            'number_of_ninjas' => 'required|integer',
            'pay' => 'required',
            'state'=> 'required',
       
        ]);
    
        $mission = Mision::find($id);
        $mission->date = $request->input('date');
        $mission->description = $request->input('description');
        $mission->number_of_ninjas = $request->input('number_of_ninjas');
        $mission->pay = $request->input('pay');
        $mission->save();

        return $mission;
    }
}
