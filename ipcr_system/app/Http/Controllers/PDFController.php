<?php

namespace App\Http\Controllers;

use App\Models\Ipcrform as Form;
use App\Models\Schedule;
use App\Models\Input;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;

class PDFController extends Controller
{
    public function printform(string $id)
    {
        // $ipcr_form = Form::find($id);
        // $schedule = Schedule::where('purpose', 'Performance Targets')->first();
        // $add_inputs = Input::where('employee_id', $ipcr_form->id)->get();
        // $data = [
        //     'Form' => $ipcr_form,
        //     'Schedule' => $schedule,
        //     'Add_inputs' => $add_inputs
        // ];

        // $html = view("print.form", $data)->render();
        // return PDF::loadHTML($html, "utf-8")->setPaper("long", "landscape")->stream();

        $dompdf = new Dompdf();

        $dompdf->setPaper('long', 'landscape');
        $options = new Options();
        $options->set('margin_top', '0.2in');
        $options->set('margin_right', '0.2in');
        $options->set('margin_bottom', '0.2in');
        $options->set('margin_left', '0.2in');

        $dompdf->setOptions($options);

        $ipcr_form = Form::find($id);
        $schedule = Schedule::where('purpose', 'Performance Targets')->first();
        $add_inputs = Input::where('employee_id', $ipcr_form->id)->get();
        $data = [
            'Form' => $ipcr_form,
            'Schedule' => $schedule,
            'Add_inputs' => $add_inputs
        ];

        $html = view("print.form", $data);
        $dompdf->loadHtml($html);

        $dompdf->render();

        $dompdf->stream('output.pdf', ['Attachment' => false]);
    }
}
