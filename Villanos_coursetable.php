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
  <title>Course Table</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    body {
        position: relative;
        background-image: url("your-background-image.jpg"); /* Replace with your actual image file path */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #ffffff; /* Set text color to contrast with the background */
        margin: 0;
        padding: 0;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.5); /* Adjust the transparency here */
    }

    .container {
        position: relative;
        z-index: 1; /* Ensure the container stays on top of the overlay */
        margin-top: 50px;
    }

    .btn-custom {
        background-color: #dc3545;
        color: #ffffff;
        border-color: #dc3545;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #bd2130;
    }

    table {
        background-color: rgba(255, 255, 255, 0.9); /* Add a semi-transparent white background to the table */
        border-radius: 10px; /* Add border-radius for rounded corners */
    }

    th, td {
        border: 1px solid #dee2e6;
    }

    th {
        background-color: #007bff;
        color: #ffffff;
    }
  </style>
</head>
';
echo "<body>";

echo "<div class='container'>";

echo "<h2 class='text-center mb-4'>Course Table</h2>";

echo "<div class='d-flex justify-content-between mb-3'>";
echo "<a class='btn btn-custom' href='/lessons/student-table.php'>Student</a>";
echo "<a class='btn btn-custom' href='/lessons/course-table.php'>Course</a>";
echo "<a class='btn btn-custom' href='/lessons/instructor-table.php'>Instructor</a>";
echo "<a class='btn btn-custom' href='/lessons/enrollment-table.php'>Enrollment</a>";
echo "</div>";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ... (your existing PHP code)

echo "<form method='post' class='mb-3'>
        <div class='row'>
            <div class='col-md-3'>
                <input type='text' class='form-control' name='newCourseID' placeholder='Course ID'>
            </div>
            <div class='col-md-4'>
                <input type='text' class='form-control' name='newCourseName' placeholder='Course Name'>
            </div>
            <div class='col-md-3'>
                <input type='text' class='form-control' name='newCourseCredits' placeholder='Credits'>
            </div>
            <div class='col-md-2'>
                <button class='btn btn-custom' name='addCourse'>Add</button>
            </div>
        </div>
      </form>";

// ... (your existing PHP code)

echo "</div>";

echo '
<script>
    function editRow(courseID) {
        document.getElementById("row" + courseID).style.display = "none";
        document.getElementById("editForm" + courseID).style.display = "table-row";
    }
</script>
';

echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>';
echo "</body>";
echo "</html>";
?>
