let errorMessage = '';
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
                            errorMessage += "-" + response.message + "\n";

                            Swal.fire({
                                html: '<pre>' + errorMessage + '</pre>',
                                customClass: {
                                    popup: 'format-pre'
                                },
                                title: 'Error!',
                                icon: 'error',
                                confirmButtonText: 'Okay'
                            })
                            errorMessage = "";
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

    function autoExpand(textarea){
        // reset textarea height size
        textarea.style.height = 'auto';
        // automatically adjust textarea size
        textarea.style.height = textarea.scrollHeight + 'px';
    }

    $("textarea").each(function(textarea) {
        // automatically adjust textarea size when loaded
        $(this).height( $(this)[0].scrollHeight );
    });