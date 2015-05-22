<?php
function sendEmailToken($empfaenger,$betreff,$Token){
$from = "From: Pascals Hairstyle <Pascals.Hairstyle@gmail.com>\n";
$from .= "Content-Type: text/html\n";
$text = "Klicken Sie bitte auf diesen Link:\n";
$text .= "www.pascals.at/v2/seiten/forgotPassword.php?tok=".$Token."&e=".$empfaenger;

mail($empfaenger, $betreff, $text, $from);
}
?>