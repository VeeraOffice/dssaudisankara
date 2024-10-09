<!-- Displaying Questions -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Questions</title>
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Quiz Questions</h2>

<table>
    <thead>
        <tr>
            <th>Question ID</th>
            <th>Question</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Database connection details
        $servername = "localhost";
        $username = "root";  // Adjust based on your MySQL credentials
        $password = "veera"; // Adjust based on your MySQL credentials
        $dbname = "demy";    // The database name

        // Create a connection to the MySQL database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check if the connection was successful
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to select all questions from the 'quiz_questions' table
        $sql = "SELECT id, question_text FROM quiz_questions"; // Select only the needed columns
        $result = $conn->query($sql);

        // Check if there are results
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td>" . $row['question_text'] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2' style='text-align:center;'>No questions found</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </tbody>
</table>

</body>
</html>
