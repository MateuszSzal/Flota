<!Doctype html>
<html>
	<head>
		<meta charset='utf-8' />
		<title>Dodano</title>
	</head>
	<body>
			<p>Pomyślnie dodano :D</p>
			<?php 
					echo $imie;
					echo $nazwisko;
					echo $telefon;
					echo $e_mail;
			 ?>
		<p><?php echo anchor('kontroler/create', 'Dodaj użytkownika', 'title="Dodaj użytkownika"'); ?></p>
		<p><?php echo anchor(base_url(), 'Strona główna', 'title="Home page"'); ?></p>
	</body>
</html>