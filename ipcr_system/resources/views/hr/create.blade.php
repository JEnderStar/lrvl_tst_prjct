@extends('layouts.app')

@section('content')

@role(['hr', 'admin'])
<div class="card">
    <div class="w-100" style="background-color:#00B0F0; color:white; display:flex; justify-content:center;">
        <h3> CREATE YOUR IPCR FORM </h3>
    </div>
    <form class="require-validation" action="/hr" id="schedule_form" method="POST">
        @CSRF

        <div class="row">
            <div class="form-group col-3">
                <label for="requested_by" class="form_label"> Type </label>
                <select class="form-control" name="type" id="type" required>
                    <option value="" selected disabled>Select Type</option>
                    <option value="IPCR">IPCR</option>
                    <option value="OPCR">OPCR</option>
                    <option value="DPCR">DPCR</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="requested_by" class="form_label"> Purpose </label>
                <select class="form-control" name="purpose" id="purpose" required>
                    <option value="" selected disabled>Select Purpose</option>
                    <option value="Performance Targets">Performance Targets</option>
                    <option value="Accomplished & rated IPCR">Accomplished & rated IPCR</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="requested_by" class="form_label"> Covered Period </label>
                <select class="form-control" name="covered_period" id="covered_period" required>
                    <option value="" selected disabled>Select Covered Period</option>
                    <option value="1st Semester">1st Semester</option>
                    <option value="2nd Semester">2nd Semester</option>
                    <option value="3rd Semester">3rd Semester</option>
                    <option value="4th Semester">4th Semester</option>
                </select>
            </div>
            <div class="form-group col-3">
                <label for="requested_by" class="form_label"> Office </label>
                <select class="form-control" name="office" id="office" required>
                    <option value="" selected disabled>Select Office</option>
                    <option value="CMIO">CMIO</option>
                    <option value="PSD">PSD</option>
                    <option value="All">All</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="employee-list form-group col-6">

            </div>
            <div class="form-group col-3">
                <label> Duration </label>
                <br>
                <label for="requested_by" class="form_label"> From </label>
                <input type="date" id="duration_from" name="duration_from" class="form-control" min="{{date('Y-m-d')}}" required>
            </div>
            <div class="form-group col-3">
                <label>   </label>
                <br>
                <label for="requested_by" class="form_label"> To </label>
                <input type="date" id="duration_to" name="duration_to" class="form-control" min="{{date('Y-m-d')}}" required>
            </div>
        </div>

        <div class="w-100">
            <div class="float-right">
                <button type="submit" class="btn btn-primary"> Submit </button>
            </div>
        </div>
    </form>
</div>
@endrole

<script src="{{asset('js/hrcreate.js')}}"> </script>
@endsection