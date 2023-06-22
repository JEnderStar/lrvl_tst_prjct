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