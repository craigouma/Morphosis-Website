<?php
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])){
    $to = "craigcarlos95@gmail.com"; // Change to your recipient email address
    $subject = "New Comment";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    if(mail($to, $subject, $body)){
        echo "Message sent successfully.";
    } else {
        echo "Sorry, there was an error sending your message. Please try again later.";
    }
}
?>
