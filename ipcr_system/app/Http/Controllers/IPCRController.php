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
        // Get all IPCR forms
        $ipcr_form = Form::get();

        return view('employee.index', compact("ipcr_form"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get the schedule for performance targets
        $schedule = Schedule::where('purpose', 'Performance Targets')->first();

        return view("employee.create", compact('schedule'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message_error = [
            // Validation error messages
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
            // Validation rules
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

        if ($validator->passes()) {
            // Store the IPCR form
            $ipcr_form = new Form();
            $ipcr_form->date_created = date("Y");
            // Set other form attributes from the request
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

            // Store inputs for different sections (SP, CF, SF)

            $last_ipcr_form = Form::get()->last();

            $sp = 0;
            $length = $sp + 1;
            $cf = 0;
            $length = $cf + 1;
            $sf = 0;
            $length = $sf + 1;

            $sp_noinput = true;
            $cf_noinput = true;
            $sf_noinput = true;

            for ($sp; $sp < $length; $sp++) {
                $word_sp = "functions_sp" . (string)$sp;
                $word_sp1 = "success_indicator_sp" . (string)$sp;
                $function_sp = $request->$word_sp;
                $si_sp = $request->$word_sp1;
                if ($function_sp != null) {
                    $length++;
                    $add_input = new Input();
                    $add_input->employee_id = $last_ipcr_form['id'];
                    $add_input->code = "SP";
                    $add_input->functions = $function_sp;
                    $add_input->success_indicators = $si_sp;
                    $add_input->semester = $request->covered_period;
                    $add_input->year = $request->year;
                    $add_input->save();
                    $sp_noinput = false;
                } else {
                    break;
                }
            }

            for ($cf; $cf < $length; $cf++) {
                $word_cf = "functions_cf" . (string)$cf;
                $word_cf1 = "success_indicator_cf" . (string)$cf;
                $function_cf = $request->$word_cf;
                $si_cf = $request->$word_cf1;
                if ($function_cf != null) {
                    $length++;
                    $add_input = new Input();
                    $add_input->employee_id = $last_ipcr_form['id'];
                    $add_input->code = "CF";
                    $add_input->functions = $function_cf;
                    $add_input->success_indicators = $si_cf;
                    $add_input->semester = $request->covered_period;
                    $add_input->year = $request->year;
                    $add_input->save();
                    $cf_noinput = false;
                } else {
                    break;
                }
            }

            for ($sf; $sf < $length; $sf++) {
                $word_sf = "functions_sf" . (string)$sf;
                $word_sf1 = "success_indicator_sf" . (string)$sf;
                $function_sf = $request->$word_sf;
                $si_sf = $request->$word_sf1;
                if ($function_sf != null) {
                    $length++;
                    $add_input = new Input();
                    $add_input->employee_id = $last_ipcr_form['id'];
                    $add_input->code = "SF";
                    $add_input->functions = $function_sf;
                    $add_input->success_indicators = $si_sf;
                    $add_input->semester = $request->covered_period;
                    $add_input->year = $request->year;
                    $add_input->save();
                    $sf_noinput = false;
                } else {
                    break;
                }
            }

            if ($sp_noinput && $cf_noinput && $sf_noinput) {
                // Delete the form if there are no inputs
                $last_ipcr_form->delete();
                return response()->json(["status" => false, "errors" => ["No input."]]);
            } else {
                return response()->json(["success" => true, "message" => "Successfully created a form!"]);
            }
        } else {
            return response()->json(["status" => false, "errors" => $validator->errors()->all()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the IPCR form by ID
        $ipcr_form = Form::find($id);

        // Get associated inputs for the form
        $add_input = Input::where('employee_id', $id)->get();

        return view("employee.show", compact(['ipcr_form', 'add_input']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the IPCR form by ID
        $ipcr_form = Form::find($id);

        // Get associated inputs for the form
        $add_input = Input::where('employee_id', $id)->get();

        return view("employee.edit", compact(['ipcr_form', 'id', 'add_input']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Get associated inputs for the form
        $add_input = Input::where('employee_id', $id)->get();

        $message_error = [];

        $ipcr_form = Form::find($id);

        $length = 0;

        $sp = 0;
        $cf = 0;
        $sf = 0;

        if (($request->functions_sp0 == "" || $request->success_indicators_sp0 == "") || ($request->functions_cf0 == "" || $request->success_indicators_cf0 == "") || ($request->functions_sf0 == "" || $request->success_indicators_sf0 == "")) {
            // returns an error if one of the textbox remains empty
            return response()->json(["status" => false, "message" => "No Input."]);
        } else {
            // removes all the employee's input data that he/she submitted
            Input::where('employee_id', $id)->delete();

            foreach ($add_input as $addinput) {
                // Update the form attributes from the request
                $length++;

                $word_sp = "functions_sp" . (string)$sp;
                $word_sp1 = "success_indicators_sp" . (string)$sp;
                $word_sp2 = "actual_accomplishments_sp" . (string)$sp;
                $function_sp = $request->$word_sp;
                $si_sp = $request->$word_sp1;
                $aa_sp = $request->$word_sp2;

                $word_cf = "functions_cf" . (string)$cf;
                $word_cf1 = "success_indicators_cf" . (string)$cf;
                $word_cf2 = "actual_accomplishments_cf" . (string)$cf;
                $function_cf = $request->$word_cf;
                $si_cf = $request->$word_cf1;
                $aa_cf = $request->$word_cf2;

                $word_sf = "functions_sf" . (string)$sf;
                $word_sf1 = "success_indicators_sf" . (string)$sf;
                $word_sf2 = "actual_accomplishments_sf" . (string)$sf;
                $function_sf = $request->$word_sf;
                $si_sf = $request->$word_sf1;
                $aa_sf = $request->$word_sf2;

                if ($function_sp != "") {
                    $add_input = new Input();
                    $add_input->employee_id = $id;
                    $add_input->code = "SP";
                    $add_input->functions = $function_sp;
                    $add_input->success_indicators = $si_sp;
                    $add_input->actual_accomplishments = $aa_sp;
                    $add_input->semester = $ipcr_form->covered_period;
                    $add_input->year = date("Y");
                    if ($ipcr_form->status == "Rejected by Director") {
                        $add_input->q1 = null;
                        $add_input->e2 = null;
                        $add_input->t3 = null;
                        $add_input->a4 = null;
                        $add_input->remarks = null;
                        $add_input->graded_by = null;
                    }
                    $add_input->save();
                } else if ($function_cf != "") {
                    $add_input = new Input();
                    $add_input->employee_id = $id;
                    $add_input->code = "CF";
                    $add_input->functions = $function_cf;
                    $add_input->success_indicators = $si_cf;
                    $add_input->actual_accomplishments = $aa_cf;
                    $add_input->semester = $ipcr_form->covered_period;
                    $add_input->year = date("Y");
                    if ($ipcr_form->status == "Rejected by Director") {
                        $add_input->q1 = null;
                        $add_input->e2 = null;
                        $add_input->t3 = null;
                        $add_input->a4 = null;
                        $add_input->remarks = null;
                        $add_input->graded_by = null;
                    }
                    $add_input->save();
                } else if ($function_sf != "") {
                    $add_input = new Input();
                    $add_input->employee_id = $id;
                    $add_input->code = "SF";
                    $add_input->functions = $function_sf;
                    $add_input->success_indicators = $si_sf;
                    $add_input->actual_accomplishments = $aa_sf;
                    $add_input->semester = $ipcr_form->covered_period;
                    $add_input->year = date("Y");
                    if ($ipcr_form->status == "Rejected by Director") {
                        $add_input->q1 = null;
                        $add_input->e2 = null;
                        $add_input->t3 = null;
                        $add_input->a4 = null;
                        $add_input->remarks = null;
                        $add_input->graded_by = null;
                    }
                    $add_input->save();
                }

                $sp++;
                $cf++;
                $sf++;
            }

            // change the status of IPCR form
            if ($ipcr_form->status == "Pending") {
                $ipcr_form->save();
            } else if ($ipcr_form->status == "Rejected by DC") {
                $ipcr_form->status = "Pending";
                $ipcr_form->save();
            } else if ($ipcr_form->status == "Rejected by Director") {
                $ipcr_form->status = "Pending";
                $ipcr_form->far = null;
                $ipcr_form->comment = null;
                $ipcr_form->save();
            } else {
                $ipcr_form->status = "Grading by DC";
                $ipcr_form->save();
            }

            return response()->json(["success" => true, "message" => "Successfully edited"]);
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
        Form::find($id)->delete();
        Input::where("employee_id", $id)->delete();

        return response()->json(["success" => true, "message" => "Successfully deleted"]);
    }
}
