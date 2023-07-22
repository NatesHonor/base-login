<?php
session_start();

require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $db_username, $db_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($password, $db_password)) {
        $_SESSION['user_id'] = $user_id;
        echo "Login successful!";
    } else {
        echo "Invalid credentials.";
    }
}
?>
