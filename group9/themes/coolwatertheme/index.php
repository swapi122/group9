<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php 
	$config = array(
	"reset-fonts-grids"=>true,
	"include-common-css"=>true,
	"include-theme-css"=>true
	);
	echo exponent_theme_headerInfo($section,$config); 
	?>
	
</head>

<body>
<?php exponent_theme_sourceSelectorInfo(); //this will be deprecated by copy 'n paste in beta ?>
<div id="outer">
	<div id="wrapper">
		<div id="nav">
		  <div id="nav-left">
		    <div id="nav-right">
    			<ul>
    			  <li><a href="<?php echo exponent_core_makeLink(array('section'=>SITE_DEFAULT_SECTION)); ?>">ABOUT US</a></li>
    			  <li><a href="<?php echo exponent_core_makeLink(array('section'=>SITE_DEFAULT_SECTION)); ?>">PRODUCTS</a></li>
    			  <li><a href="<?php echo exponent_core_makeLink(array('section'=>SITE_DEFAULT_SECTION)); ?>">SERVICES</a></li>
    			  <li><a href="<?php echo exponent_core_makeLink(array('section'=>SITE_DEFAULT_SECTION)); ?>">SHOPPING CART</a></li>
    			  <li><a href="<?php echo exponent_core_makeLink(array('section'=>SITE_DEFAULT_SECTION)); ?>">NEW GADGETS</a></li>
    			  <li><a href="<?php echo exponent_core_makeLink(array('section'=>SITE_DEFAULT_SECTION)); ?>">REGISTER</a></li>
    			</ul>
		    </div>
		  </div>
			<div class="clear"></div>
		</div>
		<div id="head">
			<div id="head-left"></div>
			<div id="head-right"></div>
			<div id="head-1"></div>
			<h1><span class="logo"><span class="top">top</span><span class="gadgets">gadgets</span></span></h1>
			<div id="navb">
			  <ul>
				  <li><a href="<?php echo exponent_core_makeLink(array('section'=>SITE_DEFAULT_SECTION)); ?>">HOME</a></li>
				  <li><a href="<?php echo exponent_core_makeLink(array('section'=>SITE_DEFAULT_SECTION)); ?>">CONTACT</a></li>
				</ul>
			</div>
		</div>
		<div id="head-2"></div>
		<div id="login">
			<div id="login-bot">
				<div id="login-box">
					<?php exponent_theme_showModule("loginmodule","Expanded"); ?>
				</div>
				<div id="login-welcome">
					<div>
						<h2>Welcome</h2>
						<p>Don't forget to check <a href="<?php echo URL_FULL; ?>">Liberty Electric</a> every day, because we add  new products almost daily.</p>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div id="body">
			<div id="body-bot">
					<h2></h2><?php exponent_theme_showModule("navigationmodule","Breadcrumb","","@top"); ?></h2>
					<div id="items">
						<?php exponent_theme_main(); ?>
						<div class="clear"></div>
					</div>
					<?php exponent_theme_showModule("textmodule","Default","","barner"); ?>
					<div id="footer">
						<div id="footloose"><span class="logo"><span class="top">top</span><span class="gadgets">gadgets</span></span></div>
						<p><a href="http://www.freewebsitetemplates.com">Privacy Policy</a> <strong>&nbsp;:&nbsp;</strong> <a href="http://www.freewebsitetemplates.com">Terms &amp; Conditions</a> <br />
						&copy; Copyright 2007. All rights reserved.</p>
					</div>					
			</div>
		</div>
	</div>
</div>

</body>
</html>
