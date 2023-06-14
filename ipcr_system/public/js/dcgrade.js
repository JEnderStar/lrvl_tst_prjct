let errorMessages = '';

$("#grade_form").on("submit", function (e) {
    e.preventDefault();
    let formData = new FormData($('#grade_form')[0]);
    Swal.fire({
        title: "Are you sure?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Confirm",
        cancelButtonText: "Cancel"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/gradedc/" + $('#grade_form').attr("data-id"),
                method: "POST",
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Successfully created a form!',
                            icon: 'success',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // redirect to page
                                window.location.href = "/gradedc/";
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

$(document).ready(function () {
    $('.input-container').on('change', 'input', function () {
        // finds the container of that index
        var container = $(this).closest('.input-container');
        // find the input inside the container
        var inputs = container.find('input');
        // find the value of the checked input
        var currentValue = $(this).val();

        // Reset readonly for all inputs
        inputs.prop('readonly', false); 

        if (currentValue !== '') {
            // make all input other than user inputted readonly
            inputs.not(this).prop('readonly', true);
        }
        //get value of user input to a4
        container.find('.a4-input').val(currentValue);
        //always make a4 input readonly
        container.find('.a4-input').prop('readonly', true);
        
        // get far input container
        var averageContainer = $('.average-container');
        // get far input
        var a4Inputs = $('.a4-input');

        var sum = 0;
        var count = 0;

        a4Inputs.each(function () {
            var value = $(this).val();
            if (value !== '') {
                //get all a4 input values
                sum += parseFloat(value);
                //count all a4 input elements
                count++;
            }
        });
        
        // count divide sum of all a4
        var average = count > 0 ? sum / count : 0;
        // place to far
        averageContainer.find('.far-input').val(average.toFixed(2));
    });
});