<?php
// Include the connection file
include('connection.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize quiz ID
    $quiz_id = mysqli_real_escape_string($connection, $_POST['quiz_id']);
    
    // Retrieve questions, options, and correct answers from the form
    $questions = $_POST['question'];
    $options = $_POST['options'];
    $correct_answers = $_POST['correct_answer'];

    // Prepare the SQL query to insert questions into the database
    $insert_question_query = "INSERT INTO quiz_questions (quiz_id, question_text, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connection, $insert_question_query);

    if ($stmt === false) {
        echo "<script>
                alert('Error preparing the statement: " . mysqli_error($connection) . "');
                window.location.href = 'quiz_list.php';
              </script>";
        exit;
    }

    // Bind parameters and execute the statement for each question
    foreach ($questions as $index => $question) {
        // Store options and correct answer in variables
        $option1 = $options[$index]['option1'];
        $option2 = $options[$index]['option2'];
        $option3 = $options[$index]['option3'];
        $option4 = $options[$index]['option4'];
        $correct_option = (int)$correct_answers[$index]; // Ensure the correct answer is an integer

        // Bind the parameters to the SQL statement
        mysqli_stmt_bind_param($stmt, 'issssss', 
            $quiz_id, 
            $question, 
            $option1, 
            $option2, 
            $option3, 
            $option4, 
            $correct_option
        );

        // Execute the statement and check for errors
        if (!mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Error executing the query for question " . ($index + 1) . ": " . mysqli_stmt_error($stmt) . "');
                    window.location.href = 'quiz_list.php';
                  </script>";
            exit;
        }
    }

    // Close the statement and the connection
    mysqli_stmt_close($stmt);
    mysqli_close($connection);

    // Redirect with success message
    echo "<script>
            alert('Questions have been successfully added.');
            window.location.href = 'quiz_list.php';
          </script>";
} else {
    // If the request method is not POST, display an invalid request message
    echo "<p>Invalid request method.</p>";
}
?>
