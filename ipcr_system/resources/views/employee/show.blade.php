@extends('layouts.app')

@section('content')

<div class="card">
    <a href="/employee" style="color:#00B0F0">
        << Back </a>
            <br>
            <div class="w-100" style="background-color:#00B0F0; color:white; display:flex; justify-content:center;">
                <h3> VIEW YOUR SUBMITTED IPCR FORM </h3>
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
                @if($ipcr_form->strategic_priorities1 != null)
                <div class="row">
                    <div class="col-2">
                        <label> Strategic Priorities </label>
                        <p> </p>
                        <p> {{$ipcr_form['strategic_priorities1']}} </p>
                    </div>
                    <div class="col-2">
                        <label> Success Indicator </label>
                        <p> </p>
                        <p> {{$ipcr_form['success_indicator1']}} </p>
                    </div>
                    <div class="col-2">
                        <label> Actual Accomplishments </label>
                        @if($ipcr_form->actual_accomplishments1 != null)
                        <p> {{$ipcr_form['actual_accomplishments1']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <label> Q1 </label>
                        <p> </p>
                        <p> {{$ipcr_form['q1_1']}} </p>
                    </div>
                    <div class="col-1">
                        <label> E2 </label>
                        <p> </p>
                        <p> {{$ipcr_form['e2_1']}} </p>
                    </div>
                    <div class="col-1">
                        <label> T3 </label>
                        <p> </p>
                        <p> {{$ipcr_form['t3_1']}} </p>
                    </div>
                    <div class="col-1">
                        <label> A4 </label>
                        <p> </p>
                        <p> {{$ipcr_form['a4_1']}} </p>
                    </div>
                    <div class="col-1">
                        <label> Remarks </label>
                        <p> </p>
                        <p> {{$ipcr_form['remarks1']}} </p>
                    </div>
                    <div class="col-1">
                        <label> Graded by </label>
                        <p> </p>
                        <p> {{$ipcr_form['reviewer1']}} </p>
                    </div>
                </div>
                @endif
                @if($ipcr_form->strategic_priorities2 != null)
                <div class="row">
                    <div class="col-2">
                        <p> {{$ipcr_form['strategic_priorities2']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$ipcr_form['success_indicator2']}} </p>
                    </div>
                    <div class="col-2">
                        @if($ipcr_form->actual_accomplishments2 != null)
                        <p> {{$ipcr_form['actual_accomplishments2']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['q1_2']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['e2_2']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['t3_2']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['a4_2']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['remarks2']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['reviewer2']}} </p>
                    </div>
                </div>
                @endif
                @if($ipcr_form->strategic_priorities3 != null)
                <div class="row">
                    <div class="col-2">
                        <p> {{$ipcr_form['strategic_priorities3']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$ipcr_form['success_indicator3']}} </p>
                    </div>
                    <div class="col-2">
                        @if($ipcr_form->actual_accomplishments3 != null)
                        <p> {{$ipcr_form['actual_accomplishments3']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['q1_3']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['e2_3']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['t3_3']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['a4_3']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['remarks3']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['reviewer3']}} </p>
                    </div>
                </div>
                @endif
                @if($ipcr_form->strategic_priorities4 != null)
                <div class="row">
                    <div class="col-2">
                        <p> {{$ipcr_form['strategic_priorities4']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$ipcr_form['success_indicator4']}} </p>
                    </div>
                    <div class="col-2">
                        @if($ipcr_form->actual_accomplishments4 != null)
                        <p> {{$ipcr_form['actual_accomplishments4']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['q1_4']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['e2_4']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['t3_4']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['a4_4']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['remarks4']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['reviewer4']}} </p>
                    </div>
                </div>
                @endif
            </div>

            <div class="card-header">
                Core Functions
            </div>
            <div class="card-body">
                @if($ipcr_form->core_functions5 != null)
                <div class="row">
                    <div class="col-2">
                        <label> Core Functions </label>
                        <p> </p>
                        <p> {{$ipcr_form['core_functions5']}} </p>
                    </div>
                    <div class="col-2">
                        <label> Success Indicator </label>
                        <p> </p>
                        <p> {{$ipcr_form['success_indicator5']}} </p>
                    </div>
                    <div class="col-2">
                        <label> Actual Accomplishments </label>
                        @if($ipcr_form->actual_accomplishments5 != null)
                        <p> {{$ipcr_form['actual_accomplishments5']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <label> Q1 </label>
                        <p> </p>
                        <p> {{$ipcr_form['q1_5']}} </p>
                    </div>
                    <div class="col-1">
                        <label> E2 </label>
                        <p> </p>
                        <p> {{$ipcr_form['e2_5']}} </p>
                    </div>
                    <div class="col-1">
                        <label> T3 </label>
                        <p> </p>
                        <p> {{$ipcr_form['t3_5']}} </p>
                    </div>
                    <div class="col-1">
                        <label> A4 </label>
                        <p> </p>
                        <p> {{$ipcr_form['a4_5']}} </p>
                    </div>
                    <div class="col-1">
                        <label> Remarks </label>
                        <p> </p>
                        <p> {{$ipcr_form['remarks5']}} </p>
                    </div>
                    <div class="col-1">
                        <label> Graded by </label>
                        <p> </p>
                        <p> {{$ipcr_form['reviewer5']}} </p>
                    </div>
                </div>
                @endif
                @if($ipcr_form->core_functions6 != null)
                <div class="row">
                    <div class="col-2">
                        <p> {{$ipcr_form['core_functions6']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$ipcr_form['success_indicator6']}} </p>
                    </div>
                    <div class="col-2">
                        @if($ipcr_form->actual_accomplishments6 != null)
                        <p> {{$ipcr_form['actual_accomplishments6']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['q1_6']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['e2_6']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['t3_6']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['a4_6']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['remarks6']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['reviewer6']}} </p>
                    </div>
                </div>
                @endif
                @if($ipcr_form->core_functions7 != null)
                <div class="row">
                    <div class="col-2">
                        <p> {{$ipcr_form['core_functions7']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$ipcr_form['success_indicator7']}} </p>
                    </div>
                    <div class="col-2">
                        @if($ipcr_form->actual_accomplishments7 != null)
                        <p> {{$ipcr_form['actual_accomplishments7']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['q1_7']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['e2_7']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['t3_7']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['a4_7']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['remarks7']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['reviewer7']}} </p>
                    </div>
                </div>
                @endif
                @if($ipcr_form->core_functions8 != null)
                <div class="row">
                    <div class="col-2">
                        <p> {{$ipcr_form['core_functions8']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$ipcr_form['success_indicator8']}} </p>
                    </div>
                    <div class="col-2">
                        @if($ipcr_form->actual_accomplishments8 != null)
                        <p> {{$ipcr_form['actual_accomplishments8']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['q1_8']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['e2_8']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['t3_8']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['a4_8']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['remarks8']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['reviewer8']}} </p>
                    </div>
                </div>
                @endif
            </div>

            <div class="card-header">
                Support Functions
            </div>
            <div class="card-body">
                @if($ipcr_form->support_functions9 != null)
                <div class="row">
                    <div class="col-2">
                        <label> Support Functions </label>
                        <p> </p>
                        <p> {{$ipcr_form['support_functions9']}} </p>
                    </div>
                    <div class="col-2">
                        <label> Success Indicator </label>
                        <p> </p>
                        <p> {{$ipcr_form['success_indicator9']}} </p>
                    </div>
                    <div class="col-2">
                        <label> Actual Accomplishments </label>
                        @if($ipcr_form->actual_accomplishments9 != null)
                        <p> {{$ipcr_form['actual_accomplishments9']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <label> Q1 </label>
                        <p> </p>
                        <p> {{$ipcr_form['q1_9']}} </p>
                    </div>
                    <div class="col-1">
                        <label> E2 </label>
                        <p> </p>
                        <p> {{$ipcr_form['e2_9']}} </p>
                    </div>
                    <div class="col-1">
                        <label> T3 </label>
                        <p> </p>
                        <p> {{$ipcr_form['t3_9']}} </p>
                    </div>
                    <div class="col-1">
                        <label> A4 </label>
                        <p> </p>
                        <p> {{$ipcr_form['a4_9']}} </p>
                    </div>
                    <div class="col-1">
                        <label> Remarks </label>
                        <p> </p>
                        <p> {{$ipcr_form['remarks9']}} </p>
                    </div>
                    <div class="col-1">
                        <label> Graded by </label>
                        <p> </p>
                        <p> {{$ipcr_form['reviewer9']}} </p>
                    </div>
                </div>
                @endif
                @if($ipcr_form->support_functions10 != null)
                <div class="row">
                    <div class="col-2">
                        <p> {{$ipcr_form['support_functions10']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$ipcr_form['success_indicator10']}} </p>
                    </div>
                    <div class="col-2">
                        @if($ipcr_form->actual_accomplishments10 != null)
                        <p> {{$ipcr_form['actual_accomplishments10']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['q1_10']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['e2_10']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['t3_10']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['a4_10']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['remarks10']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['reviewer10']}} </p>
                    </div>
                </div>
                @endif
                @if($ipcr_form->support_functions11 != null)
                <div class="row">
                    <div class="col-2">
                        <p> {{$ipcr_form['support_functions11']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$ipcr_form['success_indicator11']}} </p>
                    </div>
                    <div class="col-2">
                        @if($ipcr_form->actual_accomplishments11 != null)
                        <p> {{$ipcr_form['actual_accomplishments11']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['q1_11']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['e2_11']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['t3_11']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['a4_11']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['remarks11']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['reviewer11']}} </p>
                    </div>
                </div>
                @endif
                @if($ipcr_form->support_functions12 != null)
                <div class="row">
                    <div class="col-2">
                        <p> {{$ipcr_form['support_functions12']}} </p>
                    </div>
                    <div class="col-2">
                        <p> {{$ipcr_form['success_indicator12']}} </p>
                    </div>
                    <div class="col-2">
                        @if($ipcr_form->actual_accomplishments12 != null)
                        <p> {{$ipcr_form['actual_accomplishments12']}} </p>
                        @else
                        <p style="color:gray;"> Not yet approved </p>
                        @endif
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['q1_12']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['e2_12']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['t3_12']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['a4_12']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['remarks12']}} </p>
                    </div>
                    <div class="col-1">
                        <p> {{$ipcr_form['reviewer12']}} </p>
                    </div>
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-2">

                </div>
                <div class="col-2">

                </div>
                <div class="col-2">

                </div>
                <div class="col-1">

                </div>
                <div class="col-1">

                </div>
                <div class="col-2">
                    <label> Final Average Rating </label>
                    @if($ipcr_form->rating != null)
                    <p> {{$ipcr_form['rating']}} </p>
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