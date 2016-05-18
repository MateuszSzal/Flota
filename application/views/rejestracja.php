<!Doctype html>
<html>
	<head>
		<meta charset='utf-8' />
		<title>Rejestracja</title>
	</head>
	<body>
		<h1>Rejestracja</h1>
		<?php echo validation_errors(); ?>
			<?php echo form_open(); ?>

			<input type="text" name="login" value="<?php echo set_value('login'); ?>" size="15" placeholder="Login" /><br />
			<input type="password" name="haslo" value="<?php echo set_value('haslo'); ?>" size="15" placeholder="Hasło" /><br />
			<input type="password" name="haslo2" value="<?php echo set_value('haslo2'); ?>" size="15" placeholder="Powtórz hasło" /><br />
			<input type="text" name="imie" value="<?php echo set_value('imie'); ?>" size="15" placeholder="Imie" /><br />
			<input type="text" name="nazwisko" value="<?php echo set_value('nazwisko'); ?>" size="15" placeholder="Nazwisko" /><br />
			<input type="text" name="e_mail" value="<?php echo set_value('e_mail'); ?>" size="15" placeholder="Email" /><br />
			<input type="text" name="telefon" value="<?php echo set_value('telefon'); ?>" size="15" placeholder="Telefon" /><br />
			<select name="rodzaj_konta">
				<option value="klient">Klient</option>
				<option value="spedytor">Spedytor</option>
				<option value="kierowca">Kierowca</option>
			</select>
			<div><input type="submit" value="Dodaj konto" /></div>

			</form>
		 <p><?php echo anchor(base_url(), 'Strona główna', 'title="Home page"'); ?></p>
	</body>
</html>