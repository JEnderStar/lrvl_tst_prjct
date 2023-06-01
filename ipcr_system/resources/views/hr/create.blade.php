@extends('layouts.app')

@section('content')

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
                <input type="date" id="duration_from" name="duration_from" class="form-control" required>
            </div>
            <div class="form-group col-3">
                <label>   </label>
                <br>
                <label for="requested_by" class="form_label"> To </label>
                <input type="date" id="duration_to" name="duration_to" class="form-control" required>
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
    $('#office').change(function() {
        var office = $('#office').val();
        switch(office){
            case "CMIO":
                document.getElementById('existing')?.remove();
                $('.employee-list').append('<div id="existing"><label> Employees </label><select class="select2 form-control employees" name="employees[]" id="employees" multiple required><optgroup label="CMIO"><option value="Febe">Febe</option><option value="Macky">Macky</option><option value="CMIO3">CMIO3</option></optgroup></select></div>');
                $('.select2').select2({});
                break;
            case "PSD":
                document.getElementById('existing')?.remove();
                $('.employee-list').append('<div id="existing"><label> Employees </label><select class="select2 form-control employees" name="employees[]" id="employees" multiple required><optgroup label="PSD"><option value="Hazel">Hazel</option><option value="Rayman">Rayman</option><option value="Lyka">Lyka</option></optgroup></select></div>');
                $('.select2').select2({});
                break;
            case "All":
                document.getElementById('existing')?.remove();
                $('.employee-list').append('<div id="existing"><label> Employees </label><select class="select2 form-control employees" name="employees[]" id="employees" multiple required><optgroup label="CMIO"><option value="Febe">Febe</option><option value="Macky">Macky</option><option value="CMIO3">CMIO3</option></optgroup><optgroup label="PSD"><option value="Hazel">Hazel</option><option value="Rayman">Rayman</option><option value="Lyka">Lyka</option></optgroup></select></div>');
                $('.select2').select2({});
                break;
        }
    });

    let errorMessages = '';
    $("#schedule_form").on("submit", function(e) {
        e.preventDefault();
        let formData = new FormData($('#schedule_form')[0]);
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/hr",
                    method: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Successfully created a schedule!',
                                icon: 'success',
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "/home";
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