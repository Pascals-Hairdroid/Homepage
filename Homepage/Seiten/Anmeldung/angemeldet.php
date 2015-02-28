<br><table border='0' class='gruss'>
<?php
echo "<tr><td>hallo ".$_SESSION['username']."</tr></td>";
?>
<form action='Anmeldung/endSession.php'>
<tr>
<td><input type='submit' value='Log-Out' class='logout'></td>
</tr>
</form>
</table>