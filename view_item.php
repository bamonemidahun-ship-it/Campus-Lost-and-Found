<?php
include 'config/db.php';
include 'includes/header.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM items WHERE id='$id'");
$item = $result->fetch_assoc();
?>

<div class="card">
    <img src="<?php echo $item['image']; ?>" width="100%" style="border-radius:8px;">
    <h2><?php echo $item['title']; ?></h2>
    <p><?php echo $item['description']; ?></p>
    <p><strong>Location:</strong> <?php echo $item['location']; ?></p>
    <p><strong>Type:</strong> <?php echo strtoupper($item['type']); ?></p>

<?php if($item['type']=='found' && $item['status']=='open'){ ?>
    <a href="claim_item.php?id=<?php echo $item['id']; ?>" class="btn">Claim Item</a>
<?php } ?>

</div>

<?php include 'includes/footer.php'; ?>