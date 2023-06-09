<?php

namespace App\Http\Controllers;

use App\Models\Ipcrform as Form;
use App\Models\Input;
use Illuminate\Http\Request;

class GradeDCController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ipcr_form = Form::where('status', 'Grading by DC')->get();

        return view('dc.gradelist', compact('ipcr_form'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $ipcr_form = Form::find($id);

        $add_input = Input::where('employee_id', $id)->get();

        return view('dc.gradeedit', compact(['ipcr_form', 'id', 'add_input']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ipcr_form = Form::find($id);
        $add_input = Input::where('employee_id', $id)->get();

        Input::where('employee_id', $id)->delete();

        $length = 0;

        $sp = 0;
        $cf = 0;
        $sf = 0;

        foreach ($add_input as $addinput) {
            $length++;

            $word_sp = "functions_sp" . (string)$sp;
            $word_sp1 = "success_indicators_sp" . (string)$sp;
            $word_sp2 = "actual_accomplishments_sp" . (string)$sp;
            $grade_sp1 = "q1_sp" . (string)$sp;
            $grade_sp2 = "e2_sp" . (string)$sp;
            $grade_sp3 = "t3_sp" . (string)$sp;
            $grade_sp4 = "a4_sp" . (string)$sp;
            $remarks_sp = "remarks_sp" . (string)$sp;
            $graded_by_sp = "graded_by_sp" . (string)$sp;
            $function_sp = $request->$word_sp;
            $si_sp = $request->$word_sp1;
            $aa_sp = $request->$word_sp2;
            $q1_sp = $request->$grade_sp1;
            $e2_sp = $request->$grade_sp2;
            $t3_sp = $request->$grade_sp3;
            $a4_sp = $request->$grade_sp4;
            $re_sp = $request->$remarks_sp;
            $graded_sp = $request->$graded_by_sp;

            $word_cf = "functions_cf" . (string)$cf;
            $word_cf1 = "success_indicators_cf" . (string)$cf;
            $word_cf2 = "actual_accomplishments_cf" . (string)$cf;
            $grade_cf1 = "q1_cf" . (string)$cf;
            $grade_cf2 = "e2_cf" . (string)$cf;
            $grade_cf3 = "t3_cf" . (string)$cf;
            $grade_cf4 = "a4_cf" . (string)$cf;
            $remarks_cf = "remarks_cf" . (string)$cf;
            $graded_by_cf = "graded_by_cf" . (string)$cf;
            $function_cf = $request->$word_cf;
            $si_cf = $request->$word_cf1;
            $aa_cf = $request->$word_cf2;
            $q1_cf = $request->$grade_cf1;
            $e2_cf = $request->$grade_cf2;
            $t3_cf = $request->$grade_cf3;
            $a4_cf = $request->$grade_cf4;
            $re_cf = $request->$remarks_cf;
            $graded_cf = $request->$graded_by_cf;

            $word_sf = "functions_sf" . (string)$sf;
            $word_sf1 = "success_indicators_sf" . (string)$sf;
            $word_sf2 = "actual_accomplishments_sf" . (string)$sf;
            $grade_sf1 = "q1_sf" . (string)$sf;
            $grade_sf2 = "e2_sf" . (string)$sf;
            $grade_sf3 = "t3_sf" . (string)$sf;
            $grade_sf4 = "a4_sf" . (string)$sf;
            $remarks_sf = "remarks_sf" . (string)$sf;
            $graded_by_sf = "graded_by_sf" . (string)$sf;
            $function_sf = $request->$word_sf;
            $si_sf = $request->$word_sf1;
            $aa_sf = $request->$word_sf2;
            $q1_sf = $request->$grade_sf1;
            $e2_sf = $request->$grade_sf2;
            $t3_sf = $request->$grade_sf3;
            $a4_sf = $request->$grade_sf4;
            $re_sf = $request->$remarks_sf;
            $graded_sf = $request->$graded_by_sf;

            if ($function_sp != null) {
                $add_input = new Input();
                $add_input->employee_id = $id;
                $add_input->code = "SP";
                $add_input->functions = $function_sp;
                $add_input->success_indicators = $si_sp;
                $add_input->actual_accomplishments = $aa_sp;
                $add_input->q1 = $q1_sp;
                $add_input->e2 = $e2_sp;
                $add_input->t3 = $t3_sp;
                $add_input->a4 = $a4_sp;
                $add_input->remarks = $re_sp;
                $add_input->graded_by = $graded_sp;
                $add_input->semester = $ipcr_form->covered_period;
                $add_input->year = date("Y");
                $add_input->save();
            } else if ($function_cf != null) {
                $add_input = new Input();
                $add_input->employee_id = $id;
                $add_input->code = "CF";
                $add_input->functions = $function_cf;
                $add_input->success_indicators = $si_cf;
                $add_input->actual_accomplishments = $aa_cf;
                $add_input->q1 = $q1_cf;
                $add_input->e2 = $e2_cf;
                $add_input->t3 = $t3_cf;
                $add_input->a4 = $a4_cf;
                $add_input->remarks = $re_cf;
                $add_input->graded_by = $graded_cf;
                $add_input->semester = $ipcr_form->covered_period;
                $add_input->year = date("Y");
                $add_input->save();
            } else if ($function_sf != null) {
                $add_input = new Input();
                $add_input->employee_id = $id;
                $add_input->code = "SF";
                $add_input->functions = $function_sf;
                $add_input->success_indicators = $si_sf;
                $add_input->actual_accomplishments = $aa_sf;
                $add_input->q1 = $q1_sf;
                $add_input->e2 = $e2_sf;
                $add_input->t3 = $t3_sf;
                $add_input->a4 = $a4_sf;
                $add_input->remarks = $re_sf;
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
