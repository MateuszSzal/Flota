<!Doctype html>
<html>
	<head>
		<meta charset='utf-8' />
		<title>Zaloguj</title>
	</head>
	<body>
		<h1>Zaloguj</h1>
			<?php 

			if(isset ($komunikat))	
				echo $komunikat; 
			?>
			<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>
			<input type="text" name="login" value="<?php echo set_value('login'); ?>" size="15" placeholder="Login" /><br />
			<input type="password" name="haslo" value="<?php echo set_value('haslo'); ?>" size="15" placeholder="Hasło" /><br />
			<div><input type="submit" value="Zaloguj" /></div>

			</form>
		 <p><?php echo anchor(base_url(), 'Strona główna', 'title="Home page"'); ?></p>
	</body>
</html>