@extends('layouts.app')

@section('content')

@role(['employee', 'admin'])
<div class="card">
    <a href="/employee">
        << Back </a>
            <br>
            <div class="w-100" style="background-color:#00B0F0; color:white; display:flex; justify-content:center;">
                <h3> EDIT YOUR IPCR FORM </h3>
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
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <input type="text" id="functions_sp{{$index}}" name="functions_sp{{$index}}" class="form-control" value="{{$addinput['functions']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicators_sp{{$index}}" name="success_indicators_sp{{$index}}" class="form-control" value="{{$addinput['success_indicators']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <input type="text" id="functions_sp{{$index}}" name="functions_sp{{$index}}" class="form-control" value="{{$addinput['functions']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicators_sp{{$index}}" name="success_indicators_sp{{$index}}" class="form-control" value="{{$addinput['success_indicators']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments_sp{{$index}}" name="actual_accomplishments_sp{{$index}}" class="form-control" value="{{$addinput['actual_accomplishments']}}">
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
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Core Functions </p>
                            <input type="text" id="functions_cf{{$index}}" name="functions_cf{{$index}}" class="form-control" value="{{$addinput['functions']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicators_cf{{$index}}" name="success_indicators_cf{{$index}}" class="form-control" value="{{$addinput['success_indicators']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Core Functions </p>
                            <input type="text" id="functions_cf{{$index}}" name="functions_cf{{$index}}" class="form-control" value="{{$addinput['functions']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicators_cf{{$index}}" name="success_indicators_cf{{$index}}" class="form-control" value="{{$addinput['success_indicators']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments_cf{{$index}}" name="actual_accomplishments_cf{{$index}}" class="form-control" value="{{$addinput['actual_accomplishments']}}">
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
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Support Functions </p>
                            <input type="text" id="functions_sf{{$index}}" name="functions_sf{{$index}}" class="form-control" value="{{$addinput['functions']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicators_sf{{$index}}" name="success_indicators_sf{{$index}}" class="form-control" value="{{$addinput['success_indicators']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Support Functions </p>
                            <input type="text" id="functions_sf{{$index}}" name="functions_sf{{$index}}" class="form-control" value="{{$addinput['functions']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicators_sf{{$index}}" name="success_indicators_sf{{$index}}" class="form-control" value="{{$addinput['success_indicators']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments_sf{{$index}}" name="actual_accomplishments_sf{{$index}}" class="form-control" value="{{$addinput['actual_accomplishments']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                    @endforeach
                </div>

                <div class="w-100">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary"> Update </button>
                    </div>
                </div>
            </form>
</div>
@endrole

<script>
    let errorMessages = '';
    $("#employee_form").on("submit", function(e) {
        e.preventDefault();
        let formData = new FormData($('#employee_form')[0]);
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/employee/" + $('#employee_form').attr("data-user-id"),
                    method: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Successpully edited a profile!',
                                icon: 'success',
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "/employee";
                                }
                            })
                        } else {
                            for (let i = 0; i < response.errors.length; i++) {
                                errorMessages += "-" + response.errors[i] + "\n";
                            }
                            Swal.fire({
                                html: '<pre>' + errorMessages + '</pre>',
                                customClass: {
                                    popup: 'format-pre'
                                },
                                title: 'Error!',
                                icon: 'error',
                                confirmButtonText: 'Okay'
                            })
                            errorMessages = "";
                        }
                    }
                });
            } else {
                Swal.fire({
                    title: 'Action cancelled!',
                    text: 'You cancelled the action!',
                    icon: 'info',
                    confirmButtonText: 'Okay'
                })
            }
        });
    });
</script>
@endsection