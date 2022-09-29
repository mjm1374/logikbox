<h2 class="homeH2" tabindex="0">Latest Projects</h2>
<h3 tabindex="0"><?php echo $lastest->name ?></h3>
<img src="img/<?php echo $lastest->bigimg ?>" class="homeProject" alt="<?php echo $lastest->name ?>">
<span tabindex="0">
    <?php echo $lastest->description ?>
</span>
<?php
if ($lastest->active == 1) {
?>
    <a class="btn btn-default" href="<?php echo $lastest->link ?>" role="button" aria-label="Go see my <?php echo $lastest->name ?> project">See it &raquo; </a>
<?php
}
?>