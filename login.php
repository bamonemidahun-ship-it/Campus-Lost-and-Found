<?php
include 'config/db.php';
include 'includes/header.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $result->fetch_assoc();

    if($user && password_verify($password,$user['password'])){

        $_SESSION['user'] = $user;

        if($user['role'] == 'admin'){
            header("Location: admin_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();

    } else {
        echo "<p>Invalid credentials!</p>";
    }
}
?>

<h3>Login</h3>
<form method="POST">
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Login</button>
</form>

<?php include 'includes/footer.php'; ?>