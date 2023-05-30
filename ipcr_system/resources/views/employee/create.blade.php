@extends('layouts.app')

@section('content')

<div class="card">
    <div class="w-100" style="background-color:#00B0F0; color:white; display:flex; justify-content:center;">
        <h3> CREATE YOUR IPCR FORM </h3>
    </div>
    <form class="require-validation" action="/employee/" id="employee_form" method="POST">
        @CSRF

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
                <input type="text" id="reviewer" name="reviewer" class="form-control">
            </div>
            <div class="form-group col-6">
                <label for="requested_by" class="form_label"> Approver </label>
                <input type="text" id="approver" name="approver" class="form-control">
            </div>
        </div>

        <div class="card-header">
            <label> Strategic Priorities </label>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                    <p for="requested_by" class="form_label"> Strategic Priorities </p>
                    <input type="text" id="strategic_priorities1" name="strategic_priorities1" class="form-control">
                </div>
                <div class="form-group col-6">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <input type="text" id="success_indicator1" name="success_indicator1" class="form-control">
                </div>
            </div>
            <div class="form-group col-2">
                <button type="button" class="btn btn-primary" id="addsp"> Add more </button>
            </div>
        </div>

        <div class="card-header">
            <label> Core Functions </label>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                    <p for="requested_by" class="form_label"> Core Functions </p>
                    <input type="text" id="core_functions5" name="core_functions5" class="form-control">
                </div>
                <div class="form-group col-6">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <input type="text" id="success_indicator5" name="success_indicator5" class="form-control">
                </div>
            </div>
            <div class="form-group col-2">
                <button type="button" class="btn btn-primary" id="addsp"> Add more </button>
            </div>
        </div>
        <div class="card-header">
            <label> Support Functions </label>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-6">
                    <p for="requested_by" class="form_label"> Support Functions </p>
                    <input type="text" id="support_functions9" name="support_functions9" class="form-control">
                </div>
                <div class="form-group col-6">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <input type="text" id="success_indicator9" name="success_indicator9" class="form-control">
                </div>
            </div>
            <div class="form-group col-2">
                <button type="button" class="btn btn-primary" id="addsp"> Add more </button>
            </div>
        </div>

        <div class="w-100">
            <div class="float-right">
                <button type="submit" class="btn btn-primary"> Submit </button>
            </div>
        </div>
    </form>
</div>
<script>
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
                    url: "/employee/",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Successfully created a form!',
                                icon: 'success',
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "/employee/";
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