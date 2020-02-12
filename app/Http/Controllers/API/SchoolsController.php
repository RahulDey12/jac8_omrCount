<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\School;
use App\Http\Resources\Schools as SchoolResource;

class SchoolsController extends Controller
{
    public function getSchools($distId, Request $request) {

        $query = $request->query('q');

        // If there query exist it will search
        if($query != null) {
            $schools = School::where([['district', $distId], ['school_name', 'like', '%'.$query.'%']])
                            ->orWhere([['district', $distId], ['jac_code', 'like', $query.'%']])
                            ->get();
        }else {
            $schools = School::where('district', $distId)->get();
        }

        return SchoolResource::collection($schools);
    }
}
