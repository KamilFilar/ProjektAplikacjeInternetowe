<?php
session_start();
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
  <link rel="stylesheet" href="./CSS/know_zone/wiedza.css">
  <link rel="shortcut icon" href="./CSS/ikona.ico" />
  <link rel="stylesheet" href="./CSS/main.css" />
  <script src="https://kit.fontawesome.com/a79ff52c1c.js" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {
      let tag = location.href.slice(location.href.indexOf("#") + 1, location.href.length);
      if (!!tag) {
        if (tag == "K%C5%82%C4%85czekurkumy" || tag == "K%C5%82%C4%85czepi%C4%99ciornika" || tag == "Kwiatostankocanek") {
          $("#carouselExampleControls").carousel(1);
        } else if (tag == "Tymianek" || tag == "Oregano" || tag == "Rozmaryn") {
          $("#carouselExampleControls").carousel(2);
        } else if (tag == "Kwiatybzu" || tag == "Kwiatostanlipy" || tag == "Bazylia") {
          $("#carouselExampleControls").carousel(3);
        }
        document.getElementById(tag).scrollIntoView();
        window.scrollBy(0, -($(".navbar").height() * 2));
      }
    });
  </script>
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

  <!-- Mid page -->
  <div class="main" style="font-family:Comic Sans MS, cursive, sans-serif;">
    <div class="container">
      <div class="background">
        <div class="row mb-5">
          <div class="col-12 text-center pt-4 pb-2">
            <div class="nagłówek">Strefa wiedzy</div>
          </div>
          <div class="col-12 pt-2 pb-4">
            <div id="carouselExampleControls" class="carousel slide" data-interval="false">
              <div class="carousel-inner">
                <div class="carousel-item active" data-slide="0">
                  <div class="row">
                    <div class="col-1">
                    </div>
                    <div class="col-10 text-center">
                      <div class="row justify-content-center">
                        <div class="col-2"><a class="carousel-control-prev controll" href="#carouselExampleControls" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a></div>
                        <div class="col-6">
                          <h4><b>Morwa biała, </br> Skrzyp polny, </br> Kolendra</h4></b>
                        </div>
                        <div class="col-2"><a class="carousel-control-next controll" href="#carouselExampleControls" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a></div>
                      </div>
                      <div class="links"></div>
                    </div>
                    <div class="col-1">
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjMORWA1.jpg" width="320" height="250" alt="Morwa biała" id="Morwabia%C5%82a">
                      <h3>
                        <p class="detail">Morwa biała <br /><span class="name">Morusa alba L.<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Liście morwy stanowią cenne źródło substancji odżywczych oraz leczniczych. W suchej masie liści znakomitą
                        większość stanowią białka (15,31-30,91%) oraz błonnik pokarmowy (27,6-43,6%) (2, 9).
                        Surowcem zielarski z powodzeniem wykorzystywany jest do celów leczniczych. Odwar z liści morwy stosowany jest jako
                        środek napotny oraz do płukania w stanach zapalnych gardła. Preparaty otrzymywane z morwy białej wykazują silne
                        działanie przeciwgrzybicze, przeciwbakteryjne oraz przeciwwirusowe. Ze względu na dużą zawartość związków o różnej budowie
                        chemicznej (zwłaszcza DNJ i kwercetyny), które obniżają poziom glukozy we krwi, morwa biała jest skutecznym środkiem wspomagającym
                        leczenie cukrzycy typu II.

                        <br /><br /><b>Uprawa:</b><br />
                        Morwa biała jest rośliną dość łatwą w uprawie. Preferuje słoneczne stanowiska i lekkie, piaszczyste lub gliniaste średniożyzne gleby
                        o odczynie obojętnym. Roślina wytwarza wiele odrostów korzeniowych i pozytywnie reaguje na cięcie. W ostre zimy w chłodniejszych
                        regionach Polski może przemarzać, więc wymaga osłon na zimę (w szczególności młode okazy). Drzewo jest stosunkowo mało podatne na
                        choroby i szkodniki. </div>
                    </div>
                    <div class="col-12">
                      <hr>
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjSKRZYPpolny1.jpg" width="320" height="250" alt="skrzyp" id="Skrzyppolny">
                      <h3>
                        <p class="detail">Ziele skrzypu polnego<br /><span class="name">Equiseti herba<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Skład chemiczny: flawonoidy: kwercetyna, kemferol, luteolina, apigenina, izokwercytryna;6-10% związków krzemu, częściowo w
                        postaci rozpuszczalnej;sole mineralne (głównie potasu);fenolokwasy: kwas kawowy;ekwizetolowy związki o charakterze saponin
                        Skrzyp polny to roślina, której właściwości lecznicze od dawna są wykorzystywane w medynie naturalnej. Dzięki obecności flawonoidów
                        zwiększa objętość wydalanego moczu i usuwa nadmiar moczanów, w związku z tym odwary z tej rośliny stosuje się jako słaby środek
                        moczopędny w mało nasilonych schorzeniach dróg moczowych. Działa również łagodnie rozkurczowo na drogi żółciowe i moczowe, a tak
                        że uszczelnia ściany naczyń krwionośnych.
                        <br /><br /><b>Uprawa:</b><br />
                        Na metrze kwadratowym należy sadzić 3-5 sadzonek skrzypu. Można też utworzyć z nich małe grupy po 10 sztuk.
                        Skrzyp zimowy jest bardzo długowieczny. Najlepiej jest pozostawić go na tym samym miejscu przez wiele lat bez przesadzania.
                        Aby ograniczyć jego agresywne rozprzestrzenianie się poprzez rozłogi i odrosty, trzeba sadzić go w gruncie w dużym pojemniku,
                        albo zakopać na głębokość co najmniej 30 cm odpowiednie zapory. Przycięcie łodyg wykonuje się wiosną.
                      </div>
                    </div>
                    <div class="col-12">
                      <hr>
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjKOLENDRA1.jpg" width="320" height="250" alt="kolendra" id="Kolendra">
                      <h3>
                        <p class="detail">Owoc kolendry<br /><span class="name">Coriandri Fructus<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Skład chemiczny: 45-60% śluzów, galaktomannany WP=6 flawonoidy, saponiny,lipidy, białko.
                        Kolendra jest rośliną, która ceniona jest głównie ze względu na swoje właściwości lecznicze, które posiadają
                        zarówno nasiona, jak i liście. Stosowana jest jako zioło wspomagające pracę układu pokarmowego. Jest polecana przy
                        niestrawnościach, biegunce czy zapaleniu błony śluzowej żołądka.
                        Wykazuje również właściwości przeciwbakteryjne, pomaga przy zwalczaniu gronkowca, bakterii E.coli czy salmonelli.
                        Liście kolendry działają oczyszczająco, wspomagając usuwanie z organizmu metali ciężkich. Napar z liści kolendry
                        zawiera olejek eteryczny, działający uspokajająco w stanach ogólnego zmęczenia.
                        <br /><br /><b>Uprawa:</b><br />
                        Kolendra siewna, jak większość orientalnych ziół, lubi miejsca ciepłe, dobrze nasłonecznione. Gleba nie powinna być ani kwaśna,
                        ani wilgotna.
                        Nasiona kolendry wysiewa się bezpośrednio do gruntu wczesną wiosną; zakiełkują już po dwóch tygodniach. Młoda kolendra wymaga
                        regularnego i obfitego podlewania. Przy starszych roślinach, szczególnie gdy pojawią się owoce, należy zminimalizować podlewanie,
                        a wręcz przesuszyć roślinę w czasie upalnych, bezdeszczowych dni. Podłoże należy często odchwaszczać i spulchniać między grządkami.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item" data-slide="1">
                  <div class="row">
                    <div class="col-1">
                    </div>
                    <div class="col-10  text-center">
                      <div class="row justify-content-center">
                        <div class="col-2"><a class="carousel-control-prev controll" href="#carouselExampleControls" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a></div>
                        <div class="col-6">
                          <h4><b>Kłącze kurkumy, </br> Kłącze pięciornika, </br> Kwiatostan kocanek</h4></b>
                        </div>
                        <div class="col-2"><a class="carousel-control-next controll" href="#carouselExampleControls" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a></div>
                      </div>
                      <div class="links"></div>
                    </div>
                    <div class="col-1">
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjKURKUMA1.png" width="320" height="250" alt="Morwa biała" id="K%C5%82%C4%85czekurkumy">
                      <h3>
                        <p class="detail">Kłącze kurkumy <br /><span class="name">Curcumae xanthorrhizae Rhizoma<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Podstawowym składnikiem Curcuma longa jest kurkumina – przeciwutleniacz polifenolowy z grupy kurkumoidów. Ponad to, w kurkumie
                        zawarte są wotaminy z rodizny B: B1, B2, B3, B6, B9, witamina E oraz K, a także związki mineralne, takie jak wapń, mangan, potas,
                        żelazo, magnez, fosfor, sód, miedź oraz cynk.
                        Surowiec wykazuje ona wiele właściwości prozdrowotnych.
                        Wykorzystywana jest jako lek na bóle menstruacyjne, środek łagodzący objawy chorób pasożytniczych i układu oddechowego,
                        a także w leczeniu wrzodów żołądka, niedrożności wątroby i rożnego rodzaju stanów zapalnych. Działa przeciwwirusowo, przeciwzapalnie,
                        przeciw pasożytniczo oraz obniża steżenie cholesterolu.


                        <br /><br /><b>Uprawa:</b><br />
                        Kurkuma jest rośliną wymagającą. Potrzebuje sporo wilgoci i ciepła (średnio 28 - 30 stopni C).
                        Jeśli lato nie jest ciepłe, roślinę należy hodować w domu. Wymaga stanowiska słonecznego, ale nie lubi bezpośredniego słońca.
                        Warto osłonić ją inną rośliną lub np. kratką z pnączem. W trakcie wzrostu należy kurkumę podlewać umiarkowanie i pilnować,
                        by ziemia była wciąż wilgotna. Woda nie powinna gromadzić się w podstawce, jej nadmiar trzeba usuwać. </div>
                    </div>
                    <div class="col-12">
                      <hr>
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjPIĘCIORNIK1.jpg" width="320" height="250" alt="skrzyp" id="K%C5%82%C4%85czepi%C4%99ciornika">
                      <h3>
                        <p class="detail">Kłącze pięciornika <br /><span class="name">Tormentillae Rhizoma<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        1 g produktu leczniczego zawiera 1 g Potentilla erecta (L.) Raeusch (Potentilla tormentilla Stokes), rhizoma (kłącze pięciornika).
                        Pięciornik stosowany jest w medycynie i ziołolecznictwie do leczenia biegunek, dolegliwości błony śluzowej gardła i jamy ustnej,
                        zatruć i zapaleń jelit. Wywar z pięciornika może pomóc w leczeniu aft oraz owrzodzeń jamy ustnej.

                        <br /><br /><b>Uprawa:</b><br />
                        Pięciornik krzewiasty jest łatwy w uprawie. Rośnie szybko - nawet do 30 cm rocznie. Jest bardzo odporny na mrozy, upały,
                        susze i zanieczyszczenia powietrza. Rzadko atakują go szkodniki. Może rosnąć na glebach piaszczystych oraz gliniasto-piaszczystych,
                        przepuszczalnych. Na wilgotniejszym podłożu kwitnie długo i obficie. Nie toleruje dużej ilości wapnia w glebie - wtedy liście żółkną,
                        a krzew choruje.
                      </div>
                    </div>
                    <div class="col-12">
                      <hr>
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjKWIATOSTANKOT.jpg" width="320" height="250" alt="kolendra" id="Kwiatostankocanek">
                      <h3>
                        <p class="detail">Kwiatostan kocanek<br /><span class="name">Helichrysi inflorescentia<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Skład: surowiec zawiera związki flawonoidowe (ok. 4%), garbniki, substancje gorzkie, kwasy organiczne i niewielkie ilości olejku.
                        Substancje zawarte w kwiatostanach kocanek wykazują działanie żółciopędne.
                        Kwiatostan kocanek wchodzi w skład mieszanek ziołowych stosowanych w chorobach wątroby i woreczka żółciowego (kamicy żółciowej,
                        zapaleniu pęcherzyka żółciowego i dróg żółciowych itp.). Wykorzystywany jest także w leczeniu nieżytu i nerwicy żołądka. Zmniejsza
                        napięcie mięśni gładkich jelit, pęcherzyka żółciowego i przewodów żółciowych.

                        <br /><br /><b>Uprawa:</b><br />
                        Kocanka piaskowa nie jest trudna w uprawie. Najlepiej rośnie na słonecznych stanowiskach, o podłożu przepuszczalnym,
                        żwirowatym i niezbyt żyznym. Rozmnażamy roślinę z nasion lub przez podział podziemnego kłącza. Można także nasadzać sadzonki,
                        uzyskane z pędu, pozyskane wiosną lub jesienią.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item" data-slide="2">
                  <div class="row">
                    <div class="col-1">
                    </div>
                    <div class="col-10  text-center">
                      <div class="row justify-content-center">
                        <div class="col-2"><a class="carousel-control-prev controll" href="#carouselExampleControls" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a></div>
                        <div class="col-6">
                          <h4><b>Tymianek właściwy, </br> Oregano, </br> Rozmaryn</h4></b>
                        </div>
                        <div class="col-2"><a class="carousel-control-next controll" href="#carouselExampleControls" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a></div>
                      </div>
                      <div class="links"></div>
                    </div>
                    <div class="col-1">
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjTYMIANEK.jpg" width="320" height="250" alt="Morwa biała" id="Tymianek">
                      <h3>
                        <p class="detail">Tymianek właściwy <br /><span class="name">Thymus vulgaris L.<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Skład chemiczny: ziele tymianku zawiera olejek eteryczny w ilości do 3,5%, niekiedy nawet do 5,4%. W olejku znajduje
                        się 20 do 50% pochodnych fenolowych - tymolu i karwakrolu, ponadto cyneol, cymen, α-pinen, linalol, octan linalolu,
                        borneol i octan bornylu.
                        Tymianek ma szerokie działanie zdrowotne. Przede wszystkim wykazuje silne właściwości przeciwbakteryjne i przeciwzapalne.
                        W naturalnej medycynie wykorzystywany jest do leczenia dolegliwości układu pokarmowego i moczowego. Pomaga przy biegunkach,
                        zaparciach i niestrawnościach. Dodany do potraw ułatwia ich trawienie i przyspiesza przemianę materii. Ponadto łagodzi
                        schorzenia jelit, żołądka i wątroby.
                        <br /><br /><b>Uprawa:</b><br />
                        Tymianek powinno się uprawiać na stanowiskach słonecznych i ciepłych. Preferuje gleby
                        przepuszczalne (i jednocześnie umiarkowanie wilgotne), zasobne w wapń, o pH 5,5–6,5.
                        Nie należy uprawiać go na glebach zbyt suchych, podmokłych i kwaśnych. Roślinę warto
                        nawozić (jeśli wcześniej nie zastosowaliśmy nawozu organicznego) od później wiosny do końca lata.
                        Podlewanie wykonuje się w czasie długo utrzymującej się
                      </div>
                    </div>
                    <div class="col-12">
                      <hr>
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjOREGANO.jpg" width="320" height="250" alt="skrzyp" id="Oregano">
                      <h3>
                        <p class="detail">Oregano <br /><span class="name">Origanum vulgare L.<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Skład chemiczny: ziele zawiera do 3% olejku, bogatego w fenole, jak karwakrol i tymol (ryc. 2), których
                        ilość może sięgać do 60%. W olejku znaleziono też octan tymolu i p-cymen. Poza tym zawiera seskwiterpeny, katechinę,
                        kwasy fenolowe (p-hydrobenzoesowy, wanilinowy, kawowy, o- i p-kumarowy, ferulowy, galusowy, rozmarynowy, chlorogenowy i
                        dihydroksy- kawowy) oraz flawonoidy.
                        Ziele oregano pobudza w nieznacznym stopniu czynności wydzielnicze narządów. Zwiększa sekrecję śliny, soku żołądkowego
                        i żółci, usprawniając procesy przyswajania i trawienia pokarmów. Wzmaga również wydzielanie śluzu, zwłaszcza przez błony
                        śluzowe górnych dróg oddechowych, ponadto reguluje czynności gruczołów potowych oraz nerek, zwiększając łagodnie ilość wydalanego
                        moczu.
                        <br /><br /><b>Uprawa:</b><br />
                        Oregano potrzebuje stanowisk dobrze nasłonecznionych, ciepłych. Dobrze rośnie w niezbyt żyznych, umiarkowanie suchych i
                        dobrze przepuszczalnych podłożach o odczynie zbliżonym do obojętnego. Radzi sobie w jałowej kamienistej glebie, nie znosi
                        natomiast nadmiaru wilgoci.
                        Mrozoodporność lebiodki zależy od odmiany, podstawowy gatunek wytrzymuje nawet do -20 st. C.

                      </div>
                    </div>
                    <div class="col-12">
                      <hr>
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjROZMARYN.jpg" width="320" height="250" alt="kolendra" id="Rozmaryn">
                      <h3>
                        <p class="detail">Rozmaryn <br /><span class="name">Rosmarinus L.<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Rozmaryn lekarski zajmuje centralne miejsce w europejskiej medycynie ziołowej. Jako zioło posiadające właściwości
                        rozgrzewające, rozmaryn lekarski pobudza krążenie krwi do głowy, poprawia koncentrację oraz pamięć. Uważa się, że
                        rozmaryn podnosi niskie ciśnienie krwi i dlatego jest tak cenionym ziołem w przypadkach omdleń oraz słabości związanych z
                        ograniczonym krążeniem krwi. Zioło to jest cenione za posiadanie właściwości "podnoszenia na duchu" i jest pożyteczne w leczeniu
                        łagodnej i umiarkowanej depresji.

                        <br /><br /><b>Uprawa:</b><br />
                        W strefie mrozoodporności 6 i zimniejszych rozmaryn powinno sadzić się w doniczkach,
                        by móc przenieść je do cieplejszego pomieszczenia na wypadek chłodniejszej aury. Rozmaryn nadaje się na niski
                        żywopłot ozdobny – swobodnie można nadać mu dowolny kształt poprzez przycinanie. Doskonale czuje się sadzony w
                        donicach na tarasach i balkonach wraz z innymi roślinami lubiącymi słońce, a także w zacisznych rabatach naszego ogrodu.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="carousel-item" data-slide="3">
                  <div class="row">
                    <div class="col-1">
                    </div>
                    <div class="col-10  text-center">
                      <div class="row justify-content-center">
                        <div class="col-2"><a class="carousel-control-prev controll" href="#carouselExampleControls" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a></div>
                        <div class="col-6">
                          <h4><b>Kwiatostan bzu czarnego, </br> Kwiatostan lipy, </br> Bazylia</h4></b>
                        </div>
                        <div class="col-2"><a class="carousel-control-next controll" href="#carouselExampleControls" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a></div>
                      </div>
                      <div class="links"></div>
                    </div>
                    <div class="col-1">
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjBZU1.jpg" width="320" height="250" alt="Morwa biała" id="Kwiatybzu">
                      <h3>
                        <p class="detail">Kwiat bzu czarnego <br /><span class="name">Sambuci flos<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Owoce bzu czarnego zawierają: antocyjany, flawonoidy, garbniki, witaminy, kwasy organiczne, cukry i pektyny.
                        Kwiaty czarnego bzu stosowane są jako środek leczniczy na wszelkiego rodzaju przeziębienia i infekcje dróg oddechowych,
                        zwłaszcza z gorączką i kaszlem. Napar działa napotnie, pomagając obniżyć temperaturę ciała, oraz wykrztuśnie, pomagając
                        pozbyć się wydzieliny przy mokrym kaszlu. Wspomaga również układ odpornościowy w walce z chorobą, działa ponadto przeciwzapalnie
                        i odkażająco na błony śluzowe.
                        <br /><br /><b>Uprawa:</b><br />
                        Uprawiając czarny bez dla owoców, powinno się go sadzić w miejscach słonecznych i ciepłych, ale gorzej rośnie na stanowiskach o
                        wystawie południowej. Krzew znakomicie radzi sobie także w półcieniu.
                        Toleruje różne typy podłoży (w tym jałowe, suche i okresowo podmokłe). Najlepsze do uprawy bzu czarnego są gleby przepuszczalne,
                        próchnicze, średnio wilgotne, zasobne w związki azotowe i wapń, o pH 5,5-6,5.

                      </div>
                    </div>
                    <div class="col-12">
                      <hr>
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjLIPA1.png" width="320" height="250" alt="skrzyp" id="Kwiatostanlipy">
                      <h3>
                        <p class="detail">Kwiatostan lipy <br /><span class="name">Tilae inflorescentia<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Skład: głównymi związkami czynnymi surowca są flawonoidy, olejek eteryczny oraz związki śluzowe. We frakcji flawonoidowej
                        przeważają pochodne kwercetyny i kemferolu. Występuje w niej również tylirozyd.
                        Kwiaty lipy są cenione za swoje działanie napotne, dlatego świetnie wspomagają kurację w przypadku przeziębienia, grypy,
                        anginy, zapalenia gardła, krtani czy oskrzeli. W takich dolegliwościach sprawdzą się również inne składniki rośliny, przede
                        wszystkim śluzy i olejki eteryczne.
                        <br /><br /><b>Uprawa:</b><br />
                        Lipy nie są wymagające co do siedliska. Najlepiej rosną w miejscach słonecznych i półcienistych, preferują gleby żyzne i
                        przepuszczalne, ale tolerują też słabsze. Najlepiej, aby podłoże miało odczyn obojętny.

                      </div>
                    </div>
                    <div class="col-12">
                      <hr>
                    </div>
                    <div class="col-12 text-center pt-4 px-5">
                      <img src="./CSS/Zdj_ziola/zdjBAZYLIA1.jpg" width="320" height="250" alt="kolendra" id="Bazylia">
                      <h3>
                        <p class="detail" id="Bazylia">Bazylia pospolita<br /><span class="name">Ocimum basilicum L.<br /><br /></span>
                      </h3>
                      <div class="TextHerbs">
                        Skład chemiczny: zawiera 0,5 do 1,5 % olejku lotnego o bogatym składzie. Ponadto 5-6 % garbników, saponinę, flawonoidy, enzymy i
                        kwasy organiczne.
                        Surowiec Ma działanie rozkurczowe, wiatropędne i moczopędne, przeciwzapalne, przeciwwirusowe, przeciwbakteryjne i przeciwgrzybicze.
                        Świetnie reguluje pracę przewodu pokarmowego. Działa też wykrztuśnie. Nawet używana w małych ilościach jako przyprawa pobudza
                        wydzielanie soku żołądkowego, wzmacnia apetyt i reguluje trawienie. Do celów kulinarnych należy zbierać ziele przed kwitnieniem.
                        <br /><br /><b>Uprawa:</b><br />
                        Jest to roślina z cieplejszej strefy klimatycznej, dlatego wymaga stanowiska słonecznego, osłoniętego od wiatru.
                        Bazylia pospolita najlepiej rośnie w glebie lekkiej, przepuszczalnej. Należy jednak dbać aby gleba była stale wilgotna.
                        Pielęgnacja bazylii jest w zasadzie bardzo prosta, należy jedynie pamiętać o regularnym podlewaniu. Warto też uszczykiwać
                        wierzchołki pędów, co pozwoli rozkrzewiać się roślinie
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
  jQuery(window).load(function() {
    $('.carousel').carousel('pause');
  });
</script>
</body>

</html>