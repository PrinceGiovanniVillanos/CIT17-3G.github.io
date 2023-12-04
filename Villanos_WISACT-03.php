<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Villanos CRUD Operations with HTML Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        form {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            display: inline-block;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentinfo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $idToUpdate = $_POST["update_id"];
    $newUsername = $_POST["new_username"];
    $newEmail = $_POST["new_email"];

    $updateSql = "UPDATE users SET username='$newUsername', email='$newEmail' WHERE id=$idToUpdate";

    if ($conn->query($updateSql) === TRUE) {
        echo "<p style='color: green;'>Record updated successfully</p>";
    } else {
        echo "<p style='color: red;'>Error updating record: " . $conn->error . "</p>";
    }
}

// Handle Insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];

    $insertSql = "INSERT INTO users (username, email) VALUES ('$username', '$email')";

    if ($conn->query($insertSql) === TRUE) {
        echo "<p style='color: green;'>Record created successfully</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $insertSql . "<br>" . $conn->error . "</p>";
    }
}

// Display Records
$sql = "SELECT id, username, email FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Table Content:</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Actions</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>
                <form method='post' action='" . $_SERVER["PHP_SELF"] . "'>
                    <input type='hidden' name='update_id' value='" . $row["id"] . "'>
                    <label for='new_username'>New Username:</label>
                    <input type='text' name='new_username' required>
                    <label for='new_email'>New Email:</label>
                    <input type='email' name='new_email' required>
                    <input type='submit' name='update' value='Update'>
                </form>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No records found</p>";
}

$conn->close();
?>

<h2>Create a new record:</h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>
