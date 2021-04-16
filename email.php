<?php

//     $error = '';
//     $name = '';
//     $email = '';
//     $subject = '';
//     $message = '';
//     function clean_text($string){
//         $string = trim($string);
//         $string = stripslashes($string);
//         $string = htmlspecialchars($string);
//         return $string;
//     }


// if(isset($_POST['submit'])){
//   if(empty($_POST['name'])){
//       $error .= '<p><label class="text-danger">Пожалуйста, введите Ваше имя</label></p>';
//   }else{
//       $name = clean_text($_POST['name']);
//       if(!preg_match("/^[a-zA-z ]*$/",$name)){
//         $error .= '<p><label class="text-danger">Недопустимые символы</label></p>';
//       }
//   }

//   if(empty($_POST['email'])){
//     $error .= '<p><label class="text-danger">Пожалуйста, введите Ваше имя</label></p>';
//   }else{
//     $email = clean_text($_POST['email']);
//     if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
//       $error .= '<p><label class="text-danger">Неправильный формат e-mail</label></p>';
//     }
//   } 

//   if(empty($_POST['message'])){
//     $error .= '<p><label class="text-danger">Пожалуйста, введите Ваше сообщение</label></p>';
//   }else{
//     $message = clean_text($_POST['message']);
//   }
// }
//   echo $error;
//   if($error != ''){
//     $email_from = "romaniv.roma2013@gmail.com"; // your email
//     $mail_subject = "Problem from $name";
//     $email_body = "You have receive a new message from the user $name.\n".
//     "email: $user_email\n".
//     "Details:\n$message";
//     $to = "romaniv.roma2013@gmail.com";
//     $headers = "From: $user_email\r\n";
//     $headers .= 'MIME-Version: 1.0' . "\r\n";
//     $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
//     mail($to,$mail_subject,$email_body,$headers);
//     echo '<script>alert("The email is sent successfully")</script>';

//     if($mail->Send()){
//       $error = '<label class="text-success">Спасибо за вашу обратную связь</label>';
//     }else{
//       $error = '<label class="text-danger">Возникла ошибка :(</label>';
//     }
//     $name = '';
//     $email = '';
//     $subject = '';
//     $message = '';
//   }
if(!isset($_POST['submit'])){
    echo "Error, please submit a form\n";
}
$name = $_POST['name'];
$user_email = $_POST['email'];
$message = $_POST['message'];

if(empty($name) || empty($user_email)){
    echo "Please, enter your name and email\n";
}
$email_from = "romaniv.roma2013@gmail.com"; // your email
$mail_subject = "Problem from $name";
$email_body = "You have receive a new message from the user $name.\n".
"email: $user_email\n".
"Details:\n$message";
$to = "romaniv.roma2013@gmail.com";
$headers = "From: $email_from\r\n";
$headers .= "Organization: Sender Organization\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
$headers .= "X-Priority: 3\r\n";
$headers .= "X-Mailer: PHP". phpversion() ."\r\n";
mail($to,$mail_subject,$email_body,$headers);
// mail( '380989724811@vtext.com', '', 'Testing' );
$message = "This is a reminder about the ";
$requestParams = array(
    'user' => '**********',
    'pass' => '**********',
    'sender' => '*******',
    'phone' => trim(json_encode("380989724811", JSON_NUMERIC_CHECK),'[]'),
    'text' => $message,
    'priority' => 'ndnd',
    'stype' => 'normal'
);
$apiUrl = "http://bhashsms.com/api/sendmsg.php?";
foreach($requestParams as $key => $val){
    $apiUrl .= $key.'='.urlencode($val).'&';
}

$apiUrl = rtrim($apiUrl, "&");
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close($ch);
$return = json_encode($result);
echo "<script> alert('Sms is sent')</script>";
?>