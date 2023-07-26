<?php

namespace App\Http\Controllers;

use App\Models\Ipcrform as Form;
use App\Models\Schedule;
use App\Models\Input;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;

class PDFController extends Controller
{
    public function printform(string $id)
    {
        $dompdf = new Dompdf();

        // Set paper options
        $dompdf->setPaper('Legal', 'landscape');
        // $options = new Options();
        // $options->set('margin_top', '0.2in');
        // $options->set('margin_right', '0.2in');
        // $options->set('margin_bottom', '0.2in');
        // $options->set('margin_left', '0.2in');

        // $dompdf->setOptions($options);

        $ipcr_form = Form::find($id);
        $schedule = Schedule::where('purpose', 'Performance Targets')->first();
        $add_inputs = Input::where('form_id', $ipcr_form->id)->get();
        // get data
        $data = [
            'Form' => $ipcr_form,
            'Schedule' => $schedule,
            'Add_inputs' => $add_inputs,
            'startDate' => Carbon::createFromFormat('Y-m-d', $schedule->duration_from)->format('F d, Y'),
            'endDate' => Carbon::createFromFormat('Y-m-d', $schedule->duration_to)->format('F d, Y'),
        ];

        // import data to the blade
        $html = view("print.form", $data);
        // make it into a print form
        $dompdf->loadHtml($html);

        $dompdf->render();

        // redirect to the page
        $dompdf->stream('output.pdf', ['Attachment' => false]);
    }
}
