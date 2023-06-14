<!DOCTYPE html>
<html>
<head>
    <title>Add/Edit Student</title>
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

        form {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 16px;
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #cccccc;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4caf50;
            color: #ffffff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
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

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the form data
            $id = isset($_POST["id"]) ? $_POST["id"] : null;
            $name = $_POST["name"];
            $age = $_POST["age"];

            if (!empty($id)) {
                // Update existing student
                $sql = "UPDATE students SET name = ?, age = ? WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sii", $name, $age, $id);
                $action = "updated";
            } else {
                // Insert new student
                $sql = "INSERT INTO students (name, age) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $name, $age);
                $action = "added";
            }

            if ($stmt->execute()) {
                echo "<p>Student $action successfully!</p>";
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }

            // Close the statement
            $stmt->close();
        }

        // Check if an ID parameter is passed to edit an existing student
        if (isset($_GET["id"])) {
            $id = $_GET["id"];

            // Retrieve the student information from the database
            $sql = "SELECT * FROM students WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $student = $result->fetch_assoc();

            // Close the statement
            $stmt->close();
        }
        ?>

        <h1><?php echo isset($student) ? "Edit Student" : "Add Student"; ?></h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <?php if (isset($student)): ?>
                <input type="hidden" name="id" value="<?php echo $student["id"]; ?>">
            <?php endif; ?>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo isset($student) ? $student["name"] : ""; ?>" required>
            <br><br>
            <label for="age">Age:</label>
            <input type="number" name="age" id="age" value="<?php echo isset($student) ? $student["age"] : ""; ?>" required>
            <br><br>
            <div class="button-container">
                <input type="submit" value="<?php echo isset($student) ? "Update Student" : "Add Student"; ?>">
                <a href="listing.php">Back to Listing</a>
            </div>
        </div>
        </form>
    </div>
</body>
</html>
