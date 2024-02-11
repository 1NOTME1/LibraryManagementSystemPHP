-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 07:38 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarymanagementsystem`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ksiazki`
--

CREATE TABLE `ksiazki` (
  `KsiazkaID` int(11) NOT NULL,
  `Tytul` varchar(255) NOT NULL,
  `Autor` varchar(255) NOT NULL,
  `Rok_wydania` int(11) DEFAULT NULL,
  `Stan` enum('Dostępna','Wypożyczona') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `ksiazki`
--

INSERT INTO `ksiazki` (`KsiazkaID`, `Tytul`, `Autor`, `Rok_wydania`, `Stan`) VALUES
(2, 'Hobbit', 'J.R.R. Tolkien', 1941, 'Dostępna'),
(3, 'Harry Potter i Kamień Filozoficzny', 'J.K. Rowling', 1997, 'Dostępna'),
(12, 'Wiedźmin: Ostatnie życzenie', 'Andrzej Sapkowski', 1993, 'Dostępna'),
(13, 'Harry Potter i Kamień Filozoficzny', 'J.K. Rowling', 1997, 'Dostępna'),
(14, 'Hobbit, czyli tam i z powrotem', 'J.R.R. Tolkien', 1937, 'Wypożyczona'),
(15, 'Sto lat samotności', 'Gabriel García Márquez', 1967, 'Dostępna'),
(17, 'Mały Książę', 'Antoine de Saint-Exupéry', 1943, 'Dostępna'),
(18, '1984', 'George Orwell', 1949, 'Wypożyczona'),
(19, 'Atlas Chmur', 'David Mitchell', 2004, 'Dostępna'),
(20, 'Zbrodnia i kara', 'Fiodor Dostojewski', 1866, 'Dostępna'),
(21, 'Wielki Gatsby', 'F. Scott Fitzgerald', 1925, 'Dostępna'),
(22, 'Lalka', 'Bolesław Prus', 1890, 'Dostępna'),
(23, 'Gra o tron', 'George R.R. Martin', 1996, 'Dostępna'),
(24, 'Solaris', 'Stanisław Lem', 1961, 'Dostępna'),
(25, 'Niebezpieczne związki', 'Pierre Choderlos de Laclos', 1782, 'Dostępna'),
(26, 'Imię Róży', 'Umberto Eco', 1980, 'Dostępna');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `UzytkownikID` int(11) NOT NULL,
  `Imie` varchar(255) NOT NULL,
  `Nazwisko` varchar(255) NOT NULL,
  `Numer_telefonu` varchar(15) DEFAULT NULL,
  `Login` varchar(50) NOT NULL,
  `Haslo` varchar(255) NOT NULL,
  `Rola` enum('Admin','Uzytkownik') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`UzytkownikID`, `Imie`, `Nazwisko`, `Numer_telefonu`, `Login`, `Haslo`, `Rola`) VALUES
(1, 'michał', 'Kwaśniewski', '5674564565', 'mkwasniewski', '202cb962ac59075b964b07152d234b70', 'Uzytkownik'),
(2, 'janusz', 'kot', '987654321', 'januszkot', 'ec1e354d0c5c7ecfeb61c7f3dabf528d', 'Admin'),
(3, 'test', 'test', '123123123', 'test', 'cc03e747a6afbbcbf8be7668acfebee5', 'Uzytkownik'),
(5, '1', '1', '1', '1', 'c4ca4238a0b923820dcc509a6f75849b', 'Uzytkownik'),
(6, 'admin', ' ', '123123123', 'admin', '202cb962ac59075b964b07152d234b70', 'Admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `WypozyczenieID` int(11) NOT NULL,
  `KsiazkaID` int(11) DEFAULT NULL,
  `CzytelnikID` int(11) DEFAULT NULL,
  `Data_wypozyczenia` date NOT NULL,
  `Data_zwrotu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`WypozyczenieID`, `KsiazkaID`, `CzytelnikID`, `Data_wypozyczenia`, `Data_zwrotu`) VALUES
(22, 2, 1, '2024-02-03', '2024-02-03'),
(23, 3, 1, '2024-02-03', '2024-02-03'),
(25, 2, 1, '2024-02-03', NULL),
(26, 3, 1, '2024-02-03', '2024-02-03'),
(27, 14, 1, '2024-02-03', NULL),
(29, 18, 1, '2024-02-03', NULL),
(30, 22, 1, '2024-02-09', '2024-02-09');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `ksiazki`
--
ALTER TABLE `ksiazki`
  ADD PRIMARY KEY (`KsiazkaID`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`UzytkownikID`),
  ADD UNIQUE KEY `Login` (`Login`);

--
-- Indeksy dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD PRIMARY KEY (`WypozyczenieID`),
  ADD KEY `KsiazkaID` (`KsiazkaID`),
  ADD KEY `CzytelnikID` (`CzytelnikID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ksiazki`
--
ALTER TABLE `ksiazki`
  MODIFY `KsiazkaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `UzytkownikID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  MODIFY `WypozyczenieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_1` FOREIGN KEY (`KsiazkaID`) REFERENCES `ksiazki` (`KsiazkaID`),
  ADD CONSTRAINT `wypozyczenia_ibfk_2` FOREIGN KEY (`CzytelnikID`) REFERENCES `uzytkownicy` (`UzytkownikID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
