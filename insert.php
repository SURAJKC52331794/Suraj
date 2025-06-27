<?php
// Database credentials
$servername = "localhost";  // Change if the server is different
$username = "root";         // Default username for MySQL
$password = "";             // Default password for MySQL
$dbname = "registration_form"; // Change to your database name

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted using POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize it
    $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $register_number = mysqli_real_escape_string($conn, $_POST['register_number']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    // Validate that none of the fields are empty
    if (empty($student_name) || empty($register_number) || empty($gender) || empty($dob) || empty($state) || empty($course)) {
        echo "All fields are required!";
    } else {
        // SQL query to insert data into the 'users' table
        $sql = "INSERT INTO users (student_name, register_number, gender, date_of_birth, state, course)
                VALUES ('$student_name', '$register_number', '$gender', '$dob', '$state', '$course')";

        // Execute the query and check for success
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>