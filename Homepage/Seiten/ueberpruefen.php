<?php

$name = "test";
$pw = "test";


if ($_GET["username"] == $name && $_GET["password"] == $pw)
echo "<meta http-equiv='refresh' content='0; URL=Verwaltungsmain.php'>";
else
echo "<meta http-equiv='refresh' content='0; URL=index.php'>";


?>