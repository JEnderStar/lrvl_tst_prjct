<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ipcrform as Form;
use App\Models\Schedule;
use App\Models\Accounts as User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ipcr_form = Form::get();

        return view("hr.index", compact('ipcr_form'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("hr.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->office == "CMIO"){
            $division_chief = "Aldrin";
            $director = "Angie";
            $schedule_form = Schedule::create([
                'type' => $request->type,
                'purpose' => $request->purpose,
                'covered_period' => $request->covered_period,
                'office' => $request->office,
                'employees' => $request->input('employees'),
                'division_chief' => $division_chief,
                'director' => $director,
                'duration_from' => $request->duration_from,
                'duration_to' => $request->duration_to
            ]);
        }else if($request->office == "PSD"){
            $division_chief = "Carni";
            $director = "Alvin";
            $schedule_form = Schedule::create([
                'type' => $request->type,
                'purpose' => $request->purpose,
                'covered_period' => $request->covered_period,
                'office' => $request->office,
                'employees' => $request->input('employees'),
                'division_chief' => $division_chief,
                'director' => $director,
                'duration_from' => $request->duration_from,
                'duration_to' => $request->duration_to
            ]);
        }else if($request->office == "All"){
            $division_chief = "DC1";
            $director = "D1";
            $schedule_form = Schedule::create([
                'type' => $request->type,
                'purpose' => $request->purpose,
                'covered_period' => $request->covered_period,
                'office' => $request->office,
                'employees' => $request->input('employees'),
                'division_chief' => $division_chief,
                'director' => $director,
                'duration_from' => $request->duration_from,
                'duration_to' => $request->duration_to
            ]);
        }
        
        $dv_info = User::where('first_name', $division_chief);
        $dir_info = User::where('first_name', $director);
        
        $data = [
            'Test' => 'Test'
        ];
        Mail::send('mail.schedule', $data, function ($message) use ($data) {
            $message->to("jcuevas@finance.gov.ph"); // Get email of users when?
            $message->subject('Test Message');
            $message->from('jcuevas@finance.gov.ph', 'Test Message'); // Get HR email when?
        });

        // return response()->json($schedule_form);
        return response()->json([$schedule_form, "success" => true, "message" => "Successfully created a schedule!"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
