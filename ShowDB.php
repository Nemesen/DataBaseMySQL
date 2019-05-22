<?php
$servername = "localhost";
$username = "root";
$password = "tine";
$dbname = "Mariage";
//Pour verifier la database : http://localhost:8090/phpmyadmin

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

getAll($conn);

function getAll($conn) 
{
    $sql = "SELECT * FROM myguests";
    $result = $conn->query($sql);
    $nb = $result->num_rows;

    if ($nb > 0) {
        
        echo "<table><tr><th>ID</th><th>Name</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
        }
        echo "</table>";
    }
    else {
        echo "0 results";
    }
}

$conn->close();
?>