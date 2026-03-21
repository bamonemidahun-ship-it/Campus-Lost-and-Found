<?php
include 'config/db.php';
include 'includes/header.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $loc = $_POST['location'];
    $uid = $_SESSION['user']['id'];
    $type = 'lost';

    $imageName = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];

    $uploadPath = "uploads/" . time() . "_" . $imageName;
    move_uploaded_file($tempName, $uploadPath);

    $conn->query("INSERT INTO items(user_id,type,title,description,location,image)
    VALUES('$uid','$type','$title','$desc','$loc','$uploadPath')");

    echo "<p>Item Reported Successfully!</p>";
}
?>

<h3>Report Lost Item</h3>

<form method="POST" enctype="multipart/form-data">
<input type="text" name="title" placeholder="Item Title" required>
<textarea name="description" placeholder="Description" required></textarea>
<input type="text" name="location" placeholder="Location" required>
<input type="file" name="image" accept="image/*" required>
<button type="submit">Submit</button>
</form>

<?php include 'includes/footer.php'; ?>