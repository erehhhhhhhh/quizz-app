<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "demo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $question = $_POST['question'];
    $options = array($_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option4']);
    $correctAnswer = $_POST['correctAnswer'] - 1; // Subtract 1 to match array index

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO products (question, option1, option2, option3, option4, correct_answer) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $question, $options[0], $options[1], $options[2], $options[3], $correctAnswer);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
    $response = array('message' => 'Question added successfully');
    } else {
    $response = array('message' => 'Failed to add question');
    }

    $stmt->close();
    $conn->close();

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    ?>