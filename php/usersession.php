<?php
	session_start();
	if(isset($_SESSION['userid'])) {
	  echo $_SESSION['username'];
	} else {
		session_destroy();
	}
?>