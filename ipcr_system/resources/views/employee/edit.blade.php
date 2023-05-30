@extends('layouts.app')

@section('content')

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
                <div class="card-body">
                    @if($ipcr_form->strategic_priorities1 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <input type="text" id="strategic_priorities1" name="strategic_priorities1" class="form-control" value="{{$ipcr_form['strategic_priorities1']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator1" name="success_indicator1" class="form-control" value="{{$ipcr_form['success_indicator1']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <input type="text" id="strategic_priorities1" name="strategic_priorities1" class="form-control" value="{{$ipcr_form['strategic_priorities1']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator1" name="success_indicator1" class="form-control" value="{{$ipcr_form['success_indicator1']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments1" name="actual_accomplishments1" class="form-control" value="{{$ipcr_form['actual_accomplishments1']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($ipcr_form->strategic_priorities2 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <input type="text" id="strategic_priorities2" name="strategic_priorities2" class="form-control" value="{{$ipcr_form['strategic_priorities2']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator2" name="success_indicator2" class="form-control" value="{{$ipcr_form['success_indicator2']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <input type="text" id="strategic_priorities2" name="strategic_priorities2" class="form-control" value="{{$ipcr_form['strategic_priorities2']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator2" name="success_indicator2" class="form-control" value="{{$ipcr_form['success_indicator2']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments2" name="actual_accomplishments2" class="form-control" value="{{$ipcr_form['actual_accomplishments2']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($ipcr_form->strategic_priorities3 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <input type="text" id="strategic_priorities3" name="strategic_priorities3" class="form-control" value="{{$ipcr_form['strategic_priorities3']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator3" name="success_indicator3" class="form-control" value="{{$ipcr_form['success_indicator3']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <input type="text" id="strategic_priorities3" name="strategic_priorities3" class="form-control" value="{{$ipcr_form['strategic_priorities3']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator3" name="success_indicator3" class="form-control" value="{{$ipcr_form['success_indicator3']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments3" name="actual_accomplishments3" class="form-control" value="{{$ipcr_form['actual_accomplishments3']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($ipcr_form->strategic_priorities4 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <input type="text" id="strategic_priorities4" name="strategic_priorities4" class="form-control" value="{{$ipcr_form['strategic_priorities4']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator4" name="success_indicator4" class="form-control" value="{{$ipcr_form['success_indicator4']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Strategic Priorities </p>
                            <input type="text" id="strategic_priorities4" name="strategic_priorities4" class="form-control" value="{{$ipcr_form['strategic_priorities4']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator4" name="success_indicator4" class="form-control" value="{{$ipcr_form['success_indicator4']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments4" name="actual_accomplishments4" class="form-control" value="{{$ipcr_form['actual_accomplishments4']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="card-header">
                    <label> Core Functions </label>
                </div>
                <div class="card-body">
                    @if($ipcr_form->core_functions5 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Core Functions </p>
                            <input type="text" id="core_functions5" name="core_functions5" class="form-control" value="{{$ipcr_form['core_functions5']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator5" name="success_indicator5" class="form-control" value="{{$ipcr_form['success_indicator5']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Core Functions </p>
                            <input type="text" id="core_functions5" name="core_functions5" class="form-control" value="{{$ipcr_form['core_functions5']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator5" name="success_indicator5" class="form-control" value="{{$ipcr_form['success_indicator5']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments5" name="actual_accomplishments5" class="form-control" value="{{$ipcr_form['actual_accomplishments5']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($ipcr_form->core_functions6 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Core Functions </p>
                            <input type="text" id="core_functions6" name="core_functions6" class="form-control" value="{{$ipcr_form['core_functions6']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator6" name="success_indicator6" class="form-control" value="{{$ipcr_form['success_indicator6']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Core Functions </p>
                            <input type="text" id="core_functions6" name="core_functions6" class="form-control" value="{{$ipcr_form['core_functions6']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator6" name="success_indicator6" class="form-control" value="{{$ipcr_form['success_indicator6']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments6" name="actual_accomplishments6" class="form-control" value="{{$ipcr_form['actual_accomplishments6']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($ipcr_form->core_functions7 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Core Functions </p>
                            <input type="text" id="core_functions7" name="core_functions7" class="form-control" value="{{$ipcr_form['core_functions7']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator7" name="success_indicator7" class="form-control" value="{{$ipcr_form['success_indicator7']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Core Functions </p>
                            <input type="text" id="core_functions7" name="core_functions7" class="form-control" value="{{$ipcr_form['core_functions7']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator7" name="success_indicator7" class="form-control" value="{{$ipcr_form['success_indicator7']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments7" name="actual_accomplishments7" class="form-control" value="{{$ipcr_form['actual_accomplishments7']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($ipcr_form->core_functions8 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Core Functions </p>
                            <input type="text" id="core_functions8" name="core_functions8" class="form-control" value="{{$ipcr_form['core_functions8']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator8" name="success_indicator8" class="form-control" value="{{$ipcr_form['success_indicator8']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Core Functions </p>
                            <input type="text" id="core_functions8" name="core_functions8" class="form-control" value="{{$ipcr_form['core_functions8']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator8" name="success_indicator8" class="form-control" value="{{$ipcr_form['success_indicator8']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments8" name="actual_accomplishments8" class="form-control" value="{{$ipcr_form['actual_accomplishments8']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="card-header">
                    <label> Support Functions </label>
                </div>
                <div class="card-body">
                    @if($ipcr_form->support_functions9 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Support Functions </p>
                            <input type="text" id="support_functions9" name="support_functions9" class="form-control" value="{{$ipcr_form['support_functions9']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator9" name="success_indicator9" class="form-control" value="{{$ipcr_form['success_indicator9']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Support Functions </p>
                            <input type="text" id="support_functions9" name="support_functions9" class="form-control" value="{{$ipcr_form['support_functions9']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator9" name="success_indicator9" class="form-control" value="{{$ipcr_form['success_indicator9']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments9" name="actual_accomplishments9" class="form-control" value="{{$ipcr_form['actual_accomplishments9']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($ipcr_form->support_functions10 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Support Functions </p>
                            <input type="text" id="support_functions10" name="support_functions10" class="form-control" value="{{$ipcr_form['support_functions10']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator10" name="success_indicator10" class="form-control" value="{{$ipcr_form['success_indicator10']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Support Functions </p>
                            <input type="text" id="support_functions10" name="support_functions10" class="form-control" value="{{$ipcr_form['support_functions10']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator10" name="success_indicator10" class="form-control" value="{{$ipcr_form['success_indicator10']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments10" name="actual_accomplishments10" class="form-control" value="{{$ipcr_form['actual_accomplishments10']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($ipcr_form->support_functions11 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Support Functions </p>
                            <input type="text" id="support_functions11" name="support_functions11" class="form-control" value="{{$ipcr_form['support_functions11']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator11" name="success_indicator11" class="form-control" value="{{$ipcr_form['success_indicator11']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Support Functions </p>
                            <input type="text" id="support_functions11" name="support_functions11" class="form-control" value="{{$ipcr_form['support_functions11']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator11" name="success_indicator11" class="form-control" value="{{$ipcr_form['success_indicator11']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments11" name="actual_accomplishments11" class="form-control" value="{{$ipcr_form['actual_accomplishments11']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                    @if($ipcr_form->support_functions12 != null)
                    <div class="row">
                        @if($ipcr_form->status == "Pending" || $ipcr_form->status == "Rejected by DC")
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Support Functions </p>
                            <input type="text" id="support_functions12" name="support_functions12" class="form-control" value="{{$ipcr_form['support_functions12']}}">
                        </div>
                        <div class="form-group col-6">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator12" name="success_indicator12" class="form-control" value="{{$ipcr_form['success_indicator12']}}">
                        </div>
                        @else
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Support Functions </p>
                            <input type="text" id="support_functions12" name="support_functions12" class="form-control" value="{{$ipcr_form['support_functions12']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Success Indicator </p>
                            <input type="text" id="success_indicator12" name="success_indicator12" class="form-control" value="{{$ipcr_form['success_indicator12']}}">
                        </div>
                        <div class="form-group col-4">
                            <p for="requested_by" class="form_label"> Actual Accomplishments </p>
                            <input type="text" id="actual_accomplishments12" name="actual_accomplishments12" class="form-control" value="{{$ipcr_form['actual_accomplishments12']}}">
                        </div>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="w-100">
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary"> Update </button>
                    </div>
                </div>
            </form>
</div>

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
                                text: 'Successfully edited a profile!',
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