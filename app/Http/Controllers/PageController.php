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
    
        $this->validate($request, [
            'district'      => 'required',
            'school'        => 'required|digits:6|exists:schools,jac_code',
            'box'           => 'required|numeric',
            'total-student' => 'required|numeric|max:500'
        ]);

        // Gatering Info
        $school = School::where('jac_code', $request->input('school'))->first();
        $district = DB::table('district')->find($request->input('district'));

        //Validating School Before Update
        if(Attendance::where('school_id', $school->id)->count() > 0) {
            return redirect()->back()->withErrors(['School Folder Already Exist']);
        }

        Storage::disk('disk-to-save')->makeDirectory('/'. env('DIRECTORY_TO_SAVE') .'/omrScan/'.$district->name.'/'.$request->input('box').'/'.$school->jac_code);

        $attendance = new Attendance;
        $attendance->school_id = $school->id;
        $attendance->jac_code = $request->input('school');
        $attendance->box_no = $request->input('box');
        $attendance->student_count = $request->input('total-student');
        $attendance->save();

        return back()->with(['dist_id' => $district->id, 'box' => $request->input('box'), 'success' => 'Data Submitted']);
    }
}
