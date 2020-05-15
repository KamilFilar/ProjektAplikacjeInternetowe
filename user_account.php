<?php

session_start();

if (!isset($_SESSION['logged'])) {
  header('Location: index.php');
  exit();
}

?>

<html lang="pl">

<head>
  <title>E-Zielarnia - Twoje konto </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./CSS/user_account/user_account.css">
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
          <form>
            <div class="row">
              <div class="col-12 py-4">
                <div class="textE1">Profil użytkownika</div>
              </div>
              <div class="links1"></div>
              <div class="col-12 py-2">
                <h3>
                  <p class="detail">Imię:<span class="name"> <?php echo $_SESSION['Imie']; ?></span></p>
                </h3>
              </div>
              <div class="col-12 py-2">
                <h3>
                  <p class="detail">Nazwisko:<span class="name"> <?php echo $_SESSION['Nazwisko']; ?></span></p>
                </h3>
              </div>
              <div class="col-12 py-2">
                <h3>
                  <p class="detail">Numer telefonu:<span class="name"> <?php echo $_SESSION['Numer_Telefonu']; ?></span></p>
                </h3>
              </div>
              <div class="col-12 py-2">
                <h3>
                  <p class="detail">Adres e-mail:<span class="name"> <?php echo $_SESSION['Mail']; ?></span></p>
                </h3>
              </div>
              <div class="col-12 py-2">
                <h3>
                  <p class="detail">Miejscowość:<span class="name"> <?php echo $_SESSION['Miejscowosc']; ?></span></p>
                </h3>
              </div>
              <div class="col-12 py-2">
                <h3>
                  <p class="detail">Kod pocztowy:<span class="name"> <?php echo $_SESSION['Kod_Pocztowy']; ?></span></p>
                </h3>
              </div>
              <div class="col-12 py-2">
                <h3>
                  <p class="detail">Ulica:<span class="name"> <?php echo $_SESSION['Ulica']; ?></span></p>
                </h3>
              </div>
              <?php
              if ($_SESSION['Nr_Domu'] == 0) {

                echo '<div class="col-12 py-2"><h3>
                <p class="detail">Numer domu: <span class="name">---</span></p></h3></div>';
                echo '<div class="col-12 py-2"><h3>
                <p class="detail">Numer lokalu: <span class="name">---</span></p></h3></div>';
              } else {
                echo '<div class="col-12 py-2"><h3>
                <p class="detail">Numer domu: <span class="name">' . $_SESSION['Nr_Domu'] . "</span><p></h3></div>";
              }
              if ($_SESSION['Nr_Lokalu'] != 0) {
                echo '<div class="col-12 py-2"><h3>
                <p class="detail">Numer lokalu: <span class="name">' . $_SESSION['Nr_Lokalu'] . "</span></p></h3></div>";
              }
              ?>
              <div class="col-12 py-2">
                <div class="links"></div>
              </div>
              <div class="col-12 py-2"><a href="user_edit.php"><input type="button" value="Edytuj profil" /></a></div>
              <div class="col-12 py-2"><a href="index.php"><input type="button" value="Powrót" /></a></div>
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