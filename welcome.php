<?php

session_start();

if ((!isset($_SESSION['correct_registartion']))) {
    header('Location: index.php');
    exit();
} else {
    unset($_SESSION['correct_registartion']);
}
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <title>E-Zielarnia - Witaj!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./CSS/welcome/welcome.css">
    <link rel="shortcut icon" href="./CSS/ikona.ico" />
    <link rel="stylesheet" href="./CSS/main.css" />
    <script src="https://kit.fontawesome.com/a79ff52c1c.js" crossorigin="anonymous"></script>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-xl bg-dark navbar-dark justify-content-end fixed-top ">
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


    <div class="main">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <!-- Element 1 -->
                    <div class="text-center backimg" id="Top">
                        <h3> Dziękujemy za rejestrację w naszym serwisie! </h3>
                        </br></br></br></br>
                        <button type="button" onclick="location.href='login_panel.php'" class="button"><span>Zaloguj się </span></button>
                        </form>
                    </div>
                </div>
                <div class="col-12 backimg2">
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-6 py-2 text-center"><i class="fas fa-burn fa-3x"></i>
                            <h4>DOŚWIADCZENIE</h4>
                            <p><br />Działamy na rynku od 2015 roku! Posiadamy dziesięć punktów dystrybucyjnych w całej Polsce.</p>
                        </div>
                        <div class="col-12 col-lg-4 col-md-6 py-2 text-center"><i class="fas fa-money-bill-wave fa-3x"></i>
                            <h4>NAJNIŻSZE CENY</h4>
                            <p><br />Przy pierwszych zakupach dajemy aż 20% zniżki! Dla stakłych klientów przy zakupach za minimum
                                150 złotych dostawa do domu gratis + bony rabatowe na kolejne zakupy! </p>
                        </div>
                        <div class="col-12 col-lg-4 col-md-6 py-2 text-center"><i class="fas fa-shipping-fast fa-3x"> </i>
                            <h4>SZYBKA DOSTAWA</h4>
                            <p><br />Gwarantujemy szybką dstawę towaru dzięki współpracy z najlepszymi firmami przewozowymi w Polsce.
                                Zamówienia składane w weekendy i święta są realizowane w pierwszy dzień roboczy od dnia zamówienia.
                            </p>
                        </div>
                        <div class="col-12 col-lg-4 col-md-6 py-2 text-center"><i class="fas fa-sun fa-3x"></i>
                            <h4>JAKOŚĆ</h4>
                            <p><br />Posiadamy towary najwyższej jakości dzięki sprawdzonym dostawcom z całego świata!
                                Nasze zioła cechuje świeżość, naturalny kolor oraz intensywny zapach.</p>
                        </div>
                        <div class="col-12 col-lg-4 col-md-6 py-2 text-center"><i class="fas fa-users fa-3x"></i>
                            <h4>TYSIĄCE KLIENTÓW</h4>
                            <p><br />Dostarczamy towary do ponad 5000 klientów miesięcznie!
                                Jesteśmy jednym z najbardziej popularnych dystrybutorów ziół w Polsce,
                                który swoim zasięgiem obejmuje cały kraj.</p>
                        </div>
                        <div class="col-12 col-lg-4 col-md-6 py-2 text-center"><i class="fas fa-book-medical fa-3x"></i>
                            <h4>WIEDZA</h4>
                            <p><br />Naszą firmę tworzy wyspecjalizowana kadra miłośników ziół! Dzięki temu nasi
                                klienci mają dostęp nie tylko do wspaniałych wyrobów lecz także do fachowej wiedzy.
                            </p>
                        </div>

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
                            <li>Strona główma</li>
                        </a>
                        <a href="shop.php">
                            <li>Strefa wiedzy</li>
                        </a>
                        <a href="knowledge_zone.php">
                            <li>Strefa wiedzy</li>
                        </a>
                    </ul>
                </div>
                <div class="col">
                    <h1>Nasza oferta</h1>
                    <ul>
                        <li>Nasiona</li>
                        <li>Przyprawy</li>
                        <li>Mieszanki ziół</li>
                    </ul>
                </div>
                <div class="col">
                    <h1>Wsparcie</h1>
                    <ul>
                        <li>Nasz regulamin</li>
                        <li>Polityka prywatności</li>
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