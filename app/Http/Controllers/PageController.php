<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\School;
use App\Attendance;
use Storage;

class PageController extends Controller
{
    public function index() {
        $districts = DB::table('district')->where('StateCode', '16')->get();

        return view('index')->with(['districts' => $districts]);
    }

    public function submitData(Request $request) {
        $school = School::find($request->input('school'));
        $district = DB::table('district')->find($request->input('district'));

        $this->validate($request, [
            'district'      => 'required',
            'school'        => 'required|unique:attendance,school_id',
            'box'           => 'required',
            'total-student' => 'required'
        ]);

        Storage::disk('disk-to-save')->makeDirectory('/'. env('DIRECTORY_TO_SAVE') .'/omrScan/'.$district->name.'/'.$request->input('box').'/'.$school->jac_code);

        $attendance = new Attendance;
        $attendance->school_id = $request->input('school');
        $attendance->box_no = $request->input('box');
        $attendance->student_count = $request->input('total-student');
        $attendance->save();

        return back()->with(['dist_id' => $district->id, 'box' => $request->input('box'), 'success' => 'Data Submitted']);
    }
}
