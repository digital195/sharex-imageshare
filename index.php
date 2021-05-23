<?php
	define('DEBUG', false);
	define('READONLY', true);
	define('VERSION', '0.0.6');

	if (DEBUG) {
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	} else {
		ini_set('display_errors', 0);
		ini_set('display_startup_errors', 0);
	}

	include_once('dependencies/dependencies.php');

	Config::init();

	$image = ViewerController::findImage();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<base href="/">
		<title><?php echo Config::getTitle(); ?> - ImageShare</title>
		<link rel="icon" href="static/favicon.ico" />

		<style>
			:root {
				--bgColor: <?php echo Config::getBackgroundColors()[0]; ?>;
				--bgColor2: <?php echo Config::getBackgroundColors()[1]; ?>;

				--headerColor: <?php echo Config::getHeaderColors()[0]; ?>;
				--headerColor2: <?php echo Config::getHeaderColors()[1]; ?>;

				--linkColor: <?php echo Config::getLinkColor(); ?>;
				--accentColor: <?php echo Config::getFontColor(); ?>;

				--font: 'Nunito', sans-serif;

				--transitionDuration: .3s;
			}
		</style>

		<?php
			include_once('dependencies/css.php');
		?>

	</head>
	<body class="app">
		<div class="wrapper">
			
			<div class="header">
				<div class="logo">
					<a href="<?php echo SimpleRouter::getUrl(); ?>">
						<img src="static/logo.png" alt="">
					</a>
				</div>
				
				<div class="title">
					<span>ImageShare</span>
				</div>
			</div>

			<?php if ($image == '') { ?>

			<div class="section">

				<span>Imageshare</span><br/>
                 <br/>
				<span class="small">A ShareX image hosting solution for your own domain</span><br/>
				<span class="small">Hosted by <a href="<?php echo SimpleRouter::buildUrl(Config::getHost()); ?>" target="_blank"><?php echo Config::getHost(); ?></a></span>

			</div>

			<?php } else if ($image->error == null) { ?>

			<div class="image">
                <a href="<?php echo $image->direct; ?>" target="_blank">
			        <img src="<?php echo $image->direct; ?>" alt="<?php echo $image->type; ?>">
                </a>
			</div>

            <?php } else { ?>

            <div class="section">

				<span>Error - Image not found</span><br/>
                 <br/>
				<span class="small">The image you are looking for was not found!</span><br/>
				<span class="small">Hosted by <a href="<?php echo SimpleRouter::buildUrl(Config::getHost()); ?>" target="_blank"><?php echo Config::getHost(); ?></a></span>

			</div>

            <?php } ?>
			
			

			<div class="copyright <?php if (Config::getCopyright() != true) { echo "hidden"; } ?>">
			
			<?php if ($image != '' && $image->error != null) { ?>
			
				<span>Image was uploaded by <?php echo $image->user; ?></span><br/>
				<br/>
				
			<?php } ?>
			
						
				<span>Build by <a href="https://link.s-loer.de/" target="_blank">Sebastian Loer</a></span><br/>
				<span>ImageShare is a free software. Find the source code on <a class="button" href="https://github.com/digital195/sharex-imageshare" target="_blank">GitHub</a></span><br/>
				<br/>

				<?php if (Config::getImprint() != '' && Config::getPrivacy() != '') { ?>

				<span><a href="<?php echo Config::getImprint(); ?>" target="_blank">Imprint</a> - <a href="<?php echo Config::getPrivacy(); ?>" target="_blank">Privacy</a></span><br/>
				<br/>

				<?php } ?>

				<span>v<?php echo VERSION; ?></span>
			</div>

		</div>
	</body>
</html>