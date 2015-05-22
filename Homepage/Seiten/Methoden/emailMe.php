<?php
function sendEmailToken($empfaenger,$betreff,$Token){
$from = "From: Pascals Hairstyle <Pascals.Hairstyle@gmail.com>\n";
$from .= "Content-Type: text/html\n";
$text = "Ihr Token:".$Token;

mail($empfaenger, $betreff, $text, $from);
}
?>