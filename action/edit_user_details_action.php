<?php
$phone_no =loader_get_session('phone_no');
$post_phone_no=$post_customer_name=$post_customer_email=$post_customer_address="";
if(loader_post_isset('customer_name')&&loader_post_isset('customer_email')&&loader_post_isset('phone_no')&&loader_post_isset('customer_address'))
{
    $post_customer_name = loader_get_post_escape('customer_name');
    $post_customer_email = loader_get_post_escape('customer_email');
    $post_customer_address = loader_get_post_escape('customer_address');
    $post_phone_no = loader_get_post_escape('phone_no');
    $session = loader_get_post_escape('session');
  	//echo 'session'.$session;
  	//echo 'form_session'.loader_get_session('form_session');
  	if($session == loader_get_session('form_session'))
  	{
  		if(("" == $post_customer_name)||("" == $post_customer_email)||("" == $post_customer_address)||("" == $post_phone_no))
  		{
  			$error_message = MANDATORY_MISSING;
  		}
      else {
        $query2 = "UPDATE tbl_customer_info SET fld_email = '".$post_customer_email."', fld_name = '".$post_customer_name."', fld_postal_address = '".$post_customer_address."',fld_mobile_no = '".$post_phone_no."'  WHERE fld_mobile_no ='".$phone_no."' ";
              if(loader_query($query2))
              {
                  loader_set_session('username',$post_customer_name);
                  loader_set_session('phone_no',$post_phone_no);
                  loader_set_session('email',$post_customer_email);
                  echo '<script>alert("update success");</script>';
                header("location:index.php");

              }
              else {
                $error_message = SERVER_ERROR;
              }
      }
    }

}
?>
