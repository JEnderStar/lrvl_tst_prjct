$('.select2').select2({});

$('#office').change(function () {
    var office = $('#office').val();
    switch (office) {

        case "CMIO":
            // Remove existing element with id 'existing'
            document.getElementById('existing')?.remove();

            // Append a new element with id 'existing' and label 'Employees'
            $('.employee-list').append('<div id="existing"><label> Employees </label><select class="select2 form-control employees" name="employees[]" id="employees" multiple required></select></div>');

            var selectElement = $('.select2')[0];

            // Create optgroup for CMIO employees
            var cmiogroup = $("<optgroup label='CMIO'></optgroup>");

            // Loop through accountData and append options for CMIO employees
            for (var i = 0; i < accountData.length; i++) {
                var account = accountData[i];
                if (account.office == "CMIO" && account.position == "Employee") {
                    cmiogroup.append('<option value="' + account.first_name + '">' + account.first_name + '</option>');
                }
            }

            // Append an option for selecting all CMIO members
            cmiogroup.append('<option value="CMIO_All">All</option>');
            $(selectElement).append(cmiogroup);
            $('.select2').select2({});

        break;

        case "PSD":

            // Remove existing element with id 'existing'
            document.getElementById('existing')?.remove();

            // Append a new element with id 'existing' and label 'Employees'
            $('.employee-list').append('<div id="existing"><label> Employees </label><select class="select2 form-control employees" name="employees[]" id="employees" multiple required></select></div>');

            var selectElement = $('.select2')[0];

            // Create optgroup for PSD employees
            var psdgroup = $("<optgroup label='PSD'></optgroup>");

            // Loop through accountData and append options for PSD employees
            for (var i = 0; i < accountData.length; i++) {
                var account = accountData[i];
                if (account.office == "PSD" && account.position == "Employee") {
                    psdgroup.append('<option value="' + account.first_name + '">' + account.first_name + '</option>');
                }
            }

            // Append an option for selecting all PSD members
            psdgroup.append('<option value="PSD_All">All</option>');
            $(selectElement).append(psdgroup);
            $('.select2').select2({});

        break;

        case "All":
            // Remove existing element with id 'existing'
            document.getElementById('existing')?.remove();

            // Append a new element with id 'existing' and label 'Employees'
            $('.employee-list').append('<div id="existing"><label> Employees </label><select class="select2 form-control employees" name="employees[]" id="employees" multiple required></select></div>');

            var selectElement = $('.select2')[0];

            // Create optgroup for CMIO employees
            var cmiogroup = $("<optgroup label='CMIO'></optgroup>");

            // Loop through accountData and append options for CMIO employees
            for (var i = 0; i < accountData.length; i++) {
                var account = accountData[i];
                if (account.office == "CMIO" && account.position == "Employee") {
                    cmiogroup.append('<option value="' + account.first_name + '">' + account.first_name + '</option>');
                }
            }

            // Append an option for selecting all CMIO members
            cmiogroup.append('<option value="CMIO_All">All CMIO Members</option>');
            $(selectElement).append(cmiogroup);

            // Create optgroup for PSD employees
            var psdgroup = $("<optgroup label='PSD'></optgroup>");

            // Loop through accountData and append options for PSD employees
            for (var i = 0; i < accountData.length; i++) {
                var account = accountData[i];
                if (account.office == "PSD" && account.position == "Employee") {
                    psdgroup.append('<option value="' + account.first_name + '">' + account.first_name + '</option>');
                }
            }

            // Append an option for selecting all PSD members
            psdgroup.append('<option value="PSD_All">All PSD Members</option>');
            $(selectElement).append(psdgroup);
            $('.select2').select2({});

        break;

    }// switch

    $('.employee-list select').on('change', function() {
        
        let selected = $(this).val();
        let option_count = $('.employee-list option').length;

        switch(true) {

            case selected.includes('CMIO_All'):
            case selected.includes('PSD_All'):

                for(i = 0; i < option_count - 1; i++) {
                    $($('.employee-list option')[i]).prop('disabled', true)
                }

            break;

            default:

                if(selected == '') {
                    
                    for(i = 0; i < option_count; i++) {
                        $($('.employee-list option')[i]).prop('disabled', false)
                    }
                    
                }
                else {
                    $($('.employee-list option')[option_count - 1]).prop('disabled', true)
                }

            break;

        }// switch

    });

});


$('#covered_period').on('change', function () {
    // Get today's date
    var today = new Date().toISOString().split('T')[0];

    // Get current year
    var currentYear = new Date().getFullYear();

    // Set minimum and maximum dates
    var minDate_1stSemester = currentYear + '-01-01';
    var maxDate_1stSemester = currentYear + '-06-30';
    var minDate_2ndSemester = currentYear + '-07-01';
    var maxDate_2ndSemester = currentYear + '-12-31';

    // Handle dropdown change event
    var selectedValue = $(this).val();
    var firstDateInput = $('#duration_from');
    var secondDateInput = $('#duration_to');
    var lastSubmissionInput = $('#last_submission');

    // Clear the values of the second date and last submission inputs
    secondDateInput.val('');
    lastSubmissionInput.val('');

    // Set min and max dates for the first date input based on selected value
    if (selectedValue == '1st Semester') {
        firstDateInput.attr('min', minDate_1stSemester);
        firstDateInput.attr('max', maxDate_1stSemester);
        firstDateInput.removeAttr('readonly');
        secondDateInput.attr('min', minDate_1stSemester);
        secondDateInput.attr('max', maxDate_1stSemester);
    } else if (selectedValue == '2nd Semester') {
        firstDateInput.attr('min', minDate_2ndSemester);
        firstDateInput.attr('max', maxDate_2ndSemester);
        firstDateInput.removeAttr('readonly');
        secondDateInput.attr('min', minDate_2ndSemester);
        secondDateInput.attr('max', maxDate_2ndSemester);
    } else {
        firstDateInput.removeAttr('min');
        firstDateInput.removeAttr('max');
        firstDateInput.attr('readonly', true);
        secondDateInput.removeAttr('min');
        secondDateInput.removeAttr('max');
    }

    // Disable past dates
    firstDateInput.attr('min', today);
});

$('#duration_from').on('change', function () {
    var firstDateInput = $(this);
    var secondDateInput = $('#duration_to');
    var lastSubmissionInput = $('#last_submission');

    // Clear the values of the second date and last submission inputs
    secondDateInput.val('');
    lastSubmissionInput.val('');

    // Update the minimum value of the second date input
    var firstDateValue = firstDateInput.val();
    if (firstDateValue) {
        secondDateInput.attr('min', firstDateValue);
        secondDateInput.removeAttr('readonly');
        lastSubmissionInput.attr('min', firstDateValue);
        lastSubmissionInput.removeAttr('max');
        lastSubmissionInput.attr('readonly', true);
    } else {
        secondDateInput.removeAttr('min');
        secondDateInput.attr('readonly', true);
        lastSubmissionInput.removeAttr('min');
        lastSubmissionInput.removeAttr('max');
        lastSubmissionInput.attr('readonly', true);
    }
});

$('#duration_to').on('change', function () {
    var secondDateInput = $(this);
    var lastSubmissionInput = $('#last_submission');

    // Clear the value of the last submission input
    lastSubmissionInput.val('');

    var secondDateValue = secondDateInput.val();
    if(secondDateValue){
        lastSubmissionInput.attr('max', secondDateValue);
        lastSubmissionInput.removeAttr('readonly');
    }else{
        lastSubmissionInput.removeAttr('max');
        lastSubmissionInput.attr('readonly', true);
    }
});

let errorMessages = '';

$("#schedule_form").on("submit", function (e) {
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
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Successfully emailed the employees, and created a schedule!',
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/hr";
                            }
                        })
                    } else {
                        // Loop through response errors and concatenate error messages
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
