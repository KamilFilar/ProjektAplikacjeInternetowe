<?php
session_start();
if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}

?>

<html lang="pl">

<head>
    <title>E-Zielarnia </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a79ff52c1c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./CSS/zamowienia/zamowienia.css">
    <link rel="stylesheet" href="./CSS/main.css" />
    <link rel="shortcut icon" href="./CSS/ikona.ico" />
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
                <div class="col-12  text-center pt-4 pb-2">
                    <form class="background">
                        <div class="row">
                            <div class="links2"></div>
                            <div class="col-12 py-4 text-danger">
                                <div class="textE1">Twoje zamówienia</div>
                            </div>
                            <div class="links2"></div>

                            <div class="col-12 py-2">
                                <?php
                                $database_name = "zielarnia";
                                $con = mysqli_connect("localhost", "root", "", $database_name);
                                if (mysqli_connect_errno()) {
                                    echo "Wystąpił błąd połączenia z bazą!";
                                }
                                $ID_Konta = $_SESSION['ID_user'];
                                $zamowienia = $con->query("SELECT * FROM zamowienia WHERE ID_Konta='$ID_Konta'");
                                $LiczbaZamowien = $zamowienia->num_rows;
                                if ($LiczbaZamowien > 0) {
                                    // output data of each row
                                    while ($value = $zamowienia->fetch_assoc()) {
                                        $idZamowienia = $value['ID_Zamowienia'];
                                        $date = $value['ActDate'];
                                        $zamowieniaSczegoly = $con->query("SELECT * FROM zamowienia_produkty WHERE id_zamowienia='$idZamowienia'");
                                        echo "<div class=\"row text-left justify-content-center\"><div class=\"col-9\"><p class=\"detail3\">Numer zamówienia:<b class=\"gutgut1\"> " . $idZamowienia . "</b></p></div></div>";
                                        echo "<div class=\"row text-center justify-content-center\"><div class=\"col-8 pl-4 text-left\"><p class=\"detail\" style=\"margin-bottom:0;\">Produkty:</p></div></div>";

                                        while ($value2 = $zamowieniaSczegoly->fetch_assoc()) {

                                            $idProduktu = $value2['id_produktu'];
                                            $produkt = $con->query("SELECT * FROM produkty WHERE ID_Produktu='$idProduktu'");
                                            $produktDane = $produkt->fetch_assoc();
                                            echo "<div class=\"row text-center justify-content-center\"><div class=\"col-8 pl-5 text-left\">" . $produktDane['Nazwa_produktu'] . " x " . $value2['ilosc'] . "</div></div>";
                                        }
                                        $total = number_format($value['FullCost'], 2);
                                        echo "<div class=\"row text-center justify-content-center my-1\">
                                                    <div class=\"col-8\">
                                                        <div class=\"row\">
                                                            <div class=\"col-6 pl-4 text-left\"><p class=\"detail\">Całkowity koszt: <b class=\"gutgut2\">" . $total . " </b>PLN</p></div>
                                                            <div class=\"col-6 text-left \"><p class=\"detail\"> Data zamówienia: <b class=\"gutgut2\">" . $date . "</b></p></div>
                                                        </div>
                                                    </div>
                                                </div>";
                                        echo "<div class=\"links\"></div>";
                                    }
                                } else {
                                    echo '<p class="detail3">Nie posiadasz żadnych zamówień w naszym sklepie.</p>';
                                }
                                ?>
                                <!-- </div> -->
                            </div>
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