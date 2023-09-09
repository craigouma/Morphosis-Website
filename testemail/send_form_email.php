<?php 
// EDIT THE 2 LINES BELOW AS REQUIRED
/*function send_email($name,$email,$email_message)
{
  global $send_email_to;
  global $email_subject;
  //$headers = "MIME-Version: 1.0" . "\r\n";
  //$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  $headers = "From: ".$email. "\r\n";
  $message = "<strong>Email = </strong>".$email."<br>";
  $message .= "<strong>Name = </strong>".$name."<br>";  
  $message .= "<strong>Message = </strong>".$email_message."<br>";
  $sent = mail($send_email_to, $email_subject, $message,$headers);
  $message = "Line 1\r\nLine 2\r\nLine 3";

  // In case any of our lines are larger than 70 characters, we should use wordwrap()
 $message = wordwrap($message, 70, "\r\n");

  // Send
   mail('caffeinated@example.com', 'My Subject', $message);
  if($sent) echo "email sent";
  //return true;
}*/

/*function validate($name,$email,$message)
{
  $return_array = array();
  $return_array['success'] = '1';
  $return_array['name_msg'] = '';
  $return_array['email_msg'] = '';
  $return_array['message_msg'] = '';
  if($email == '')
  {
    $return_array['success'] = '0';
    $return_array['email_msg'] = 'Email is required';
  }
  else
  {
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp,$email)) {
      $return_array['success'] = '0';
      $return_array['email_msg'] = 'Enter valid email.';  
    }
  }
  if($name == '')
  {
    $return_array['success'] = '0';
    $return_array['name_msg'] = 'Name is required';
  }
  else
  {
    $string_exp = "/^[A-Za-z .'-]+$/";
    if (!preg_match($string_exp, $name)) {
      $return_array['success'] = '0';
      $return_array['name_msg'] = 'Enter valid name.';
    }
  }
		
  if($message == '')
  {
    $return_array['success'] = '0';
    $return_array['message_msg'] = 'Message is required';
  }
  else
  {
    if (strlen($message) < 2) {
      $return_array['success'] = '0';
      $return_array['message_msg'] = 'Enter valid message.';
    }
  }
  return $return_array;
}*/

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

include('Mail.php');
$mail = Mail::factory("mail");

$headers = array("From"=>$email, "Subject"=>"Test Mail");
$body = "This is a test!";
$mail->send("bennahkairu@gmail.com", $headers, $body);

// send_email($name,$email,$message);

//echo $name.$email.$message;
//$return_array = validate($name,$email,$message);

/*if($return_array['success'] == '1')
{
	send_email($name,$email,$message);
}*/

//header('Content-type: text/json');
//echo json_encode($return_array);
//die();
?>

