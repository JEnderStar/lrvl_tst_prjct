let errorMessages = '';
    // Get all ID of Form and Buttons
    var form = document.getElementById('approve_form');
    var buttons = form.querySelectorAll('button[type="submit"]');

    // For each button press will use the function
    buttons.forEach(function(button) {
        // Specific button pressed
        button.addEventListener('click', function(e) {
            //get value of clicked button
            var status = button.value;
            //get all data from form into array
            let formData = new FormData($('#approve_form')[0]);

            if (status == "Approved by DC") {
                // prevent from redirecting to other page
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure you want to approve this form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Confirm",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // get button value for replacing "status" data in ipcr form
                        formData.append('status', status);
                        $.ajax({
                            // link to update ipcr form
                            url: "/approvedc/" + $('#approve_form').attr("data-id"),
                            method: "POST",
                            processData: false,
                            contentType: false,
                            cache: false,
                            // get array of form data
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
                                            // redirect to Approve Page
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
                                $.ajax({
                                    url: "/approvedc/" + $('#approve_form').attr("data-id"),
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