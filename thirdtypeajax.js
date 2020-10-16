$(document).ready(function(e) {
    $('#adminLogin').on('submit', (function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'includes/auth.php',
            data: formData,
            cache: false,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function() {
              $(".submitButton").html("Validating...");
              $(".submitButton").attr('disabled', 'disabled');
            },
            success: function(data) {
                console.log(data);
                if (data.response.code == '1') {
                    $(".submitButton").html("Redirecting...");
                    $.toast({
                        heading: "Success!",
                        showHideTransition: "slide",
                        text: data.response.msg,
                        position: "top-right",
                        loaderBg: "#5ba035",
                        icon: "success",
                        hideAfter: 3e3,
                        stack: 1
                    })
                    setTimeout(function() {
                        window.location = data.response.url;
                    }, 2000);
                }
                if (data.response.code == '0') {
                    $(".submitButton").html("SIGN IN");
                    $(".submitButton").removeAttr('disabled');
                    $.toast({
                        heading: "Oh Snap!",
                        showHideTransition: "slide",
                        text: data.response.msg,
                        position: "top-right",
                        loaderBg: "#bf441d;",
                        icon: "error",
                        hideAfter: 3e3,
                        stack: 1
                    })
                }
            },
            error: function(data) {
                console.log("error");
                console.log(data);
            }
        });
    }));
});