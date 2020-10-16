onkeyup="this.value=this.value.replace(/[^\a-zA-Z\s]{1,}/,'')"
onkeyup="this.value=this.value.replace(/[^\d]/,'')"

var formData = new FormData(this);

$(".send_btn").click(function(){
		$("#formdata").submit();
	});
    $(".send_btn").click(function(event) {
        var msg = $("#msg").val();
        if (msg != '') {
          $("#msgSubmit").submit();
        }else{
          swal("Oh Snap!", "Please Write Msg!", "warning");
        }
      });
return exit(json_encode(["response" => ["code" => $int, "msg" => $str]]));
setTimeout(function() {
    window.location = "signup-freelancer.php";
}, 2000);
style="display: <?php echo $editautoelectrician['vehicle_category'] == 'Yes' ? 'block' : 'none';?>;">