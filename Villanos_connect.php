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
  <title>Student Information System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      margin-top: 50px;
    }
    .table {
      background-color: #ffffff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    th, td {
      text-align: center;
    }
    .edit-form {
      background-color: #f1f1f1;
      padding: 10px;
      margin-top: 10px;
    }
  </style>
</head>
';
echo "<body>";

echo "<div class='container'>";
echo "<h2 class='text-center mb-4'>Student Information System</h2>";

echo "<a class='btn btn-primary m-2' href='/lessons/student-table.php'>Student</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/course-table.php'>Course</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/instructor-table.php'>Instructor</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/enrollment-table.php'>Enrollment</a>";

// ... (Your existing PHP code)

echo "<table class='table'>";
echo "<thead class='thead-dark'>";
echo "<tr>";
echo "<th>Student ID</th>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th>Date of Birth</th>";
echo "<th>Email</th>";
echo "<th>Phone</th>";
echo "<th></th>";
echo "<th></th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

while ($row = $studentResults->fetch_assoc()) {
    echo "
    <tr id='row{$row["StudentID"]}'>
        <td>{$row["StudentID"]}</td>
        <td>{$row["FirstName"]}</td>
        <td>{$row["LastName"]}</td>
        <td>{$row["DateOfBirth"]}</td>
        <td>{$row["Email"]}</td>
        <td>{$row["Phone"]}</td>
        <td> <button class='btn btn-warning' onclick='editRow({$row["StudentID"]})'>Edit</button> </td>
        <td> 
            <form method='post'>
                <input type='hidden' name='deleteStudentID' value='{$row["StudentID"]}'>
                <button class='btn btn-danger' name='deleteStudent'>Delete</button> 
            </form>
        </td>
    </tr>
    <tr id='editForm{$row["StudentID"]}' style='display: none;'>
        <form method='post'>
            <td> <input type='text' class='form-control' name='updateStudentID' value='{$row["StudentID"]}' readonly></td>
            <td> <input type='text' class='form-control' name='updateFirstName' value='{$row["FirstName"]}'></td>
            <td> <input type='text' class='form-control' name='updateLastName' value='{$row["LastName"]}'></td>
            <td> <input type='text' class='form-control' name='updateDateOfBirth' value='{$row["DateOfBirth"]}'></td>
            <td> <input type='text' class='form-control' name='updateEmail' value='{$row["Email"]}'></td>
            <td> <input type='text' class='form-control' name='updatePhone' value='{$row["Phone"]}'></td>
            <td> <button class='btn btn-success' name='updateStudent'>Update</button> </td>
        </form>
        <td></td>
    </tr>";
}

echo "</tbody>";
echo "</table>";

// ... (Your existing PHP code)

echo '</div>'; // Closing container div

echo '
<script>
    function editRow(studentID) {
        document.getElementById("row" + studentID).style.display = "none";
        document.getElementById("editForm" + studentID).style.display = "table-row";
    }
</script>
';

echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>';
echo "</body>";
echo "</html>";
