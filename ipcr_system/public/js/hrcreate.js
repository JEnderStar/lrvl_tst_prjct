$('.select2').select2({});

$('#office').change(function() {
    var office = $('#office').val();
    switch(office){
        case "CMIO":
            // Remove existing element with id 'existing'
            document.getElementById('existing')?.remove();
            
            // Append a new element with id 'existing' and label 'Employees'
            $('.employee-list').append('<div id="existing"><label> Employees </label><select class="select2 form-control employees" name="employees[]" id="employees" multiple required><optgroup label="CMIO"></optgroup></select></div>');
            
            var selectElement = $('.select2')[0];
            
            // Loop through accountData and append options for CMIO employees
            for (var i = 0; i < accountData.length; i++) {
                var account = accountData[i];
                if(account.office == "CMIO" && account.position == "Employee"){
                    $(selectElement).append('<option value="' + account.first_name + '">' + account.first_name + '</option>');
                }
            }
            
            // Append an option for selecting all CMIO employees
            $(selectElement).append('<option value="CMIO_All">All</option>');
            $('.select2').select2({});

            // Event listener for select change
            $(selectElement).change(function() {
                if ($(this).val() === "CMIO_All") {
                    // Select all options in the 'CMIO' optgroup when 'CMIO_All' is selected
                    $(selectElement).val($(selectElement).find('optgroup[label="CMIO"] option').map(function() {
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
                if(account.office == "PSD" && account.position == "Employee"){
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
                if(account.office == "CMIO" && account.position == "Employee"){
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
                if(account.office == "PSD" && account.position == "Employee"){
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
