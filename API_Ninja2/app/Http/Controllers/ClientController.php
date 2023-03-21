<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    //
    public function crear(Request $request)
{
   
        // Validate the request data
        $this->validate($request, [
            'code' => 'required|unique:clients|max:255',
            'preference' => 'required',
            'antiquity' => 'required|date|before_or_equal:today',
        ]);
    
        // Create a new client with the validated data
        $client = new Client();
        $client->code = $request->input('code');
        $client->preference = $request->input('preference');
        $client->antiquity = $request->input('antiquity');
        
        // Save the client to the database
        $client->save();
    
        // Return the created client
        return $client;
    
    
}

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|unique:clients',
            'preference' => 'required',
        ]);
        $client = Client::findOrFail($id);
        $client->code = $request->input('code');
        $client->preference = $request->input('preference');
        $client->save();
        return $client;
    }
    
    public function index()
    { 
         return Client::select(['id', 'code', 'preference', 'antiquity'])->get();
    }
}

