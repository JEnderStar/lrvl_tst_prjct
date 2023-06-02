@extends('layouts.app')

@section('content')

<div class="card">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-mm" id="ipcr_form_table">
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
                    timer: 10000,
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

    function printForm() {
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
    };

    $(document).ready(function(){
        $('#ipcr_form_table').DataTable({
            width: '100%',
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            processing: true,
            ajax: {
                url: '/test/create',
            },
            columns: [{
                    title: 'First Name',
                    'data': 'first_name',
                    targets: [0]
                },
                {
                    title: 'Last Name',
                    'data': 'last_name',
                    targets: [1]
                },
                {
                    title: 'Middle Initial',
                    'data': 'mi',
                    targets: [2]
                },
                {
                    title: 'Position',
                    'data': 'position',
                    targets: [3]
                },
                {
                    title: 'Office',
                    'data': 'office',
                    targets: [4]
                },
                {
                    title: 'Status',
                    'data': 'status',
                    targets: [5]
                },
                {
                    title: 'Action',
                    'data': null,
                    "defaultContent": "",
                    targets: [6]
                }
            ],
            createdRow: function(row, data, index) {
                let divgroup = $('<div class="btn-group"> </div>');
                let divbtnmenu = $('<div class="dropdown-menu"> </div>');
                let action = $('<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split dropdown-icon" data-toggle="dropdown"> Action </button>');
                let view = $('<a href="/employee/' + data.id + '" class="dropdown-item">              View </a>');
                let deletee = $('<a href="/deleteform/' + data.id + '" id="delete_form" class="dropdown-item" >            Delete </a>');
                // OnClick inside a
                let edit = $('<a href="/employee/' + data.id + '/edit" class="dropdown-item">              Edit </a>');
                let print = $('<button type="submit" id="print_ipcr" class="dropdown-item">              Print </button>');
                // div.append(data.status);
                divgroup.append(action);
                divbtnmenu.append(view);
                divbtnmenu.append(edit);
                divbtnmenu.append(deletee);
                divbtnmenu.append(print);
                divgroup.append(divbtnmenu);

    
                // Display Color
                $('td', row).eq(6).append(divgroup);
            }
        });
    }); // document ready
</script>
@endsection