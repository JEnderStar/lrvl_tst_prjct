@extends('layouts.app')

@section('content')

@role(['division_chief', 'admin'])

<div class="card">
    <a href="/gradedc" class="btn btn-primary col-1">
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

            <form class="require-validation" method="POST" action="/gradedc/{{$id}}" data-id="{{$id}}" id="grade_form">
                @CSRF
                @METHOD('PUT')

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
                        <div class="col-2">
                            <label> Remarks </label>
                            <p> </p>
                        </div>
                        <div hidden>
                            <label> Graded by </label>
                            <p> </p>
                        </div>
                    </div>
                    @foreach($add_input as $index => $addinput)
                    @if($addinput->code == "SP")
                    <div class="row">
                        <div class="col-2">
                            <textarea type="text" id="functions_sp{{$index}}" name="functions_sp{{$index}}" class="form-control" readonly>{{$addinput['functions']}}</textarea>
                        </div>
                        <div class="col-2">
                            <textarea type="text" id="success_indicators_sp{{$index}}" name="success_indicators_sp{{$index}}" class="form-control" readonly>{{$addinput['success_indicators']}}</textarea>
                        </div>
                        <div class="col-2">
                            <textarea type="text" id="actual_accomplishments_sp{{$index}}" name="actual_accomplishments_sp{{$index}}" class="form-control" readonly>{{$addinput['actual_accomplishments']}}</textarea>
                        </div>
                        <div class="col-4 row input-container" data-index="{{$index}}">
                            <div class="col-3">
                                <input type="text" id="q1_sp{{$index}}" name="q1_sp{{$index}}" class="form-control q1-input" maxlength="1" pattern="[1-5]" oninput="this.value = this.value.replace(/[^1-5]/g, '')">
                            </div>
                            <div class="col-3">
                                <input type="text" id="e2_sp{{$index}}" name="e2_sp{{$index}}" class="form-control e2-input" maxlength="1" pattern="[1-5]" oninput="this.value = this.value.replace(/[^1-5]/g, '')">
                            </div>
                            <div class="col-3">
                                <input type="text" id="t3_sp{{$index}}" name="t3_sp{{$index}}" class="form-control t3-input" maxlength="1" pattern="[1-5]" oninput="this.value = this.value.replace(/[^1-5]/g, '')">
                            </div>
                            <div class="col-3">
                                <input type="number" id="a4_sp{{$index}}" name="a4_sp{{$index}}" class="form-control a4-input" readonly>
                            </div>
                        </div>
                        <div class="col-2">
                            <input type="text" id="remarks_sp{{$index}}" name="remarks_sp{{$index}}" class="form-control">
                        </div>
                        <div hidden>
                            <input type="text" id="graded_by_sp{{$index}}" name="graded_by_sp{{$index}}" class="form-control" value="{{ Auth::user()->first_name }}" readonly>
                        </div>
                    </div>
                    <p> </p>
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
                        <div class="col-2">
                            <label> Remarks </label>
                            <p> </p>
                        </div>
                        <div hidden>
                            <label> Graded by </label>
                            <p> </p>
                        </div>
                    </div>
                    @foreach($add_input as $index => $addinput)
                    @if($addinput->code == "CF")
                    <div class="row">
                        <div class="col-2">
                            <textarea type="text" id="functions_cf{{$index}}" name="functions_cf{{$index}}" class="form-control" readonly>{{$addinput['functions']}}</textarea>
                        </div>
                        <div class="col-2">
                            <textarea type="text" id="success_indicators_cf{{$index}}" name="success_indicators_cf{{$index}}" class="form-control" readonly>{{$addinput['success_indicators']}}</textarea>
                        </div>
                        <div class="col-2">
                            <textarea type="text" id="actual_accomplishments_cf{{$index}}" name="actual_accomplishments_cf{{$index}}" class="form-control" readonly>{{$addinput['actual_accomplishments']}}</textarea>
                        </div>
                        <div class="col-4 row input-container" data-index="{{$index}}">
                            <div class="col-3">
                                <input type="text" id="q1_cf{{$index}}" name="q1_cf{{$index}}" class="form-control q1-input" maxlength="1" pattern="[1-5]" oninput="this.value = this.value.replace(/[^1-5]/g, '')">
                            </div>
                            <div class="col-3">
                                <input type="text" id="e2_cf{{$index}}" name="e2_cf{{$index}}" class="form-control e2-input" maxlength="1" pattern="[1-5]" oninput="this.value = this.value.replace(/[^1-5]/g, '')">
                            </div>
                            <div class="col-3">
                                <input type="text" id="t3_cf{{$index}}" name="t3_cf{{$index}}" class="form-control t3-input" maxlength="1" pattern="[1-5]" oninput="this.value = this.value.replace(/[^1-5]/g, '')">
                            </div>
                            <div class="col-3">
                                <input type="number" id="a4_cf{{$index}}" name="a4_cf{{$index}}" class="form-control a4-input" readonly>
                            </div>
                        </div>
                        <div class="col-2">
                            <input type="text" id="remarks_cf{{$index}}" name="remarks_cf{{$index}}" class="form-control">
                        </div>
                        <div hidden>
                            <input type="text" id="graded_by_cf{{$index}}" name="graded_by_cf{{$index}}" class="form-control" value="{{ Auth::user()->first_name }}" readonly>
                        </div>
                    </div>
                    <p> </p>
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
                        <div class="col-2">
                            <label> Remarks </label>
                            <p> </p>
                        </div>
                        <div hidden>
                            <label> Graded by </label>
                            <p> </p>
                        </div>
                    </div>
                    @foreach($add_input as $index => $addinput)
                    @if($addinput->code == "SF")
                    <div class="row">
                        <div class="col-2">
                            <textarea type="text" id="functions_sf{{$index}}" name="functions_sf{{$index}}" class="form-control" readonly>{{$addinput['functions']}}</textarea>
                        </div>
                        <div class="col-2">
                            <textarea type="text" id="success_indicators_sf{{$index}}" name="success_indicators_sf{{$index}}" class="form-control" readonly>{{$addinput['success_indicators']}}</textarea>
                        </div>
                        <div class="col-2">
                            <textarea type="text" id="actual_accomplishments_sf{{$index}}" name="actual_accomplishments_sf{{$index}}" class="form-control" readonly>{{$addinput['actual_accomplishments']}}</textarea>
                        </div>
                        <div class="col-4 row input-container" data-index="{{$index}}">
                            <div class="col-3">
                                <input type="text" id="q1_sf{{$index}}" name="q1_sf{{$index}}" class="form-control q1-input" maxlength="1" pattern="[1-5]" oninput="this.value = this.value.replace(/[^1-5]/g, '')">
                            </div>
                            <div class="col-3">
                                <input type="text" id="e2_sf{{$index}}" name="e2_sf{{$index}}" class="form-control e2-input" maxlength="1" pattern="[1-5]" oninput="this.value = this.value.replace(/[^1-5]/g, '')">
                            </div>
                            <div class="col-3">
                                <input type="text" id="t3_sf{{$index}}" name="t3_sf{{$index}}" class="form-control t3-input" maxlength="1" pattern="[1-5]" oninput="this.value = this.value.replace(/[^1-5]/g, '')">
                            </div>
                            <div class="col-3">
                                <input type="number" id="a4_sf{{$index}}" name="a4_sf{{$index}}" class="form-control a4-input" readonly>
                            </div>
                        </div>
                        <div class="col-2">
                            <input type="text" id="remarks_sf{{$index}}" name="remarks_sf{{$index}}" class="form-control">
                        </div>
                        <div hidden>
                            <input type="text" id="graded_by_sf{{$index}}" name="graded_by_sf{{$index}}" class="form-control" value="{{ Auth::user()->first_name }}" readonly>
                        </div>
                    </div>
                    <p> </p>
                    @endif
                    @endforeach
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
                    <div class="col-2 w-100">
                        <div class="float-right">
                            <label> Final Average Rating </label>
                        </div>
                    </div>
                    <div class="col-1 average-container">
                        <input type="text" id="far" name="far" class="form-control far-input" value="0.00" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <label> Comments and Recommendation for Development Purpose. </label>
                        <p> </p>
                        <textarea type="text" id="comments" name="comments" class="form-control" oninput="autoExpand(this)"></textarea>
                    </div>

                    <div class="col-5"></div>

                    <div class="col-1 w-100">
                        <div class="float-right">
                            <p>   </p>
                            <button type="submit" class="btn btn-primary"> Submit </button>
                        </div>
                    </div>
                </div>
            </form>
</div>

<script src="{{asset('js/dcgrade.js')}}"> </script>
@endrole

@endsection