<?php
$servername = "localhost";
$username = "root";
$password = "tine";
$dbname = "Mariage";
$tableName = "Guests";
//Pour verifier la database : http://localhost:8090/phpmyadmin

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
//createDatabase($dbname, $conn);
//createTable("$tableName", $conn);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$variables = array("famille", "prenom", "nom", "presence", "brunch", "voiture", "email");
newData($conn, $variables);

function createDatabase($dbname, $conn)
{
    $sql = "CREATE DATABASE $dbname";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
}
function createTable($nameTable, $conn)
{
    $sql = "CREATE TABLE $nameTable (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
    famille VARCHAR(30) NOT NULL,
    prenom VARCHAR(30) NOT NULL,
    nom VARCHAR(30) NOT NULL,
    presence VARCHAR(3) NOT NULL,
    brunch VARCHAR(3) NOT NULL,
    voiture VARCHAR(3), 
    email VARCHAR(50),
    reg_date TIMESTAMP
    )";
    
    if ($conn->query($sql) === TRUE) {
        echo "Table $nameTable created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}
function newData($conn, $variables)
{
    $varName = $variables[0];
    $infos = $_POST[$variables[0]];
    $infosStr = "'$infos'";
    for ($i = 1; $i < count($variables); $i++)
    {
        $varName .= ", " . $variables[$i];
        $infos = "";
        if (isset($_POST[$variables[$i]]))
        {
            $infos = $_POST[$variables[$i]];
        }
        else
        {
            $infos = "off";
        }
        $infosStr .= ", '$infos'";
    }
    //echo $varName . "<br>" . $infosStr;
    $sql = "INSERT INTO Guests ($varName)
    VALUES ($infosStr)";

    if ($conn->query($sql) === TRUE) {
        echo $_POST["prenom"] . " " . $_POST["nom"] . " a été rajouté à la base de donnée.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();
?>