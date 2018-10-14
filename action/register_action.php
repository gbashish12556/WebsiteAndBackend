<?php
$phone_no = "";
  if(loader_post_isset("phone_no")&&loader_post_isset("login_button"))
  {
     $phone_no = loader_get_post_escape("phone_no");
     loader_set_session('phone_no',$phone_no);
    if(""==$phone_no)
    {
      $error_message=MANDATORY_MISSING;
    }
    else
   {
     if(validate_phone_number($phone_no))
     {

       $query = "SELECT * FROM tbl_customer_info WHERE fld_mobile_no='".$phone_no."'";
       $result = loader_query($query);
       if(loader_num_rows($result)==0)
       {
         $error_message = "This Mobile number is not registered yet. Please register first";
       }
       else {

         loader_set_session('otp_session',rand(100000,999999));
         $otp ="6 digit OTP for verification is ".loader_get_session('otp_session');

         loader_send_sms($otp,$phone_no);


         echo '<script>
       $(document).ready(function(){

               $("#myModal").modal();
           });

       </script>';
       }

     }
     else
     {
       $error_message= MOBILE_INVALID;
     }
    }


  }

if(loader_post_isset("phone_no")&&loader_post_isset("register_button"))
  {

    $phone_no = loader_get_post_escape('phone_no');
    loader_set_session('phone_no',$phone_no);

    if(""==$phone_no)
    {
      $error_message=MANDATORY_MISSING;
    }
    else {
        if(validate_phone_number($phone_no))
        {

          $query = "SELECT * FROM tbl_customer_info WHERE fld_mobile_no='".$phone_no."'";
          $result = loader_query($query);
          if(loader_num_rows($result)>0)
          {
            $error_message = "This Mobile number is already registerd. Please login to continue.";
          }
          else
          {
            loader_set_session('otp_session',rand(100000,999999));
            $otp ="6 digit OTP for verification is ".loader_get_session('otp_session');
            loader_send_sms($otp,$phone_no);


            echo '<script>
          $(document).ready(function(){

                  $("#myModal").modal();
              });

          </script>';
          }

        }
        else {
          $error_message= MOBILE_INVALID;
        }


    }

  }

  $otp= "";
  if(loader_post_isset('register_otp'))
  {
  $otp = loader_get_post_escape('register_otp');
    if($otp==loader_get_session('otp_session'))
    {
      echo '<script>
              $(document).ready(function(){

                    $("#detailsModal").modal();
                    });

          </script>';
    }
    else {

      echo "<script>alert('incorrect otp');</script>";

    }
  }

  if(loader_post_isset('login_otp'))
  {
  $otp = loader_get_post_escape('login_otp');
    if($otp==loader_get_session('otp_session'))
    {
      $phone_no = loader_get_session('phone_no');
      $query = "SELECT * FROM tbl_customer_info WHERE fld_mobile_no='".$phone_no."'";
      $result = loader_query($query);
      $row = loader_fetch_assoc($result);
      $customer_name = $row['fld_name'];
      $user_token=$row['fld_user_token'];
      loader_set_session('username',$customer_name);
      loader_set_session('user_token',$user_token);
      echo '<script>window.location.assign("index.php");</script>';
    }
    else {

      echo "<script>alert('incorrect otp');</script>";

    }
  }

  $customer_name=$customer_email=$customer_address = "";
  if(loader_post_isset('customer_email')&&loader_post_isset('customer_name')&&loader_post_isset('customer_address')&&loader_post_isset('details_button'))
  {
    $customer_email = loader_get_post_escape('customer_email');
    $customer_name = loader_get_post_escape('customer_name');
    $customer_address = loader_get_post_escape('customer_address');
    $phone_no = loader_get_session('phone_no');
    $query = "INSERT INTO tbl_customer_info(fld_email,fld_name,fld_postal_address,fld_mobile_no) VALUES('".$customer_email."','".$customer_name."','".$customer_address."','".$phone_no."')";
    if($result = loader_query($query))
    {
      $last_inserted_id = loader_last_inserted();
      $user_token = loader_hash($last_inserted_id);
      $query3 = "UPDATE tbl_customer_info SET fld_user_token = '".$user_token."' WHERE fld_customer_ai_id = '".$last_inserted_id."' ";
      if(loader_query($query3))
      {
      loader_set_session('username',$customer_name);
      loader_set_session('email',$customer_email);
      loader_set_session('user_token',$user_token);
      }

    echo '<script>window.location.assign("index.php");</script>';
    }
  }
?>
