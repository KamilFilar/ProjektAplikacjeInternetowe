-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Maj 2020, 18:58
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `zielarnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adres`
--

CREATE TABLE `adres` (
  `ID_Adres` int(11) NOT NULL,
  `Miejscowosc` varchar(255) NOT NULL,
  `Ulica` varchar(255) NOT NULL,
  `Kod_Pocztowy` varchar(255) NOT NULL,
  `Nr_Domu` varchar(5) NOT NULL,
  `Nr_Lokalu` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `adres`
--

INSERT INTO `adres` (`ID_Adres`, `Miejscowosc`, `Ulica`, `Kod_Pocztowy`, `Nr_Domu`, `Nr_Lokalu`) VALUES
(1, 'Przeworsk', 'Błotna', '32-542', '673', '0'),
(2, 'Przeworsk', 'Kopisto', '23', '51a', '0'),
(3, 'Rzeszów', 'Jagiellońska', '32-142', '673', '0'),
(4, 'Rzeszów', 'Kopisto', '32-542', '673', '27'),
(5, 'Przeworsk', 'Jagiellońska', '37-200', '14', '4'),
(6, 'Przeworsk', 'Wodna', '37-500', '13', '2'),
(7, 'Przeworsk', 'Wodna', '32-542', '543b', '0'),
(8, 'Kraków', 'Polna', '00-457', '15', '15'),
(9, 'Warszawa', 'Polna', '32-142', '543b', '0'),
(10, 'Poznań', 'Jagiellońska', '37-200', '543b', '2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dostawcy`
--

CREATE TABLE `dostawcy` (
  `ID_Dostawcy` int(11) NOT NULL,
  `Nazwa_Dostawcy` varchar(255) NOT NULL,
  `Czas_realizacji` int(10) NOT NULL,
  `Koszt` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `dostawcy`
--

INSERT INTO `dostawcy` (`ID_Dostawcy`, `Nazwa_Dostawcy`, `Czas_realizacji`, `Koszt`) VALUES
(1, 'DHL', 3, 16.82),
(2, 'Fedex', 4, 13.52),
(3, 'InPost', 2, 25.05);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konto`
--

CREATE TABLE `konto` (
  `ID_Konta` int(11) NOT NULL,
  `ID_Adres` int(11) NOT NULL,
  `Imie` varchar(20) NOT NULL,
  `Nazwisko` varchar(30) NOT NULL,
  `Mail` tinytext NOT NULL,
  `Numer_Telefonu` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `konto`
--

INSERT INTO `konto` (`ID_Konta`, `ID_Adres`, `Imie`, `Nazwisko`, `Mail`, `Numer_Telefonu`) VALUES
(1, 1, 'Krzysztof', 'Strzałka', 'szaka99931@o2.pl', 999222000),
(2, 2, 'Bartek', 'Curzytek', 'szaka9991@o2.pl', 999222111),
(3, 3, 'Kacper', 'Janusz', 'FilarKamil04@gmail.com', 999222333),
(4, 4, 'Janusz', 'Czopek', 'CycuKoks@gmail.com', 999222114),
(5, 5, 'Paulina', 'Bomba', 'Bebebe418@gmail.com', 722247918),
(6, 6, 'Adam', 'Hipolit', 'ja@op.pl', 333444555),
(7, 7, 'Kamil', 'Filar', 'FilarKamil05@gmail.com', 999222113),
(8, 8, 'Xi', 'Pi', 'test1@gmail.com', 999999000),
(9, 9, 'Janusz', 'Curzytek', 'CycuuKoks@gmail.com', 999222111),
(10, 10, 'Bartek', 'Curzytek', 's2zaka9991@o2.pl', 999222000);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konto_logowanie`
--

CREATE TABLE `konto_logowanie` (
  `ID_Konta` int(11) NOT NULL,
  `UserLogin` varchar(20) NOT NULL,
  `Haslo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `konto_logowanie`
--

INSERT INTO `konto_logowanie` (`ID_Konta`, `UserLogin`, `Haslo`) VALUES
(1, 'szaka', '$2y$10$SnwUS3h73coM5i1zhq46TO22xyKSIrLuTDDHUUaxE2me30X/GizWW'),
(2, 'cycu321', '$2y$10$zXL9iSBm717ov6W4hjoggOA/Gu4fTVsF2DuOtN3uS5Db76L8jYd1i'),
(3, 'adam5', '$2y$10$pRCzhi3C5/rdlklCV0dsT.xaqoUAJXqRqNc3KWUzJ3DkPMQNfy5ii'),
(4, 'Cycu', '$2y$10$vMIN0Y0pXciwJBaActHcoOvWBeCp5nEgdbHINBtZQ4BT72FRhllXG'),
(5, 'Paulina', '$2y$10$Ql6bSLjSzZLj0Llq17joLOY5SASRQFc9UfBOlVmIHlMU74KPocE/a'),
(6, 'adam', '$2y$10$Njh13lEEUTailJKyq2VQIOa3bpT5.V7fvrfxoAWEtBXoWIlITnXVi'),
(7, 'Kamil2', '$2y$10$EMmdl4uMSIHUZ.zpbbuqxOft1A4ImGJgxwtoA2i9PogVaPUUuwcZe'),
(8, 'test1', '$2y$10$iVRlDEMALNVRMau4kLtlhOxaECr8UBqKhpdiYr7HV11xMHdjVxe4e'),
(9, 'szaka12', '$2y$10$fB7VsxAH/kfzEjxMSY/K4OuLA.o1dw6Tt/8gFZsT1FBTOj6AE9gu6'),
(10, 'szaka27', '$2y$10$C4ghWdMp4KMT3D7Hc5W0xOCpGr6b.HcEGvgMYKv/O2MbApNIVXh/a');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `ID_Produktu` int(11) NOT NULL,
  `Nazwa_produktu` varchar(255) NOT NULL,
  `Zdjecie` varchar(255) NOT NULL,
  `Ilosc` double NOT NULL,
  `Cena` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`ID_Produktu`, `Nazwa_produktu`, `Zdjecie`, `Ilosc`, `Cena`) VALUES
(1, 'Bazylia', 'zdjBAZYLIA1.jpg', 100, 3.99),
(2, 'Morwa biała', 'zdjMORWA1.jpg', 100, 5.49),
(3, 'Skrzyp polny', 'zdjSKRZYPpolny1.jpg', 85, 4.99),
(4, 'Kolendra', 'zdjKOLENDRA1.jpg', 100, 2.99),
(5, 'Kłącze kurkumy', 'zdjKURKUMA1.png', 100, 6.99),
(6, 'Kłącze pięciornika', 'zdjPIĘCIORNIK1.jpg', 100, 5.99),
(7, 'Kwiatostan kocanek', 'zdjKWIATOSTANKOT.jpg', 100, 3.99),
(8, 'Kwiaty bzu', 'zdjBZU1.jpg', 100, 3.99),
(9, 'Kwiatostan lipy', 'zdjLIPA1.png', 60, 5.99),
(10, 'Oregano', 'zdjOREGANO.jpg', 200, 4.49),
(11, 'Tymianek', 'zdjTYMIANEK.jpg', 100, 3.99),
(12, 'Rozmaryn', 'zdjROZMARYN.jpg', 100, 4.49);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `ID_Zamowienia` int(11) NOT NULL,
  `ID_Konta` int(11) NOT NULL,
  `ID_Dostawcy` int(11) NOT NULL,
  `FullCost` float NOT NULL,
  `ActDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia`
--

INSERT INTO `zamowienia` (`ID_Zamowienia`, `ID_Konta`, `ID_Dostawcy`, `FullCost`, `ActDate`) VALUES
(28, 2, 3, 39.52, '2020-05-12'),
(29, 2, 2, 18.51, '2020-05-14'),
(30, 2, 2, 23, '2020-05-22'),
(31, 2, 1, 31.29, '2020-05-01'),
(32, 2, 2, 240.07, '2020-05-20'),
(39, 1, 2, 73.4, '2020-05-18'),
(60, 1, 2, 31.99, '2020-05-27'),
(61, 1, 2, 23, '2020-05-04'),
(63, 1, 3, 41.02, '2020-05-06'),
(64, 1, 3, 34.53, '2020-05-10'),
(65, 5, 1, 25.8, '2020-05-10'),
(66, 5, 2, 27.99, '2020-05-10'),
(67, 5, 2, 229.14, '2020-05-10'),
(68, 5, 1, 74.2, '2020-05-10'),
(69, 1, 2, 23, '2020-05-10'),
(70, 1, 2, 20.51, '2020-05-11'),
(71, 6, 2, 28.99, '2020-05-11'),
(72, 6, 3, 105.36, '2020-05-11'),
(73, 6, 2, 21.5, '2020-05-12'),
(74, 7, 2, 25, '2020-05-12'),
(75, 8, 3, 39.52, '2020-05-14'),
(76, 8, 2, 19.01, '2020-05-14'),
(77, 8, 1, 35.78, '2020-05-14'),
(78, 8, 2, 30.49, '2020-05-15'),
(79, 8, 1, 135.53, '2020-05-15');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia_produkty`
--

CREATE TABLE `zamowienia_produkty` (
  `id_zamowienia` int(11) NOT NULL,
  `id_produktu` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zamowienia_produkty`
--

INSERT INTO `zamowienia_produkty` (`id_zamowienia`, `id_produktu`, `ilosc`) VALUES
(28, 3, 1),
(28, 2, 1),
(28, 1, 1),
(29, 3, 1),
(30, 1, 1),
(30, 2, 1),
(31, 1, 1),
(31, 2, 1),
(31, 3, 1),
(32, 1, 1),
(32, 2, 2),
(32, 3, 3),
(32, 4, 4),
(32, 5, 5),
(32, 6, 6),
(32, 7, 7),
(32, 8, 8),
(32, 9, 9),
(39, 3, 12),
(60, 2, 1),
(60, 5, 1),
(60, 6, 1),
(61, 1, 1),
(61, 2, 1),
(63, 5, 1),
(63, 12, 1),
(63, 10, 1),
(64, 1, 1),
(64, 2, 1),
(65, 4, 1),
(65, 6, 1),
(66, 1, 1),
(66, 2, 1),
(66, 3, 1),
(67, 5, 14),
(67, 9, 11),
(67, 7, 13),
(68, 1, 1),
(68, 2, 1),
(68, 3, 1),
(68, 4, 1),
(68, 5, 1),
(68, 6, 1),
(68, 7, 1),
(68, 8, 1),
(68, 9, 1),
(68, 10, 1),
(68, 11, 1),
(68, 12, 1),
(69, 2, 1),
(69, 1, 1),
(70, 5, 1),
(71, 2, 1),
(71, 3, 2),
(71, 4, 0),
(72, 2, 1),
(72, 3, 1),
(72, 8, 12),
(72, 9, 1),
(72, 4, 1),
(72, 7, 1),
(72, 10, 1),
(72, 12, 1),
(73, 3, 1),
(73, 4, 1),
(74, 6, 1),
(74, 2, 1),
(75, 3, 1),
(75, 2, 1),
(75, 1, 1),
(76, 2, 1),
(77, 3, 1),
(77, 7, 1),
(77, 8, 1),
(77, 9, 1),
(78, 6, 1),
(78, 1, 1),
(78, 5, 1),
(79, 8, 25),
(79, 12, 3),
(79, 2, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dostawcy`
--
ALTER TABLE `dostawcy`
  ADD PRIMARY KEY (`ID_Dostawcy`),
  ADD KEY `ID_Dostawcy` (`ID_Dostawcy`);

--
-- Indeksy dla tabeli `konto`
--
ALTER TABLE `konto`
  ADD PRIMARY KEY (`ID_Adres`);

--
-- Indeksy dla tabeli `konto_logowanie`
--
ALTER TABLE `konto_logowanie`
  ADD PRIMARY KEY (`ID_Konta`),
  ADD KEY `ID_Konta` (`ID_Konta`);

--
-- Indeksy dla tabeli `produkty`
--
ALTER TABLE `produkty`
  ADD PRIMARY KEY (`ID_Produktu`),
  ADD KEY `ID_Produktu` (`ID_Produktu`),
  ADD KEY `ID_Produktu_2` (`ID_Produktu`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`ID_Zamowienia`),
  ADD KEY `ID_Konta` (`ID_Konta`),
  ADD KEY `ID_Dostawcy` (`ID_Dostawcy`);

--
-- Indeksy dla tabeli `zamowienia_produkty`
--
ALTER TABLE `zamowienia_produkty`
  ADD KEY `id_zamowienia` (`id_zamowienia`),
  ADD KEY `id_produktu` (`id_produktu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `dostawcy`
--
ALTER TABLE `dostawcy`
  MODIFY `ID_Dostawcy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `konto`
--
ALTER TABLE `konto`
  MODIFY `ID_Adres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `konto_logowanie`
--
ALTER TABLE `konto_logowanie`
  MODIFY `ID_Konta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `produkty`
--
ALTER TABLE `produkty`
  MODIFY `ID_Produktu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `ID_Zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD CONSTRAINT `zamowienia_ibfk_1` FOREIGN KEY (`ID_Dostawcy`) REFERENCES `dostawcy` (`ID_Dostawcy`),
  ADD CONSTRAINT `zamowienia_ibfk_2` FOREIGN KEY (`ID_Konta`) REFERENCES `konto_logowanie` (`ID_Konta`);

--
-- Ograniczenia dla tabeli `zamowienia_produkty`
--
ALTER TABLE `zamowienia_produkty`
  ADD CONSTRAINT `zamowienia_produkty_ibfk_2` FOREIGN KEY (`id_produktu`) REFERENCES `produkty` (`ID_Produktu`),
  ADD CONSTRAINT `zamowienia_produkty_ibfk_3` FOREIGN KEY (`id_zamowienia`) REFERENCES `zamowienia` (`ID_Zamowienia`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
