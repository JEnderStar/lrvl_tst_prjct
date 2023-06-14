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
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
}

$("textarea").each(function(textarea) {
    $(this).height( $(this)[0].scrollHeight );
});

$(document).ready(function () {
    $('.input-container').on('change', 'input', function () {
        var container = $(this).closest('.input-container');
        var inputs = container.find('input');
        var currentValue = $(this).val();

        inputs.prop('readonly', false); // Reset readonly for all inputs 

        if (currentValue !== '') {
            inputs.not(this).prop('readonly', true);
        }
        container.find('.a4-input').val(currentValue);
        container.find('.a4-input').prop('readonly', true);
        
        var averageContainer = $('.average-container');
        var a4Inputs = $('.a4-input');

        var sum = 0;
        var count = 0;

        a4Inputs.each(function () {
            var value = $(this).val();
            if (value !== '') {
                sum += parseFloat(value);
                count++;
            }
        });

        var average = count > 0 ? sum / count : 0;
        averageContainer.find('.far-input').val(average.toFixed(2));
    });
});