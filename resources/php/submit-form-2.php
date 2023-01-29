<?php
if($_POST["Email"]) {
mail("jiterewa@gmail.com", "Here is the sample subject line",
$_POST["Message"]. "From: jane@janedoe.com");
}
?>
