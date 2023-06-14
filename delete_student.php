<!DOCTYPE html>
<html>
<head>
    <title>Delete Student</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
        }

        .button-container a {
            display: inline-block;
            margin-right: 10px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4caf50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Include the connection file
        require_once "connection.php";

        // Check if the ID parameter is provided
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            // Prepare and execute the SQL query to delete the student
            $sql = "DELETE FROM students WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                echo "<p>Student deleted successfully!</p>";
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }

            // Close the statement
            $stmt->close();
        }
        ?>

        <h1>Delete Student</h1>
        <p>Are you sure you want to delete this student?</p>
        <div class="button-container">
            <a href="listing.php">Back to Listing</a>
            <a href="delete_student.php?id=<?php echo $_GET["id"]; ?>">Delete</a>
        </div>
    </div>
</body>
</html>
