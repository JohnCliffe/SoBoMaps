<?php
	$servername = "localhost";
    $username = "000334810";
    $password = "19940705";
    $database = "000334810";
    // Create connection
    ob_start();
    $conn = new mysqli($servername, $username, $password, $database);
    ob_end_clean();
    if ($conn->connect_error) {
        echo "db ERROR";
        exit();
    }
    session_start();
	
	$friends = array();
    $userid = $_SESSION['userid'];
	
    ob_start();
	$sql = $conn->prepare("SELECT u.userName, u.userId FROM Friends f " .
		   "JOIN User u ON f.userId = u.userId " .
           "WHERE f.userfriendid = ? " . 
		   "AND f.acceptedStatus = 0 ;");
	$sql->bind_param("i", $userid);
	$sql->execute();
	$result = $sql->get_result();
	ob_end_clean();
	
    if ( $result === false ) {
        echo "sql ERROR";
    } else {
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $friendData = array($row['userName'], $row['userId']);
                array_push($friends, $friendData);
            }
            echo json_encode($friends);
        }
        else{
            echo json_encode($friends);
        }
    }
    mysqli_close($conn);
?>