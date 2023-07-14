<?php

namespace App\Http\Controllers;

use App\Models\Ipcrform as Form;
use App\Models\Input;
use App\Models\Schedule;
use App\Models\Accounts as User;
use App\Models\DraftIPCR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class IPCRFormController extends Controller
{

    // For Employee view

    /**
     * Display a listing of the resource.
     */
    public function EmployeeIPCRFormList()
    {
        // Get all IPCR forms
        $ipcr_form = Form::get();

        return view('table.empIPCRList', compact("ipcr_form"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function EmployeeCreateIPCRForm()
    {
        // Get the schedule for performance targets
        $schedule = Schedule::where('purpose', 'Performance Targets')->first();
        $draft = DraftIPCR::where('employee_id', Auth::user()->id)->first();

        return view("create.ipcrForm", compact('schedule', 'draft'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function EmployeeStoreIPCRForm(Request $request)
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
            'office.min' => 'Office must be at least 2 characters',

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
            'office' => 'required|min:2|max:50',
            'email' => 'required|min:12|max:50',
            'reviewer' => 'required',
            'approver' => 'required',
        ], $message_error);

        $schedule = Schedule::where('purpose', 'Performance Targets')->first();

        if ($validator->passes()) {
            // Store the IPCR form
            $ipcr_form = new Form();
            $ipcr_form->date_created = date("Y");
            $ipcr_form->employee_id = $request->employee_id;
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
            $length1 = $sp + 1;
            $cf = 0;
            $length2 = $cf + 1;
            $sf = 0;
            $length3 = $sf + 1;

            $sp_noinput = true;
            $cf_noinput = true;
            $sf_noinput = true;

            for ($sp; $sp < $length1; $sp++) {
                $word_sp = "function_sp" . (string)$sp;
                $word_sp1 = "success_indicator_sp" . (string)$sp;
                $function_sp = $request->$word_sp;
                $si_sp = $request->$word_sp1;
                if ($function_sp != null) {
                    $length1++;
                    $add_input = new Input();
                    $add_input->form_id = $last_ipcr_form['id'];
                    $add_input->code = "SP";
                    $add_input->function = $function_sp;
                    $add_input->success_indicator = $si_sp;
                    $add_input->semester = $request->covered_period;
                    $add_input->year = $request->year;
                    $add_input->save();
                    $sp_noinput = false;
                } else {
                    break;
                }
            }

            for ($cf; $cf < $length2; $cf++) {
                $word_cf = "function_cf" . (string)$cf;
                $word_cf1 = "success_indicator_cf" . (string)$cf;
                $function_cf = $request->$word_cf;
                $si_cf = $request->$word_cf1;
                if ($function_cf != null) {
                    $length2++;
                    $add_input = new Input();
                    $add_input->form_id = $last_ipcr_form['id'];
                    $add_input->code = "CF";
                    $add_input->function = $function_cf;
                    $add_input->success_indicator = $si_cf;
                    $add_input->semester = $request->covered_period;
                    $add_input->year = $request->year;
                    $add_input->save();
                    $cf_noinput = false;
                } else {
                    break;
                }
            }

            for ($sf; $sf < $length3; $sf++) {
                $word_sf = "function_sf" . (string)$sf;
                $word_sf1 = "success_indicator_sf" . (string)$sf;
                $function_sf = $request->$word_sf;
                $si_sf = $request->$word_sf1;
                if ($function_sf != null) {
                    $length3++;
                    $add_input = new Input();
                    $add_input->form_id = $last_ipcr_form['id'];
                    $add_input->code = "SF";
                    $add_input->function = $function_sf;
                    $add_input->success_indicator = $si_sf;
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

    public function EmployeeSaveDraft(Request $request)
    {
        $schedule = Schedule::where('purpose', 'Performance Targets')->first();

        // Store inputs for different sections (SP, CF, SF)

        $sp = 0;
        $length1 = $sp + 1;
        $cf = 0;
        $length2 = $cf + 1;
        $sf = 0;
        $length3 = $sf + 1;

        $sp_noinput = true;
        $cf_noinput = true;
        $sf_noinput = true;

        for ($sp; $sp < $length1; $sp++) {
            $word_sp = "function_sp" . (string)$sp;
            $word_sp1 = "success_indicator_sp" . (string)$sp;
            $function_sp = $request->$word_sp;
            $si_sp = $request->$word_sp1;
            if ($function_sp != null) {
                $length1++;
                $draft = new DraftIPCR();
                $draft->employee_id = Auth::user()->id;
                $draft->code = "SP";
                $draft->function = $function_sp;
                $draft->success_indicator = $si_sp;
                $draft->semester = $request->covered_period;
                $draft->year = $request->year;
                $draft->save();
                $sp_noinput = false;
            } else {
                break;
            }
        }

        for ($cf; $cf < $length2; $cf++) {
            $word_cf = "function_cf" . (string)$cf;
            $word_cf1 = "success_indicator_cf" . (string)$cf;
            $function_cf = $request->$word_cf;
            $si_cf = $request->$word_cf1;
            if ($function_cf != null) {
                $length2++;
                $draft = new Input();
                $draft->employee_id = Auth::user()->id;
                $draft->code = "CF";
                $draft->function = $function_cf;
                $draft->success_indicator = $si_cf;
                $draft->semester = $request->covered_period;
                $draft->year = $request->year;
                $draft->save();
                $cf_noinput = false;
            } else {
                break;
            }
        }

        for ($sf; $sf < $length3; $sf++) {
            $word_sf = "function_sf" . (string)$sf;
            $word_sf1 = "success_indicator_sf" . (string)$sf;
            $function_sf = $request->$word_sf;
            $si_sf = $request->$word_sf1;
            if ($function_sf != null) {
                $length3++;
                $draft = new Input();
                $draft->form_id = Auth::user()->id;
                $draft->code = "SF";
                $draft->function = $function_sf;
                $draft->success_indicator = $si_sf;
                $draft->semester = $request->covered_period;
                $draft->year = $request->year;
                $draft->save();
                $sf_noinput = false;
            } else {
                break;
            }
        }

        if ($sp_noinput && $cf_noinput && $sf_noinput) {
            return response()->json(["status" => false, "errors" => ["No input."]]);
        } else {
            return response()->json(["success" => true, "message" => "Successfully created a form!"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function EmployeeViewIPCRForm(string $id)
    {
        // Find the IPCR form by ID
        $ipcr_form = Form::find($id);

        // Get associated inputs for the form
        $add_input = Input::where('form_id', $id)->get();

        return view("view.ipcrForm", compact(['ipcr_form', 'add_input']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function EmployeeEditIPCRForm(string $id)
    {
        // Find the IPCR form by ID
        $ipcr_form = Form::find($id);

        // Get associated inputs for the form
        $add_input = Input::where('form_id', $id)->get();

        return view("edit.ipcrForm", compact(['ipcr_form', 'id', 'add_input']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function EmployeeUpdateIPCRForm(Request $request, string $id)
    {
        // Get associated inputs for the form
        $add_input = Input::where('form_id', $id)->get();

        $message_error = [];

        $ipcr_form = Form::find($id);

        $length = 0;

        $sp = 0;
        $cf = 0;
        $sf = 0;

        if (($request->function_sp0 == "" || $request->success_indicator_sp0 == "") && ($request->function_cf0 == "" || $request->success_indicator_cf0 == "") && ($request->function_sf0 == "" || $request->success_indicator_sf0 == "")) {
            // returns an error if one of the textbox remains empty
            return response()->json(["status" => false, "message" => "No Input."]);
        } else {
            // removes all the employee's input data that he/she submitted
            Input::where('form_id', $id)->delete();

            foreach ($add_input as $addinput) {
                // Update the form attributes from the request
                $length++;

                $word_sp = "function_sp" . (string)$sp;
                $word_sp1 = "success_indicator_sp" . (string)$sp;
                $word_sp2 = "actual_accomplishments_sp" . (string)$sp;
                $function_sp = $request->$word_sp;
                $si_sp = $request->$word_sp1;
                $aa_sp = $request->$word_sp2;

                $word_cf = "function_cf" . (string)$cf;
                $word_cf1 = "success_indicator_cf" . (string)$cf;
                $word_cf2 = "actual_accomplishments_cf" . (string)$cf;
                $function_cf = $request->$word_cf;
                $si_cf = $request->$word_cf1;
                $aa_cf = $request->$word_cf2;

                $word_sf = "function_sf" . (string)$sf;
                $word_sf1 = "success_indicator_sf" . (string)$sf;
                $word_sf2 = "actual_accomplishments_sf" . (string)$sf;
                $function_sf = $request->$word_sf;
                $si_sf = $request->$word_sf1;
                $aa_sf = $request->$word_sf2;

                if ($function_sp != "") {
                    $add_input = new Input();
                    $add_input->form_id = $id;
                    $add_input->code = "SP";
                    $add_input->function = $function_sp;
                    $add_input->success_indicator = $si_sp;
                    $add_input->actual_accomplishments = $aa_sp;
                    $add_input->semester = $ipcr_form->covered_period;
                    $add_input->year = date("Y");
                    if ($ipcr_form->status == "Rejected by Director") {
                        $add_input->q1 = null;
                        $add_input->e2 = null;
                        $add_input->t3 = null;
                        $add_input->a4 = null;
                        $add_input->remark = null;
                        $add_input->graded_by = null;
                    }
                    $add_input->save();
                } else if ($function_cf != "") {
                    $add_input = new Input();
                    $add_input->form_id = $id;
                    $add_input->code = "CF";
                    $add_input->function = $function_cf;
                    $add_input->success_indicator = $si_cf;
                    $add_input->actual_accomplishments = $aa_cf;
                    $add_input->semester = $ipcr_form->covered_period;
                    $add_input->year = date("Y");
                    if ($ipcr_form->status == "Rejected by Director") {
                        $add_input->q1 = null;
                        $add_input->e2 = null;
                        $add_input->t3 = null;
                        $add_input->a4 = null;
                        $add_input->remark = null;
                        $add_input->graded_by = null;
                    }
                    $add_input->save();
                } else if ($function_sf != "") {
                    $add_input = new Input();
                    $add_input->form_id = $id;
                    $add_input->code = "SF";
                    $add_input->function = $function_sf;
                    $add_input->success_indicator = $si_sf;
                    $add_input->actual_accomplishments = $aa_sf;
                    $add_input->semester = $ipcr_form->covered_period;
                    $add_input->year = date("Y");
                    if ($ipcr_form->status == "Rejected by Director") {
                        $add_input->q1 = null;
                        $add_input->e2 = null;
                        $add_input->t3 = null;
                        $add_input->a4 = null;
                        $add_input->remark = null;
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
    public function EmployeeDeleteIPCRForm(string $id, Request $request)
    {
        Form::find($id)->delete();
        Input::where("form_id", $id)->delete();

        return response()->json(["success" => true, "message" => "Successfully deleted"]);
    }

    // For HR View

    /**
     * Display a listing of the resource.
     */
    public function HRListIPCRForm()
    {
        $ipcr_form = Form::get();

        return view("table.hrListForm", compact('ipcr_form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function HRViewIPCRForm(string $id)
    {
        $ipcr_form = Form::find($id);

        $add_input = Input::where('form_id', $id)->get();

        return view("approve.hrVerify", compact(['ipcr_form', 'id', 'add_input']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function HRUpdateIPCRForm(Request $request, string $id)
    {
        $ipcr_form = Form::find($id);
        $email = $ipcr_form->email;

        $data = [
            'ipcr_form' => $ipcr_form,
            'hr_firstName' => Auth::user()->first_name,
            'hr_lastName' => Auth::user()->last_name,
            'hr_position' => Auth::user()->position,
            'hr_email' => Auth::user()->email,
        ];

        // send email that he/she was verified
        Mail::send('mail.verified', $data, function ($message) use ($email) {
            $message->to($email);
            $message->subject('HR Confirmation: Your Form Has Been Successfully Verified');
            $message->from(Auth::user()->email, 'IPCR HR');
        });

        // change the status of the form to "Verified"
        $ipcr_form->status = "Verified";
        $ipcr_form->save();

        return response()->json(["success" => true, "message" => "Successfully verified the form!"]);
    }

    // For Division Chief View

    // For Approving IPCR Form

    /**
     * Display a listing of the resource.
     */
    public function DCListPendingIPCRForm()
    {
        // Find the IPCR form where the status is Pending
        $ipcr_form = Form::where('status', 'Pending')->get();

        return view('table.dcApproveList', compact('ipcr_form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function DCEditPendingIPCRForm(string $id)
    {
        // Find the IPCR form based on the provided $id
        $ipcr_form = Form::find($id);

        // Find the Additional input from the user
        $add_input = Input::where('form_id', $id)->get();

        return view("approve.dcApprove", compact(['ipcr_form', 'id', 'add_input']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function DCUpdatePendingIPCRForm(Request $request, string $id)
    {
        // Find the IPCR form based on the provided $id
        $ipcr_form = Form::find($id);

        // Get the email associated with the IPCR form and the desired status from the request
        $email = $ipcr_form->email;
        $status = $request->status;

        if ($status == "Approved by DC") {
            $data = [
                'ipcr_form' => $ipcr_form,
                'dc_firstName' => Auth::user()->first_name,
                'dc_lastName' => Auth::user()->last_name,
                'dc_position' => Auth::user()->position,
                'dc_email' => Auth::user()->email,
                'schedule' => Schedule::where('purpose', 'Performance Targets')->first(),
            ];

            // Send an email notification for form approval
            Mail::send('mail.approveDC', $data, function ($message) use ($email) {
                $message->to($email);
                $message->subject('Update Your IPCR Form: Division Chief Approval and Accomplishments Input');
                $message->from(Auth::user()->email, 'IPCR Division Chief');
            });

            // Update the status of the IPCR form and save it
            $ipcr_form->status = $request->status;
            $ipcr_form->save();

            return response()->json(["success" => true, "message" => "Successfully approved!"]);
        } else if ($status == "Rejected by DC") {
            $data = [
                'reason' => $request->reason,
                'ipcr_form' => $ipcr_form,
                'dc_firstName' => Auth::user()->first_name,
                'dc_lastName' => Auth::user()->last_name,
                'dc_position' => Auth::user()->position,
                'dc_email' => Auth::user()->email,
                'schedule' => Schedule::where('purpose', 'Performance Targets')->first(),
            ];

            // Send an email notification for form rejection
            Mail::send('mail.rejectDC', $data, function ($message) use ($data, $email) {
                $message->to($email);
                $message->subject('Action Required: Revision of IPCR Form - Division Chief Review');
                $message->from(Auth::user()->email, 'IPCR Division Chief');
            });

            // Update the status of the IPCR form and save it
            $ipcr_form->status = $request->status;
            $ipcr_form->save();

            return response()->json(["success" => true, "message" => "Successfully rejected!"]);
        }
    }

    // For Grading IPCR Form

    /**
     * Display a listing of the resource.
     */
    public function DCListGradingIPCRForm()
    {
        $ipcr_form = Form::where('status', 'Grading by DC')->get();

        return view('table.dcGradeList', compact('ipcr_form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function DCEditGradingIPCRForm(string $id)
    {
        $ipcr_form = Form::find($id);

        $add_input = Input::where('form_id', $id)->get();

        return view('grading.dcGrading', compact(['ipcr_form', 'id', 'add_input']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function DCUpdateGradingIPCRForm(Request $request, string $id)
    {
        $message_error = [
            // Validation error messages
            'comments.required' => 'Comments is required.',
        ];

        $validator = validator::make($request->all(), [
            // Validation rules
            'comments' => 'required',
        ], $message_error);

        $schedule = Schedule::where('purpose', 'Performance Targets')->first();

        if ($validator->passes()) {
            // Find the IPCR form based on the provided $id
            $ipcr_form = Form::find($id);
            $add_input = Input::where('form_id', $id)->get();

            // Delete existing input records for the employee
            Input::where('form_id', $id)->delete();

            $length = 0;

            $sp = 0;
            $cf = 0;
            $sf = 0;

            foreach ($add_input as $addinput) {
                $length++;

                // Generate dynamic variable names based on the index
                $word_sp = "function_sp" . (string)$sp;
                $word_sp1 = "success_indicator_sp" . (string)$sp;
                $word_sp2 = "actual_accomplishments_sp" . (string)$sp;
                $grade_sp1 = "q1_sp" . (string)$sp;
                $grade_sp2 = "e2_sp" . (string)$sp;
                $grade_sp3 = "t3_sp" . (string)$sp;
                $grade_sp4 = "a4_sp" . (string)$sp;
                $remark_sp = "remark_sp" . (string)$sp;
                $graded_by_sp = "graded_by_sp" . (string)$sp;

                // Get the values from the request using the generated variable names
                $function_sp = $request->$word_sp;
                $si_sp = $request->$word_sp1;
                $aa_sp = $request->$word_sp2;
                $q1_sp = $request->$grade_sp1;
                $e2_sp = $request->$grade_sp2;
                $t3_sp = $request->$grade_sp3;
                $a4_sp = $request->$grade_sp4;
                $re_sp = $request->$remark_sp;
                $graded_sp = $request->$graded_by_sp;

                // Repeat the same process for "CF" and "SF" codes
                $word_cf = "function_cf" . (string)$cf;
                $word_cf1 = "success_indicator_cf" . (string)$cf;
                $word_cf2 = "actual_accomplishments_cf" . (string)$cf;
                $grade_cf1 = "q1_cf" . (string)$cf;
                $grade_cf2 = "e2_cf" . (string)$cf;
                $grade_cf3 = "t3_cf" . (string)$cf;
                $grade_cf4 = "a4_cf" . (string)$cf;
                $remark_cf = "remark_cf" . (string)$cf;
                $graded_by_cf = "graded_by_cf" . (string)$cf;

                $function_cf = $request->$word_cf;
                $si_cf = $request->$word_cf1;
                $aa_cf = $request->$word_cf2;
                $q1_cf = $request->$grade_cf1;
                $e2_cf = $request->$grade_cf2;
                $t3_cf = $request->$grade_cf3;
                $a4_cf = $request->$grade_cf4;
                $re_cf = $request->$remark_cf;
                $graded_cf = $request->$graded_by_cf;

                $word_sf = "function_sf" . (string)$sf;
                $word_sf1 = "success_indicator_sf" . (string)$sf;
                $word_sf2 = "actual_accomplishments_sf" . (string)$sf;
                $grade_sf1 = "q1_sf" . (string)$sf;
                $grade_sf2 = "e2_sf" . (string)$sf;
                $grade_sf3 = "t3_sf" . (string)$sf;
                $grade_sf4 = "a4_sf" . (string)$sf;
                $remark_sf = "remark_sf" . (string)$sf;
                $graded_by_sf = "graded_by_sf" . (string)$sf;

                $function_sf = $request->$word_sf;
                $si_sf = $request->$word_sf1;
                $aa_sf = $request->$word_sf2;
                $q1_sf = $request->$grade_sf1;
                $e2_sf = $request->$grade_sf2;
                $t3_sf = $request->$grade_sf3;
                $a4_sf = $request->$grade_sf4;
                $re_sf = $request->$remark_sf;
                $graded_sf = $request->$graded_by_sf;

                if ($function_sp != null) {
                    // Create and save a new Input record for "SP" code
                    $add_input = new Input();
                    $add_input->form_id = $id;
                    $add_input->code = "SP";
                    $add_input->function = $function_sp;
                    $add_input->success_indicator = $si_sp;
                    $add_input->actual_accomplishments = $aa_sp;
                    $add_input->q1 = $q1_sp;
                    $add_input->e2 = $e2_sp;
                    $add_input->t3 = $t3_sp;
                    $add_input->a4 = $a4_sp;
                    $add_input->remark = $re_sp;
                    $add_input->graded_by = $graded_sp;
                    $add_input->semester = $ipcr_form->covered_period;
                    $add_input->year = date("Y");
                    $add_input->save();
                } else if ($function_cf != null) {
                    // Create and save a new Input record for "CF" code
                    $add_input = new Input();
                    $add_input->form_id = $id;
                    $add_input->code = "CF";
                    $add_input->function = $function_cf;
                    $add_input->success_indicator = $si_cf;
                    $add_input->actual_accomplishments = $aa_cf;
                    $add_input->q1 = $q1_cf;
                    $add_input->e2 = $e2_cf;
                    $add_input->t3 = $t3_cf;
                    $add_input->a4 = $a4_cf;
                    $add_input->remark = $re_cf;
                    $add_input->graded_by = $graded_cf;
                    $add_input->semester = $ipcr_form->covered_period;
                    $add_input->year = date("Y");
                    $add_input->save();
                } else if ($function_sf != null) {
                    // Create and save a new Input record for "SF" code
                    $add_input = new Input();
                    $add_input->form_id = $id;
                    $add_input->code = "SF";
                    $add_input->function = $function_sf;
                    $add_input->success_indicator = $si_sf;
                    $add_input->actual_accomplishments = $aa_sf;
                    $add_input->q1 = $q1_sf;
                    $add_input->e2 = $e2_sf;
                    $add_input->t3 = $t3_sf;
                    $add_input->a4 = $a4_sf;
                    $add_input->remark = $re_sf;
                    $add_input->graded_by = $graded_sf;
                    $add_input->semester = $ipcr_form->covered_period;
                    $add_input->year = date("Y");
                    $add_input->save();
                }

                $sp++;
                $cf++;
                $sf++;
            }

            $ipcr_form->status = "Graded by DC";
            $ipcr_form->far = $request->far;
            $ipcr_form->comment = $request->comments;
            $ipcr_form->save();

            return response()->json(["success" => true, "message" => "Successfully updated the form"]);
        } else {
            return response()->json(["success" => false, "message" => "An error has been occured."]);
        }
    }

    // For Director View

    /**
     * Display a listing of the resource.
     */
    public function DirectorListGradedIPCRForm()
    {
        $ipcr_form = Form::where('status', 'Graded by DC')->get();

        return view('table.directorApproveList', compact('ipcr_form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function DirectorEditGradedIPCRForm(string $id)
    {
        $ipcr_form = Form::find($id);

        $add_input = Input::where('form_id', $id)->get();

        return view('approve.directorApprove', compact(['ipcr_form', 'id', 'add_input']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function DirectorUpdateGradedIPCRForm(Request $request, string $id)
    {
        $ipcr_form = Form::find($id);
        $input = Input::where('form_id', $id)->first();
        $dc_email = $input->graded_by;
        $dc_info = User::where('email', $input->graded_by)->first();
        $email = $ipcr_form->email;
        $status = $request->status;

        if ($status == "Approved by Director") {
            $ipcr_form->status = $request->status;
            $ipcr_form->save();

            return response()->json(["success" => true, "message" => "Successfully approved!"]);
        } else if ($status == "Rejected by Director") {
            $data = [
                'reason' => $request->reason,
                'ipcr_form' => $ipcr_form,
                'director_firstName' => Auth::user()->first_name,
                'director_lastName' => Auth::user()->last_name,
                'director_position' => Auth::user()->position,
                'director_email' => Auth::user()->email,
                'dc_info' => $dc_info,
                'schedule' => Schedule::where('purpose', 'Performance Targets')->first(),
            ];
            Mail::send('mail.rejectDirectorToEmployee', $data, function ($message) use ($data, $email) {
                $message->to($email);
                $message->subject("Action Required: Revision of IPCR Form - Director's Feedback");
                $message->from(Auth::user()->email, 'IPCR Director');
            });
            Mail::send('mail.rejectDirectorToDC', $data, function ($message) use ($data, $dc_email) {
                $message->to($dc_email);
                $message->subject('Request for Review: IPCR Form Grade Rejection');
                $message->from(Auth::user()->email, 'IPCR Director');
            });

            $ipcr_form->status = $request->status;
            $ipcr_form->save();

            return response()->json(["success" => true, "message" => "Successfully rejected!"]);
        }
    }
}
