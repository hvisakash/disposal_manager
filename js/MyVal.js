//custom validation rule - text only
//validation for login functionallity
$(document).ready(function() 
{
      //alert(generators_url);
      $("#login").validate({
            rules:
            {
                  email:
                  {
                  required:true,
                  },
                  password :"required",
           },
            messages:
            {
                  email:
                  {
                  required:"Plese Enter Email address or User name",	
                  },
                  password :" Enter Password",
            }
      });

      // validation for popup value

      //validation for password match
      $.validator.addMethod("passMatch", 
            function(value, element) {
                return /^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(value);
            }, 
            "Password must be 8-digit alphanumeric, containing at least one capital letter, one number and one symbol."
       );
      //validation for EPA Code
      $.validator.addMethod("epa",function(value, element) {
            if($("#epa").val().length == 7)
            {
                 return /^[a-zA-Z\s]+$/.test(value);
            }
            else if ($("#epa").val().length == 12) {
                 return /^(?=.*?[a-z])(?=.*?\d)[a-z\d]+$/.test(value);
                  
            }
            },
            "EPA must be 7-digit Alphabetical or 12-digit alphanumeric."
            );
      //validation for generator or Vendors new account generate 
      $("#generators_form").validate
      ({
            
            rules:
            {
                  "companyname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                  
                  "firstname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                    "lastname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  }, 
                  email:
                  {
                  required:true,
                  },
                  password :{
                  required:true,
                  passMatch:true
                  },
                  cpassword:{
                  equalTo: "#password"
                  },
                  "address1":{
                  required:true,
                  minlength:2,
                  maxlength:40
                  
                  },  
                  "city":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                  "state":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },
                  "zipcode":{
                  number:true,
                  minlength:5,
                  maxlength:9
                  },  
                  "epa_id":{
                  required: true,
                  epa:true
                  },
                  "contact":{
                  required: true,     
                  number: true,
                  minlength:10,
                  maxlength:10
                  },
                  
                  "fax":{
                  
                  required: true,     
                  number: true,
                  minlength:10,
                  maxlength:10
                  }                 
            },
            messages:
            {
                  companyname:{
                        required: "Please provide a Company Name",
                        minlength: "Your Company Name must be at least 2 characters long",
                        maxlength: "Your Company Name must be at least less than or equal to 40"
                  },
                  firstname:{
                        required: "Please provide a First Name",
                        minlength: "Your First Name must be at least 2 characters long",
                        maxlength: "Your First Name must be at least less than or equal to 40"
                  },
                    
                  lastname:{
                        required: "Please provide a Last Name",
                        minlength: "Your Last Name must be at least 2 characters long",
                        maxlength: "Your Last Name must be at least less than or equal to 40"
                  },
                  password :{
                  required:" Enter Password",
                  pattern:"Incorrect pattern"
                  },
                  cpassword :" Enter Confirm Password Same as Password",
                  zipcode:{
                  number: "Please use numbers",
                  maxlength:"Zip Code should be 5 - 9 digits"
                  },
                  address1:{
                        required: "Please provide Address1",
                        minlength: "Your Address1 must be at least 2 characters long",
                        maxlength: "Your address1 must be at least less than or equal to 40"
                        
                  },
                  city:{
                        required: "Please provide City",
                        minlength: "Your City must be at least 2 characters long",
                        maxlength: "Your City Name must be at least less than or equal to 40"
                  },
                  state:{
                        required: "Please provide State",
                        minlength: "Your State must be at least 2 characters long",
                        maxlength: "Your State Name must be at least less than or equal to 40"
                  },
                  epa_id:{
                  required: "Please provide EPA ID Number"
                        
                  },
                  contact:{
                        required: "Please provide Phone Number",      
                        number: "Plese provide Number only"
                  },
                  fax:{
                        required: "Please provide Fax Number",
                        number:     "Plese provide Number only",
                        
                  }
            },

            submitHandler: function (form) {    
            var formData = $("#generators_form").serialize();
            $.ajax({
                type: "POST",
               url: generators_url,
                data: formData,
                dataType: 'json',
                  success: function(data)
                  {
                      if (data.email=="false") {
                              alert("The email address you have entered already exists.  Enter a different email address or try resetting your password.");
                      }
                      else{
                        //$('#show tr:last').after('<tr><td>'+data.account_no+'</td><td><a class="btn btn-success" role="button" href="#">Edit</a></td><td><a href="#link7" id="'+data.id+'" value="'+data.id+'" class="suspend btn btn-success" role="button" data-toggle="modal"  data-toggle="modal" >Running</a></td><a href="#rejoin" role="button" data-toggle="modal" class= "btn btn-success suspend" data-toggle="modal"></a></td></tr>');
                        $( ".close" ).trigger( "click" );
                        $('#generators_form')[0].reset();
                        location.reload();
                      }
                  }
                });
             return false; // required to block normal submit since you used ajax
            }
      });
      //Validation for email End With disposalmanager.com
      $.validator.addMethod("test", 
            function(value, element) {
                return /^([\w-\.]+@(?=disposalmanager.com)([\w-]+\.)+[\w-]{2,4})?$/.test(value);
            }, 
            "Only Email Ended with disposalmanager.com"
      );
        
      //add new administrator 
      $("#admin_form").validate
      ({
            
            rules:
            {
                  "companyname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                  
                  "firstname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                    "lastname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  }, 
                  email:
                  {
                  required:true,
                  test:true
                  },
                  password :{
                  required:true,
                  passMatch:true
                  },
                  cpassword:{
                  equalTo: "#password"
                  },
                  "address1":{
                  required:true,
                  minlength:2,
                  maxlength:40
                  
                  },  
                  "city":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                  "state":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },
                  "zipcode":{
                  number:true,
                  minlength:5,
                  maxlength:9
                  },  
                  "epa_id":{
                  required: true,
                  epa:true
                  },
                  "contact":{
                  required: true,     
                  number: true,
                  minlength:10,
                  maxlength:10
                  },
                  
                  "fax":{
                  required: true,     
                  number: true,
                  minlength:10,
                  maxlength:10
                  }                 
            },
            messages:
            {
                  companyname:{
                        required: "Please provide a Company Name",
                        minlength: "Your Company Name must be at least 2 characters long",
                        maxlength: "Your Company Name must be at least less than or equal to 40"
                  },
                  firstname:{
                        required: "Please provide a First Name",
                        minlength: "Your First Name must be at least 2 characters long",
                        maxlength: "Your First Name must be at least less than or equal to 40"
                  },
                    
                  lastname:{
                        required: "Please provide a Last Name",
                        minlength: "Your Last Name must be at least 2 characters long",
                        maxlength: "Your Last Name must be at least less than or equal to 40"
                  },
                  password :{
                  required:" Enter Password",
                  pattern:"Incorrect pattern"
                  },
                  cpassword :" Enter Confirm Password Same as Password",
                  zipcode:{
                  number: "Please use numbers",
                  maxlength:"Zip Code should be 5 - 9 digits"
                  },
                  address1:{
                        required: "Please provide Address1",
                        minlength: "Your Address1 must be at least 2 characters long",
                        maxlength: "Your address1 must be at least less than or equal to 40"
                        
                  },
                  city:{
                        required: "Please provide City",
                        minlength: "Your City must be at least 2 characters long",
                        maxlength: "Your City Name must be at least less than or equal to 40"
                  },
                  state:{
                        required: "Please provide State",
                        minlength: "Your State must be at least 2 characters long",
                        maxlength: "Your State Name must be at least less than or equal to 40"
                  },
                  epa_id:{
                  required: "Please provide EPA ID Number"
                        
                  },
                  contact:{
                        required: "Please provide Phone Number",      
                        number: "Plese provide Number only"
                  },
                  fax:{
                        required: "Please provide Fax Number",
                        number:     "Plese provide Number only",
                        
                  }
            },

            submitHandler: function (form) {    
            var formData = $("#admin_form").serialize();
            $.ajax({
                type: "POST",
                url: "ajaxcalling.php",
                data: formData,
                dataType: 'json',
                  success: function(data)
                  {
                      if (data.email=="false") {
                              alert("The email address you have entered already exists.  Enter a different email address or try resetting your password.");
                      }
                      else{
                        //$('#show tr:last').after('<tr><td>'+data.account_no+'</td><td><a class="btn btn-success" role="button" href="#">Edit</a></td><td><a href="#link7" id="'+data.id+'" value="'+data.id+'" class="suspend btn btn-success" role="button" data-toggle="modal"  data-toggle="modal" >Running</a></td><a href="#rejoin" role="button" data-toggle="modal" class= "btn btn-success suspend" data-toggle="modal"></a></td></tr>');
                        $( ".close" ).trigger( "click" );
                        $('#admin_form')[0].reset();
                        location.reload();
                      }
                  }
                });
             return false; // required to block normal submit since you used ajax
            }
      });
      
      // Registeration(new user) validation
      $(".Register").validate
      ({
            rules:
            {
                  "companyname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                    "department":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },
                  "firstname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                    "lastname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  }, 
                  email:
                  {
                  required:true,
                  },
                  password :{
                  required:true,
                  passMatch:true
                  },
                  cpassword:{
                  equalTo: "#password"
                  },
                  "address1":{
                  required:true,
                  minlength:2,
                  maxlength:40
                  
                  },  
                  "address2":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },
                  "city":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                  "state":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },
                  "zipcode":{
                  number:true,
                  minlength:5,
                  maxlength:9
                  },  
                  "epa_id":{
                  required: true,
                  epa:true
                  },
                  "contact":{
                  required: true,     
                  number: true,
                  minlength:10,
                  maxlength:10
                  },
                  "fax":{
                  required: true,     
                  number: true,
                  minlength:10,
                  maxlength:10
                  }                 
            },
            messages:
            {
                  companyname:{
                        required: "Please provide a Company Name",
                        minlength: "Your Company Name must be at least 2 characters long",
                        maxlength: "Your Company Name must be at least less than or equal to 40"
                  },
                  department:{
                        required: "Please provide a Department Name",
                        minlength: "Your Department Name must be at least 2 characters long",
                        maxlength: "Your Department Name must be at least less than or equal to 40"
                  },
                  firstname:{
                        required: "Please provide a First Name",
                        minlength: "Your First Name must be at least 2 characters long",
                        maxlength: "Your First Name must be at least less than or equal to 40"
                  },
                    
                  lastname:{
                        required: "Please provide a Last Name",
                        minlength: "Your Last Name must be at least 2 characters long",
                        maxlength: "Your Last Name must be at least less than or equal to 40"
                  },
                  password :{
                  required:" Enter Password",
                  pattern:"Incorrect pattern"
                  },
                  cpassword :" Enter Confirm Password Same as Password",
                  zipcode:{
                  number: "Please use numbers",
                  maxlength:"Zip Code should be 5 - 9 digits"
                  },
                  address1:{
                        required: "Please provide Address1",
                        minlength: "Your Address1 must be at least 2 characters long",
                        maxlength: "Your address1 must be at least less than or equal to 40"
                        
                  },
                  address2:{
                        required: "Please provide Address2",
                        minlength: "Your Address2 must be at least 2 characters long",
                        maxlength: "Your address2 must be at least less than or equal to 40"
                  },
                  city:{
                        required: "Please provide City",
                        minlength: "Your City must be at least 2 characters long",
                        maxlength: "Your City Name must be at least less than or equal to 40"
                  },
                  state:{
                        required: "Please provide State",
                        minlength: "Your State must be at least 2 characters long",
                        maxlength: "Your State Name must be at least less than or equal to 40"
                  },
                  epa_id:{
                  required: "Please provide EPA ID Number"
                        
                  },
                  contact:{
                        required: "Please provide Phone Number",      
                        number: "Plese provide Number only"
                  },
                  fax:{
                        required: "Please provide Fax Number",
                        number:     "Plese provide Number only",
                        
                  }
            }
      });      

      // Add New sites validation
      $("#new_sites").validate
      ({
            rules:
            {
                  "sitename":{
                  required: true,     
                  minlength:2,
                  maxlength:100
                  },
                  "companyname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                  "firstname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                    "lastname":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  }, 
                  email:
                  {
                  required:true,
                  },
                  password :{
                  required:true,
                  passMatch:true
                  },
                  cpassword:{
                  equalTo: "#password"
                  },
                  "address1":{
                  required:true,
                  minlength:2,
                  maxlength:40
                  
                  },
                  "city":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },  
                  "state":{
                  required: true,     
                  minlength:2,
                  maxlength:40
                  },
                  "zipcode":{
                  number:true,
                  minlength:5,
                  maxlength:9
                  },  
                  "epa_id":{
                  required: true,
                  epa:true
                  },
                  "contact":{
                  required: true,     
                  number: true,
                  minlength:10,
                  maxlength:10
                  },
                  
                  "fax":{
                  
                  required: true,     
                  number: true,
                  minlength:10,
                  maxlength:10
                  }                 
            },
            messages:
            {
                  sitename:{
                        required: "Please provide a New Site",
                        minlength: "Your New Site Name must be at least 2 characters long",
                        maxlength: "Your New Site Name must be at least less than or equal to 40"
                  },
                  companyname:{
                        required: "Please provide a Company Name",
                        minlength: "Your Company Name must be at least 2 characters long",
                        maxlength: "Your Company Name must be at least less than or equal to 40"
                  },
                  firstname:{
                        required: "Please provide a First Name",
                        minlength: "Your First Name must be at least 2 characters long",
                        maxlength: "Your First Name must be at least less than or equal to 40"
                  },
                    
                  lastname:{
                        required: "Please provide a Last Name",
                        minlength: "Your Last Name must be at least 2 characters long",
                        maxlength: "Your Last Name must be at least less than or equal to 40"
                  },
                  password :{
                  required:" Enter Password",
                  pattern:"Incorrect pattern"
                  },
                  cpassword :" Enter Confirm Password Same As Password",
                  zipcode:{
                  number: "Please use numbers",
                  maxlength:"Zip Code should be 5 - 9 digits"
                  },
                  address1:{
                        required: "Please provide Address1",
                        minlength: "Your Address1 must be at least 2 characters long",
                        maxlength: "Your address1 must be at least less than or equal to 40"
                        
                  },
                  city:{
                        required: "Please provide City",
                        minlength: "Your City must be at least 2 characters long",
                        maxlength: "Your City Name must be at least less than or equal to 40"
                  },
                  state:{
                        required: "Please provide State",
                        minlength: "Your State must be at least 2 characters long",
                        maxlength: "Your State Name must be at least less than or equal to 40"
                  },
                  epa_id:{
                  required: "Please provide EPA ID Number"
                        
                  },
                  contact:{
                        required: "Please provide Phone Number",      
                        number: "Plese provide Number only"
                  },
                  fax:{
                        required: "Please provide Fax Number",
                        number:     "Plese provide Number only",
                        
                  }
            }
      });      

      $("#reset_password").validate
      ({
            rules:
            {
                  new_password :{
                  required:true,
                  passMatch:true
                  },
                  confirm_password:{
                  equalTo: "#password"
                  }
                                
            },
            messages:
            {
                  new_password :{
                  required:" Enter Password",
                  pattern:"Incorrect pattern"
                  },
                  confirm_password :" Enter Confirm Password Same as Password"
            }
      });
      $(".ChangePassword").validate
      ({
            rules:
            {
                  password :{
                  required:true,
                  },
                  npassword :{
                  required:true,
                  passMatch:true
                  },
                  cpassword:{
                  equalTo: "#npassword"
                  }
                                
            },
            messages:
            {
                  password :{
                  required:" Enter Old Password",
                  },
                  new_password :{
                  required:" Enter Password",
                  pattern:"Incorrect pattern"
                  },
                  confirm_password :" Enter Confirm Password Same as Password"
            }
      });
});
