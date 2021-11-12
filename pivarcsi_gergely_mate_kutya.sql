-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Nov 12. 20:07
-- Kiszolgáló verziója: 10.4.17-MariaDB
-- PHP verzió: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `kutyak`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `kutya`
--

CREATE TABLE `kutya` (
  `id` int(15) NOT NULL,
  `nev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `fajta` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `kor` int(50) NOT NULL,
  `szul_ido` datetime NOT NULL,
  `gazda_nev` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `kutya`
--

INSERT INTO `kutya` (`id`, `nev`, `fajta`, `kor`, `szul_ido`, `gazda_nev`) VALUES
(8, 'Tarou', 'shiba inu', 3, '2018-06-07 00:00:00', 'Thoma'),
(9, 'Bodri', 'labrador', 4, '2017-06-01 00:00:00', 'Kis Pista Gézáné'),
(10, 'Gizi', 'keverék', 2, '2019-08-20 00:00:00', 'Simon Erika'),
(11, 'Fruzsi', 'keverék', 6, '2016-06-08 00:00:00', 'Simon Erika'),
(12, 'Dáffni', 'Airdale Terrier', 6, '2014-12-31 00:00:00', 'Simon Erika'),
(13, 'Gorou', 'Shiba inu', 3, '2018-02-09 00:00:00', 'Sangonomiya Kokomi'),
(14, 'Buksi', 'Foxterrier', 9, '2012-05-09 00:00:00', 'Kovács Erzsébet'),
(15, 'a', 'b', 3, '2021-12-31 00:00:00', 'l'),
(16, 'Zsömle', 'Bullterrier', 5, '2016-02-03 00:00:00', 'Erős Ferenc Béla');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `kutya`
--
ALTER TABLE `kutya`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `kutya`
--
ALTER TABLE `kutya`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
