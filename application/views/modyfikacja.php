<!Doctype html>
<html>
	<head>
		<meta charset='utf-8' />
		<title>Modyfikacja danych</title>
	</head>
	<body>
		<h1>Modyfikacja danych</h1>
		<p>Tutaj mozesz modyfikowac swoje dane:</p>
		<?php
			echo validation_errors();
			echo form_open();
			foreach ($rekordy as $key) 
			{?>
				<?php echo "Imie: ".$key->imie; ?>
				<input type="text" name="imie" size="15" placeholder="Imie" />
				<br />
				<?php echo "Nazwisko: ".$key->nazwisko;?>
				<input type="text" name="nazwisko" size="15" placeholder="Nazwisko" />
				<br />;
				<?php echo "Nr. telefonu: ".$key->telefon;?>
				<input type="text" name="e_mail" size="15" placeholder="Email" />
				<br />;
				<?php echo "E-mail: ".$key->e_mail;?>
				<input type="text" name="telefon"size="15" placeholder="Telefon" />
				<input type="submit" value="Dodaj konto" />
			</form>
			<?php
			}
			?>
			<br />
		 <p><?php echo anchor(base_url(), 'Strona główna', 'title="Home page"'); ?></p>
	</body>
</html>