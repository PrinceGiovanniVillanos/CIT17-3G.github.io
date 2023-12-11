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
      background-color: #f8f9fa;
    }
    .container {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
      padding: 20px;
      border-radius: 10px;
      background-color: white;
    }
    .btn-primary {
      background-color: #dc3545;
      border-color: #dc3545;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }
    .btn-primary:hover {
      background-color: #c82333;
      border-color: #c82333;
    }
    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }
    .btn-success:hover {
      background-color: #218838;
      border-color: #218838;
    }
    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }
    .btn-danger:hover {
      background-color: #c82333;
      border-color: #c82333;
    }
    table {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    th {
      background-color: #000;
      color: white;
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

if (isset($_POST['addInstructor'])) {
    $newInstructorID = $_POST['newInstructorID'];
    $newInstructorFirstName = $_POST['newInstructorFirstName'];
    $newInstructorLastName = $_POST['newInstructorLastName'];
    $newInstructorEmail = $_POST['newInstructorEmail'];
    $newInstructorPhone = $_POST['newInstructorPhone'];

    $insertInstructor = "INSERT INTO instructor (InstructorID, FirstName, LastName, Email, Phone)
                         VALUES ('$newInstructorID', '$newInstructorFirstName', '$newInstructorLastName', '$newInstructorEmail', '$newInstructorPhone')";

    if ($conn->query($insertInstructor) === TRUE) {
        echo "New instructor record created successfully";
    } else {
        echo "Error: " . $insertInstructor . "<br>" . $conn->error;
    }
}

// ... (rest of your PHP code)

echo '
<form method="post">
    <table class="table">
        <thead>
            <tr>
                <th>Instructor ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
';

$selectInstructor = "SELECT * FROM instructor";
$instructorResults = $conn->query($selectInstructor);

if ($instructorResults) {

    while ($row = $instructorResults->fetch_assoc()) {
        echo "
        <tr id='row{$row["InstructorID"]}'>
            <td>" . $row["InstructorID"] . "</td>
            <td>" . $row["FirstName"] . "</td>
            <td>" . $row["LastName"] . "</td>
            <td>" . $row["Email"] . "</td>
            <td>" . $row["Phone"] . "</td>
            <td> <button class='btn btn-primary' onclick='editRow({$row["InstructorID"]})'>Edit</button> </td>
            <td> 
                <form method='post'>
                    <input type='hidden' name='deleteInstructorID' value='{$row["InstructorID"]}'>
                    <button class='btn btn-danger' name='deleteInstructor'>Delete</button> 
                </form>
            </td>
        </tr>
        <tr id='editForm{$row["InstructorID"]}' style='display: none;'>
            <form method='post'>
                <td> <input type='text' name='updateInstructorID' value='{$row["InstructorID"]}' readonly></td>
                <td> <input type='text' name='updateInstructorFirstName' value='{$row["FirstName"]}'></td>
                <td> <input type='text' name='updateInstructorLastName' value='{$row["LastName"]}'></td>
                <td> <input type='text' name='updateInstructorEmail' value='{$row["Email"]}'></td>
                <td> <input type='text' name='updateInstructorPhone' value='{$row["Phone"]}'></td>
                <td> <button class='btn btn-success' name='updateInstructor'>Update</button> </td>
            </form>
            <td></td>
        </tr>";
    }

    echo "
        <tr>
            <td> <input type='text' name='newInstructorID' placeholder='Instructor ID'></td>
            <td> <input type='text' name='newInstructorFirstName' placeholder='First Name'></td>
            <td> <input type='text' name='newInstructorLastName' placeholder='Last Name'></td>
            <td> <input type='text' name='newInstructorEmail' placeholder='Email'></td>
            <td> <input type='text' name='newInstructorPhone' placeholder='Phone'></td>
            <td> <button class='btn btn-primary' name='addInstructor'>Add</button> </td>
        </tr>";

    echo "</tbody></table></form>";
} else {
    echo "Error: " . $selectInstructor . "<br>" . $conn->error;
}

echo '
<script>
    function editRow(instructorID) {
        document.getElementById("row" + instructorID).style.display = "none";
        document.getElementById("editForm" + instructorID).style.display = "table-row";
    }
</script>
';

echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>';
echo "</body>";
echo "</html>";
?>
