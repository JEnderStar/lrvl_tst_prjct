<?php

namespace App\Http\Controllers;

use App\Models\Ipcrform as Form;
use App\Models\Input;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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
        $schedule = Schedule::where('purpose', 'Performance Targets')->first();

        return view("employee.create", compact('schedule'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message_error = [
            'first_name.required' => 'First name is required.',
            'first_name.max' => 'First name should not exceed 25 characters.',
            'first_name.min' => 'First name must be at least 2 characters',

            'last_name.required' => 'Last name is required.',
            'last_name.max' => 'Last name should not exceed 25 characters.',
            'last_name.min' => 'Last name must be at least 2 characters',

            'mi.max' => 'Middle Initial should not exceed 25 characters.',

            'position.required' => 'Position is required.',
            'position.max' => 'Position should not exceed 30 characters.',
            'position.min' => 'Position must be at least 4 characters',

            'office.required' => 'Office is required.',
            'office.max' => 'Office should not exceed 50 characters.',
            'office.min' => 'Office must be at least 4 characters',

            'email.required' => 'Email is required.',
            'email.max' => 'Email should not exceed 50 characters.',
            'email.min' => 'Email must be at least 12 characters',

            'reviewer.required' => 'Reviewer is required',

            'approver.required' => 'Approver is required',
        ];

        $validator = validator::make($request->all(), [
            'first_name' => 'required|min:2|max:25',
            'last_name' => 'required|min:2|max:25',
            'mi' => 'max:1',
            'position' => 'required|min:4|max:30',
            'office' => 'required|min:4|max:50',
            'email' => 'required|min:12|max:50',
            'reviewer' => 'required',
            'approver' => 'required',
        ], $message_error);

        $schedule = Schedule::where('purpose', 'Performance Targets')->first();

        if($validator ->passes()){
            $timenow = Carbon::now()->toDateTimeString();
    
            $ipcr_form = new Form();
            $ipcr_form->date_created = $timenow;
            $ipcr_form->covered_period = $request->covered_period;
            $ipcr_form->first_name = $request->first_name;
            $ipcr_form->last_name = $request->last_name;
            $ipcr_form->mi = $request->mi;
            $ipcr_form->position = $request->position;
            $ipcr_form->office = $request->office;
            $ipcr_form->email = $request->email;
            $ipcr_form->reviewer = $request->reviewer;
            $ipcr_form->approver = $request->approver;
            $ipcr_form->status = "Pending";
            $ipcr_form->save();

            $last_ipcr_form = Form::get()->last();

            $sp = 0;
            $sp2 = $sp + 1;
            $cf = 0;
            $cf2 = $cf + 1;
            $sf = 0;
            $sf2 = $sf + 1;

            for($sp; $sp < $sp2; $sp++){
                $word_sp = "functions_sp".(string)$sp;
                $word_sp1 = "success_indicator_sp".(string)$sp;
                $function = $request->$word_sp;
                $si = $request->$word_sp1;
                if($function != null){
                    $sp2++;
                    $add_input = new Input();
                    $add_input->employee_id = $last_ipcr_form['id'];
                    $add_input->code = "SP";
                    $add_input->functions = $function;
                    $add_input->success_indicators = $si;
                    $add_input->semester = $request->covered_period;
                    $add_input->year = $request->year;
                    $add_input->save();
                }else{
                    break;
                }
            }

            for($cf; $cf < $cf2; $cf++){
                $word_cf = "functions_cf".(string)$cf;
                $word_cf1 = "success_indicator_cf".(string)$cf;
                $function = $request->$word_cf;
                $si = $request->$word_cf1;
                if($function != null){
                    $cf2++;
                    $add_input = new Input();
                    $add_input->employee_id = $last_ipcr_form['id'];
                    $add_input->code = "CF";
                    $add_input->functions = $function;
                    $add_input->success_indicators = $si;
                    $add_input->semester = $request->covered_period;
                    $add_input->year = $request->year;
                    $add_input->save();
                }else{
                    break;
                }
            }

            for($sf; $sf < $sf2; $sf++){
                $word_sf = "functions_sf".(string)$sf;
                $word_sf1 = "success_indicator_sf".(string)$sf;
                $function = $request->$word_sf;
                $si = $request->$word_sf1;
                if($function != null){
                    $sf2++;
                    $add_input = new Input();
                    $add_input->employee_id = $last_ipcr_form['id'];
                    $add_input->code = "SF";
                    $add_input->functions = $function;
                    $add_input->success_indicators = $si;
                    $add_input->semester = $request->covered_period;
                    $add_input->year = $request->year;
                    $add_input->save();
                }else{
                    break;
                }
            }
    
            return response()->json(["success" => true, "message" => "Successfully created a form!"]);
        }else{
            return response()->json(["status" => false, "errors" => $validator->errors()->all()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ipcr_form = Form::find($id);

        $add_input = Input::where('employee_id', $id)->get();

        return view("employee.show", compact(['ipcr_form', 'add_input']));
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
        $message_error = [
            "strategic_priorities1.required" => "Strategic Priorities is required.",
            "strategic_priorities1.max" => "Strategic Priorities should not exceed 200 characters.",
            "strategic_priorities1.min" => "Strategic Priorities must be at least 10 characters",

            "success_indicator1.required" => "Strategic Priorities' Success Indicator is required.",
            "success_indicator1.max" => "Strategic Priorities' Success Indicator should not exceed 200 characters.",
            "success_indicator1.min" => "Strategic Priorities' Success Indicator must be at least 10 characters",

            "strategic_priorities2.max" => "Strategic Priorities should not exceed 200 characters.",
            "strategic_priorities2.min" => "Strategic Priorities must be at least 10 characters",

            "success_indicator2.max" => "Strategic Priorities' Success Indicator should not exceed 200 characters.",
            "success_indicator2.min" => "Strategic Priorities' Success Indicator must be at least 10 characters",

            "strategic_priorities3.max" => "Strategic Priorities should not exceed 200 characters.",
            "strategic_priorities3.min" => "Strategic Priorities must be at least 10 characters",

            "success_indicator3.max" => "Strategic Priorities' Success Indicator should not exceed 200 characters.",
            "success_indicator3.min" => "Strategic Priorities' Success Indicator must be at least 10 characters",

            "strategic_priorities4.max" => "Strategic Priorities should not exceed 200 characters.",
            "strategic_priorities4.min" => "Strategic Priorities must be at least 10 characters",

            "success_indicator4.max" => "Strategic Priorities' Success Indicator should not exceed 200 characters.",
            "success_indicator4.min" => "Strategic Priorities' Success Indicator must be at least 10 characters",

            "core_functions5.required" => "Core Functions is required.",
            "core_functions5.max" => "Core Functions should not exceed 200 characters.",
            "core_functions5.min" => "Core Functions must be at least 10 characters",

            "success_indicator5.required" => "Core Functions' Success Indicator is required.",
            "success_indicator5.max" => "Core Functions' Success Indicator should not exceed 200 characters.",
            "success_indicator5.min" => "Core Functions' Success Indicator must be at least 10 characters",

            "core_functions6.max" => "Core Functions should not exceed 200 characters.",
            "core_functions6.min" => "Core Functions must be at least 10 characters",

            "success_indicator6.max" => "Core Functions' Success Indicator should not exceed 200 characters.",
            "success_indicator6.min" => "Core Functions' Success Indicator must be at least 10 characters",

            "core_functions7.max" => "Core Functions should not exceed 200 characters.",
            "core_functions7.min" => "Core Functions must be at least 10 characters",

            "success_indicator7.max" => "Core Functions' Success Indicator should not exceed 200 characters.",
            "success_indicator7.min" => "Core Functions' Success Indicator must be at least 10 characters",

            "core_functions8.max" => "Core Functions should not exceed 200 characters.",
            "core_functions8.min" => "Core Functions must be at least 10 characters",

            "success_indicator8.max" => "Core Functions' Success Indicator should not exceed 200 characters.",
            "success_indicator8.min" => "Core Functions' Success Indicator must be at least 10 characters",

            "support_functions9.required" => "Support Functions is required.",
            "support_functions9.max" => "Support Functions should not exceed 200 characters.",
            "support_functions9.min" => "Support Functions must be at least 10 characters",

            "success_indicator9.required" => "Support Functions' Success Indicator is required.",
            "success_indicator9.max" => "Support Functions' Success Indicator should not exceed 200 characters.",
            "success_indicator9.min" => "Support Functions' Success Indicator must be at least 10 characters",

            "support_functions10.max" => "Support Functions should not exceed 200 characters.",
            "support_functions10.min" => "Support Functions must be at least 10 characters",

            "success_indicator10.max" => "Support Functions' Success Indicator should not exceed 200 characters.",
            "success_indicator10.min" => "Support Functions' Success Indicator must be at least 10 characters",

            "support_functions11.max" => "Support Functions should not exceed 200 characters.",
            "support_functions11.min" => "Support Functions must be at least 10 characters",

            "success_indicator11.max" => "Support Functions' Success Indicator should not exceed 200 characters.",
            "success_indicator11.min" => "Support Functions' Success Indicator must be at least 10 characters",

            "support_functions12.max" => "Support Functions should not exceed 200 characters.",
            "support_functions12.min" => "Support Functions must be at least 10 characters",

            "success_indicator12.max" => "Support Functions' Success Indicator should not exceed 200 characters.",
            "success_indicator12.min" => "Support Functions' Success Indicator must be at least 10 characters"
        ];

        $validator = validator::make($request->all(), [
            'strategic_priorities1' => 'required|min:10|max:200',
            'success_indicator1' => 'required|min:10|max:200',
            'strategic_priorities2' => 'min:10|max:200',
            'success_indicator2' => 'min:10|max:200',
            'strategic_priorities3' => 'min:10|max:200',
            'success_indicator3' => 'min:10|max:200',
            'strategic_priorities4' => 'min:10|max:200',
            'success_indicator4' => 'min:10|max:200',
            'core_functions5' => 'required|min:10|max:200',
            'success_indicator5' => 'required|min:10|max:200',
            'core_functions6' => 'min:10|max:200',
            'success_indicator6' => 'min:10|max:200',
            'core_functions7' => 'min:10|max:200',
            'success_indicator7' => 'min:10|max:200',
            'core_functions8' => 'min:10|max:200',
            'success_indicator8' => 'min:10|max:200',
            'support_functions9' => 'required|min:10|max:200',
            'success_indicator9' => 'required|min:10|max:200',
            'support_functions10' => 'min:10|max:200',
            'success_indicator10' => 'min:10|max:200',
            'support_functions11' => 'min:10|max:200',
            'success_indicator11' => 'min:10|max:200',
            'support_functions12' => 'min:10|max:200',
            'success_indicator12' => 'min:10|max:200'
        ], $message_error);

        if($validator ->passes()){
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
        }else{
            return response()->json(["status" => false, "errors" => $validator->errors()->all()]);
        }
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
