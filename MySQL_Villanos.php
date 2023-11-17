<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentrecord";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";

$sql = "SELECT * FROM student";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Process the results
    while ($row = $result->fetch_assoc()) {
        echo "StudentID: " . $row["StudentID"] . "<br>" . 
        "Name: " . $row["FirstName"]. " " . $row["LastName"]. "<br>" . 
        " - DateofBirth: " . $row["DateOfBirth"]. "<br>" . 
         " - Email: " . $row["Email"]. "<br>" . 
         " - Phone: " . $row["Phone"]. "<br>";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?> 

