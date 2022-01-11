<?php
$host = "lrgs.ftsm.ukm.my"; /* Host name */
$user = "a167552"; /* User */
$password = "hugepurpledonkey"; /* Password */
$dbname = "a167552"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}