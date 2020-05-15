<?php
session_start();
$database_name = "zielarnia";
$con = mysqli_connect("localhost", "root", "", $database_name);
if (mysqli_connect_errno()) {
  echo "Wystąpił błąd połączenia z bazą!";
}
$result1 = mysqli_query($con, "SELECT Nazwa_Dostawcy, Czas_realizacji, Koszt FROM dostawcy WHERE ID_Dostawcy=1");
$row = $result1->fetch_assoc();
$_SESSION['ID_dostawcy'] = 1;
$_SESSION['Nazwa_dostawcy1'] = $row['Nazwa_Dostawcy'];
$_SESSION['Czas_realizacji1'] = $row['Czas_realizacji'];
$_SESSION['Koszt1'] = $row['Koszt'];
$result1->free_result();

$result2 = mysqli_query($con, "SELECT Nazwa_Dostawcy, Czas_realizacji, Koszt FROM dostawcy WHERE ID_Dostawcy=2");
$row = $result2->fetch_assoc();
$_SESSION['ID_dostawcy'] = 2;
$_SESSION['Nazwa_dostawcy2'] = $row['Nazwa_Dostawcy'];
$_SESSION['Czas_realizacji2'] = $row['Czas_realizacji'];
$_SESSION['Koszt2'] = $row['Koszt'];
$result2->free_result();

$result3 = mysqli_query($con, "SELECT Nazwa_Dostawcy, Czas_realizacji, Koszt FROM dostawcy WHERE ID_Dostawcy=3");
$row = $result3->fetch_assoc();
$_SESSION['ID_dostawcy'] = 3;
$_SESSION['Nazwa_dostawcy3'] = $row['Nazwa_Dostawcy'];
$_SESSION['Czas_realizacji3'] = $row['Czas_realizacji'];
$_SESSION['Koszt3'] = $row['Koszt'];
$result3->free_result();

$AllOk = true;
if (isset($_SESSION['logged'])) {
  if ($_SESSION['Nr_Domu'] == 0) {
    $AllOk = false;
    $_SESSION['ErrorD'] = "Przed dokonaniem zamówienia należy wprowadzić numer domu!";
  }
}

// $e = "0";
if (isset($_SESSION['logged'])) {
  if (isset($_POST['buttonorder'])) {
    try {
      if (empty($_SESSION['ID_user'])) {
        $AllOk = false;
        $_SESSION['errorK'] = "Aby zrealizować zamówienie musisz posiadać aktywne konto w naszym serwisie!";
      } else {
        $ID_Konta = $_SESSION['ID_user'];
      }

      $productCost; //cena calkowita zamowienia
      if (empty($_POST['RadioButton'])) {
        $AllOk = false;
        $_SESSION['errorB'] = "Proszę wybrać dostawcę!";
      } else {
        $deliveryCost = $_POST['RadioButton'];
      }
      // ksozt dostawy
      //echo "koszt dostawy" . $deliveryCost . "</br>";
      $productCost = 0;

      if (!empty($_SESSION["cart"])) {
        foreach ($_SESSION["cart"] as $key => $value) {
          $productCost = $productCost + ($value["item_quantity"] * $value["product_price"]);
        }
      }

      if (empty($_POST['RadioButton'])) {
        $AllOk = false;
        $_SESSION['errorB'] = "Proszę wybrać dostawcę!";
      }


      if ($AllOk == true) {
        $total = $productCost + $deliveryCost;
        // echo "total: " . $total . "</br>";
        // echo "idkonta: " . $ID_Konta . "</br>";
        $resultDostawcy = $con->query("SELECT * FROM dostawcy WHERE Koszt='$deliveryCost'");
        $row = $resultDostawcy->fetch_assoc();
        $ID_Dostawcy = $row['ID_Dostawcy'];
        $date = date('Y-m-d');
        // echo "iddostawcy: " . $ID_Dostawcy . "</br>";
        if ($con->query("INSERT INTO zamowienia (ID_Konta, ID_Dostawcy, FullCost, ActDate)
        VALUE ('$ID_Konta','$ID_Dostawcy','$total','$date')")) {
          // echo "poprawne dodanie zamowienia</br>";
        } else {
          throw new Exception($con->error);
        }
        $idZamowienia = $con->insert_id;

        // echo "idzamowienia: " . $ID_Dostawcy . "</br>";
        foreach ($_SESSION["cart"] as $key => $value) {
          $productId = $value["product_id"];
          $quantity = $value["item_quantity"];
          $con->query("INSERT INTO zamowienia_produkty (id_zamowienia, id_produktu, ilosc)
          VALUE ('$idZamowienia','$productId','$quantity')");
        }

        unset($_SESSION["cart"]);
        echo "<script>window.location.replace(\"zamowienia.php\");</script>";
      }
    } catch (exception $ex) {
      // $e = $ex->getMessage();
    }

    // echo $e;
  } else {
    $_SESSION['errorB'] = "Proszę wybrać dostawcę!";
  }
} else {
  $_SESSION['errorK'] = "Żeby zrealizować zamówienie należy posiadać aktywne konto w naszyms serwisie!";
}




$con->close();

?>
<html lang="pl">

<head>
  <title>E-Zielarnia </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/a79ff52c1c.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./CSS/koszyk/koszyk.css">
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
    <div class="container bacground">
      <div class="row mb-5">
        <div class="col-12  text-center pt-4 pb-2">
          <form class="background" method="post">
            <div class="row">
              <div class="col-12 py-4 text-danger">
                <div class="textE1">Szczegóły zamówienia</div>
              </div>
              <div class="links"></div>
              <div class="col-12">
                <div class="row text-center">
                  <div class="col-4">
                    <p class="detail">Nazwa produktu</p>
                  </div>
                  <div class="col-2">
                    <p class="detail">Ilość (szt.)</p>
                  </div>
                  <div class="col-2">
                    <p class="detail">Cena (szt.)</p>
                  </div>
                  <div class="col-2">
                    <p class="detail">Łączna cena</p>
                  </div>
                  <div class="col-2">
                    <p class="detail">Usuń</p>
                  </div>
                </div>
              </div>
              <?php
              if (!empty($_SESSION["cart"])) {
                $total = 0;
                foreach ($_SESSION["cart"] as $key => $value) {
              ?>
                  <div class="col-12 py-2">
                    <div class="row text-center">
                      <div class="col-4"><b class="name"><?php echo $value["item_name"]; ?></b></div>
                      <div class="col-2"><b class="name"><?php echo $value["item_quantity"]; ?></b></div>
                      <div class="col-2"><b class="name"><?php echo $value["product_price"]; ?> PLN</b></div>
                      <div class="col-2"><b class="name">
                          <?php echo number_format($value["item_quantity"] * $value["product_price"], 2); ?> PLN</b></div>
                      <div class="col-2"><a href="index.php?action=delete&id=<?php echo $value["product_id"]; ?>"><i class="fas fa-times fa-2x" style="color:red;"></i></a></div>
                    </div>
                  </div>

                <?php
                  $total = $total + ($value["item_quantity"] * $value["product_price"]);
                }
                ?>
                <div class="links"></div>
                <div class="col-12 py-4">
                  <div class="row">
                    <div class="col-4">
                      <input type="radio" name="RadioButton" value="<?php echo $_SESSION['Koszt1']; ?>" /><br />
                      <b class="name5"><?php echo $_SESSION['Nazwa_dostawcy1']; ?><br /></b>
                      <p class="detail2">Czas realizacji: ~<b class="name"><?php echo $_SESSION['Czas_realizacji1']; ?> dni<br /></b></p>
                      <p class="detail2">Koszt dostawy: <b class="name"><?php echo $_SESSION['Koszt1']; ?> PLN </b></p>
                    </div>
                    <div class=" col-4">
                      <input type="radio" name="RadioButton" value="<?php echo $_SESSION['Koszt2']; ?>" /><br />
                      <b class="name5"><?php echo $_SESSION['Nazwa_dostawcy2']; ?><br /></b>
                      <p class="detail2">Czas realizacji: ~<b class="name"><?php echo $_SESSION['Czas_realizacji2']; ?> dni<br /></b></p>
                      <p class="detail2">Koszt dostawy: <b class="name"><?php echo $_SESSION['Koszt2']; ?> PLN</b></p>
                    </div>
                    <div class="col-4">
                      <input type="radio" name="RadioButton" value="<?php echo $_SESSION['Koszt3']; ?>" /><br />
                      <b class="name5"><?php echo $_SESSION['Nazwa_dostawcy3']; ?></b><br />
                      <p class="detail2">Czas realizacji: ~<b class="name"><?php echo $_SESSION['Czas_realizacji3']; ?> dni<br /></b></p>
                      <p class="detail2">Koszt dostawy: <b class="name"><?php echo $_SESSION['Koszt3']; ?> PLN </b></p>
                    </div>
                  </div>
                </div>
                <div class="links"></div>
                <div class="col-12 py-4">
                  <div class="row">
                    <div class="col-6">
                      <p class="detail3">Cena towaru:</p>
                    </div>
                    <div class="col-6"><b class="name2"><?php echo number_format($total, 2); ?> PLN</b></div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <p class="detail3">Koszto dostawy:</p>
                    </div>
                    <div class="col-6"><b class="name2" id="kosztDostawy"> </b><b class="name2">&nbsp;PLN</b></div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <p class="detail3">Do zapłaty:</p>
                    </div>
                    <div class="col-6"><b class="name2" id="calkowityKoszt"> </b><b class="name2">&nbsp;PLN</b></div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <div class="errorK"><?php
                                          if (isset($_SESSION['errorK'])) {
                                            echo '<br />';
                                            echo $_SESSION['errorK'];
                                            echo '<br /><a href="registration_panel2.php"><input type="button" class="button_active" onclick="" value="Zarejestruj się" /></a><br />';
                                            unset($_SESSION['errorK']);
                                          }
                                          if (isset($_SESSION['ErrorD'])) {
                                            echo '<br />';
                                            echo $_SESSION['ErrorD'];
                                            echo '<br /><a href="user_edit.php"><input type="button" class="button_active" onclick="" value="Edytuj profil" /></a><br />';
                                            unset($_SESSION['ErrorD']);
                                          }
                                          if (isset($_SESSION['errorB'])) {
                                            echo $_SESSION['errorB'] . '<br /><br />';
                                            unset($_SESSION['errorB']);
                                          }

                                          ?>
                      </div>
                      <input type="submit" name="buttonorder" value="Potwierdzam" />
                    </div>
                  </div>

                </div>

              <?php
              }
              ?>
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
<script>
  var orderValue = <?php echo number_format($total, 2); ?>;
  var deliveryValue = 0;
  var total = deliveryValue + orderValue;
  document.getElementById("calkowityKoszt").innerHTML = orderValue;
  document.getElementById("kosztDostawy").innerHTML = deliveryValue;
  $('[name="RadioButton"]').change(function() {
    deliveryValue = $('[name="RadioButton"]:checked').val();
    document.getElementById("kosztDostawy").innerHTML = deliveryValue;
    // alert($('[name="RadioButton"]:checked').val());
    document.getElementById("calkowityKoszt").innerHTML = eval(deliveryValue + "+" + orderValue).toFixed(2);
  });
</script>

</html>