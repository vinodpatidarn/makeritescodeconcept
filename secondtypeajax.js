$("#UpdateCarWash").on('submit',function(event) {
event.preventDefault();
var data=new FormData(this);
$.ajax({
type:'POST',
url: 'edit_vehicle_carwash.php',
data:data,
dataType:'json',
contentType: false,
processData: false,
cache:false,
})
.done(function(data) {

if (data.response.code=='1') {
  console.log(data);
  $("#submit-all").html('Update Information');
                var notify = $.notify('<strong>Saving</strong> Do not close Vendor added success...', {
                    type: 'success',
                    allow_dismiss: false,
                    showProgressbar: true,
                    offset: {
                        x: 50,
                        y: 100
                    },
                });
                setTimeout(function() {
                    notify.update('message', '<strong>Redirecting</strong> for view vendor');
                    setTimeout(function() {
                        setTimeout(function() {
                            window.location.href = "view_vehicle_carwash.php";
                        }, 3000);
                    });
                }, 2000);
}
if (data.response.code=='0') {
      $("#submit-all").html('Update Information');
                $("#submit-all").removeAttr('disabled');
                $.notify(data.response.msg, {
                    offset: {
                        x: 50,
                        y: 100
                    },
                    type: 'warning'
                });
}
})
.fail(function(data) {
console.log(data);
 $("#submit-all").removeAttr('disabled');
            $.notify('Error: Please Contact Developer!', {
                offset: {
                    x: 50,
                    y: 100
                },
                type: 'warning'
            });
})

})