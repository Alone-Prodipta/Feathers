<?php
session_start();

// 1. DATABASE CONNECTION
$servername = getenv('DB_HOST');
$username   = getenv('DB_USER');
$password   = getenv('DB_PASS');
$dbname     = getenv('DB_NAME');
$port       = 18078; // Add this specific port from your Aiven screen

// Update this line to include $port at the end
$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. PHP LOGIC FOR LOGIN & SIGNUP
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    // --- SIGN UP LOGIC ---
    if ($action == "signup") {
        $u = $_POST['reg_user'];
        $e = $_POST['reg_email'];
        $p = $_POST['reg_psw'];
        
        $sql = "INSERT INTO users (username, email, password) VALUES ('$u', '$e', '$p')";
        if ($conn->query($sql)) {
            echo "<script>alert('Account created! Now please Log in.');</script>";
        } else {
            echo "<script>alert('Error: Username might already exist');</script>";
        }
    }

    // --- LOGIN LOGIC ---
    if ($action == "login") {
        $u = $_POST['login_user'];
        $p = $_POST['login_psw'];
        
        $sql = "SELECT * FROM users WHERE username='$u' AND password='$p'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['user'] = $u;
             echo "<script>alert('Welcome $u!'); window.location.href='home.html';</script>";
        } else {
            echo "<script>alert('Invalid Username or Password');</script>";
        }
    }
}
?>