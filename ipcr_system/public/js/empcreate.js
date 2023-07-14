let errorMessages = '';

// Submit event handler for the employee form
$("#employee_form").on("submit", function (e) {
    e.preventDefault();
    let formData = new FormData($('#employee_form')[0]);

    // Display a confirmation dialog using Swal (SweetAlert) library
    Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            // Display a loading dialog using Swal library
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

            // Send an AJAX request to submit the form data
            $.ajax({
                url: "/employee/",
                method: "POST",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                success: function (response) {
                    if (response.success) {
                        // Display a success message using Swal library
                        Swal.fire({
                            title: 'Success!',
                            text: 'Successfully created a form!',
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/employee/";
                            }
                        })
                    } else {
                        // Loop through response errors and concatenate error messages
                        for (let i = 0; i < response.errors.length; i++) {
                            errorMessages += "-" + response.errors[i] + "\n";
                        }

                        // Display an error message with the concatenated error messages
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
            // Display a message when the action is cancelled
            Swal.fire({
                title: 'Action cancelled!',
                text: 'You cancelled the action!',
                icon: 'info',
                confirmButtonText: 'Okay'
            })
        }
    });
});

$("#saveDraft").on('submit', function (e) {
    let formData = new FormData($('#employee_form')[0]);
    e.preventDefault();

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

    // Send an AJAX request to save the form data as a draft
    $.ajax({
        url: "/draft",
        method: "POST",
        processData: false,
        contentType: false,
        cache: false,
        data: formData,
        success: function (response) {
            if (response.success) {
                // Display a success message using Swal library
                Swal.fire({
                    title: 'Draft Saved!',
                    text: 'Your form has been saved as a draft.',
                    icon: 'success',
                    confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/employee/";
                    }
                })
            } else {
                // Loop through response errors and concatenate error messages
                for (let i = 0; i < response.errors.length; i++) {
                    errorMessages += "-" + response.errors[i] + "\n";
                }

                // Display an error message with the concatenated error messages
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

// Variable to keep track of the sp index
var sp = 1;

// Event handler for adding a new Strategic Priority
$("#addsp").click(function () {
    var sp1 = sp + 1;

    // Infinite loop to check and add elements
    for (sp; sp < sp1; sp++) {
        // Check if the element with the current sp index exists
        for (var i = 0; i < sp; i++) {
            if ($('#function_sp' + sp).val() == null) {
                // Create a new element for the Strategic Priority
                $("#strat_table").append('<div class="row addedsp"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><textarea type="text" id="function_sp' + sp + '" name="function_sp' + sp + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_sp' + sp + '" name="success_indicator_sp' + sp + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesp"> ⌦ </button></div></div>');
            } else {
                // Repeat from the first index if an element with the index exists
                for (var sp2 = 1; sp2 < sp; sp2++) {
                    if ($('#function_sp' + sp2).val() == null) {
                        // Create an element with an index that does not exist
                        $("#strat_table").append('<div class="row addedsp"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><textarea type="text" id="function_sp' + sp2 + '" name="function_sp' + sp2 + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_sp' + sp2 + '" name="success_indicator_sp' + sp2 + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesp"> ⌦ </button></div></div>');
                        break;
                    }
                }
            }
            break;
        }
    }
});

// Event handler for removing a Strategic Priority
$(document).on('click', '#removesp', function () {
    $(this).parents('.addedsp').remove();
    --sp;
});

// Variable to keep track of the cf index
var cf = 1;

// Event handler for adding a new Core Function
$("#addcf").click(function () {
    var cf1 = cf + 1;

    // Infinite loop to check and add elements
    for (cf; cf < cf1; cf++) {
        // Check if the element with the current cf index exists
        for (var i = 0; i < cf; i++) {
            if ($('#function_cf' + cf).val() == null) {
                // Create a new element for the Core Function
                $("#core_table").append('<div class="row addedcf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Function </p><textarea type="text" id="function_cf' + cf + '" name="function_cf' + cf + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_cf' + cf + '" name="success_indicator_cf' + cf + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-2" > <p> </p><button type="button" class="btn btn-danger" id="removecf"> ⌦  </button></div></div>');
            } else {
                // Repeat from the first index if an element with the index exists
                for (var cf2 = 1; cf2 < cf; cf2++) {
                    if ($('#function_cf' + cf2).val() == null) {
                        // Create an element with an index that does not exist
                        $("#core_table").append('<div class="row addedcf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Function </p><textarea type="text" id="function_cf' + cf2 + '" name="function_cf' + cf2 + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_cf' + cf2 + '" name="success_indicator_cf' + cf2 + '" class="form-control" oninput="autoExpand(this)"></textarea></div><div class="form-group col-2"> <p> </p><button type="button" class="btn btn-danger" id="removecf"> ⌦  </button></div></div>');
                        break;
                    }
                }
            }
            break;
        }
    }
});

// Event handler for removing a Core Function
$(document).on('click', '#removecf', function () {
    $(this).parents('.addedcf').remove();
    --cf;
});

// Variable to keep track of the sf index
var sf = 1;

// Event handler for adding a new Support Function
$("#addsf").click(function () {
    var sf1 = sf + 1;

    // Infinite loop to check and add elements
    for (sf; sf < sf1; sf++) {
        // Check if the element with the current sf index exists
        for (var i = 0; i < sf; i++) {
            if ($('#function_sf' + sf).val() == null) {
                // Create a new element for the Support Function
                $("#supp_table").append('<div class="row addedsf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Function </p><textarea type="text" id="function_sf' + sf + '" name="function_sf' + sf + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_sf' + sf + '" name="success_indicator_sf' + sf + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesf"> ⌦ </button></div></div>');
            } else {
                // Repeat from the first index if an element with the index exists
                for (var sf2 = 1; sf2 < sf; sf2++) {
                    if ($('#function_sf' + sf2).val() == null) {
                        // Create an element with an index that does not exist
                        $("#supp_table").append('<div class="row addedsf"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Function </p><textarea type="text" id="function_sf' + sf2 + '" name="function_sf' + sf2 + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_sf' + sf2 + '" name="success_indicator_sf' + sf2 + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" id="removesf"> ⌦ </button></div></div>');
                        break;
                    }
                }
            }
            break;
        }
    }
});

// Event handler for removing a Support Function
$(document).on('click', '#removesf', function () {
    $(this).parents('.addedsf').remove();
    --sf;
});

function autoExpand(textarea) {
    // reset textarea height size
    textarea.style.height = 'auto';
    // automatically adjust textarea size
    textarea.style.height = textarea.scrollHeight + 'px';
}

$("textarea").each(function (textarea) {
    // automatically adjust textarea size when loaded
    $(this).height($(this)[0].scrollHeight);
});