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
                            text: 'Successfully graded a form!',
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
    $('.input-container').on('keyup', 'input', function () {
        // finds the container of that index
        var container = $(this).closest('.input-container');
        // find the input inside the container
        var inputs = container.find('input');
        // find the value of the checked input
        var currentValue = $(this).val();

        //get values of Q1, E2, and T3 inputs
        var q1Value = parseFloat(container.find('.q1-input').val()) || 0;
        var e2Value = parseFloat(container.find('.e2-input').val()) || 0;
        var t3Value = parseFloat(container.find('.t3-input').val()) || 0;

        // limit decimal places to 2 and restrict to maximum 5.00, and update them to the blade
        if(q1Value > 5){
            q1Value = Math.min(parseFloat(q1Value.toFixed(2)), 5.00);
            container.find('.q1-input').val(q1Value);
        }
        if(e2Value > 5){
            e2Value = Math.min(parseFloat(e2Value.toFixed(2)), 5.00);
            container.find('.e2-input').val(e2Value);
        }
        if(t3Value > 5){
            t3Value = Math.min(parseFloat(t3Value.toFixed(2)), 5.00);
            container.find('.t3-input').val(t3Value);
        }

        // calculate the sum of Q1, E2, and T3
        var sum = q1Value + e2Value + t3Value;

        // calculate the divisor based on the number of inputs with values
        var divisor = (q1Value !== 0 ? 1 : 0) + (e2Value !== 0 ? 1 : 0) + (t3Value !== 0 ? 1 : 0);

        // divide the sum by the divisor
        var dividedSum = sum / divisor;

        // set the dividedSum value to A4 input
        container.find('.a4-input').val(dividedSum.toFixed(2));
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