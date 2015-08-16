<?php
$to = 'ben.white10@outlook.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: enquiries@arleneducation.com' . "\r\n" .
'Reply-To: enquiries@arleneducation.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>