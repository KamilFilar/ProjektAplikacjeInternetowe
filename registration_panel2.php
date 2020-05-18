<?php
session_start();

if (
    !empty($_POST['login']) && !empty($_POST['userpassword1']) && !empty($_POST['userpassword2']) &&
    !empty($_POST['regulamin']) && !empty($_POST['g-recaptcha-response']) && !empty($_POST['email'] &&
        !empty($_POST['Username']) && !empty($_POST['Usersurname']) && !empty($_POST['PhonNumber']) &&
        !empty($_POST['UserCode']) && !empty($_POST['location']) &&
        !empty($_POST['NumberD']))
) {

    $All_Ok = true;
    $nick = $_POST['login'];
    if ((strlen($nick) < 3) || (strlen($nick) > 20)) {
        $All_Ok = false;
        $_SESSION['error_login'] = "Login musi posiadać od 3 do 20 znaków!";
    }
    if (ctype_alnum($nick) == false) {
        $All_Ok = false;
        $_SESSION['error_login'] = "Nick może składać się tylko z liter i cyfr (bez polskich znaków) i być pojedynczym wyrazem!";
    }


    //Check password
    $pass1 = $_POST['userpassword1'];
    $pass2 = $_POST['userpassword2'];

    if ((strlen($pass1) < 8) || (strlen($pass2) > 20)) {
        $All_Ok = false;
        $_SESSION['error_password'] = "Hasło musi posiadać od 8 do 20 znaków!";
    }
    if ($pass1 != $pass2) {
        $All_Ok = false;
        $_SESSION['error_password'] = "Podane hasła nie są identyczne!";
    }

    $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);

    //Checkbox regumanin
    if (!isset($_POST['regulamin'])) {
        $All_Ok = false;
        $_SESSION['error_regulamin'] = "Nie zaakceptowano regulaminu!";
    }

    //Bot veryfied

    $s = "6Lc8IuwUAAAAAJgCOvRBVDgeaPy70qVbiHkXElJG";

    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $s . '&response=' . $_POST['g-recaptcha-response']);

    $answer = json_decode($check);
    if ($answer->success == false) {
        $All_Ok = false;
        $_SESSION['error_bot'] = "Potiwerdź, że nie jesteś botem!";
    }

    //Check email
    $email = $_POST['email'];
    $email_OK = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($email_OK, FILTER_VALIDATE_EMAIL) == false) || ($email_OK != $email)) {
        $All_Ok = false;
        $_SESSION['error_email'] = "Podaj poprawny adres e-mail! E-mail nie może zawierać polskich znaków!";
    }


    //Check Phon_Number
    $PhonNumber = $_POST['PhonNumber'];
    if (strlen($PhonNumber) != 9) {
        $All_Ok = false;
        $_SESSION['error_PhonNumber'] = "Podaj poprawny numer telefonu! Odpowiedni format to: XXXXXXXXX gdzie X to cyfra.";
    }
    if (!is_numeric($PhonNumber)) {
        $All_Ok = false;
        $_SESSION['error_PhonNumber'] = "Numer telefonu może składać się tylko z cyfr!";
    }
    if (
        $PhonNumber == "000000000" || $PhonNumber == "111111111" || $PhonNumber == "222222222" || $PhonNumber == "333333333" || $PhonNumber == "444444444"
        || $PhonNumber == "555555555" || $PhonNumber == "666666666" || $PhonNumber == "777777777" || $PhonNumber == "888888888" || $PhonNumber == "999999999"
    ) {
        $All_Ok = false;
        $_SESSION['error_PhonNumber'] = "Poadno nieprawidłowy numer telefonu!";
    }
    if (substr($PhonNumber, 0, 1) == 0) {
        $All_Ok = false;
        $_SESSION['error_PhonNumber'] = "Poadno nieprawidłowy numer telefonu!";
    }

    //Check User name
    $UserName = mb_strtolower($_POST['Username']);
    if (strlen($UserName) < 2) {
        $All_Ok = false;
        $_SESSION['error_Username'] = "Podano za krótkie imię!";
    }
    $ArrName = str_split($UserName);
    for ($i = 2; $i < count($ArrName); $i++) {
        if (($ArrName[$i - 2] == $ArrName[$i - 1]) && ($ArrName[$i - 1] == $ArrName[$i])) {
            $All_Ok = false;
            $_SESSION['error_Username'] = "Niepoprawne imię!";
        }
    }
    $Username = ucfirst($UserName);
    if (!preg_match('/^[a-ząćęłńóśźż]+$/ui', $UserName)) {
        $All_Ok = false;
        $_SESSION['error_Username'] = "Imię może składać się tylko z liter!";
    }
    if (strpbrk($UserName, '1234567890')) {
        $All_Ok = false;
        $_SESSION['error_Username'] = "Imię nie może zawierać cyfr!";
    }

    //Check User surname
    $UsersurName = mb_strtolower($_POST['Usersurname']);
    if (strlen($UsersurName) < 2) {
        $All_Ok = false;
        $_SESSION['error_Username'] = "Podano za krótkie nazwisko!";
    }
    $ArrsurName = str_split($UsersurName);
    for ($i = 2; $i < count($ArrsurName); $i++) {
        if (($ArrsurName[$i - 2] == $ArrsurName[$i - 1]) && ($ArrsurName[$i - 1] == $ArrsurName[$i])) {
            $All_Ok = false;
            $_SESSION['error_Usersurname'] = "Niepoprawne nazwisko!";
        }
    }

    $Usersurname = ucfirst($UsersurName);
    if (!(preg_match('/^[a-ząćęłńóśźż]+$/ui', $UsersurName))) {
        $All_Ok = false;
        $_SESSION['error_Usersurname'] = "Nazwisko może składać się tylko z liter!";
    }
    if (strpbrk($UsersurName, '1234567890')) {
        $All_Ok = false;
        $_SESSION['error_Usersurname'] = "Nazwisko nie może zawierać cyfr!";
    }

    //Check location
    $Userlocation = mb_strtolower($_POST['location']);
    if (strlen($Userlocation) < 4) {
        $All_Ok = false;
        $_SESSION['error_location'] = "Podano za krótką nazwę miejscowości!";
    }

    $Arrlocation = str_split($Userlocation);
    for ($i = 2; $i < count($Arrlocation); $i++) {
        if (($Arrlocation[$i - 2] == $Arrlocation[$i - 1]) && ($Arrlocation[$i - 1] == $Arrlocation[$i])) {
            $All_Ok = false;
            $_SESSION['error_location'] = "Niepoprawna nazwa miejscowości!";
        }
    }
    $location = ucfirst($Userlocation);
    if (!(preg_match('/^[a-ząćęłńóśźż]+$/ui', $location))) {
        $All_Ok = false;
        $_SESSION['error_location'] = "Podano błędną nazwę miejscowości!";
    }
    if (strpbrk($Userlocation, '1234567890')) {
        $All_Ok = false;
        $_SESSION['error_location'] = "Nazwa miejscowości nie może zawierać cyfr!";
    }
    //Check street 
    if (!empty($_POST['street'])) {
        $Userstreet = mb_strtolower($_POST['street']);
        if (strlen($Userstreet) < 4) {
            $All_Ok = false;
            $_SESSION['error_street'] = "Podano za krótką nazwę ulicy!";
        }
        $Arrstreet = str_split($Userstreet);
        for ($i = 2; $i < count($Arrstreet); $i++) {
            if (($Arrstreet[$i - 2] == $Arrstreet[$i - 1]) && ($Arrstreet[$i - 1] == $Arrstreet[$i])) {
                $All_Ok = false;
                $_SESSION['error_street'] = "Niepoprawna nazwa ulicy!";
            }
        }
        $street = ucfirst($Userstreet);
        if (!(preg_match('/^[a-ząćęłńóśźż]+$/ui', $street))) {
            $All_Ok = false;
            $_SESSION['error_street'] = "Podano błędną nazwę ulicy!";
        }
        if (strpbrk($Userstreet, '1234567890')) {
            $All_Ok = false;
            $_SESSION['error_street'] = "Nazwa ulicy nie może zawierać cyfr!";
        }
    }

    //Check Postcode

    $UserCode = $_POST["UserCode"];
    if (strlen($UserCode) != 6) {
        $All_Ok = false;
        $_SESSION['error_kod_pocztowy'] = "Poprawny format kodu pocztowego to: XX-XXX";
    }
    if (!preg_match("/^([0-9]{2})(-[0-9]{3})?$/i", $UserCode)) {
        $All_Ok = false;
        $_SESSION['error_kod_pocztowy'] = "Poprawny format kodu pocztowego to: XX-XXX";
    }
    if (
        $UserCode == "00-000" || $UserCode == "11-111" || $UserCode == "22-222" || $UserCode == "44-444" || $UserCode == "66-666" ||
        $UserCode == "77-777" || $UserCode == "88-888" || $UserCode == "99-999"
    ) {
        $All_Ok = false;
        $_SESSION['error_kod_pocztowy'] = "Podano niepoprawny kod pocztowy!";
    }

    //Check numberL
    if (!empty($_POST['NumberL'])) {
        $NumberL = $_POST['NumberL'];
        $NumberL_string = strval($NumberL);
        if (strlen($_POST['NumberL']) == 1) {
            if (substr($NumberL_string, -1) == 0) {
                $All_Ok = false;
                $_SESSION['error_NumberL'] = "Podano niewłaściwy numer lokalu!";
            }
        }
        if (strlen($_POST['NumberL']) == 2) {
            if (substr($NumberL_string, 0, 1) == 0) {
                $All_Ok = false;
                $_SESSION['error_NumberL'] = "Podano niewłaściwy numer lokalu!";
            }
        }
        if (strlen($_POST['NumberL']) == 3) {
            if (substr($NumberL_string, 0, 2) == 0) {
                $All_Ok = false;
                $_SESSION['error_NumberL'] = "Podano niewłaściwy numer lokalu!";
            }
        }
        if (strlen($_POST['NumberL']) == 4) {
            if (substr($NumberL_string, 0, 3) == 0) {
                $All_Ok = false;
                $_SESSION['error_NumberL'] = "Podano niewłaściwy numer lokalu!";
            }
        }
        if (!is_numeric($NumberL)) {
            $All_Ok = false;
            $_SESSION['error_NumberL'] = "W polu z numerem lokalu można podwać tylko cyfry!";
        }
        if ($NumberL <= 0) {
            $All_Ok = false;
            $_SESSION['error_NumberL'] = "Numer lokalu musi być większy od zera!";
        }
    } else {
        $NumberL = 0;
    }
    //Check numberD

    $NumberD = $_POST['NumberD'];
    $NumberD_string = strval($NumberD);
    // $New_ND_5_char = substr($NumberD_string,-1);
    // $New_ND_4_char = substr($NumberD_string,0,1);
    // $New_ND_3_char = substr($NumberD_string,0,2);
    // $New_ND_2_char = substr($NumberD_string,0,3);
    // $New_ND_1_char = substr($NumberD_string,0,4);

    if (strlen($_POST['NumberD']) == 1) {
        if (!is_numeric(substr($NumberD_string, -1))) {
            $All_Ok = false;
            $_SESSION['error_NumberD'] = "Podano niewłaściwy numer domu!";
            //(if 1) Wartość substr: ".$New_ND_5_char;
        }
        if (substr($NumberD_string, -1) == 0) {
            $All_Ok = false;
            $_SESSION['error_NumberD'] = "Podano niewłaściwy numer domu!";
        }
    }
    if (strlen($_POST['NumberD']) == 2) {
        if (!is_numeric(substr($NumberD_string, 0, 1))) {
            $All_Ok = false;
            $_SESSION['error_NumberD'] = "Podano niewłaściwy numer domu!";
            //(if 2) Wartość substr: ".$New_ND_4_char;
        }
        if (substr($NumberD_string, 0, 1) == 0) {
            $All_Ok = false;
            $_SESSION['error_NumberD'] = "Podano niewłaściwy numer domu!";
        }
    }
    if (strlen($_POST['NumberD']) == 3) {
        if (!is_numeric(substr($NumberD_string, 0, 2))) {
            $All_Ok = false;
            $_SESSION['error_NumberD'] = "Podano niewłaściwy numer domu!";
            //(if 3) Wartość substr: ".$New_ND_3_char;
        }
        if (substr($NumberD_string, 0, 2) == 0) {
            $All_Ok = false;
            $_SESSION['error_NumberD'] = "Podano niewłaściwy numer domu!";
        }
    }
    if (strlen($_POST['NumberD']) == 4) {
        if (!is_numeric(substr($NumberD_string, 0, 3))) {
            $All_Ok = false;
            $_SESSION['error_NumberD'] = "Podano niewłaściwy numer domu!";
            //(if 4) Wartość substr: ".$New_ND_2_char;
        }
        if (substr($NumberD_string, 0, 3) == 0) {
            $All_Ok = false;
            $_SESSION['error_NumberD'] = "Podano niewłaściwy numer domu!";
            //(if 4) Wartość substr: ".$New_ND_2_char;
        }
    }
    if (strlen($_POST['NumberD']) == 5) {
        if (!is_numeric(substr($NumberD_string, 0, 4))) {
            $All_Ok = false;
            $_SESSION['error_NumberD'] = "Podano niewłaściwy numer domu!";
            //(if 5) Wartość substr: ".$New_ND_1_char;
        }
        if (substr($NumberD_string, 0, 4) == 0) {
            $All_Ok = false;
            $_SESSION['error_NumberD'] = "Podano niewłaściwy numer domu!";
        }
    }
    if (strlen($_POST['NumberD']) > 5) {
        $All_Ok = false;
        $_SESSION['error_NumberD'] = "Podano zbyt długi numer domu!";
    }
    if (!ctype_alnum($NumberD)) {
        $All_Ok = false;
        $_SESSION['error_NumberD'] = "W polu z numerem domu można podwać tylko cyfry i litery!";
    }
    if ($_POST['NumberD'] < 0) {
        $All_Ok = false;
        $_SESSION['error_NumberD'] = "Numer domu musi być większy od 0!";
    }
    if ($_POST['NumberD'] == 0) {
        $All_Ok = false;
        $_SESSION['error_NumberD'] = "Numer domu musi być większy od 0!";
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Check login (when exist)
            $result = $connection->query("SELECT ID_Konta FROM konto_logowanie WHERE UserLogin='$nick'");
            if (!$result) {
                throw new Exception($connection->error);
            }
            $Number_of_nick = $result->num_rows;
            if ($Number_of_nick > 0) {
                $All_Ok = false;
                $_SESSION['error_login'] = "Podany login już istnieje!";
            }
            //Check phone number (when exist)
            $result = $connection->query("SELECT ID_Konta FROM konto WHERE Mail='$email' AND Numer_Telefonu='$PhonNumber'");
            if (!$result) {
                throw new Exception($connection->error);
            }
            $Number_of_Phonnumber = $result->num_rows;
            if ($Number_of_Phonnumber > 0) {
                $All_Ok = false;
                $_SESSION['error_phonnumber'] = "Podany numer telefonu już istnieje!";
            }
            //Check e-mail (when exist)
            $result = $connection->query("SELECT ID_Konta FROM konto WHERE Mail='$email'");
            if (!$result) {
                throw new Exception($connection->error);
            }
            $Number_of_emails = $result->num_rows;
            if ($Number_of_emails > 0) {
                $All_Ok = false;
                $_SESSION['error_email'] = "Podany e-mail już istnieje!";
            }

            //Add user to database
            if ($All_Ok == true) {
                if ($connection->query("INSERT INTO konto_logowanie (UserLogin, Haslo)
                    VALUE ('$nick','$pass_hash')")) {
                    //echo "Załadowane dane poprawnie do tabeli: konto_logowanie!";
                } else {
                    throw new Exception($connection->error);
                }

                $ID_Konta = $connection->insert_id;

                if ($connection->query("INSERT INTO konto (ID_Konta, Imie, Nazwisko, Mail, Numer_Telefonu)
                    VALUE ('$ID_Konta','$Username','$Usersurname','$email','$PhonNumber')")) {
                    //echo "Załadowane dane poprawnie do tabeli: konto!";
                } else {
                    throw new Exception($connection->error);
                }

                $ID_Adres = $connection->insert_id;
                if ($connection->query("INSERT INTO adres (ID_Adres, Miejscowosc, Ulica, Nr_Lokalu, Kod_Pocztowy, Nr_Domu)
                VALUE ('$ID_Adres','$location','$street','$NumberL','$UserCode','$NumberD')")) {
                    //echo "Załadowane dane poprawnie do tabeli: adres!";
                    $_SESSION['correct_registartion'] = true;
                    header('Location: welcome.php');
                } else {
                    throw new Exception($connection->error);
                }
            }

            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
} else {
    $_SESSION['fatalerror'] = "Należy wypełnić wszystkie wymagane pola!";
}
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <title>E-Zielarnia </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./CSS/registartion_panel/registration_panel.css">
    <link rel="shortcut icon" href="./CSS/ikona.ico" />
    <link rel="stylesheet" href="./CSS/main.css" />
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://kit.fontawesome.com/a79ff52c1c.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-xl bg-dark navbar-dark justify-content-end fixed-top">
        <a class="navbar-brand logo" href="#"><img src="./CSS/Logo.jpg" class="Logostr"></a>
        <button class="navbar-toggler ml-auto mr-1" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0 ml-auto mr-1 mt-1" id="navbarSupportedContent">
            <ul class="navbar-nav text-right">
                <li class="nav-item mt-1 mr-1">
                    <a class="nav-link text-center" href="koszyk.php"><i class="fas fa-shopping-cart fa-lg"></i>
                        <?php
                        error_reporting(0);
                        try {
                            echo (count($_SESSION["cart"]));
                        } catch (Exception $e) {
                            echo "0";
                        }
                        error_reporting(1);
                        ?>
                        KOSZYK</span></a>
                </li>
                <li class="nav-item mt-1 mr-1">
                    <a class="nav-link text-center" href="index.php">SKLEP</a>
                </li>
                <?php
                if (isset($_SESSION['logged'])) {
                    echo  '<li class="nav-item mt-1 mr-1 ">
                        <a class="nav-link text-center" href="zamowienia.php">MOJE ZAMÓWIENIA</a>
                        </li>';
                }
                ?>
                <li class="nav-item mt-1 mr-1">
                    <a class="nav-link text-center" href="knowledge_zone.php">STREFA WIEDZY</a>
                </li>
                <li class="nav-item mt-1 mr-1">
                    <a class="nav-link text-center" href="contact.php">KONTAKT</a>
                </li>
                <?php
                if (isset($_SESSION['logged'])) {
                    echo  '<li class="nav-item mt-1 mr-1 ">
                      <a class="nav-link text-center" href="user_account.php">MOJE KONTO</a>
                    </li>';
                    echo  '<li class="nav-item mt-1 mr-1">
                      <a class="nav-link text-center" href="logout.php">WYLOGUJ SIĘ</a>
                    </li>';
                } else {
                    echo  '<li class="nav-item mt-1 mr-1">
                  <a class="nav-link text-center" href="login_panel.php">ZALOGUJ SIĘ</a>
                </li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <div class="main" style="font-family:Comic Sans MS, cursive, sans-serif;">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 col-md-6 offset-md-3  text-center pt-4 pb-2 background">
                    <form method="post">
                        <div class="row">
                            <div class="col-12 py-4">
                                <div class="textE1">Panel rejestracyjny</div>
                                <div class="links"></div>
                            </div>
                            <div class="col-12 py-2">
                                <!-- Login -->
                                <input type="text" placeholder="Login użytkownika (pole wymagane)" name="login" value="<?php echo isset($_POST["login"]) ? $_POST["login"] : ''; ?>" />
                                <?php
                                if (isset($_SESSION['error_login'])) {
                                    echo '<div class="error">' . $_SESSION['error_login'] . '</div>';
                                    unset($_SESSION['error_login']);
                                }
                                ?></div>
                            <div class="col-12 py-2">
                                <!-- Hasło -->
                                <input type="password" placeholder="Hasło (pole wymagane)" name="userpassword1" />
                            </div>
                            <div class="col-12 py-2">
                                <input type="password" placeholder="Powtórz hasło (pole wymagane)" name="userpassword2" />
                                <?php
                                if (isset($_SESSION['error_password'])) {
                                    echo '<div class="error">' . $_SESSION['error_password'] . '</div>';
                                    unset($_SESSION['error_password']);
                                }
                                ?>
                            </div>
                            <div class="col-12 py-2">
                                <div class="links"></div>
                            </div>
                            <div class="col-12 py-2">
                                <!-- E-mail -->
                                <input type="text" placeholder="Adres e-mail (pole wymagane)" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" />
                                <?php
                                if (isset($_SESSION['error_email'])) {
                                    echo '<div class="error">' . $_SESSION['error_email'] . '</div>';
                                    unset($_SESSION['error_email']);
                                }
                                ?></div>
                            <div class="col-12 py-2">
                                <!-- Imię -->
                                <input type="text" placeholder="Imię (pole wymagane)" name="Username" value="<?php echo isset($_POST["Username"]) ? $_POST["Username"] : ''; ?>" />
                                <?php
                                if (isset($_SESSION['error_Username'])) {
                                    echo '<div class="error">' . $_SESSION['error_Username'] . '</div>';
                                    unset($_SESSION['error_Username']);
                                }
                                ?></div>
                            <div class="col-12 py-2">
                                <!-- Nazwisko -->
                                <input type="text" placeholder="Nazwisko (pole wymagane)" name="Usersurname" value="<?php echo isset($_POST["Usersurname"]) ? $_POST["Usersurname"] : ''; ?>" />
                                <?php
                                if (isset($_SESSION['error_Usersurname'])) {
                                    echo '<div class="error">' . $_SESSION['error_Usersurname'] . '</div>';
                                    unset($_SESSION['error_Usersurname']);
                                }
                                ?></div>
                            <div class="col-12 py-2">
                                <!-- Numer telefonu -->
                                <input type="text" placeholder="Numer telefonu (pole wymagane)" name="PhonNumber" value="<?php echo isset($_POST["PhonNumber"]) ? $_POST["PhonNumber"] : ''; ?>" />
                                <?php
                                if (isset($_SESSION['error_PhonNumber'])) {
                                    echo '<div class="error">' . $_SESSION['error_PhonNumber'] . '</div>';
                                    unset($_SESSION['error_PhonNumber']);
                                }
                                ?>
                            </div>
                            <div class="col-12 py-2">
                                <div class="links"></div>
                            </div>
                            <div class="col-12 py-2">
                                <!-- Miejscowość -->

                                <input type="text" placeholder="Miejscowość (pole wymagane)" name="location" value="<?php echo isset($_POST["location"]) ? $_POST["location"] : ''; ?>" />
                                <?php
                                if (isset($_SESSION['error_location'])) {
                                    echo '<div class="error">' . $_SESSION['error_location'] . '</div>';
                                    unset($_SESSION['error_location']);
                                }
                                ?>
                            </div>
                            <div class="col-12 py-2">
                                <!-- Kod pocztowy -->
                                <input type="text" placeholder="Kod pocztowy (pole wymagane)" name="UserCode" value="<?php echo isset($_POST["UserCode"]) ? $_POST["UserCode"] : ''; ?>" />
                                <?php
                                if (isset($_SESSION['error_kod_pocztowy'])) {
                                    echo '<div class="error">' . $_SESSION['error_kod_pocztowy'] . '</div>';
                                    unset($_SESSION['error_kod_pocztowy']);
                                }
                                ?></div>
                            <div class="col-12 py-2">
                                <!-- Ulica -->
                                <input type="text" placeholder="Ulica" name="street" value="<?php echo isset($_POST["street"]) ? $_POST["street"] : ''; ?>" />
                                <?php
                                if (isset($_SESSION['error_street'])) {
                                    echo '<div class="error">' . $_SESSION['error_street'] . '</div>';
                                    unset($_SESSION['error_street']);
                                }
                                ?></div>
                            <div class="col-12 py-2">
                                <div class="links"></div>
                            </div>
                            <div class="col-12 py-2">
                                <!-- Numer domu -->
                                <input type="text" placeholder="Numer domu (pole wymagane)" name="NumberD" value="<?php echo isset($_POST["NumberD"]) ? $_POST["NumberD"] : ''; ?>" />
                                <?php
                                if (isset($_SESSION['error_NumberD'])) {
                                    echo '<div class="error">' . $_SESSION['error_NumberD'] . '</div>';
                                    unset($_SESSION['error_NumberD']);
                                }
                                ?></div>
                            <div class="col-12 py-2">
                                <!-- Numer lokalu -->
                                <input type="text" placeholder="Numer lokalu " name="NumberL" value="<?php echo isset($_POST["NumberL"]) ? $_POST["NumberL"] : ''; ?>" />
                                <?php
                                if (isset($_SESSION['error_NumberL'])) {
                                    echo '<div class="error">' . $_SESSION['error_NumberL'] . '</div>';
                                    unset($_SESSION['error_NumberL']);
                                }
                                ?></div>
                            <div class="col-12 py-2">
                                <!-- Regulamin -->
                                <input type="checkbox" name="regulamin"><a href="regulamin.php"><label>
                                        <h5>Akceptuję regulamin</h5></a></label>
                                <?php
                                if (isset($_SESSION['error_regulamin'])) {
                                    echo '<div class="error">' . $_SESSION['error_regulamin'] . '</div>';
                                    unset($_SESSION['error_regulamin']);
                                }
                                ?></div>
                            <div class="col-12 py-2">
                                <!-- Recaptcha -->
                                <div class="g-recaptcha" data-sitekey="6Lc8IuwUAAAAAObb4lR83IoY9GHd1eW4TUZQy2NU"></div>
                                <?php
                                if (isset($_SESSION['error_bot'])) {
                                    echo '<div class="error">' . $_SESSION['error_bot'] . '</div>';
                                    unset($_SESSION['error_bot']);
                                }
                                ?>
                            </div>
                            <div class="col-12 py-2"><input type="submit" value="Załóż konto" /></div>
                            <div class="col-12 py-2">
                                <?php
                                if (isset($_SESSION['fatalerror'])) {
                                    echo '<div class="error">' . $_SESSION['fatalerror'] . '</div>';
                                    unset($_SESSION['fatalerror']);
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Nawigacja</h1>
                    <ul>
                        <a href="index.php">
                            <li>Sklep</li>
                        </a>
                        <a href="knowledge_zone.php">
                            <li>Strefa wiedzy</li>
                        </a>
                        <a href="registration_panel2.php">
                            <li>Stwórz konto</li>
                        </a>
                    </ul>
                </div>
                <div class="col">
                    <h1>BLOGI</h1>
                    <ul>
                        <a href="https://zioladookola.pl/pl_PL/blog/">
                            <li>Zioła dookoła</li>
                        </a>
                        <a href="https://www.pracowniaziol.pl/blog/">
                            <li>Pracownia ziół</li>
                        </a>
                        <a href="http://ziołaojcagrzegorza.pl/przykladowa-strona/">
                            <li>Zioła Ojca Grzegorza</li>
                        </a>
                    </ul>
                </div>
                <div class="col">
                    <h1>Wsparcie</h1>
                    <ul>
                        <a href="regulamin.php">
                            <li>Regulamin serwisu</li>
                        </a>
                        <a href="polityka_prywatnosci.php">
                            <li>Polityka prywatności</li>
                        </a>
                        <a href="contact.php">
                            <li>Kontakt</li>
                        </a>
                    </ul>
                </div>
                <div class="col">
                    <h1>Nasi dostawcy</h1>
                    <ul>
                        <a href="https://www.dhl.com/pl-pl/home.html">
                            <li>DHL</li>
                        </a>
                        <a href="https://www.fedex.com/pl-pl/home.html">
                            <li>FedEx</li>
                        </a>
                        <a href="https://inpost.pl">
                            <li>InPost</li>
                        </a>
                    </ul>
                </div>
                <div class="col social">
                    <h1>Znajdź nas</h1>
                    <ul>
                        <li><a href="https://www.facebook.com"><img src="./CSS/login_panel/fb.png" width="32" style="width: 32px;"></a></li>
                        <li><a href="https://www.instagram.com"><img src="./CSS/login_panel/instagram.png" width="32" style="width: 32px;"></a></li>
                        <li><a href="https://www.telegram.com"><img src="./CSS/login_panel/telegram.png" width="32" style="width: 32px;"></a></li>
                    </ul>
                </div>
                <div class="col social">
                    <h1>Wyróżnienia</h1>
                    <ul>
                        <li><a href="http://laurklienta.pl"><img src="./CSS/login_panel/laur1.png" width="100" style="width: 100px;"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>