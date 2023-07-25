$('.select2').select2({});

$('#office').change(function () {
    var office = $('#office').val();

    // Remove existing element with id 'existing'
    document.getElementById('existing')?.remove();

    // Append a new element with id 'existing' and label 'Employees'
    $('.employee-list').append('<div id="existing"><label> Employees </label><select class="select2 form-control employees" name="employees[]" id="employees" multiple required></select></div>');

    var selectElement = $('.select2')[0];

    switch (office) {

        case "CMIO":

            // Create optgroup for CMIO employees
            var cmiogroup = $("<optgroup label='CMIO'></optgroup>");

            // Loop through accountData and append options for CMIO employees
            for (var i = 0; i < accountData.length; i++) {
                var account = accountData[i];
                if (account.office == "CMIO" && account.position == "Employee") {
                    cmiogroup.append('<option value="' + account.first_name + ' ' + account.last_name + '">' + account.first_name + ' ' + account.last_name + '</option>');
                }
            }

            // Append an option for selecting all CMIO members
            cmiogroup.append('<option value="CMIO_All">All</option>');
            $(selectElement).append(cmiogroup);
            $('.select2').select2({});

            break;

        case "PSD":

            // Create optgroup for PSD employees
            var psdgroup = $("<optgroup label='PSD'></optgroup>");

            // Loop through accountData and append options for PSD employees
            for (var i = 0; i < accountData.length; i++) {
                var account = accountData[i];
                if (account.office == "PSD" && account.position == "Employee") {
                    psdgroup.append('<option value="' + account.first_name + ' ' + account.last_name + '">' + account.first_name + ' ' + account.last_name + '</option>');
                }
            }

            // Append an option for selecting all PSD members
            psdgroup.append('<option value="PSD_All">All</option>');
            $(selectElement).append(psdgroup);
            $('.select2').select2({});

            break;

        case "All":

            // Create optgroup for CMIO employees
            var cmiogroup = $("<optgroup label='CMIO'></optgroup>");

            // Loop through accountData and append options for CMIO employees
            for (var i = 0; i < accountData.length; i++) {
                var account = accountData[i];
                if (account.office == "CMIO" && account.position == "Employee") {
                    cmiogroup.append('<option value="' + account.first_name + ' ' + account.last_name + '">' + account.first_name + ' ' + account.last_name + '</option>');
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
                    psdgroup.append('<option value="' + account.first_name + ' ' + account.last_name + '">' + account.first_name + ' ' + account.last_name + '</option>');
                }
            }

            // Append an option for selecting all PSD members
            psdgroup.append('<option value="PSD_All">All PSD Members</option>');
            $(selectElement).append(psdgroup);
            $('.select2').select2({});

            break;

    }// switch

    // Attach the event handler using event delegation to the parent '.employee-list' element
    $('.employee-list').on('change', 'select', function () {
        let selected = $(this).val();
        let officeSelected = $('#office').val();

        // Enable all options and optgroups
        $('.employee-list option').prop('disabled', false);
        $('.employee-list optgroup').prop('disabled', false);

        // Check if any individual employee is selected within the office
        if (selected.length > 0) {
            if (officeSelected === 'CMIO') {
                let cmioAllDisabled = $('.employee-list option[value="CMIO_All"]').prop('disabled');
                if (!cmioAllDisabled) {
                    if (selected.includes('CMIO_All')) {
                        // Disable all CMIO options except for "All CMIO Members"
                        $('.employee-list optgroup[label="CMIO"] option:not([value="CMIO_All"])').prop('disabled', true);
                    } else {
                        $('.employee-list option[value="CMIO_All"]').prop('disabled', true);
                    }
                }
            } else if (officeSelected === 'PSD') {
                let psdAllDisabled = $('.employee-list option[value="PSD_All"]').prop('disabled');
                if (!psdAllDisabled) {
                    if (selected.includes('PSD_All')) {
                        // Disable all PSD options except for "All PSD Members"
                        $('.employee-list optgroup[label="PSD"] option:not([value="PSD_All"])').prop('disabled', true);
                    } else {
                        $('.employee-list option[value="PSD_All"]').prop('disabled', true);
                    }
                }
            }
        }

        // Handle the "All" option in the office selection
        if (officeSelected == 'All') {
            let allCMIOSelected = selected.includes('CMIO_All');
            let allPSDSelected = selected.includes('PSD_All');

            let selectedCMIOEmployees = $('.employee-list optgroup[label="CMIO"] option:not([value="CMIO_All"])').map(function() {return $(this).attr("value");}).get();
            let selectedPSDEmployees = $('.employee-list optgroup[label="PSD"] option:not([value="PSD_All"])').map(function(){return $(this).attr("value");}).get();
            
            let lengthCMIOEmployees = $('.employee-list optgroup[label="CMIO"] option:not([value="CMIO_All"])').length;
            let lengthPSDEmployees = $('.employee-list optgroup[label="PSD"] option:not([value="PSD_All"])').length;

            if (selected.length > 0 && allCMIOSelected) {
                // Disable all CMIO options except for "All CMIO Members"
                $('.employee-list optgroup[label="CMIO"] option:not([value="CMIO_All"])').prop('disabled', true);
            } else {
                for(var i = 0; i < lengthCMIOEmployees; i++){
                    if (selected.length > 0 && selected.includes(selectedCMIOEmployees[i])){
                        $('.employee-list optgroup[label="CMIO"] option[value="CMIO_All"]').prop('disabled', true);
                        break;
                    } else {
                        $('.employee-list optgroup[label="CMIO"] option[value="CMIO_All"]').removeAttr('disabled');
                    }
                }
            }

            if (selected.length > 0 && allPSDSelected) {
                // Disable all PSD options except for "All PSD Members"
                $('.employee-list optgroup[label="PSD"] option:not([value="PSD_All"])').prop('disabled', true);
            } else {
                for(var i = 0; i < lengthPSDEmployees; i++){
                    if (selected.length > 0 && selected.includes(selectedPSDEmployees[i])){
                        $('.employee-list optgroup[label="PSD"] option[value="PSD_All"]').prop('disabled', true);
                        break;
                    } else {
                        $('.employee-list optgroup[label="PSD"] option[value="PSD_All"]').removeAttr('disabled');
                    }
                }
            }
        }
    });

});

// document.addEventListener('DOMContentLoaded', function () {
//     flatpickr('#duration_from', {
//         dateFormat: 'Y-m-d', // Set the date format (adjust as needed)
//         minDate: 'today', // Disable past dates
//         disable: [
//             function (date) {
//                 // Disable weekends
//                 return date.getDay() === 0 || date.getDay() === 6;
//             }
//         ],
//     });

//     flatpickr('#duration_to', {
//         dateFormat: 'Y-m-d', // Set the date format (adjust as needed)
//         minDate: 'today', // Disable past dates
//         disable: [
//             function (date) {
//                 // Disable weekends
//                 return date.getDay() === 0 || date.getDay() === 6;
//             }
//         ],
//     });

//     flatpickr('#last_submission', {
//         dateFormat: 'Y-m-d', // Set the date format (adjust as needed)
//         minDate: 'today', // Disable past dates
//         disable: [
//             function (date) {
//                 // Disable weekends
//                 return date.getDay() === 0 || date.getDay() === 6;
//             }
//         ],
//     });
// });

var maxDate;

$('#covered_period').on('change', function () {

    // Get current year
    var currentYear = new Date().getFullYear();

    // Handle dropdown change event
    var selectedValue = $(this).val();
    var firstDateDiv = $('#startDate');

    // Get Input elements
    var secondDateInput = $('#duration_to');
    var lastSubmissionInput = $('#last_submission');

    // Clear the values of the second date and last submission inputs
    secondDateInput.val('');
    lastSubmissionInput.val('');

    // Set min and max dates for the first date input based on selected value
    if (selectedValue == '1st Semester') {
        // Set maximum date
        maxDate = currentYear + '-06-30';

        flatpickr('#duration_from', {
            dateFormat: 'Y-m-d', // Set the date format (adjust as needed)
            minDate: 'today', // Disable past dates
            maxDate: maxDate, // Dates are until 1st semester
            disable: [
                function (date) {
                    // Disable weekends
                    return date.getDay() === 0 || date.getDay() === 6;
                }
            ],
        });
        firstDateDiv.removeAttr('hidden');
    } else if (selectedValue == '2nd Semester') {
        // Set maximum date
        maxDate = currentYear + '-12-31';

        flatpickr('#duration_from', {
            dateFormat: 'Y-m-d', // Set the date format (adjust as needed)
            minDate: 'today', // Disable past dates
            maxDate: maxDate, // Dates are until 2nd semester
            disable: [
                function (date) {
                    // Disable weekends
                    return date.getDay() == 0 || date.getDay() == 6;
                }
            ],
        });
        firstDateDiv.removeAttr('hidden');
    } else {
        firstDateDiv.attr('hidden', true);
    }
});

$('#duration_from').on('change', function () {
    var firstDateInput = $(this);
    var secondDateInput = $('#duration_to');
    var lastSubmissionInput = $('#last_submission');

    var secondDateDiv = $('#endDate');
    var lastSubmissionDiv = $('#lastSubmit');

    // Clear the values of the second date and last submission inputs
    secondDateInput.val('');
    lastSubmissionInput.val('');

    // Update the minimum value of the second date input
    var firstDateValue = firstDateInput.val();
    if (firstDateValue) {
        flatpickr('#duration_to', {
            dateFormat: 'Y-m-d', // Set the date format (adjust as needed)
            minDate: firstDateValue, // Disable past dates
            maxDate: maxDate, // Use the stored maxDate
            disable: [
                function (date) {
                    // Disable weekends
                    return date.getDay() === 0 || date.getDay() === 6;
                }
            ],
        });
        secondDateDiv.removeAttr('hidden');
        lastSubmissionDiv.attr('hidden', true);
    } else {
        secondDateDiv.attr('hidden', true);
        lastSubmissionDiv.attr('hidden', true);
    }
});

$('#duration_to').on('change', function () {
    var lastSubmissionDiv = $('#lastSubmit');
    var lastSubmissionInput = $('#last_submission');

    // Clear the value of the last submission input
    lastSubmissionInput.val('');

    // Update the minimum and maximum value of the third date input
    var firstDateValue = $('#duration_from').val();
    var secondDateValue = $('#duration_to').val();

    if (secondDateValue) {
        flatpickr('#last_submission', {
            dateFormat: 'Y-m-d', // Set the date format (adjust as needed)
            minDate: firstDateValue, // Disable past dates
            maxDate: maxDate, // Use the stored maxDate
            disable: [
                function (date) {
                    // Disable weekends
                    return date.getDay() === 0 || date.getDay() === 6;
                }
            ],
        });
        lastSubmissionDiv.removeAttr('hidden');
    } else {
        lastSubmissionDiv.attr('hidden', true);
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
