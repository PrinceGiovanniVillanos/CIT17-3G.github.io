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
  <title>Enrollment Management System</title>
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
  </style>
</head>
';
echo "<body>";

echo "<div class='container'>";

echo "<a class='btn btn-primary m-2' href='/lessons/student-table.php'>Student</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/course-table.php'>Course</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/instructor-table.php'>Instructor</a>";
echo "<a class='btn btn-primary m-2' href='/lessons/enrollment-table.php'>Enrollment</a>";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selectEnrollment = "SELECT * FROM enrollment";
$enrollmentResults = $conn->query($selectEnrollment);

if ($enrollmentResults) {

    echo "
    <table class='table'>
    <tr>
        <th>Enrollment ID</th>
        <th>Student ID</th>
        <th>Course ID</th>
        <th>Enrollment Date</th>
        <th>Grade</th>
        <th></th>
        <th></th>
    </tr>";

    while ($row = $enrollmentResults->fetch_assoc()) {
        // ... your existing code for displaying rows ...

        echo "
        <tr id='editForm{$row["EnrollmentID"]}' style='display: none;'>
            <form method='post'>
                <td> <input type='text' name='updateEnrollmentID' value='{$row["EnrollmentID"]}' readonly></td>
                <td> <input type='text' name='updateStudentID' value='{$row["StudentID"]}'></td>
                <td> <input type='text' name='updateCourseID' value='{$row["CourseID"]}'></td>
                <td> <input type='text' name='updateEnrollmentDate' value='{$row["EnrollmentDate"]}'></td>
                <td> <input type='text' name='updateGrade' value='{$row["Grade"]}'></td>
                <td> <button class='btn btn-success' name='updateEnrollment'>Update</button> </td>
            </form>
            <td></td>
        </tr>";
    }

    echo "
    <tr>
        <form method='post'>
            <td> <input type='text' name='newEnrollmentID' placeholder='Enrollment ID'></td>
            <td> <input type='text' name='newStudentID' placeholder='Student ID'></td>
            <td> <input type='text' name='newCourseID' placeholder='Course ID'></td>
            <td> <input type='text' name='newEnrollmentDate' placeholder='Enrollment Date'></td>
            <td> <input type='text' name='newGrade' placeholder='Grade'></td>
            <td> <button class='btn btn-primary' name='addEnrollment'>Add</button> </td>
        </form>
    </tr>";

    echo "</table>";
} else {
    echo "Error: " . $selectEnrollment . "<br>" . $conn->error;
}

echo '
<script>
    function editRow(enrollmentID) {
        document.getElementById("row" + enrollmentID).style.display = "none";
        document.getElementById("editForm" + enrollmentID).style.display = "table-row";
    }
</script>
';

echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>';

echo "</div>"; // Close the container div

echo "</body>";
echo "</html>";
?>

