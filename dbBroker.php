<?php $serverName = "localhost"; $userName = "root"; $password = "";
$baza = mysqli_connect($serverName, $userName, $password);
mysqli_select_db($baza, "bioskop");
?>