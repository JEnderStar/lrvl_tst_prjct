@extends('layouts.app')

@section('content')

<div class="card">
    <a href="/employee" class="btn btn-primary col-1">
        << Back </a>
            <br>
            <div class="w-100" style="background-color:#00B0F0; color:white; display:flex; justify-content:center;">
                <h3> Edit your IPCR Form </h3>
            </div>
            <br>
            <form class="require-validation" action="/employee/edit/{{$id}}" data-user-id="{{$id}}" id="employee_form" method="POST">
                @CSRF
                @METHOD('PUT')

                <div class="card-header">
                    <label> Strategic Priorities </label>
                </div>
                <div class="card-body" id="sp_table">
                    @foreach($add_input as $index => $addinput)
                    @if($addinput->code == "SP")
                    <div class="row">
                    @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC" || $ipcr_form->status == "Rejected by Director")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <textarea type="text" id="function_sp{{$index}}" name="function_sp{{$index}}" class="form-control" oninput="autoExpand(this)">{{$addinput['function']}}</textarea>
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <textarea type="text" id="success_indicator_sp{{$index}}" name="success_indicator_sp{{$index}}" class="form-control" oninput="autoExpand(this)">{{$addinput['success_indicator']}}</textarea>
                        </div>
                        <div class="form-group" hidden>
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments_sp{{$index}}" name="actual_accomplishments_sp{{$index}}" class="form-control">
                        </div>
                        @elseif($ipcr_form->status == "Approved by DC" || $ipcr_form->status == "Grading by DC")
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <p> <b> {{$addinput['function']}} </b> </p>
                            <textarea type="text" id="function_sp{{$index}}" name="function_sp{{$index}}" class="form-control" style="display:none;" readonly>{{$addinput['function']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <p> <b> {{$addinput['success_indicator']}} </b> </p>
                            <textarea type="text" id="success_indicator_sp{{$index}}" name="success_indicator_sp{{$index}}" class="form-control" style="display:none;" readonly>{{$addinput['success_indicator']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <textarea type="text" id="actual_accomplishments_sp{{$index}}" name="actual_accomplishments_sp{{$index}}" class="form-control" oninput="autoExpand(this)">{{$addinput['actual_accomplishments']}}</textarea>
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <textarea type="text" id="function_sp{{$index}}" name="function_sp{{$index}}" class="form-control"readonly>{{$addinput['function']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <textarea type="text" id="success_indicator_sp{{$index}}" name="success_indicator_sp{{$index}}" class="form-control" readonly>{{$addinput['success_indicator']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <textarea type="text" id="actual_accomplishments_sp{{$index}}" name="actual_accomplishments_sp{{$index}}" class="form-control" readonly>{{$addinput['actual_accomplishments']}}</textarea>
                        </div>
                        @endif
                    </div>
                    @endif
                    @endforeach
                </div>

                <div class="card-header">
                    <label> Core Functions </label>
                </div>
                <div class="card-body" id="cf_table">
                    @foreach($add_input as $index => $addinput)
                    @if($addinput->code == "CF")
                    <div class="row" id="cf_table">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC" || $ipcr_form->status == "Rejected by Director")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Core Function </p>
                            <textarea type="text" id="function_cf{{$index}}" name="function_cf{{$index}}" class="form-control" oninput="autoExpand(this)">{{$addinput['function']}}</textarea>
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <textarea type="text" id="success_indicator_cf{{$index}}" name="success_indicator_cf{{$index}}" class="form-control" oninput="autoExpand(this)">{{$addinput['success_indicator']}}</textarea>
                        </div>
                        <div class="form-group" hidden>
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments_cf{{$index}}" name="actual_accomplishments_cf{{$index}}" class="form-control">
                        </div>
                        @elseif($ipcr_form->status == "Approved by DC" || $ipcr_form->status == "Grading by DC")
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Core Function </p>
                            <p> <b> {{$addinput['function']}} </b> </p>
                            <textarea type="text" id="function_cf{{$index}}" name="function_cf{{$index}}" class="form-control" style="display:none;" readonly>{{$addinput['function']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <p> <b> {{$addinput['success_indicator']}} </b> </p>
                            <textarea type="text" id="success_indicator_cf{{$index}}" name="success_indicator_cf{{$index}}" class="form-control" style="display:none;" readonly>{{$addinput['success_indicator']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <textarea type="text" id="actual_accomplishments_cf{{$index}}" name="actual_accomplishments_cf{{$index}}" class="form-control" oninput="autoExpand(this)">{{$addinput['actual_accomplishments']}}</textarea>
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Core Function </p>
                            <textarea type="text" id="function_cf{{$index}}" name="function_cf{{$index}}" class="form-control" readonly>{{$addinput['function']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <textarea type="text" id="success_indicator_cf{{$index}}" name="success_indicator_cf{{$index}}" class="form-control" readonly>{{$addinput['success_indicator']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <textarea type="text" id="actual_accomplishments_cf{{$index}}" name="actual_accomplishments_cf{{$index}}" class="form-control" readonly>{{$addinput['actual_accomplishments']}}</textarea>
                        </div>
                        @endif
                    </div>
                    @endif
                    @endforeach
                </div>

                <div class="card-header">
                    <label> Support Functions </label>
                </div>
                <div class="card-body" id="sf_table">
                    @foreach($add_input as $index => $addinput)
                    @if($addinput->code == "SF")
                    <div class="row" id="sf_table">
                    @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC" || $ipcr_form->status == "Rejected by Director")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Support Function </p>
                            <textarea type="text" id="function_sf{{$index}}" name="function_sf{{$index}}" class="form-control" oninput="autoExpand(this)">{{$addinput['function']}}</textarea>
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <textarea type="text" id="success_indicator_sf{{$index}}" name="success_indicator_sf{{$index}}" class="form-control" oninput="autoExpand(this)">{{$addinput['success_indicator']}}</textarea>
                        </div>
                        <div class="form-group" hidden>
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments_sf{{$index}}" name="actual_accomplishments_sf{{$index}}" class="form-control">
                        </div>
                        @elseif($ipcr_form->status == "Approved by DC" || $ipcr_form->status == "Grading by DC")
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Support Function </p>
                            <p> <b> {{$addinput['function']}} </b> </p>
                            <textarea type="text" id="function_sf{{$index}}" name="function_sf{{$index}}" class="form-control" style="display:none;" readonly>{{$addinput['function']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <p> <b> {{$addinput['success_indicator']}} </b> </p>
                            <textarea type="text" id="success_indicator_sf{{$index}}" name="success_indicator_sf{{$index}}" class="form-control" style="display:none;" readonly>{{$addinput['success_indicator']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <textarea type="text" id="actual_accomplishments_sf{{$index}}" name="actual_accomplishments_sf{{$index}}" class="form-control" oninput="autoExpand(this)">{{$addinput['actual_accomplishments']}}</textarea>
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Support Function </p>
                            <textarea type="text" id="function_sf{{$index}}" name="function_sf{{$index}}" class="form-control" readonly>{{$addinput['function']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <textarea type="text" id="success_indicator_sf{{$index}}" name="success_indicator_sf{{$index}}" class="form-control" readonly>{{$addinput['success_indicator']}}</textarea>
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <textarea type="text" id="actual_accomplishments_sf{{$index}}" name="actual_accomplishments_sf{{$index}}" class="form-control" readonly>{{$addinput['actual_accomplishments']}}</textarea>
                        </div>
                        @endif
                    </div>
                    @endif
                    @endforeach
                </div>

                @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Approved by DC" || $ipcr_form->status == "Grading by DC" || $ipcr_form->status == "Rejected by DC" || $ipcr_form->status == "Rejected by Director")
                <div class="w-100">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary"> Update </button>
                    </div>
                </div>
                @endif
            </form>
</div>

<script src="{{asset('js/empedit.js')}}"> </script>
@endsection