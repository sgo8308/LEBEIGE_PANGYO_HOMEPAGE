<?php
include_once '../etc/dbConnection.php';
// Include the database configuration file
global $clothesDbConnection;
$db= $clothesDbConnection;

// Get image data from database
$result = $db->query("SELECT mainImage FROM Clothes ORDER BY uploaded DESC");
?>


<?php if($result->num_rows > 0){ ?>
    <div class="gallery">
        <?php while($row = $result->fetch_assoc()){ ?>

            <img class="clothesItemChilds" style="width: 304px; height: 402px" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" />
        <?php } ?>
    </div>
<?php }else{ ?>
    <p class="status error">Image(s) not found...</p>
<?php } ?>