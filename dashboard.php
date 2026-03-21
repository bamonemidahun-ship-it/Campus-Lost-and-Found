<?php
include 'config/db.php';
include 'includes/header.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<h3>Welcome, <?php echo $_SESSION['user']['name']; ?> 👋</h3>

<form method="GET">
<input type="text" name="search" placeholder="Search by title or location">
<button type="submit">Search</button>
</form>

<a href="report_lost.php" class="btn">Report Lost</a>
<a href="report_found.php" class="btn">Report Found</a>

<div class="dashboard-grid">

<?php

if(isset($_GET['search'])){
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM items 
            WHERE status='open'
            AND (title LIKE '%$search%' 
            OR location LIKE '%$search%')
            ORDER BY created_at DESC";
} else {
    $sql = "SELECT * FROM items 
            WHERE status='open'
            ORDER BY created_at DESC";
}

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>
<div class="card">
    <img src="<?php echo $row['image']; ?>" width="100%" height="200" style="object-fit:cover;border-radius:8px;">
    <h4><?php echo $row['title']; ?></h4>
    <p><?php echo substr($row['description'],0,60); ?>...</p>
    <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
    <a href="view_item.php?id=<?php echo $row['id']; ?>" class="btn">View Details</a>
</div>
<?php } ?>

</div>

<?php include 'includes/footer.php'; ?>