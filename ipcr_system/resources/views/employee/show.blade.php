@extends('layouts.app')

@section('content')

<div class="card">
    <a href="/employee" class="btn btn-primary col-1">
        << Back </a>
            <br>
            <div class="w-100" style="background-color:#00B0F0; color:white; display:flex; justify-content:center;">
                <h3> View your submitted IPCR Form </h3>
            </div>

            <div class="row">
                <div class="form-group col-2">
                    <label for="requested_by" class="form_label"> Covered Period </label>
                    <input type="text" id="covered_period" name="covered_period" class="form-control" value="{{$ipcr_form['covered_period']}}" readonly>
                </div>
                <div class="form-group col-2">
                    <label for="requested_by" class="form_label"> Year </label>
                    <input type="text" id="year" name="year" class="form-control" value="{{$ipcr_form['date_created']}}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-5">
                    <label> First Name </label>
                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{$ipcr_form['first_name']}}" disabled>
                </div>
                <div class="col-5">
                    <label> Last Name </label>
                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{$ipcr_form['last_name']}}" disabled>
                </div>
                <div class="col-2">
                    <label> MI </label>
                    <input type="text" id="mi" name="mi" class="form-control" value="{{$ipcr_form['mi']}}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="col-3">
                    <label> Position </label>
                    <input type="text" id="position" name="position" class="form-control" value="{{$ipcr_form['position']}}" disabled>
                </div>
                <div class="col-3">
                    <label> Office </label>
                    <input type="text" id="office" name="office" class="form-control" value="{{$ipcr_form['office']}}" disabled>
                </div>
                <div class="col-6">
                    <label> E-mail </label>
                    <input type="text" id="email" name="email" class="form-control" value="{{$ipcr_form['email']}}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label> Reviewer </label>
                    <input type="text" id="reviewer" name="reviewer" class="form-control" value="{{$ipcr_form['reviewer']}}" disabled>
                </div>
                <div class="col-6">
                    <label> Approver </label>
                    <input type="text" id="approver" name="approver" class="form-control" value="{{$ipcr_form['approver']}}" disabled>
                </div>
            </div>

            <div class="card-header">
                Strategic Priorities
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <label> Strategic Priorities </label>
                        <p> </p>
                    </div>
                    <div class="col-2">
                        <label> Success Indicator </label>
                        <p> </p>
                    </div>
                    <div class="col-2">
                        <label> Actual Accomplishments </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> Q1 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> E2 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> T3 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> A4 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> Remarks </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> Graded by </label>
                        <p> </p>
                    </div>
                </div>
                @foreach($add_input as $addinput)
                @if($addinput->code == "SP")
                <div class="row">
                    <div class="col-2">
                        <p> {{$addinput['functions']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$addinput['success_indicators']}} </p>
                    </div>
                    <div class="col-2">
                        @if($addinput->actual_accomplishments != null)
                        <p> {{$addinput['actual_accomplishments']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['q1']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['e2']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['t3']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['a4']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['remarks']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['graded_by']}} </p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <div class="card-header">
                Core Functions
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <label> Core Functions </label>
                        <p> </p>
                    </div>
                    <div class="col-2">
                        <label> Success Indicator </label>
                        <p> </p>
                    </div>
                    <div class="col-2">
                        <label> Actual Accomplishments </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> Q1 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> E2 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> T3 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> A4 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> Remarks </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> Graded by </label>
                        <p> </p>
                    </div>
                </div>
                @foreach($add_input as $addinput)
                @if($addinput->code == "CF")
                <div class="row">
                    <div class="col-2">
                        <p> {{$addinput['functions']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$addinput['success_indicators']}} </p>
                    </div>
                    <div class="col-2">
                        @if($addinput->actual_accomplishments != null)
                        <p> {{$addinput['actual_accomplishments']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['q1']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['e2']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['t3']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['a4']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['remarks']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['graded_by']}} </p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <div class="card-header">
                Support Functions
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-2">
                        <label> Support Functions </label>
                        <p> </p>
                    </div>
                    <div class="col-2">
                        <label> Success Indicator </label>
                        <p> </p>
                    </div>
                    <div class="col-2">
                        <label> Actual Accomplishments </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> Q1 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> E2 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> T3 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> A4 </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> Remarks </label>
                        <p> </p>
                    </div>
                    <div class="col-1">
                        <label> Graded by </label>
                        <p> </p>
                    </div>
                </div>
                @foreach($add_input as $addinput)
                @if($addinput->code == "SF")
                <div class="row">
                    <div class="col-2">
                        <p> {{$addinput['functions']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$addinput['success_indicators']}} </p>
                    </div>
                    <div class="col-2">
                        @if($addinput->actual_accomplishments != null)
                        <p> {{$addinput['actual_accomplishments']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['q1']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['e2']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['t3']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['a4']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['remarks']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$addinput['graded_by']}} </p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <div class="row">
                <div class="col-2">

                </div>
                <div class="col-2">

                </div>
                <div class="col-3">

                </div>
                <div class="col-2 w-100">
                    <div class="float-right">
                        <label> Final Average Rating </label>
                    </div>
                </div>
                <div class="col-1">
                    @if($ipcr_form->far != null)
                    <p> {{$ipcr_form['far']}} </p>
                    @else
                    <p style="color:gray; float: right; padding-right: 56px;"> N/A </p>
                    @endif
                </div>
            </div>

            <div class="col-md-12">
                <label> Comments and Recommendation for Development Purpose. </label>
                @if($ipcr_form->comment != null)
                <p> {{$ipcr_form['comment']}} </p>
                @else
                <p style="color:gray;"> Not reviewed </p>
                @endif
            </div>

</div>

@endsection