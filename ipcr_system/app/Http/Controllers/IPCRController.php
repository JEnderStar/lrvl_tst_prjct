<?php

namespace App\Http\Controllers;

use App\Models\Ipcrform as Form;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IPCRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $ipcr_form = Form::get();

        return view('employee.index', compact("ipcr_form"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("employee.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $timenow = Carbon::now()->toDateTimeString();

        $ipcr_form = new Form();
        $ipcr_form->date_created = $timenow;
        $ipcr_form->first_name = $request->first_name;
        $ipcr_form->last_name = $request->last_name;
        $ipcr_form->mi = $request->mi;
        $ipcr_form->position = $request->position;
        $ipcr_form->office = $request->office;
        $ipcr_form->email = $request->email;
        $ipcr_form->reviewer = $request->reviewer;
        $ipcr_form->approver = $request->approver;
        $ipcr_form->status = "Pending";
        $ipcr_form->strategic_priorities1 = $request->strategic_priorities1;
        $ipcr_form->success_indicator1 = $request->success_indicator1;
        $ipcr_form->core_functions5 = $request->core_functions5;
        $ipcr_form->success_indicator5 = $request->success_indicator5;
        $ipcr_form->support_functions9 = $request->support_functions9;
        $ipcr_form->success_indicator9 = $request->success_indicator9;
        $ipcr_form->save();

        return response()->json(["success" => true, "message" => "Successfully created a form!"]);
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
