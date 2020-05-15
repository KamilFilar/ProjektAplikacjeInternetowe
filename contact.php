<?php

session_start();

?>

<html lang="pl">

<head>
  <title>E-Zielarnia</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./CSS/contact/contact.css">
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
        <div class="col-12 col-md-8 offset-md-2  text-center pt-4 pb-2">
          <form class="background">
            <div class="row">
              <div class="col-12 py-4">
                <div class="textE1">Kontakt</div>
              </div>
              <div class="links"></div>
              <div class="col-12 py-2">
                <h3>
                  <p class="detail">Numer telefonu: <b class="name">500 400 300
                    </b></p>
                </h3>
              </div>
              <div class="col-12 py-2 pb-4">
                <h3 style="margin-bottom: -23px">
                  <p class="detail">Adres e-mail: <b class="name">Ezielarnia@gmail.com
                    </b></p>
                </h3>
              </div>
              <div class="links"></div>
              <div class="col-12 col-lg-8 py-2"><iframe style="width: 100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2794.2869642749597!2d22.00331010353184!3d50.041853982120436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x473cfb0487a9e705%3A0x45889be6cac7200a!2sPomnik%20Czynu%20Rewolucyjnego%20w%20Rzeszowie!5e0!3m2!1spl!2spl!4v1588418573916!5m2!1spl!2spl" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
              <div class="col-12 col-lg-4">
                <h3>
                  <br />
                  <p class="detail">Adres: <br /><b class="name">10-100<br />
                      <div class="links"></div> Rzeszów <br />
                      <div class="links"></div> ul. XYZ 5
                    </b></p>
                </h3>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


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