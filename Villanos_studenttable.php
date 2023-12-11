<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "villanos_studentinformation";

$conn = new mysqli($servername, $username, $password, $dbName);

echo "<html>";
echo '
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    body {
      background-color: black;
      color: white;
    }
    .btn-primary, .btn-success, .btn-danger {
      background-color: violet;
      border-color: violet;
      box-shadow: 2px 2px 5px darkviolet;
    }
    .btn-primary:hover, .btn-success:hover, .btn-danger:hover {
      background-color: darkviolet;
      border-color: darkviolet;
    }
  </style>
</head>
';
echo "<body>";

echo "<a class='btn btn-primary m-2' href='/lessons/student-table.php'>Student</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/course-table.php'>Course</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/instructor-table.php'>Instructor</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/enrollment-table.php'>Enrollment</a>";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "
<table class='table'>
    <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Date of Birth</th>
        <th>Email</th>
        <th>Phone</th>
        <th></th>
        <th></th>
    </tr>";

// ... (Your existing PHP code)

echo "
    <tr>
        <td> <input type='text' name='newStudentID' placeholder='Student ID'></td>
        <td> <input type='text' name='newStudentFirstName' placeholder='First Name'></td>
        <td> <input type='text' name='newStudentLastName' placeholder='Last Name'></td>
        <td> <input type='text' name='newStudentDateOfBirth' placeholder='Date of Birth'></td>
        <td> <input type='text' name='newStudentEmail' placeholder='Email'></td>
        <td> <input type='text' name='newStudentPhone' placeholder='Phone'></td>
        <td> <button class='btn btn-primary' name='addStudent'>Add</button> </td>
    </tr>";

echo "</table>";

// ... (Your existing PHP code)

echo '
</body>
</html>';
?>
