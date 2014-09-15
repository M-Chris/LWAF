<?php $this->staticInclude('header.html'); ?>

<div class="containment spaceheader">
    <div class="wrapper">
        <div class="title">
            <h1>LWAF - Light Weight Application Framework</h1>
        </div>
        <div class="content">
            <p>LWAF is the most light weight framwork ever, using traditional OOP PHP to create amazing applications.</p>
            <p>It allows fast proccessing with an intuitive platform to create just about anything you could want.</p>
            <p>View a plain text test page <?php echo '<a href="'.$this->getHost().'/test">(Click here)</a>'; ?></p>
            <p>View a json test page <?php echo '<a href="'.$this->getHost().'/test-json">(Click here)</a>'; ?></p>
            <p>View a page test / example <?php echo '<a href="'.$this->getHost().'/page-test">(Click here)</a>'; ?></p>
            <p>View a folder example <?php echo '<a href="'.$this->getHost().'/blogs">(Click here)</a>'; ?></p>
            <p>
			<?php 
				$param = $this->getParam('param'); 
				if(empty($param)){
					echo '<a href="'.$this->getHost().'/param_'.urlencode('this is what param equals in the url').'">View a url parameter</a>';
				}else{
					echo '<b>URL parameter:</b> (param) '.$param.' <a href="'.$this->getHost().'/">Remove</a>';
				}
			?>
			</p>
            <p><b>PHP function call:</b> <?php echo some_function(); ?></p>
            <p>Your time starts now.</p>
        </div>
    </div>
</div>

<?php $this->staticInclude('footer.html'); ?>