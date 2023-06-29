@extends('layouts.app')

@section('content')

<div class="card">
    <div class="w-100" style="background-color:#00B0F0; color:white; display:flex; justify-content:center;">
        <h3> Create your IPCR Form </h3>
    </div>
    <form class="require-validation" action="/employee/" id="employee_form" method="POST">
        @CSRF

        <div class="row">
            <div class="form-group col-2">
                <label for="requested_by" class="form_label"> Covered Period </label>
                <input type="text" id="covered_period" name="covered_period" class="form-control" value="{{$schedule['covered_period']}}" readonly>
            </div>
            <div class="form-group col-2">
                <label for="requested_by" class="form_label"> Year </label>
                <input type="text" id="year" name="year" class="form-control" value="2023" readonly>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-5">
                <label for="requested_by" class="form_label"> First Name </label>
                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ Auth::user()->first_name }}" readonly>
            </div>
            <div class="form-group col-5">
                <label for="requested_by" class="form_label"> Last Name </label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" readonly>
            </div>
            <div class="form-group col-2">
                <label for="requested_by" class="form_label"> MI </label>
                <input type="text" id="mi" name="mi" class="form-control" value="{{ Auth::user()->mi }}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-3">
                <label for="requested_by" class="form_label"> Position </label>
                <input type="text" id="position" name="position" class="form-control" value="{{ Auth::user()->position }}" readonly>
            </div>
            <div class="form-group col-3">
                <label for="requested_by" class="form_label"> Office </label>
                <input type="text" id="office" name="office" class="form-control" value="{{ Auth::user()->office }}" readonly>
            </div>
            <div class="form-group col-6">
                <label for="requested_by" class="form_label"> E-mail </label>
                <input type="text" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-6">
                <label for="requested_by" class="form_label"> Reviewer </label>
                <input type="text" id="reviewer" name="reviewer" class="form-control" value="{{$schedule['division_chief']}}" readonly>
            </div>
            <div class="form-group col-6">
                <label for="requested_by" class="form_label"> Approver </label>
                <input type="text" id="approver" name="approver" class="form-control" value="{{$schedule['director']}}" readonly>
            </div>
        </div>

        <div class="card-header">
            <label> Strategic Priorities </label>
        </div>
        <div class="card-body" id="strat_table">
            <div class="row">
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Strategic Priorities </p>
                    <textarea type="text" id="functions_sp0" name="functions_sp0" class="form-control" oninput="autoExpand(this)"></textarea>
                </div>
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <textarea type="text" id="success_indicator_sp0" name="success_indicator_sp0" class="form-control" oninput="autoExpand(this)"></textarea>
                </div>
                <div class="form-group col-2">
                    <p>   </p>
                    <button type="button" class="btn btn-primary" id="addsp"> Add more </button>
                </div>
            </div>
        </div>

        <div class="card-header">
            <label> Core Functions </label>
        </div>
        <div class="card-body" id="core_table">
            <div class="row">
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Core Functions </p>
                    <textarea type="text" id="functions_cf0" name="functions_cf0" class="form-control" oninput="autoExpand(this)"></textarea>
                </div>
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <textarea type="text" id="success_indicator_cf0" name="success_indicator_cf0" class="form-control" oninput="autoExpand(this)"></textarea>
                </div>
                <div class="form-group col-2">
                    <p>   </p>
                    <button type="button" class="btn btn-primary" id="addcf"> Add more </button>
                </div>
            </div>
        </div>
        <div class="card-header">
            <label> Support Functions </label>
        </div>
        <div class="card-body" id="supp_table">
            <div class="row">
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Support Functions </p>
                    <textarea type="text" id="functions_sf0" name="functions_sf0" class="form-control" oninput="autoExpand(this)"></textarea>
                </div>
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <textarea type="text" id="success_indicator_sf0" name="success_indicator_sf0" class="form-control" oninput="autoExpand(this)"></textarea>
                </div>
                <div class="form-group col-2">
                    <p>   </p>
                    <button type="button" class="btn btn-primary" id="addsf"> Add more </button>
                </div>
            </div>
        </div>

        <div class="w-100">
            <div class="float-right">
                <button type="submit" class="btn btn-primary"> Submit </button>
            </div>
        </div>
    </form>
</div>

<script src="{{asset('js/empcreate.js')}}"> </script>
@endsection