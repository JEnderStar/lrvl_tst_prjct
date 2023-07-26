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
                <p> {{$schedule['covered_period']}} </p>
                <div class="form-group" hidden>
                    <input type="text" id="covered_period" name="covered_period" class="form-control" value="{{$schedule['covered_period']}}" readonly hidden>
                </div>
            </div>
            <div class="form-group col-2">
                <label for="requested_by" class="form_label"> Year </label>
                <p> {{ date('Y') }} </p>
                <div class="form-group" hidden>
                    <input type="text" id="year" name="year" class="form-control" value="{{ date('Y') }}" readonly hidden>
                </div>
            </div>
            <div class="form-group col-2" hidden>
                <input type="text" id="employee_id" name="employee_id" class="form-control" value="{{ Auth::user()->id }}" readonly>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-5">
                <label for="requested_by" class="form_label"> First Name </label>
                <p> {{ Auth::user()->first_name }} </p>
                <div class="form-group" hidden>
                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ Auth::user()->first_name }}" readonly hidden>
                </div>
            </div>
            <div class="form-group col-5">
                <label for="requested_by" class="form_label"> Last Name </label>
                <p> {{ Auth::user()->last_name }} </p>
                <div class="form-group" hidden>
                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ Auth::user()->last_name }}" readonly hidden>
                </div>
            </div>
            <div class="form-group col-2">
                <label for="requested_by" class="form_label"> MI </label>
                <p> {{ Auth::user()->mi }} </p>
                <div class="form-group" hidden>
                    <input type="text" id="mi" name="mi" class="form-control" value="{{ Auth::user()->mi }}" readonly hidden>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-3">
                <label for="requested_by" class="form_label"> Position </label>
                <p> {{ Auth::user()->position }} </p>
                <div class="form-group" hidden>
                    <input type="text" id="position" name="position" class="form-control" value="{{ Auth::user()->position }}" readonly hidden>
                </div>
            </div>
            <div class="form-group col-3">
                <label for="requested_by" class="form_label"> Office </label>
                <p> {{ Auth::user()->office }} </p>
                <div class="form-group" hidden>
                    <input type="text" id="office" name="office" class="form-control" value="{{ Auth::user()->office }}" readonly hidden>
                </div>
            </div>
            <div class="form-group col-6">
                <label for="requested_by" class="form_label"> E-mail </label>
                <p> {{ Auth::user()->email }} </p>
                <div class="form-group" hidden>
                    <input type="text" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly hidden>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-6">
                <label for="requested_by" class="form_label"> Reviewer </label>
                <p> {{$schedule['division_chief']}} </p>
                <div class="form-group" hidden>
                    <input type="text" id="reviewer" name="reviewer" class="form-control" value="{{$schedule['division_chief']}}" readonly hidden>
                </div>
            </div>
            <div class="form-group col-6">
                <label for="requested_by" class="form_label"> Approver </label>
                <p> {{$schedule['director']}} </p>
                <div class="form-group" hidden>
                    <input type="text" id="approver" name="approver" class="form-control" value="{{$schedule['director']}}" readonly hidden>
                </div>
            </div>
        </div>

        <div class="card-header">
            <label> Strategic Priorities </label>
        </div>
        <div class="card-body" id="strat_table">
            <div class="form-group col-2">
                <button type="button" class="btn btn-primary" id="addsp" title="Add a Strategic Priorities Input"> + </button>
            </div>
            @foreach ($draftData['strategicPriorities'] as $index => $sp)
            <div class="row addedsp">
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Strategic Priorities </p>
                    <textarea type="text" id="function_sp{{ $index }}" name="function_sp{{ $index }}" class="form-control" title="Place your Strategic Priorities here" oninput="autoExpand(this)">{{ $sp->function }}</textarea>
                </div>
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <textarea type="text" id="success_indicator_sp{{ $index }}" name="success_indicator_sp{{ $index }}" class="form-control" title="Place your Success Indicator of your Strategic Priorities here" oninput="autoExpand(this)">{{ $sp->success_indicator }}</textarea>
                </div>
                <div class="form-group col-2">
                    <p>   </p>
                    <button type="button" class="btn btn-danger" id="removesp_draft" title="Remove the line of this Strategic Priorities"> ⌦ </button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="card-header">
            <label> Core Functions </label>
        </div>
        <div class="card-body" id="core_table">
            <div class="form-group col-2">
                <button type="button" class="btn btn-primary" id="addcf" title="Add a Core Functions Input"> + </button>
            </div>
            @foreach ($draftData['coreFunctions'] as $index => $cf)
            <div class="row addedcf">
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Core Function </p>
                    <textarea type="text" id="function_cf{{ $index }}" name="function_cf{{ $index }}" class="form-control" title="Place your Core function here" oninput="autoExpand(this)">{{ $cf->function }}</textarea>
                </div>
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <textarea type="text" id="success_indicator_cf{{ $index }}" name="success_indicator_cf{{ $index }}" class="form-control" title="Place your Success Indicator of your Core function here" oninput="autoExpand(this)">{{ $cf->success_indicator }}</textarea>
                </div>
                <div class="form-group col-2">
                    <p>   </p>
                    <button type="button" class="btn btn-danger" id="removecf_draft" title="Remove the line of this Core Function"> ⌦ </button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="card-header">
            <label> Support Functions </label>
        </div>
        <div class="card-body" id="supp_table">
            <div class="form-group col-2">
                <button type="button" class="btn btn-primary" id="addsf" title="Add a Support Functions Input"> + </button>
            </div>
            @foreach ($draftData['supportFunctions'] as $index => $sf)
            <div class="row addedsf">
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Support Function </p>
                    <textarea type="text" id="function_sf{{ $index }}" name="function_sf{{ $index }}" class="form-control" title="Place your Support function here" oninput="autoExpand(this)">{{ $sf->function }}</textarea>
                </div>
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <textarea type="text" id="success_indicator_sf{{ $index }}" name="success_indicator_sf{{ $index }}" title="Place your Success Indicator of your Support function here" class="form-control" oninput="autoExpand(this)">{{ $sf->success_indicator }}</textarea>
                </div>
                <div class="form-group col-2">
                    <p>   </p>
                    <button type="button" class="btn btn-danger" id="removesf_draft" title="Remove the line of this Support Function"> ⌦ </button>
                </div>
            </div>
            @endforeach
        </div>

        <div class="w-100">
            <div class="float-right">
                <button type="button" class="btn btn-secondary" id="saveDraft">Save as Draft</button>
                <button type="submit" class="btn btn-primary"> Submit </button>
            </div>
        </div>
    </form>
</div>

<script src="{{asset('js/empcreate.js')}}"> </script>
@endsection