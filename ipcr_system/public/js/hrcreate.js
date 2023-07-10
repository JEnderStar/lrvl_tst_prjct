$('.select2').select2({});

$('#office').change(function () {
    var office = $('#office').val();
    switch (office) {
        case "CMIO":
            // Remove existing element with id 'existing'
            document.getElementById('existing')?.remove();

            // Append a new element with id 'existing' and label 'Employees'
            $('.employee-list').append('<div id="existing"><label> Employees </label><select class="select2 form-control employees" name="employees[]" id="employees" multiple required><optgroup label="CMIO"></optgroup></select></div>');

            var selectElement = $('.select2')[0];

            // Loop through accountData and append options for CMIO employees
            for (var i = 0; i < accountData.length; i++) {
                var account = accountData[i];
                if (account.office == "CMIO" && account.position == "Employee") {
                    $(selectElement).append('<option value="' + account.first_name + '">' + account.first_name + '</option>');
                }
            }

            // Append an option for selecting all CMIO employees
            $(selectElement).append('<option value="CMIO_All">All</option>');
            $('.select2').select2({});

            // Event listener for select change
            $(selectElement).change(function () {
                if ($(this).val() === "CMIO_All") {
                    // Select all options in the 'CMIO' optgroup when 'CMIO_All' is selected
                    $(selectElement).val($(selectElement).find('optgroup[label="CMIO"] option').map(function () {
                        return $(this).val();
                    }).get()).trigger('change');
                }
            });
            break;
        case "PSD":
            // Remove existing element with id 'existing'
            document.getElementById('existing')?.remove();

            // Append a new element with id 'existing' and label 'Employees'
            $('.employee-list').append('<div id="existing"><label> Employees </label><select class="select2 form-control employees" name="employees[]" id="employees" multiple required><optgroup label="PSD"></optgroup></select></div>');

            var selectElement = $('.select2')[0];

            // Loop through accountData and append options for PSD employees
            for (var i = 0; i < accountData.length; i++) {
                var account = accountData[i];
                if (account.office == "PSD" && account.position == "Employee") {
                    $(selectElement).append('<option value="' + account.first_name + '">' + account.first_name + '</option>');
                }
            }

            // Append an option for selecting all PSD employees
            $(selectElement).append('<option value="PSD_All">All</option>');
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
    }
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

    firstDateInput.removeAttr('value');
    secondDateInput.removeAttr('value');

    // Set min and max dates based on selected value
    if (selectedValue == '1st Semester') {
        firstDateInput.val(today);
        firstDateInput.attr('min', minDate_1stSemester);
        firstDateInput.attr('max', maxDate_1stSemester);
        firstDateInput.attr('readonly', false);
        secondDateInput.attr('readonly', false);
    } else if (selectedValue == '2nd Semester') {
        firstDateInput.val(today);
        firstDateInput.attr('min', minDate_2ndSemester);
        firstDateInput.attr('max', maxDate_2ndSemester);
        firstDateInput.attr('readonly', false);
        secondDateInput.attr('readonly', false);
    } else {
        firstDateInput.attr('value', '');
        firstDateInput.attr('readonly', true);
        secondDateInput.attr('readonly', true);
    }

    // Disable past dates
    firstDateInput.attr('min', today);

    // Clear the value of the second date input
    secondDateInput.val('');

    // Update the minimum value of the second date input
    var firstDateValue = firstDateInput.val();
    if (firstDateValue) {
        if (selectedValue == '1st Semester') {
            secondDateInput.attr('min', firstDateValue);
            secondDateInput.attr('max', maxDate_1stSemester);
            secondDateInput.attr('readonly', false);
        } else if (selectedValue == '2nd Semester') {
            secondDateInput.attr('min', firstDateValue);
            secondDateInput.attr('max', maxDate_2ndSemester);
            secondDateInput.attr('readonly', false);
        }
    } else {
        secondDateInput.removeAttr('min');
        secondDateInput.removeAttr('max');
        secondDateInput.removeAttr('value');
        secondDateInput.attr('readonly', true);
    }
});

$('#duration_from').on('change', function () {
    // Get current year
    var currentYear = new Date().getFullYear();

    // Set maximum dates
    var maxDate_1stSemester = currentYear + '-06-30';
    var maxDate_2ndSemester = currentYear + '-12-31';

    var firstDateValue = $(this).val();
    
    var periodValue = $('#covered_period').val();
    var secondDateInput = $('#duration_to');

    // Clear the value of the second date input
    secondDateInput.val('');

    // Update the minimum value of the second date input
    if (firstDateValue) {
        if (periodValue == '1st Semester') {
            secondDateInput.attr('min', firstDateValue);
            secondDateInput.attr('max', maxDate_1stSemester);
            secondDateInput.attr('readonly', false);
        } else if (periodValue == '2nd Semester') {
            secondDateInput.attr('min', firstDateValue);
            secondDateInput.attr('max', maxDate_2ndSemester);
            secondDateInput.attr('readonly', false);
        }
    } else {
        secondDateInput.removeAttr('min');
        secondDateInput.removeAttr('max');
        secondDateInput.removeAttr('value');
        secondDateInput.attr('readonly', true);
    }
});

// Get the checkbox and input element
var checkbox = document.getElementById('enableStartDate');
var input = document.getElementById('duration_from');

// Add event listener to the checkbox
checkbox.addEventListener('change', function() {
    // If the checkbox is checked, remove the readonly attribute
    if (this.checked) {
        input.removeAttribute('readonly');
    } else {
        // If the checkbox is unchecked, add the readonly attribute
        input.setAttribute('readonly', 'readonly');
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
