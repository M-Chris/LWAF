<?php $this->staticInclude('header.php',array('_metaPageTitle'=>'This is a page Test')); ?>
<div class="containment spaceheader">
    <div class="wrapper">
        <div class="title">
            <h1>(Test Page) LWAF</h1>
        </div>
        <div class="content">
            <p>This is just a test page to show the syntax for a page using the - [dash] ([underscores] _'s are reserved for parameters).</p>
            <br />
            <p>This page also que's a php header which triggers the use of custom meta titles</p>
            <br />
            <p><?php echo '<a href="'.$this->getHost().'/">(Main page)</a>'; ?></p>
        </div>
    </div>
</div>

<?php $this->staticInclude('footer.html'); ?>