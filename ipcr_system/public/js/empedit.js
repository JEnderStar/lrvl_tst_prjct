let errorMessage = '';
$("#employee_form").on("submit", function (e) {
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
                success: function (response) {
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

// Variable to keep track of the sp index
var sp = 0;

// Event handler for adding a new Strategic Priority
$("#addsp").click(function () {
    // Temporary fix: when sp is less than 0, it returns to 0.
    if (sp < 0) {
        sp = 0;
    }
    // Check if the element with the current sp index exists
    if ($('#sp_table_' + sp).val() == null) {
        // Create a new element for the Strategic Priority
        $("#sp_table").append('<div class="row" id="sp_table_' + sp + '"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><textarea type="text" id="function_sp' + sp + '" name="function_sp' + sp + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_sp' + sp + '" name="success_indicator_sp' + sp + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" onclick="deleteFunction_sp(' + sp + ')"> ⌦ </button></div></div>');
    } else {
        // Repeat from the first index if an element with the index exists
        var sp2 = 0
        // Infinite loop to check and add element
        while (true) {
            if ($('#sp_table_' + sp2).val() == null) {
                // Create an element with an index that does not exist
                $("#sp_table").append('<div class="row" id="sp_table_' + sp2 + '"><div class="form-group col-5"><p for="requested_by" class="form_label"> Strategic Priorities </p><textarea type="text" id="function_sp' + sp2 + '" name="function_sp' + sp2 + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_sp' + sp2 + '" name="success_indicator_sp' + sp2 + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" onclick="deleteFunction_sp(' + sp2 + ')"> ⌦ </button></div></div>');
                break;
            } else {
                sp2++
            }
        }
    }
});

// Variable to keep track of the cf index
var cf = 0;

// Event handler for adding a new Core Function
$("#addcf").click(function () {
    // Temporary fix: when cf is less than 0, it returns to 0.
    if (cf < 0) {
        cf = 0;
    }
    // Check if the element with the current cf index exists
    if ($('#cf_table_' + cf).val() == null) {
        if (cf < 0) {
            cf = 0;
        }
        // Create a new element for the Core Function
        $("#cf_table").append('<div class="row" id="cf_table_' + cf + '"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Function </p><textarea type="text" id="function_cf' + cf + '" name="function_cf' + cf + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_cf' + cf + '" name="success_indicator_cf' + cf + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-2" > <p> </p><button type="button" class="btn btn-danger" onclick="deleteFunction_cf(' + cf + ')"> ⌦  </button></div></div>');
    } else {
        // Repeat from the first index if an element with the index exists
        var cf2 = 0
        // Infinite loop to check and add elements
        while (true) {
            if ($('#cf_table_' + cf2).val() == null) {
                // Create an element with an index that does not exist
                $("#cf_table").append('<div class="row" id="cf_table_' + cf2 + '"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Function </p><textarea type="text" id="function_cf' + cf2 + '" name="function_cf' + cf2 + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_cf' + cf2 + '" name="success_indicator_cf' + cf2 + '" class="form-control" oninput="autoExpand(this)"></textarea></div><div class="form-group col-2"> <p> </p><button type="button" class="btn btn-danger" onclick="deleteFunction_cf(' + cf2 + ')"> ⌦  </button></div></div>');
                break;
            } else {
                cf2++
            }
        }
    }
});

// Variable to keep track of the sf index
var sf = 0;

// Event handler for adding a new Support Function
$("#addsf").click(function () {
    // Temporary fix: when sf is less than 0, it returns to 0.
    if(sf < 0){
        sf = 0;
    }
    // Check if the element with the current sf index exists
    if ($('#sf_table_' + sf).val() == null) {
        // Create a new element for the Support Function
        $("#sf_table").append('<div class="row" id="sf_table_' + sf + '"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Function </p><textarea type="text" id="function_sf' + sf + '" name="function_sf' + sf + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_sf' + sf + '" name="success_indicator_sf' + sf + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" onclick="deleteFunction_sf(' + sf + ')"> ⌦ </button></div></div>');
    } else {
        // Repeat from the first index if an element with the index exists
        var sf2 = 0
        // Infinite loop to check and add elements
        while (true) {
            if ($('#sf_table_' + sf2).val() == null) {
                // Create an element with an index that does not exist
                $("#sf_table").append('<div class="row" id="sf_table_' + sf2 + '"><div class="form-group col-5"><p for="requested_by" class="form_label"> Core Function </p><textarea type="text" id="function_sf' + sf2 + '" name="function_sf' + sf2 + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-5"><p for="requested_by" class="form_label"> Success Indicator </p><textarea type="text" id="success_indicator_sf' + sf2 + '" name="success_indicator_sf' + sf2 + '" class="form-control" oninput="autoExpand(this)"></textarea> </div><div class="form-group col-2"><p> </p><button type="button" class="btn btn-danger" onclick="deleteFunction_sf(' + sf2 + ')"> ⌦ </button></div></div>');
                break;
            } else {
                sf2++
            }
        }
    }
});

function deleteFunction_sp(index) {
    // Remove the function line from the view
    document.getElementById('sp_table_' + index).remove();
    --sp;
}

function deleteFunction_cf(index) {
    // Remove the function line from the view
    document.getElementById('cf_table_' + index).remove();
    --cf;
}

function deleteFunction_sf(index) {
    // Remove the function line from the view
    document.getElementById('sf_table_' + index).remove();
    --sf;
}