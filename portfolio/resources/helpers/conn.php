<?php
// Connect to Database
$db = $config['db'];

$con = mysqli_connect($db['server'], $db['user'], $db['pass'])
or die ("Could not connect to server ... \n" . mysqli_error ());

mysqli_select_db($con, $db['db'])
or die ("Could not connect to database ... \n" . mysqli_error ());
?>
