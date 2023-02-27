<?php

error_reporting(0);

$DBHOST = "skubotics.in";
$DBUSER = "skubotic_rojgaar";
$DBNAME = "skubotic_rojgaar";
$DBPASSWORD = "bhDDi^n1&pY!";

$com = mysqli_connect("$DBHOST", "$DBUSER", "$DBPASSWORD", "$DBNAME");
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
