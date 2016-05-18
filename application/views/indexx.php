<html>
	<head>
		<meta charset='utf-8' />
		<title>Wyswietlanie</title>
		<link rel="stylesheet" href="<?=$assets_url?>/css/style.css" >
	</head>
	<body>
		<?php foreach ($rekordy as $key) {
			echo $key->login." ";
			echo $key->imie." ";
			echo $key->nazwisko." ";
			echo $key->e_mail;
			?><br /><?php 
			}

		 ?>
		 <br />
		 <?php echo anchor('uzytkownik/rejestracja', 'Dodaj użytkownika', 'title="Dodaj użytkownika"'); ?>
	</body>
</html>