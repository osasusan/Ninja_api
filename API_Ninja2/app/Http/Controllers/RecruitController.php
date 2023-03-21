<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Recruit;

class RecruitController extends Controller
{
    //
    public function index()
    {
        return Recruit::select(['id', 'name', 'state'])->get();
    }
    public function store(Request $request)
    {
    try {
    $this->validate($request, [
        'name' => 'required',
        'skills' => 'required',
        'state' => 'required',
    ]);
    }catch (ValidationException $e) {
        return response()->json(['error' => $e->getMessage()], 422);
    }
    $recruit = new Recruit();
    $recruit->name = $request->input('name');
    $recruit->skills = $request->input('skills');
    $recruit->state = $request->input('state');
    $recruit->save();
    return $recruit;
    }

    public function update(Request $request, $id)
    {
    $this->validate($request, [
        'name' => 'required',
        'skills' => 'required',
        'state' => 'required',
    ]);
    $recruit = Recruit::find($id);
    $recruit->name = $request->input('name');
    $recruit->skills = $request->input('skills');
    $recruit->state = $request->input('state');
    $recruit->save();
    return $recruit;
    }
// Esta función se encargará de buscar un Recluta por su ID
    public function show_by_id($id)
    {
    $recruit = Recruit::findOrFail($id);
    return $recruit;
    }
    public function show_by_name($nombre)
    {
        $recruit = Recruit::where('name', $nombre)->get();

        if ($recruit->count() > 0) {
            return $recruit;
        } else {
            return response()->json(['error' => 'Recluta no encontrado'], 404);
        }
    }

    public function retire(Request $request, $id)
    {
        $recruit = Recruit::find($id);
        if (!$recruit) {
            return response()->json(['error' => 'Recluta no encontrado'], 404);
        }
        $recruit->state = 'Retirado';
        $recruit->save();

        return $recruit;
    }
}
