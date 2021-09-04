<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo NOMBRE_PROYECTO; ?></title>
		<?php echo register_style_sheet(); ?>
		<script type="text/javascript">
			const SERVER_API = "<?php echo SERVER_API ?>";
			const SERVER_URL = "<?php echo SERVER_URL ?>";
			const DIR_CONTROLLERS = "<?php echo base64_encode(DIR_CONTROLLERS) ?>";
			const IP_SERVER = "<?php echo base64_encode(IP_SERVER) ?>";
		</script>
	</head>	
	