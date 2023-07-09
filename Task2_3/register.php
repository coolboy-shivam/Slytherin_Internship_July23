<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users1";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT mail FROM users WHERE mail = '$mail'";
    $checkEmailResult = $conn->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
        echo "Email already exists. Please try a different email.";
        header("Locaton: loginUnsuccessful.html");
    } else {
        // Prepare and bind the statement to insert data into the database
        $stmt = $conn->prepare("INSERT INTO users (name, phone, mail, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $phone, $mail, $password);

        if ($stmt->execute()) {
            echo "Registered successfully!<br>";
            header("Location: loginSuccessful.html");
        } else {
            echo "Registration failed. Please try again.";
            header("Locaton: loginUnsuccessful.html");

            $stmt->close();
        }
    }
}

$conn->close();

?>