<?php
$host = "sql206.infinityfree.com"; 
$user = "if0_41907840";
$pass = "1PwMWAiitxQv8y"; // Your FTP/Account password
$db   = "if0_41907840_fasion";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. PHP LOGIC FOR LOGIN & SIGNUP
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $action = $_POST['action'];

    // --- SIGN UP LOGIC ---
    if ($action == "signin") {
        $u = $_POST['reg_user'];
        $e = $_POST['reg_email'];
        $p = $_POST['reg_psw'];
        
        $sql = "INSERT INTO users (username, email, password) VALUES ('$u', '$e', '$p')";
        if ($conn->query($sql)) {
           echo "<script>alert('Welcome $u!'); window.location.href='home.php';</script>";
        } else {
            echo "<script>alert('Error: Username might already exist');</script>";
        }
    }

    // --- LOGIN LOGIC ---
    if ($action == "login") {
        $login_input = trim($_POST['login_user'] ?? '');
        $p = $_POST['login_psw'] ?? '';

        $login_input = mysqli_real_escape_string($conn, $login_input);
        $p = mysqli_real_escape_string($conn, $p);

        $sql = "SELECT * FROM users WHERE (username='$login_input' OR email='$login_input') AND password='$p'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user'] = $user['username'];
            echo "<script>alert('Welcome " . addslashes($user['username']) . "!'); window.location.href='home.php';</script>";
        } else {
            echo "<script>alert('Invalid Username or Password');</script>";
        }
    }
}
?>