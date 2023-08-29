<?php
    // getDoctors.php
    $host = "localhost:3306";
    $user = "root";
    $pass = "ishan@1999";
    $db = "doc+";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $department = $_POST['department'];

    $sql = "SELECT * FROM doctors WHERE department = '$department'";
    $result = $conn->query($sql);

    $doctors = array();
    while($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }

    echo json_encode($doctors);
?>