<?php

namespace App\Http\Controllers;

use App\Models\Ipcrform as Form;
use PDF;

class PDFController extends Controller
{
    public function printform(string $id)
    {
        $ipcr_form = Form::find($id);
        $data = [
            'Form' => $ipcr_form,
        ];

        $html = view("print.form", $data)->render();
        return PDF::loadHTML($html, "utf-8")->setPaper("long", "landscape")->stream();
    }
}
