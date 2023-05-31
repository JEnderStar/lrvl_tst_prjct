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
        <div class="card-body" id="strat_table">
            <div class="row">
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Strategic Priorities </p>
                    <input type="text" id="strategic_priorities1" name="strategic_priorities1" class="form-control">
                </div>
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <input type="text" id="success_indicator1" name="success_indicator1" class="form-control">
                </div>
                <div class="form-group col-2">
                    <p>   </p>
                    <button type="button" class="btn btn-primary" id="addsp"> Add more </button>
                </div>
            </div>
        </div>

        <div class="card-header">
            <label> Core Functions </label>
        </div>
        <div class="card-body" id="core_table">
            <div class="row">
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Core Functions </p>
                    <input type="text" id="core_functions5" name="core_functions5" class="form-control">
                </div>
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <input type="text" id="success_indicator5" name="success_indicator5" class="form-control">
                </div>
                <div class="form-group col-2">
                    <p>   </p>
                    <button type="button" class="btn btn-primary" id="addcf"> Add more </button>
                </div>
            </div>
        </div>
        <div class="card-header">
            <label> Support Functions </label>
        </div>
        <div class="card-body" id="supp_table">
            <div class="row">
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Support Functions </p>
                    <input type="text" id="support_functions9" name="support_functions9" class="form-control">
                </div>
                <div class="form-group col-5">
                    <p for="requested_by" class="form_label"> Success Indicator </p>
                    <input type="text" id="success_indicator9" name="success_indicator9" class="form-control">
                </div>
                <div class="form-group col-2">
                    <p>   </p>
                    <button type="button" class="btn btn-primary" id="addsf"> Add more </button>
                </div>
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

    var sp = 1;
    $("#addsp").click(function() {
        ++sp;
        switch (sp) {
            case 2:
                $("#strat_table").append('<div class="row addedsp"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><input type="text" id="strategic_priorities2" name="strategic_priorities2" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator2" name="success_indicator2" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesp"> Remove </button></div></div>');
                break;
            case 3:
                if ($('#strategic_priorities3').val() == null) {
                    $("#strat_table").append('<div class="row addedsp"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><input type="text" id="strategic_priorities3" name="strategic_priorities3" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator3" name="success_indicator3" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesp"> Remove </button></div></div>');
                } else if ($('#strategic_priorities2').val() == null) {
                    $("#strat_table").append('<div class="row addedsp"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><input type="text" id="strategic_priorities2" name="strategic_priorities2" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator2" name="success_indicator2" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesp"> Remove </button></div></div>');
                } else if ($('#strategic_priorities4').val() == null) {
                    $("#strat_table").append('<div class="row addedsp"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><input type="text" id="strategic_priorities4" name="strategic_priorities4" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator4" name="success_indicator4" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesp"> Remove </button></div></div>');
                }
                break;
            case 4:
                if ($('#strategic_priorities4').val() == null) {
                    $("#strat_table").append('<div class="row addedsp"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><input type="text" id="strategic_priorities4" name="strategic_priorities4" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator4" name="success_indicator4" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesp"> Remove </button></div></div>');
                } else if ($('#strategic_priorities2').val() == null) {
                    $("#strat_table").append('<div class="row addedsp"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><input type="text" id="strategic_priorities2" name="strategic_priorities2" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator2" name="success_indicator2" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesp"> Remove </button></div></div>');
                } else if ($('#strategic_priorities3').val() == null) {
                    $("#strat_table").append('<div class="row addedsp"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><input type="text" id="strategic_priorities3" name="strategic_priorities3" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator3" name="success_indicator3" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesp"> Remove </button></div></div>');
                }
                break;
            default:
                Swal.fire({
                    title: "Maximum input reached.",
                    text: "You cannot add more inputs for Strategic Priorities",
                    icon: "warning",
                    confirmButtonText: "Okay"
                });
                --sp;
                break;
        }
    });
    $(document).on('click', '#removesp', function() {
        $(this).parents('.addedsp').remove();
        --sp;
    });

    var cf = 5;
    $("#addcf").click(function() {
        ++cf;
        switch (cf) {
            case 6:
                $("#core_table").append('<div class="row addedcf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Functions </p><input type="text" id="core_functions6" name="core_functions6" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator6" name="success_indicator6" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removecf"> Remove </button></div></div>');
                break;
            case 7:
                if ($('#core_functions7').val() == null) {
                    $("#core_table").append('<div class="row addedcf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Functions </p><input type="text" id="core_functions7" name="core_functions7" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator7" name="success_indicator7" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removecf"> Remove </button></div></div>');
                } else if ($('#core_functions6').val() == null) {
                    $("#core_table").append('<div class="row addedcf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Functions </p><input type="text" id="core_functions6" name="core_functions6" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator6" name="success_indicator6" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removecf"> Remove </button></div></div>');
                } else if ($('#core_functions8').val() == null) {
                    $("#core_table").append('<div class="row addedcf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Functions </p><input type="text" id="core_functions8" name="core_functions8" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator8" name="success_indicator8" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removecf"> Remove </button></div></div>');
                }
                break;
            case 8:
                if ($('#core_functions8').val() == null) {
                    $("#core_table").append('<div class="row addedcf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Functions </p><input type="text" id="core_functions8" name="core_functions8" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator8" name="success_indicator8" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removecf"> Remove </button></div></div>');
                } else if ($('#core_functions6').val() == null) {
                    $("#core_table").append('<div class="row addedcf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Functions </p><input type="text" id="core_functions6" name="core_functions6" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator6" name="success_indicator6" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removecf"> Remove </button></div></div>');
                } else if ($('#core_functions7').val() == null) {
                    $("#core_table").append('<div class="row addedcf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Functions </p><input type="text" id="core_functions7" name="core_functions7" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator7" name="success_indicator7" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removecf"> Remove </button></div></div>');
                }
                break;
            default:
                Swal.fire({
                    title: "Maximum input reached.",
                    text: "You cannot add more inputs for Core Functions",
                    icon: "warning",
                    confirmButtonText: "Okay"
                });
                --cf;
                break;
        }
    });
    $(document).on('click', '#removecf', function() {
        $(this).parents('.addedcf').remove();
        --cf;
    });

    var sf = 9;
    $("#addsf").click(function() {
        ++sf;
        switch (sf) {
            case 10:
                $("#supp_table").append('<div class="row addedsf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Support Functions </p><input type="text" id="support_functions10" name="support_functions10" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator10" name="success_indicator10" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesf"> Remove </button></div></div>');
                break;
            case 11:
                if ($('#support_functions11').val() == null) {
                    $("#supp_table").append('<div class="row addedsf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Support Functions </p><input type="text" id="support_functions11" name="support_functions11" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator11" name="success_indicator11" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesf"> Remove </button></div></div>');
                } else if ($('#support_functions10').val() == null) {
                    $("#supp_table").append('<div class="row addedsf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Support Functions </p><input type="text" id="support_functions10" name="support_functions10" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator10" name="success_indicator10" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesf"> Remove </button></div></div>');
                } else if ($('#support_functions12').val() == null) {
                    $("#supp_table").append('<div class="row addedsf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Support Functions </p><input type="text" id="support_functions12" name="support_functions12" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator12" name="success_indicator12" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesf"> Remove </button></div></div>');
                }
                break;
            case 12:
                if ($('#support_functions12').val() == null) {
                    $("#supp_table").append('<div class="row addedsf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Support Functions </p><input type="text" id="support_functions12" name="support_functions12" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator12" name="success_indicator12" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesf"> Remove </button></div></div>');
                } else if ($('#support_functions10').val() == null) {
                    $("#supp_table").append('<div class="row addedsf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Support Functions </p><input type="text" id="support_functions10" name="support_functions10" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator10" name="success_indicator10" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesf"> Remove </button></div></div>');
                } else if ($('#support_functions11').val() == null) {
                    $("#supp_table").append('<div class="row addedsf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Support Functions </p><input type="text" id="support_functions11" name="support_functions11" class="form-control"></div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><input type="text" id="success_indicator11" name="success_indicator11" class="form-control"></div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesf"> Remove </button></div></div>');
                }
                break;
            default:
                Swal.fire({
                    title: "Maximum input reached.",
                    text: "You cannot add more inputs for Support Functions",
                    icon: "warning",
                    confirmButtonText: "Okay"
                });
                --sf;
                break;
        }
    });
    $(document).on('click', '#removesf', function() {
        $(this).parents('.addedsf').remove();
        --sf;
    });
</script>
@endsection