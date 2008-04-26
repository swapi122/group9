<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php 
	$config = array(
	"reset-fonts-grids"=>false,
	"include-common-css"=>true,
	"include-theme-css"=>true
	);
	echo exponent_theme_headerInfo($section,$config); 
	?>
</head>
<body>
<?php exponent_theme_sourceSelectorInfo(); //this will be deprecated by copy 'n paste in beta ?>
<!-- wrap starts here -->
<div id="wrap">
	<!--header -->
	<div id="header">			
		<h1 id="logo-text"><a href="<?php echo URL_FULL; ?>index.php">LE<span class="green"> Website</span> <sup>Liberty Electronics</sup></a></h1>		
		<p id="slogan">Sự hài lòng của quí khách là thành công của chúng tôi</p>		
		<div id="header-links">
			<a href="<?php echo exponent_core_makeLink(array('section'=>SITE_DEFAULT_SECTION)); ?>">Trang chủ</a> | 
			<a href="<?php echo exponent_core_makeLink(array('section'=>16)); ?>">Liên hệ</a> | 
			<a href="<?php echo exponent_core_makeLink(array('section'=>10)); ?>">Bản đồ</a>
		</div>
		<div id="header-login">
			<?php exponent_theme_showModule("loginmodule","Expanded"); ?>
		</div>
	</div>
	<!-- navigation -->
	<div  id="menu">
		<?php exponent_theme_showModule("navigationmodule","YUI Top Nav","","@top"); ?>
	</div>
	<!-- content-wrap starts here -->
	<div id="content-wrap">
		
		<div id="main">
			<?php exponent_theme_main(); ?>
		</div>
		<div id="sidebar">
			<?php exponent_theme_showModule("containermodule","Default","","@left"); ?>			
		</div>
	<!-- content-wrap ends here -->	
	</div>
	<!--footer starts here-->
	<div id="footer">
		<?php exponent_theme_showModule("containermodule","Default","","@footer"); ?>				
	</div>	


</div>

</body>
</html>
