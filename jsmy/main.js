// contact_us page ajax

function send_message(){
    
    var name=jQuery("#name").val();
    var email=jQuery("#email").val();
    var mobile=jQuery("#mobile").val();
    var message=jQuery("#message").val();

    if(name=="")
    {
        alert("please enter your name");
    }else if(email=="")
    {
        alert("enter your email");
    }
    else if(mobile=="")
    {
        alert("enter your email please");
    }
    else if(message=="")
    {
        alert("enter your comment please!");
    }
    else
    {
        jQuery.ajax({

            url:'send_message.php',
            type:'post',
            data:'name='+name+'&email='+email+'&mobile='+mobile+'&message='+message,
            success:function(result){
                alert(result);
            }
        })
    }
}


// register page ajax

function user_register(){

    jQuery('.field_error').html('');

    var name=jQuery("#name").val();
    var email=jQuery("#email").val();
    var mobile=jQuery("#mobile").val();
    var password=jQuery("#password").val();
    var is_error='';


    if(name=="")
    {
        jQuery('#name_error').html('please enter your name');
        is_error='yes';
    }if(email=="")
    {
        jQuery('#email_error').html('please enter your email');
        is_error='yes';
    }if(mobile=="")
    {
        jQuery('#mobile_error').html('please enter your mobile');
        is_error='yes';
    }if(password=="")
    {
        jQuery('#password_error').html('please enter your password');
        is_error='yes';
    }
    
    
    

    if(is_error=='')
    {
        jQuery.ajax({

            url:'register_submit.php',
            type:'post',
            data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
            success:function(result){
                // alert(result);
                if(result=='present')
                {
                    jQuery('#email_error').html('Email id already Exist');
                }
                if(result=='insert')
                {
                    jQuery('.register_msg').html('Thank you for registration !');
                }
            }
        })
    }

}

// login page ajax

function user_login(){

    jQuery('.field_error').html('');

    
    var email=jQuery("#login_email").val();
    var password=jQuery("#login_password").val();
    var is_error='';


    if(email=="")
    {
        jQuery('#login_email_error').html('please enter your email');
        is_error='yes';
    }if(password=="")
    {
        jQuery('#login_password_error').html('please enter your password');
        is_error='yes';
    }
    
    
    

    if(is_error=='')
    {
        jQuery.ajax({

            url:'login_submit.php',
            type:'post',
            data:'email='+email+'&password='+password,
            success:function(result){
                // alert(result);
                if(result=='wrong')
                {
                    jQuery('.login_msg p').html('Please Enter valid Credentials');
                }
                if(result=='valid')
                {
                    window.location.href=window.location.href;
                }
            }
        })
    }

}


// add_to_cart ajax  line no 96 product.page // below code and this code is same them why type not pass from here

// function manage_cart(pid,type){

//         var qty=jQuery("#qty").val();

//     jQuery.ajax({
//         url:'manage_cart.php',
//         type:'post',
//         data:'pid='+pid+'&qty='+qty+'&type'+type,
//         success:function(result){
//             jQuery('.htc__qua').html(result);   
//         }
//     });
  
// }


function manage_cart(pid,type){
	
    if(type=='update')
    {
        var qty=jQuery("#"+pid+"qty").val();
    }
    else{
		var qty=jQuery("#qty").val();
    }
	
	jQuery.ajax({
		url:'manage_cart.php',
		type:'post',
		data:'pid='+pid+'&qty='+qty+'&type='+type,
		success:function(result){
            if(type=='update' || type=='remove')
            {
                window.location.href=window.location.href; //redirect on same page
            }
            if(result=='Not_available'){
                // alert('Qty Not available ');
                alert("Qty Not available !");
            }else{
                jQuery('.htc__qua').html(result);
            }
		}	
	});	
}


//////////////////////////////////////////////Search category dropdown///////////////////////////////////

function sort_product_drop(cat_id,site_path)
{
    var sort_product_id=jQuery('#sort_product_id').val();
    window.location.href=site_path+"categories.php?id="+cat_id+"&sort="+sort_product_id;

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////
