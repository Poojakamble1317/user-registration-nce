// $().ready(function() {
    // validate the comment form when it is submitted
    $("#commentForm").validate();

    // validate signup form on keyup and submit
    $("#registration-form").validate({
        rules: {
            firstname: {
                required: true,
                minlength: 2,
                lettersonly:true
            },
            password: {
                required: true,
                minlength: 5
            },
            conpassword: {
                required: true,
                minlength: 5,
                equalTo: "#exampleInputPassword"
            },
            email: {
                required: true,
                email: true
            },
            phoneno: {
                required: true,
                minlength: 10,
                number:true
            },
            userpicture:{
                required:true,
            },
            userpicture: { required: true, 
                extension: "png|jpe?g|gif", 
                filesize: 1048576  
            }
        },
        messages: {
            firstname: {
                required:"Please enter your firstname",
                lettersonly:"Please provide proper name",
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            conpassword: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            },
            email: "Please enter a valid email address",
            phoneno: {
                required:"Please enter a valid mobile number",
                minlength:"Mobile number should be of 10 digit",
                number: "Add Only numbers",
            },
            userpicture:"File must be JPG, GIF or PNG, less than 1MB"
        },
        submitHandler: function(form){
            var formData = $('#registration-form').serialize();
            console.log(data);
            $.ajax({
                url: 'php/registration.php',
                type: 'POST',
                data: formData,
                success: function (data) {
                    alert(data)
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });

    $.validator.addMethod('filesize', function(value, element, param) {
        // param = size (in bytes) 
        // element = element to validate (<input>)
        // value = value of the element (file name)
        return this.optional(element) || (element.files[0].size <= param) 
    });

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
      }, "Letters only please"); 

    // propose username by combining first- and lastname
    $("#username").focus(function() {
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        if (firstname && lastname && !this.value) {
            this.value = firstname + "." + lastname;
        }
    });

    // //code to hide topic selection, disable for demo
    // var newsletter = $("#newsletter");
    // // newsletter topics are optional, hide at first
    // var inital = newsletter.is(":checked");
    // var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
    // var topicInputs = topics.find("input").attr("disabled", !inital);
    // // show when newsletter is checked
    // newsletter.click(function() {
    //     topics[this.checked ? "removeClass" : "addClass"]("gray");
    //     topicInputs.attr("disabled", !this.checked);
    // });
// });