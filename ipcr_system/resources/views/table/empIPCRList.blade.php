@extends('layouts.app')

@section('content')

<div class="card">
    <div class="w-100" style="background-color:#00B0F0; color:white; display:flex; justify-content:center;">
        <h3> View your submitted IPCR Form </h3>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-mm" id="ipcr_form_table">
                <thead>
                    <tr>
                        <th> Form ID </th>
                        <th> Name </th>
                        <th>
                            Semester
                            <select class="form-control">
                                <option value="">All</option>
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>
                                <!-- Add options specific to "Covered Period" column -->
                            </select>
                        </th>
                        <th>
                            Year
                            <select class="form-control">
                                <option value="">All</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <!-- Add options specific to "Date Created" column -->
                            </select>
                        </th>
                        <th> Status </th>
                        <th> Remarks </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ipcr_form as $ipcrform)
                    @if($ipcrform["employee_id"] == Auth::user()->id)
                    <tr>
                        <td> {{$ipcrform["id"]}} </td>
                        <td> {{$ipcrform["first_name"]}} {{$ipcrform["mi"]}}. {{$ipcrform["last_name"]}} </td>
                        <td> {{$ipcrform["covered_period"]}} </td>
                        <td> {{$ipcrform["date_created"]}} </td>
                        <td> {{$ipcrform["status"]}} </td>
                        <td> {{$ipcrform["comment"]}} </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split dropdown-icon" data-toggle="dropdown"> Action </button>
                                <div class="dropdown-menu">
                                    @if($ipcrform["status"] == "Pending" || $ipcrform["status"] == "Approved by DC" || $ipcrform["status"] == "Grading by DC")
                                    <a href="/employee/{{$ipcrform['id']}}" class="dropdown-item">          👁 View </a>
                                    @endif
                                    @if($ipcrform["status"] == "Approved by DC" || $ipcrform["status"] == "Rejected by DC" || $ipcrform["status"] == "Rejected by Director")
                                    <a href="/employee/{{$ipcrform['id']}}/edit" class="dropdown-item">          ✏ Edit </a>
                                    @endif
                                    <!-- @if($ipcrform["status"] == "Rejected by DC" || $ipcrform["status"] == "Rejected by Director")
                                    <button type="button" id="delete_form" data-product-id="{{$ipcrform['id']}}" class="dropdown-item">            Delete </button>
                                    @endif -->
                                    @if($ipcrform["status"] == "Approved by Director" || $ipcrform["status"] == "Verified")
                                    <form action="/printform/{{$ipcrform['id']}}" id="print_form" data-product-id="{{$ipcrform['id']}}" method="POST">
                                        @CSRF
                                        <button type="submit" id="print_ipcr" class="dropdown-item">          🖨 Print </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $("body").on("click", "#delete_form", function(e) {
        e.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                let formData = new FormData();
                let reason = result.value;
                formData.append('reason', reason);
                Swal.fire({
                    title: 'Now Loading',
                    html: '<b> Please wait... </b>',
                    timer: 15000,
                    didOpen: () => {
                        Swal.showLoading()
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                })
                $.ajax({
                    url: "/deleteform/" + $(this).attr("data-product-id"),
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
                                text: 'Successfully deleted a form!',
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

    $('#print_form').on('submit', function(e) {
        let errorMessages = '';
        let formData = new FormData($("#print_form")[0]);
        $.ajax({
            url: '/printform/' + $(this).attr("data-product-id"),
            method: "POST",
            processData: false,
            contentType: false,
            cache: false,
            data: formData,
            success: function(response) {
                if (response.success) {
                    window.location.href = '/printform/' + $(this).attr("data-product-id");
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
    });

    $(document).ready(function() {
        var dataTable = $('#ipcr_form_table').DataTable({
            width: '100%',
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            order: [[0, 'desc']],
        });

        // Custom filters for "covered_period," "date_created," and "office" columns
        $('#ipcr_form_table thead th').each(function() {
            var title = $(this).text();
            if (title === 'Semester' || title === 'Year') {
                $(this).html('<select class="form-control"><option value="">All</option></select>');
            }
        });

        dataTable.columns().every(function() {
            var that = this;

            $('select', this.header()).on('change', function() {
                var value = $.fn.dataTable.util.escapeRegex($(this).val());
                that.search(value !== '' ? '^' + value + '$' : '', true, false).draw();
            });
        });
    });
</script>
@endsection