<?php

namespace App\Http\Controllers;

use App\Models\Ipcrform as Form;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class IPCRController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ipcr_form = Form::get();

        return view('employee.index', compact("ipcr_form"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Place Schedule IPCR controller here, get data here

        return view("employee.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $ipcr_form = Form::find($id);

        return view("employee.show", compact(['ipcr_form']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ipcr_form = Form::find($id);

        return view("employee.edit", compact(['ipcr_form', 'id']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ipcr_form = Form::find($id);
        $ipcr_form->strategic_priorities1 = $request->strategic_priorities1;
        $ipcr_form->success_indicator1 = $request->success_indicator1;
        $ipcr_form->actual_accomplishments1 = $request->actual_accomplishments1;
        $ipcr_form->strategic_priorities2 = $request->strategic_priorities2;
        $ipcr_form->success_indicator2 = $request->success_indicator2;
        $ipcr_form->actual_accomplishments2 = $request->actual_accomplishments2;
        $ipcr_form->strategic_priorities3 = $request->strategic_priorities3;
        $ipcr_form->success_indicator3 = $request->success_indicator3;
        $ipcr_form->actual_accomplishments3 = $request->actual_accomplishments3;
        $ipcr_form->strategic_priorities4 = $request->strategic_priorities4;
        $ipcr_form->success_indicator4 = $request->success_indicator4;
        $ipcr_form->actual_accomplishments4 = $request->actual_accomplishments4;
        $ipcr_form->core_functions5 = $request->core_functions5;
        $ipcr_form->success_indicator5 = $request->success_indicator5;
        $ipcr_form->actual_accomplishments5 = $request->actual_accomplishments5;
        $ipcr_form->core_functions6 = $request->core_functions6;
        $ipcr_form->success_indicator6 = $request->success_indicator6;
        $ipcr_form->actual_accomplishments6 = $request->actual_accomplishments6;
        $ipcr_form->core_functions7 = $request->core_functions7;
        $ipcr_form->success_indicator7 = $request->success_indicator7;
        $ipcr_form->actual_accomplishments7 = $request->actual_accomplishments7;
        $ipcr_form->core_functions8 = $request->core_functions8;
        $ipcr_form->success_indicator8 = $request->success_indicator8;
        $ipcr_form->actual_accomplishments8 = $request->actual_accomplishments8;
        $ipcr_form->support_functions9 = $request->support_functions9;
        $ipcr_form->success_indicator9 = $request->success_indicator9;
        $ipcr_form->actual_accomplishments9 = $request->actual_accomplishments9;
        $ipcr_form->support_functions10 = $request->support_functions10;
        $ipcr_form->success_indicator10 = $request->success_indicator10;
        $ipcr_form->actual_accomplishments10 = $request->actual_accomplishments10;
        $ipcr_form->support_functions11 = $request->support_functions11;
        $ipcr_form->success_indicator11 = $request->success_indicator11;
        $ipcr_form->actual_accomplishments11 = $request->actual_accomplishments11;
        $ipcr_form->support_functions12 = $request->support_functions12;
        $ipcr_form->success_indicator12 = $request->success_indicator12;
        $ipcr_form->actual_accomplishments12 = $request->actual_accomplishments12;
        if($ipcr_form->status == "Pending"){
            $ipcr_form->save();
        }else if($ipcr_form->status == "Rejected by DC"){
            $ipcr_form->status = "Pending";
            $ipcr_form->save();
        }else{
            $ipcr_form->status = "Grading by DC";
            $ipcr_form->save();
        }

        return response()->json(["success" => true, "message" => "Successfully edited"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function DeleteForm(string $id, Request $request)
    {
        $ipcr_form = Form::find($id);
        $ipcr_form->delete();

        return response()->json(["success" => true, "message" => "Successfully deleted"]);
    }
}
