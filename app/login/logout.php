<?php  
session_start();
session_unset();
session_destroy();
header("location: index.html"); //redirect to the index page
exit();

?>