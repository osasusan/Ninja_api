<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Ninja;

class NinjaController extends Controller
{
//

    public function create(Request $request)
    
    {
        $json =  $request->getContent();
        $data = \json_decode($json, true);
        
        $validator = Validator::make($data,[
            'name' => 'required|min:3',
            'skills' => 'required|min:10',
            'rank' => 'required|in:Novato,Soldado,Experto,Maestro',
            'state' => 'required|in:Activo,Retirado,Fallecido,Desertor',
        ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }
    
        $ninja = new Ninja();
        $ninja->name = $request->name;
        $ninja->skills = $request->skills;
        $ninja->rank = $request->rank;
        $ninja->state = $request->state;
        $ninja->save();

        return response()->json('creado correctemanete',201);
            
    
    }
       
    public function create2(Request $request, Response $response)
    {
        // Validamos los campos de la solicitud: name, skills, rank y state
        $request->validate([
            'name' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
            'rank' => 'required|integer|between:1,5',
            'state' => 'required|boolean',
        ]);
    
        // Si la validación ha sido correcta, creamos un nuevo modelo de Ninja
        $ninja = new Ninja();
        $ninja->name = $request->name;
        $ninja->skills = $request->skills;
        $ninja->rank = $request->rank;
        $ninja->state = $request->state;
        $ninja->save();
    
        // Devolvemos el nuevo modelo de Ninja creado en la respuesta
        return $response->json_decode([$ninja]);
    }
    

    // Esta función se encargará de mostrar todos los ninjas
    public function show_all()
    {
        $ninjas = Ninja::all();
        return $ninjas;
    }

    // Esta función se encargará de buscar un ninja por su ID
   // public function show_by_id($id)
   // {
   //     $ninja = Ninja::findOrFail($id);
   //     return $ninja;
   // }

    // Esta función se encargará de eliminar un ninja
    public function destroy1($id)
    {
        $ninja = Ninja::findOrFail($id);
        $ninja->delete();
        return $ninja;
    }

    // Esta función se encargará de actualizar los datos de un ninja
    public function updater(Request $request, $id)
    {
        // Primero, validamos los campos que nos has indicado: name, skills, rank y state
        $request->validate([
            'name' => 'required|string|min:3',
            'skills' => 'required',
            'rank' => 'required',
            'state' => 'required',
        ]);
        // Si la validación ha sido correcta, podemos actualizar los datos del ninja
        $ninja = Ninja::findOrFail($id);
        $ninja->name = $request->name;
        $ninja->skills = $request->skills;
        $ninja->rank = $request->rank;
        $ninja->state = $request->state;
        $ninja->save();

        return $ninja;
    }
    
  ///////////////////////////////
 
    public function index()
    {
        return Ninja::select(['id', 'name', 'rank', 'state'])->get();
    }
    public function store(Request $request)
    {
        $json =  $request->getContent();
        $data = \json_decode($json, true);
        
        $validator = Validator::make($data,[
            'name' => 'required|min:3',
            'skills' => 'required|min:10',
            'rank' => 'required|in:Novato,Soldado,Experto,Maestro',
            'state' => 'required|in:Activo,Retirado,Fallecido,Desertor',
        ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

        $ninja = new Ninja();
        $ninja->name = $request->name;
        $ninja->skills = $request->skills;
        $ninja->rank = $request->rank;
        $ninja->state = $request->state;
        $ninja->save();

        return response()->json($data,201);
            
    }
public function update(Request $request, $id)
    {
    $this->validate($request, [
        'name' => 'required',
        'skills' => 'required',
        'rank' => 'required',
        'state' => 'required',
    ]);
    $ninja = Ninja::find($id);
    $ninja->name = $request->input('name');
    $ninja->skills = $request->input('skills');
    $ninja->rank = $request->input('rank');
    $ninja->state = $request->input('state');
    $ninja->save();
    return $ninja;
    }
// Esta función se encargará de buscar un ninja por su ID
    public function show_by_id($id)
    {
    $ninja = Ninja::findOrFail($id);
    return $ninja;
    }
    public function show_by_name($nombre)
    {
        $ninjas = Ninja::where('name', $nombre)->get();

        if ($ninjas->count() > 0) {
            return $ninjas;
        } else {
            return response()->json(['error' => 'Ninja no encontrado'], 404);
        }
    }

    public function retire(Request $request, $id)
    {
        $ninja = Ninja::find($id);
        if (!$ninja) {
            return response()->json(['error' => 'Ninja no encontrado'], 404);
        }
        $ninja->state = 'Retirado';
        $ninja->save();

        return $ninja;
    }
    public function getMissions($id)
    {
        try {
            $ninja = Ninja::with('missions')->findOrFail($id);
            return $ninja->missions;
        } catch (ModelNotFoundException $e) {
            return response()->json([
                "status" => "error",
                "message" => "No se ha encontrado ningún ninja con el id proporcionado"
            ], 404);
        }
    }
    public function assignToMission($ninjaId, $missionId)
    {
        $ninja = Ninja::find($ninjaId);
        $mission = Mission::find($missionId);

        if ($mission->ninjas()->count() >= $mission->number_of_ninjas) {
            return response()->json([
                "status" => "error",
                "message" => "La misión ya tiene el número máximo de ninjas asignados"
            ], 400);
        }

        $mission->ninjas()->attach($ninja);
        $mission->status = "en curso";
        $mission->save();
    }

}
   
