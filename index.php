<?php
session_start();

$database_name = "zielarnia";
$con = mysqli_connect("localhost", "root", "", $database_name);
if (isset($_POST["add"])) {
  if (isset($_SESSION["cart"])) {
    $item_array_id = array_column($_SESSION["cart"], "product_id");
    if (!in_array($_GET["id"], $item_array_id)) {
      $count = count($_SESSION["cart"]);
      if ($_POST["quantity"] <= 0) {
        echo '<script>alert("Liczba porduktów musi być większa od 0! Do zamówienia została dodana automatycznie domyślna ilość produktów.")</script>';
        echo '<script>window.location="index.php"</script>';
        $_POST["quantity"] = 1;
      }
      // if (!is_numeric($_POST['quantity'])) {
      //   echo '<script>alert("Liczba porduktów musi być cyfrą! Do zamówienia została dodana automatycznie domyślna ilość produktów.")</script>';
      //   echo '<script>window.location="index.php"</script>';
      //   $_POST["quantity"] = 1;
      // }
      if (!ctype_digit($_POST['quantity'])) {
        echo '<script>alert("Liczba porduktów musi być cyfrą całkowitą! Do zamówienia została dodana automatycznie domyślna ilość produktów.")</script>';
        echo '<script>window.location="index.php"</script>';
        $_POST["quantity"] = 1;
      }
      $item_array = array(
        'product_id' => $_GET["id"],
        'item_name' => $_POST["hidden_name"],
        'product_price' => $_POST["hidden_price"],
        'item_quantity' => $_POST["quantity"],
      );
      $_SESSION["cart"][$count] = $item_array;
      echo '<script>window.location="index.php"</script>';
    } else {
      echo '<script>alert("Posiadasz już ten produkt w koszyku! Jeżeli chcesz zmienić jego ilość, najpierw usuń go z koszyka!")</script>';
      echo '<script>window.location="index.php"</script>';
    }
  } else {
    $item_array = array(
      'product_id' => $_GET["id"],
      'item_name' => $_POST["hidden_name"],
      'product_price' => $_POST["hidden_price"],
      'item_quantity' => $_POST["quantity"],
    );
    $_SESSION["cart"][0] = $item_array;
  }
}

if (isset($_GET["action"])) {
  if ($_GET["action"] == "delete") {
    foreach ($_SESSION["cart"] as $keys => $value) {
      if ($value["product_id"] == $_GET["id"]) {
        unset($_SESSION["cart"][$keys]);
        echo '<script>window.location="koszyk.php"</script>';
      }
    }
  }
}
?>

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
  <link rel="stylesheet" href="./CSS/idnex/index.css">
  <link rel="shortcut icon" href="./CSS/ikona.ico" />
  <link rel="stylesheet" href="./CSS/main.css" />
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
        <div class="col-12 col-md-6 offset-md-3 pb-2 text-center pt-4 pb-2">
          <div class="svg-wrapper">
            <svg class="svg" height="60" width="420" xmlns="http://www.w3.org/2000/svg">
              <rect class="shape" height="60" width="420" />
              <div class="text">Nasza oferta </div>
            </svg>
          </div>
        </div>
        <script>
          $(function() {
            $('.shape').addClass("shape-border");
            $('.svg-wrapper').click(function() {
              $('.shape').toggleClass('shape-border');
            });
          });
        </script>
        <?php
        $query = "SELECT * FROM produkty ORDER BY ID_Produktu ASC ";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="col-12 col-md-6 col-lg-4 text-center">
              <form method="post" action="index.php?action=add&id=<?php echo $row["ID_Produktu"]; ?>">
                <div class="product">
                  <img src="<?php echo $row["Zdjecie"]; ?>" width="250px" height="180px" style="margin-bottom:5px;" class="alignleft size-medium wp-image-7000">
                  <h5 class="text-info1">
                    <?php echo $row["Nazwa_produktu"]; ?></h5>
                  <h5 class="text-info2">
                    <?php echo $row["Cena"];
                    echo ' PLN' ?></h5>
                  <div style="display:flex; flex-direction: row; justify-content: center; align-items: center">
                    <input type="text" name="quantity" id="quantity" class="form-control" value="1" />
                    <label name="quantity"> /szt.</label></div>
                  <input type="hidden" name="hidden_name" value="<?php echo $row["Nazwa_produktu"]; ?>">
                  <input type="hidden" name="hidden_price" value="<?php echo $row["Cena"]; ?>">
                  <input type="submit" name="add" style="margin-top: 7px;" class="btn btn-success" value="Dodaj do koszyka"><br />
                  <a href="knowledge_zone.php#<?php echo str_replace(' ', '', $row["Nazwa_produktu"]); ?>"><input type="button" value="Więcej"></a><br />
                  <div class="DownBOX">Opakowanie zawiera <?php echo $row["Ilosc"]; ?>g produktu.</div>

                </div>
              </form>
            </div>
        <?php
          }
        }
        ?>
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