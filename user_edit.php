<?php

session_start();
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}
//Check password
if (!empty($_POST['userpasswordOLD'])) {
    $All_Ok = true;
    $passOLD = $_POST['userpasswordOLD'];
    $passOLD_hashed = $_SESSION['H'];
    if (!password_verify($passOLD, $passOLD_hashed)) {
        $All_Ok = false;
        $_SESSION['error_password_old'] = "Podane stare hasło nie jest prawidłowe!";
    }
    $pass1 = $_POST['userpassword1'];
    $pass2 = $_POST['userpassword2'];
    if ((strlen($pass1) < 6) || (strlen($pass2) > 20)) {
        $All_Ok = false;
        $_SESSION['error_password'] = "Hasło musi posiadać od 6 do 20 znaków!";
    }
    if ($pass1 != $pass2) {
        $All_Ok = false;
        $_SESSION['error_password'] = "Podane hasła nie są identyczne!";
    }
    if (($pass1 == NULL) && ($pass2 == NULL)) {
        $All_Ok = false;
        $_SESSION['error_password'] = "Pamiętaj aby, przy zmianie hasła podać od 6 do 20 znaków.";
    }
    $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_user'];
                try {
                    $connection->query("UPDATE konto_logowanie SET Haslo ='$pass_hash' WHERE ID_Konta='$GoodID'");
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}
//Check Username
if (!empty($_POST['Username'])) {
    $All_Ok = true;
    $UserName = mb_strtolower($_POST['Username']);
    $ArrName = str_split($UserName);
    for ($i = 1; $i < count($ArrName); $i++) {
        if (($ArrName[$i - 2] == $ArrName[$i - 1]) && ($ArrName[$i - 1] == $ArrName[$i])) {
            $All_Ok = false;
            $_SESSION['error_Username'] = "Niepoprawne imię!";
        }
    }
    $Username = ucfirst($UserName);
    if (!(preg_match('/^[a-ząćęłńóśźż]+$/ui', $Username))) {
        $All_Ok = false;
        $_SESSION['error_Username'] = "W polu imię należy podać tylko litery!";
    }
    if (strpbrk($UserName, '1234567890')) {
        $All_Ok = false;
        $_SESSION['error_Username'] = "Imię nie może zawierać cyfr!";
    }
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_user'];
                try {
                    $connection->query("UPDATE konto SET Imie='$Username' WHERE ID_Konta='$GoodID'");
                    $_SESSION['Imie'] = $Username;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}
//Check Usersurname    
if (!empty($_POST['Usersurname'])) {
    $All_Ok = true;
    $UsersurName = mb_strtolower($_POST['Usersurname']);
    $ArrsurName = str_split($UsersurName);
    for ($i = 1; $i < count($ArrsurName); $i++) {
        if (($ArrsurName[$i - 2] == $ArrsurName[$i - 1]) && ($ArrsurName[$i - 1] == $ArrsurName[$i])) {
            $All_Ok = false;
            $_SESSION['error_Usersurname'] = "Niepoprawne nazwisko!";
        }
    }
    $Usersurname = ucfirst($UsersurName);

    $Usersurname = ucfirst(mb_strtolower($_POST['Usersurname']));
    if (!(preg_match('/^[a-ząćęłńóśźż]+$/ui', $Usersurname))) {
        $All_Ok = false;
        $_SESSION['error_Usersurname'] = "W polu nazwisko należy podać tylko litery!";
    }
    if (strpbrk($UsersurName, '1234567890')) {
        $All_Ok = false;
        $_SESSION['error_Usersurname'] = "Nazwisko nie może zawierać cyfr!";
    }
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_user'];
                try {
                    $connection->query("UPDATE konto SET Nazwisko='$Usersurname' WHERE ID_Konta='$GoodID'");
                    $_SESSION['Nazwisko'] = $Usersurname;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}
//Check PhonNumber
if (!empty($_POST['PhonNumber'])) {
    $All_Ok = true;
    $PhonNumber = $_POST['PhonNumber'];
    if (strlen($PhonNumber) != 9) {
        $All_Ok = false;
        $_SESSION['error_PhonNumber'] = "Podaj poprawny dziewięcio cyfrowy numer telefonu!";
    }
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Check phone number (when exist)
            $result = $connection->query("SELECT ID_Konta FROM konto WHERE Numer_Telefonu='$PhonNumber'");
            if (!$result) {
                throw new Exception($connection->error);
            }
            $Number_of_Phonnumber = $result->num_rows;
            if ($Number_of_Phonnumber > 0) {
                $row = $result->fetch_assoc();
                if ($_SESSION['ID_user'] == $row['ID_Konta']) {
                    $All_Ok = false;
                    $_SESSION['error_PhonNumber'] = "Masz przyspiany już ten numer telefonu!";
                } else {
                    $All_Ok = false;
                    $_SESSION['error_PhonNumber'] = "Podany numer telefonu już istnieje!";
                }
            }
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_user'];
                try {
                    $connection->query("UPDATE konto SET Numer_Telefonu='$PhonNumber' WHERE ID_Konta='$GoodID'");
                    $_SESSION['Numer_Telefonu'] = $PhonNumber;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}
//Check email
if (!empty($_POST['email'])) {
    $All_Ok = true;
    $email = $_POST['email'];
    $email_OK = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($email_OK, FILTER_VALIDATE_EMAIL) == false) || ($email_OK != $email)) {
        $All_Ok = false;
        $_SESSION['error_email'] = "Podaj poprawny adres e-mail!";
    }
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Check e-mail (when exist)
            $result = $connection->query("SELECT ID_Konta FROM konto WHERE Mail='$email'");
            if (!$result) {
                throw new Exception($connection->error);
            }
            $Number_of_Email = $result->num_rows;
            if ($Number_of_Email > 0) {
                $row = $result->fetch_assoc();
                if ($_SESSION['ID_user'] == $row['ID_Konta']) {
                    $All_Ok = false;
                    $_SESSION['error_email'] = "Masz przyspiany już ten adres e-mail!";
                } else {
                    $All_Ok = false;
                    $_SESSION['error_email'] = "Podany adres e-mail już istnieje!";
                }
            }
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_user'];
                try {
                    $connection->query("UPDATE konto SET Mail='$email' WHERE ID_Konta='$GoodID'");
                    $_SESSION['Mail'] = $email;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}

//Check location
if (!empty($_POST['location'])) {
    $All_Ok = true;
    $Userlocation = mb_strtolower($_POST['location']);
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
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_ad'];
                try {
                    $connection->query("UPDATE adres SET Miejscowosc='$location' WHERE ID_Adres='$GoodID'");
                    $_SESSION['Miejscowosc'] = $location;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}
//Check street
if (!empty($_POST['street'])) {
    $All_Ok = true;
    $Userstreet = mb_strtolower($_POST['street']);
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
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_ad'];
                try {
                    $connection->query("UPDATE adres SET Ulica='$street' WHERE ID_Adres='$GoodID'");
                    $_SESSION['Ulica'] = $street;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}
//Check postcode
if (!empty($_POST['UserCode'])) {
    $All_Ok = true;
    $UserCode = $_POST['UserCode'];

    if (!preg_match("/^([0-9]{2})(-[0-9]{3})?$/i", $UserCode)) {
        $All_Ok = false;
        $_SESSION['error_kod_pocztowy'] = "Poprawny format kodu pocztowego to: XX-XXX";
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_ad'];
                try {
                    $connection->query("UPDATE adres SET Kod_Pocztowy='$UserCode' WHERE ID_Adres='$GoodID'");
                    $_SESSION['Kod_Pocztowy'] = $UserCode;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}
//Check NumberD
if (!empty($_POST['NumberD'])) {
    $All_Ok = true;
    $NumberD = $_POST['NumberD'];
    $NumberD_string = strval($NumberD);
    $New_ND_5_char = substr($NumberD_string, -1);
    $New_ND_4_char = substr($NumberD_string, 0, 1);
    $New_ND_3_char = substr($NumberD_string, 0, 2);
    $New_ND_2_char = substr($NumberD_string, 0, 3);
    $New_ND_1_char = substr($NumberD_string, 0, 4);

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
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_ad'];
                try {
                    $connection->query("UPDATE adres SET Nr_Domu='$NumberD' WHERE ID_Adres='$GoodID'");
                    $_SESSION['Nr_Domu'] = $NumberD;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}

//Check NumberL
if ((!empty($_POST['NumberL']))) {
    $All_Ok = true;
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
    if ($NumberL < 0) {
        $All_Ok = false;
        $_SESSION['error_NumberL'] = "Numer lokalu musi być większy od zera!";
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_ad'];
                try {
                    $connection->query("UPDATE adres SET Nr_Lokalu='$NumberL' WHERE ID_Adres='$GoodID'");
                    $_SESSION['Nr_Lokalu'] = $NumberL;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}
//Chcek button delete
if (isset($_POST["resetbutton"])) {
    $All_Ok = true;
    $NumberL = "";
    $NumberD = "";
    if ($NumberL != "" && $NumberD != "") {
        $All_Ok = false;
        $_SESSION['error_delete'] = "Coś poszło nie tak!";
    }
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_ad'];
                try {
                    $connection->query("UPDATE adres SET Nr_Lokalu='$NumberL', Nr_Domu='$NumberD' WHERE ID_Adres='$GoodID'");
                    $_SESSION['Nr_Lokalu'] = $NumberL;
                    $_SESSION['Nr_Domu'] = $NumberD;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}
//Reset street
if (isset($_POST["resetbutton1"])) {
    $All_Ok = true;
    $Userstreet = "";
    if ($Userstreet != "") {
        $All_Ok = false;
        $_SESSION['error_delete'] = "Coś poszło nie tak!";
    }
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            //Update user into db
            if ($All_Ok == true) {
                $GoodID = $_SESSION['ID_ad'];
                try {
                    $connection->query("UPDATE adres SET Ulica='$Userstreet' WHERE ID_Adres='$GoodID'");
                    $_SESSION['Ulica'] = $Userstreet;
                } catch (Exception $e) {
                    echo '<span style="color:red;">Błąd aktualizacji! Przepraszamy za niedogodności i prosimy o aktualizację w innym terminie!</span>';
                    echo '<br />Informacja developerska' . $e;
                }
            }
            $connection->close();
        }
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejstrację w innym terminie!</span>';
        echo '<br />Informacja developerska' . $e;
    }
}


?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <title>E-Zielarnia - konto edycja </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./CSS/user_account/user_edit.css">
    <link rel="shortcut icon" href="./CSS/ikona.ico" />
    <link rel="stylesheet" href="./CSS/main.css" />
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
                                <div class="textE1">Profil użytkownika - edycja</div>
                            </div>
                            <div class="col-12 py-2 text-center">
                                <div class="links"></div>
                            </div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail">
                                    <label for="login">Login:</label>
                                    <input type="text" placeholder="<?php echo $_SESSION['UserLogin']; ?>" name="login" />
                                </p>
                            </div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_login'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_login'] . '</div>';
                                                                        unset($_SESSION['error_login']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail"><label for="userpasswordOLD">Stare hasło:</label>
                                    <input type="password" name="userpasswordOLD" /></p>
                            </div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_password_old'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_password_old'] . '</div>';
                                                                        unset($_SESSION['error_password_old']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail"><label for="userpassword1">Hasło:</label>
                                    <input type="password" name="userpassword1" /></p>
                            </div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail"><label for="userpassword2">Powtórz hasło:</label>
                                    <input type="password" name="userpassword2" /></p>
                            </div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_password'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_password'] . '</div>';
                                                                        unset($_SESSION['error_password']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center"><input type="submit" value="Zapisz dane" /></div>
                            <div class="col-12 py-2 text-center">
                                <div class="links"></div>
                            </div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail"><label for="Name">Imię:</label>
                                    <input type="text" placeholder="<?php echo $_SESSION['Imie']; ?>" name="Username" /></p>
                            </div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_Username'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_Username'] . '</div>';
                                                                        unset($_SESSION['error_Username']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail"><label for="Usersurname">Nazwisko:</label>
                                    <input type="text" placeholder="<?php echo $_SESSION['Nazwisko']; ?>" name="Usersurname" /></p>
                            </div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_Usersurname'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_Usersurname'] . '</div>';
                                                                        unset($_SESSION['error_Usersurname']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail"><label for="PhonNumber">Numer telefonu:</label>
                                    <input type="text" placeholder="<?php echo $_SESSION['Numer_Telefonu']; ?>" name="PhonNumber" /></p>
                            </div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_PhonNumber'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_PhonNumber'] . '</div>';
                                                                        unset($_SESSION['error_PhonNumber']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail"><label for="email">Adres e-mail:</label>
                                    <input type="text" placeholder="<?php echo $_SESSION['Mail']; ?>" name="email" /></p>
                            </div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_email'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_email'] . '</div>';
                                                                        unset($_SESSION['error_email']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center"><input type="submit" value="Zapisz dane" /></div>
                            <div class="col-12 py-2 text-center">
                                <div class="links"></div>
                            </div>
                            <div class="col-12 py-2 text-center"><input type="submit" name="resetbutton1" value="Resetuj ulicę" /></div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_delete'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_delete'] . '</div>';
                                                                        unset($_SESSION['error_delete']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail"><label for="location">Miejscowość:</label>
                                    <input type="text" placeholder="<?php if ($_SESSION['Miejscowosc'] == "") {
                                                                        echo "";
                                                                    } else {
                                                                        echo $_SESSION['Miejscowosc'];
                                                                    } ?>" name="location" /></p>
                            </div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_location'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_location'] . '</div>';
                                                                        unset($_SESSION['error_location']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail"><label for="UserCode">Kod pocztowy:</label>
                                    <input type="text" placeholder="<?php echo $_SESSION['Kod_Pocztowy']; ?>" name="UserCode" /></p>
                            </div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_kod_pocztowy'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_kod_pocztowy'] . '</div>';
                                                                        unset($_SESSION['error_kod_pocztowy']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center">
                                <p class="detail"><label for="street">Ulica:</label>
                                    <input type="text" placeholder="<?php echo $_SESSION['Ulica']; ?>" name="street" /></p>
                            </div>
                            <div class="col-12 py-2 text-center"><?php
                                                                    if (isset($_SESSION['error_street'])) {
                                                                        echo '<div class="error">' . $_SESSION['error_street'] . '</div>';
                                                                        unset($_SESSION['error_street']);
                                                                    }
                                                                    ?></div>
                            <div class="col-12 py-2 text-center"><input type="submit" value="Zapisz dane" /></div>
                        </div>
                        <div class="col-12 py-2 text-center">
                            <div class="links"></div>
                        </div>
                        <div class="col-12 py-2 text-center"><input type="submit" name="resetbutton" value="Resetuj adres" /></div>
                        <div class="col-12 py-2 text-center"><?php
                                                                if (isset($_SESSION['error_delete'])) {
                                                                    echo '<div class="error">' . $_SESSION['error_delete'] . '</div>';
                                                                    unset($_SESSION['error_delete']);
                                                                }
                                                                ?></div>
                        <div class="col-12 py-2 text-center">
                            <p class="detail"><label for="NumberD">Numer domu:</label>
                                <input type="text" placeholder="<?php
                                                                if ($_SESSION['Nr_Domu'] == 0) {
                                                                    echo "";
                                                                } else {
                                                                    echo $_SESSION['Nr_Domu'];
                                                                }
                                                                ?>" name="NumberD" /></p>
                        </div>
                        <div class="col-12 py-2 text-center"><?php
                                                                if (isset($_SESSION['error_NumberD'])) {
                                                                    echo '<div class="error">' . $_SESSION['error_NumberD'] . '</div>';
                                                                    unset($_SESSION['error_NumberD']);
                                                                }
                                                                ?></div>
                        <div class="col-12 py-2 text-center">
                            <p class="detail"><label for="NumberL">Numer lokalu: </label>
                                <input type="text" placeholder="<?php

                                                                if ($_SESSION['Nr_Lokalu'] == 0) {
                                                                    echo "";
                                                                } else {
                                                                    echo $_SESSION['Nr_Lokalu'];
                                                                }
                                                                ?>" name="NumberL" /></p>
                        </div>
                        <div class="col-12 py-2 text-center"><?php
                                                                if (isset($_SESSION['error_NumberL'])) {
                                                                    echo '<div class="error">' . $_SESSION['error_NumberL'] . '</div>';
                                                                    unset($_SESSION['error_NumberL']);
                                                                }
                                                                ?></div>
                        <div class="col-12 py-2 text-center"><input type="submit" value="Zapisz dane" /></div>
                        <div class="col-12 py-2 text-center">
                            <div class="links"></div>
                        </div>
                        <div class="col-12 py-2 text-center"><a href="user_account.php"><input type="button" value="Powrót" /></a></div>
                </div>
                </form>
            </div>
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