let errorMessages = '';
    // Get all ID of Form and Buttons
    var form = document.getElementById('approve_form');
    var buttons = form.querySelectorAll('button[type="submit"]');

    buttons.forEach(function(button) {      // For each button press will use the function
        button.addEventListener('click', function(e) {      // Specific button pressed
            var status = button.value;    //get value of clicked button
            let formData = new FormData($('#approve_form')[0]);     //get all data from form into array

            if (status == "Approved by Director") {
                e.preventDefault();     // prevent from redirecting to other page
                Swal.fire({
                    title: "Are you sure you want to approve this form?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Confirm",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        formData.append('status', status);      // get button value for replacing "status" data in ipcr form
                        $.ajax({
                            url: "/approvedir/" + $('#approve_form').attr("data-id"),    // link to update ipcr form
                            method: "POST",
                            processData: false,
                            contentType: false,
                            cache: false,
                            data: formData,     // get array of form data
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')    //CSRF Token
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
                                            window.location.href = "/approvedir";    // redirect to Approve Page
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
            } else if (status == "Rejected by Director") {
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
                                    url: "/approvedir/" + $('#approve_form').attr("data-id"),
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
                                                    window.location.href = "/approvedir";
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