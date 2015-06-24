<?php
function sendEmailToken($empfaenger,$betreff,$Token){
$from = "From: Pascals Hairstyle <Pascals.Hairstyle@gmail.com>\n";
$from .= "Content-Type: text/html\n";
$text = "Klicken Sie bitte auf diesen Link:\n";
$text .= "<a href='www.pascals.at/v2/Seiten/passwortAendern.php?tok=".$Token."&e=".$empfaenger."'>Passwort zur&uuml;cksetzen</a>";

mail($empfaenger, $betreff, $text, $from);
}

function sendEmailNotification($empfaenger,$betreff,$text,$file){
	$from = "From: Pascals Hairstyle <Pascals.Hairstyle@gmail.com>\n";
	$from .= "Content-Type: text/html\n";
	$text .= "<br><img src='".$file."'>";

	mail($empfaenger, $betreff, $text, $from);
}
?>