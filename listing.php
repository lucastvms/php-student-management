<!DOCTYPE html>
<html>
<head>
    <title>Student Listing</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #cccccc;
        }

        .action-icons {
            display: flex;
            justify-content: center;
        }

        .action-icons a {
            margin-right: 5px;
            text-decoration: none;
            color: #333333;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Student Listing</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the connection file
                require_once "connection.php";

                // Retrieve the list of students from the database
                $sql = "SELECT * FROM students";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["age"] . "</td>";
                        echo "<td class='action-icons'>";
                        echo "<a href='add_edit_student.php?id=" . $row["id"] . "' title='Edit'><i class='fas fa-edit'></i></a>";
                        echo "<a href='delete_student.php?id=" . $row["id"] . "' title='Delete'><i class='fas fa-trash-alt'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No students found.</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="action-icons">
            <a href="add_edit_student.php" title="Add New Student"><i class="fas fa-plus"></i> Add Student</a>
        </div>
    </div>
</body>

</html>
