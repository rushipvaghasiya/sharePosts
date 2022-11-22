<?php require APPROOT . "/app/views/inc/header.php" ?>

<h1 class="display-3">
    <?php echo $data['title'] ?>
</h1>
<p class="lead">
    <?php echo $data['description'] ?>
</p>
<p>
    <?php echo "App Version: " . "<strong>" . APPVERSION . "</strong>" ?>
</p>
<?php require APPROOT . "/app/views/inc/footer.php" ?>