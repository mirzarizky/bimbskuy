<?php

namespace App\Http\Controllers;

use App\Departemen;
use App\Http\Resources\DepartemenResource;
use App\Http\Resources\DosenResource;
use Illuminate\Http\Request;

class DepartemenController extends Controller
{
    public function getAllDepartemen()
    {
        $all_departemen = Departemen::all();

        return response()->json(DepartemenResource::collection($all_departemen));
    }

    public function getDosenByDepartemenId($id)
    {
        $departemen = Departemen::find($id);

        if($departemen) {
            return response()->json(DosenResource::collection($departemen->dosen));
        } else {
            return response()->json(['message' => 'Departemen not found.'], 404);
        }
    }
}
