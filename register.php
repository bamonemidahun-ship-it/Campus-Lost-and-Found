<?php
include 'config/db.php';
include 'includes/header.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')";
    if($conn->query($sql)) {
        echo "Registered Successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<h3>Register</h3>
<form method="POST">
<input type="text" name="name" placeholder="Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit">Register</button>
</form>

<?php include 'includes/footer.php'; ?>