@extends('layouts.app')

@section('content')

@role(['employee', 'admin'])
<div class="card">
    <a href="/employee" style="color:#00B0F0">
        << Back </a>
            <br>
            <div class="w-100" style="background-color:#00B0F0; color:white; display:flex; justify-content:center;">
                <h3> VIEW YOUR SUBMITTED IPCR FORM </h3>
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
                    <div class="col-6">
                        <label> Strategic Priorities </label>
                        <p> </p>
                    </div>
                    <div class="col-6">
                        <label> Success Indicator </label>
                        <p> </p>
                    </div>
                </div>
                @foreach($add_input as $addinput)
                @if($addinput->code == "SP")
                <div class="row">
                    <div class="col-6">
                        <p> {{$addinput['functions']}} </p>
                    </div>
                    <div class="col-6">
                        <p> {{$addinput['success_indicators']}} </p>
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
                    <div class="col-6">
                        <label> Core Functions </label>
                        <p> </p>
                    </div>
                    <div class="col-6">
                        <label> Success Indicator </label>
                        <p> </p>
                    </div>
                </div>
                @foreach($add_input as $addinput)
                @if($addinput->code == "CF")
                <div class="row">
                    <div class="col-6">
                        <p> {{$addinput['functions']}} </p>
                    </div>
                    <div class="col-6">
                        <p> {{$addinput['success_indicators']}} </p>
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
                    <div class="col-6">
                        <label> Support Functions </label>
                        <p> </p>
                    </div>
                    <div class="col-6">
                        <label> Success Indicator </label>
                        <p> </p>
                    </div>
                </div>
                @foreach($add_input as $addinput)
                @if($addinput->code == "SF")
                <div class="row">
                    <div class="col-6">
                        <p> {{$addinput['functions']}} </p>
                    </div>
                    <div class="col-6">
                        <p> {{$addinput['success_indicators']}} </p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <div class="w-100">
                <div class="float-right">
                    <form action="/approvedc/{{$id}}" data-user-id="{{$id}}" id="approve_form" method="POST">
                        @METHOD('PUT')
                        <button type="submit" name="status" value="Rejected by DC" class="btn btn-danger"> Reject </button>
                        <button type="submit" name="status" value="Approved by DC" class="btn btn-success"> Approve </button>
                    </form>
                </div>
            </div>
</div>

<script>
    let errorMessages = '';
    var form = document.getElementById('approve_form');
    var buttons = form.querySelectorAll('button[type="submit"]');

    buttons.forEach(function(button) {
        button.addEventListener('click', function(e) {
            var status = button.value;
            let formData = new FormData($('#approve_form')[0]);

            if (status == "Approved by DC") {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure you want to approve this form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Confirm",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        formData.append('status', status);
                        $.ajax({
                            url: "/approvedc/" + $('#approve_form').attr("data-user-id"),
                            method: "POST",
                            processData: false,
                            contentType: false,
                            cache: false,
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Successfully approved the form!',
                                        icon: 'success',
                                        confirmButtonText: 'Okay'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = "/approvedc";
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
            } else if (status == "Rejected by DC") {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure you want to reject this form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Confirm",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Please state the reason for rejection to be emailed to the employee/patient",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Submit",
                            cancelButtonText: "Cancel",
                            input: "text",
                            inputValidator: (value) => {
                                if (!value) {
                                    return "Please state the reason for approval.";
                                }
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let reason = result.value;
                                formData.append('status', status);
                                formData.append('reason', reason);
                                // Swal.fire({
                                //     title: 'Now Loading',
                                //     html: '<b> Please wait... </b>',
                                //     timer: 10000,
                                //     didOpen: () => {
                                //         Swal.showLoading()
                                //     },
                                //     willClose: () => {
                                //         clearInterval(timerInterval)
                                //     }
                                // });
                                $.ajax({
                                    url: "/approvedc/" + $('#approve_form').attr("data-user-id"),
                                    method: "POST",
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    data: formData,
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            Swal.fire({
                                                title: 'Success!',
                                                text: 'Successfully rejected the form!',
                                                icon: 'success',
                                                confirmButtonText: 'Okay'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    window.location.href = "/approvedc";
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
                    } else {
                        Swal.fire({
                            title: 'Action cancelled!',
                            text: 'You cancelled the action!',
                            icon: 'info',
                            confirmButtonText: 'Okay'
                        })
                    }
                });
            }
        })
    })
</script>
@endrole

@endsection