<?php
session_start();

if ((strlen($_POST['login']) == 0) && (strlen($_POST['password']) == 0)) {
	$_SESSION['error1'] = '<span div class="error">Nie podano danych!</span>';
	header('Location: login_panel.php');
} else {
	require_once "connect.php";
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($connection->connect_errno != 0) {
		echo "Error: " . $connection->connect_errno;
	} else {

		$Userlogin = $_POST['login'];
		$UserPassword = $_POST['password'];

		$UserLogin = htmlentities($Userlogin, ENT_QUOTES, "UTF-8");

		if ($result = @$connection->query(
			sprintf(
				"SELECT * FROM konto_logowanie AS K, konto AS KO, adres AS A WHERE K.ID_Konta=KO.ID_Konta
		AND KO.ID_Adres = A.ID_Adres AND K.UserLogin='%s'",
				mysqli_real_escape_string($connection, $UserLogin)
			)
		)) {
			$Number_of_users = $result->num_rows;
			if ($Number_of_users > 0) {
				$row = $result->fetch_assoc();
				if (password_verify($UserPassword, $row['Haslo'])) {

					$_SESSION['logged'] = true;

					$_SESSION['ID_user'] = $row['ID_Konta'];
					$_SESSION['ID_ad'] = $row['ID_Adres'];
					$_SESSION['H'] = $row['Haslo'];
					$_SESSION['UserLogin'] = $row['UserLogin'];
					$_SESSION['Imie'] = $row['Imie'];
					$_SESSION['Nazwisko'] = $row['Nazwisko'];
					$_SESSION['Numer_Telefonu'] = $row['Numer_Telefonu'];
					$_SESSION['Miejscowosc'] = $row['Miejscowosc'];
					$_SESSION['Ulica'] = $row['Ulica'];
					$_SESSION['Nr_Lokalu'] = $row['Nr_Lokalu'];
					$_SESSION['Kod_Pocztowy'] = $row['Kod_Pocztowy'];
					$_SESSION['Nr_Domu'] = $row['Nr_Domu'];
					$_SESSION['Mail'] = $row['Mail'];

					unset($_SESSION['error1']);
					$result->free_result();
					header('Location: index.php');
				} else {
					$_SESSION['error1'] = '<span div class="error">Podano błędne dane!</span>';
					header('Location: login_panel.php');
				}
			} else {

				$_SESSION['error1'] = '<span div class="error">Podano błędne dane!</span>';
				header('Location: login_panel.php');
			}
		}

		$connection->close();
	}
}
