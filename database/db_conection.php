<?php
$con=mysqli_init(); 
mysqli_ssl_set($con, NULL, NULL, {ca-cert filename}, NULL, NULL); 
mysqli_real_connect($con, "sundarphpwork.mysql.database.azure.com", "alagu123@sundarphpwork", {suntest123$}, {users}, 3306);

?>
