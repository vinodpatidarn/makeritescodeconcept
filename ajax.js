$(document).ready(function(){

    $("#formData").submit(function(e){
   e.preventDefault();   
   
   var formData = new FormData(this);
   
         $.ajax({
           url :'login_from.php',
           type :'POST',
             data : formData,
             cache: false,
             dataType: 'json',
             contentType: false,
             processData: false,
            
 
               success:function(data){
                
                if(data.response.code == '1')
               {
                   $.toast({
              heading: 'Success',
              text: data.response.msg,
                showHideTransition: 'slide',
                icon: 'success',
                showHideTransition: 'fade',
                hideAfter: 3000,
              position: 'top-right',
                loaderBg: '#9EC600'
         });   
                    setTimeout(function() {
                             window.location.href = "admin_login.php";
                         }, 3000);             
                }
                if(data.response.code == '0')
               {
                   $.toast({
             heading: 'Warning',
             text: data.response.msg,
               showHideTransition: 'slide',
               icon: 'warning',
               showHideTransition: 'fade',
               hideAfter: 3000,
             position: 'top-right',
               loaderBg: '#9EC600'
         });             }
 
            },
 
             error:function(data) {
                 console.log("error");
                 console.log(data);
             }
         });
     });
 
   });
 