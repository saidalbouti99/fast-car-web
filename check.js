$(document).ready(function() {
                
    $("#formCheckPassword").validate({
    /* here we define the rules for the password and confirmpassword  input type field in the      
           html page.*/
           
rules: { 
               password: { 
                 required: true,
                    minlength: 6,
                    maxlength: 10,
               } , 
                   cfmPassword: { 
             required: true,
                     equalTo: "#password",
                     minlength: 6,
                     maxlength: 10
               }
           },
/* here we define the messages for the password and confirmpassword  in case the user does not fulfill the rules defined above.*/
     messages:{
         password: { 
                 required:"The password is required",
                 minlength: "Minimum 6 characters",
                 maxlength: "Maximum 10 characters"
               },
               cfmPassword: {
                   required: "Confirm password required",
                   equalTo: "Not equal",
                   minlength: "Minimum 6 characters",
                   maxlength: "Maximum 10 characters"
                   }
                },
        
                
        submitHandler: function(form) {
            form.submit();
        }
            
});
            
 });