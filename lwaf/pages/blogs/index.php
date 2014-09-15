<?php $_metaPageTitle = 'Blogs'; ?>
<?php $this->staticInclude('header.php'); ?>
<div class="containment spaceheader">
    <div class="wrapper">
        <div class="title">
            <h1>Blogs</h1>
        </div>
        <div class="content">
            <p>View this amazing blog <?php echo '<a href="'.LWAF_PROTOCOL.LWAF_HOST.'/blogs/blog-view">(Here)</a>'; ?></p>
            <br />
            <p><?php echo '<a href="'.LWAF_PROTOCOL.LWAF_HOST.'/">(Main page)</a>'; ?></p>
        </div>
    </div>
</div>

<?php $this->staticInclude('footer.html'); ?>