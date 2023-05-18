-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 18 May 2023, 00:46:16
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ecomsoft`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `picture` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `about`
--

INSERT INTO `about` (`id`, `title`, `description`, `picture`) VALUES
(1, 'deneme başlık', 'deneme açıklama biraz uzun olmalı', '1683930176.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `advert`
--

CREATE TABLE `advert` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `picture` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `advert`
--

INSERT INTO `advert` (`id`, `title`, `description`, `picture`) VALUES
(1, 'hgkhgjk', 'ghghsfdgfdsghfdghsfgjgfhjkhgk ghghsfdgfdsghfdghsfgjgfhjkhgk ghghsfdgfdsghfdghsfgjgfhjkhgk sdfkghjfs dlksdfghnf sldfjghfdsdfkghjfs dlksdfghnf sldfjghfdghghsfdgfdsghfdghsfgjgfhjkhgk ghghsfdgfdsghfdghsfgjgfhjkhgk sdfkghjfs dlksdfghnf sldfjghfdsdfkghjfs dlksd', '1683162702.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `banner1` varchar(60) NOT NULL,
  `banner2` varchar(60) NOT NULL,
  `banner3` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `banner`
--

INSERT INTO `banner` (`id`, `banner1`, `banner2`, `banner3`) VALUES
(1, '1683157781.jpg', '1683157756.jpg', '1683157760.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `secenek` varchar(60) NOT NULL,
  `secenekfiyat` varchar(60) NOT NULL,
  `secenekdeger` varchar(255) NOT NULL,
  `varyant` varchar(255) NOT NULL,
  `adet` int(11) NOT NULL DEFAULT 1,
  `kupon` varchar(60) NOT NULL,
  `urunId` int(11) NOT NULL,
  `uyeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `basket`
--

INSERT INTO `basket` (`id`, `secenek`, `secenekfiyat`, `secenekdeger`, `varyant`, `adet`, `kupon`, `urunId`, `uyeId`) VALUES
(92, '0', '', '', '', 4, '', 57, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `picture` varchar(60) NOT NULL,
  `metaTitle` varchar(60) NOT NULL,
  `metaDescription` varchar(255) NOT NULL,
  `metaKeywords` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `brands`
--

INSERT INTO `brands` (`id`, `name`, `description`, `status`, `picture`, `metaTitle`, `metaDescription`, `metaKeywords`) VALUES
(2, 'Örnek Marka', 'Örnek Marka Açıklaması', 1, '1679364225.jpg', 'Örnek Marka Meta Başlığı', 'Örnek Marka Meta Açıklaması', 'Örnek Marka Meta Başlığı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `picture` varchar(60) NOT NULL,
  `topCategory` int(11) NOT NULL DEFAULT 0,
  `metaTitle` varchar(60) NOT NULL,
  `metaDescription` varchar(255) NOT NULL,
  `metaKeywords` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `status`, `picture`, `topCategory`, `metaTitle`, `metaDescription`, `metaKeywords`) VALUES
(16, 'Örnek Kategori', 'Örnek Ürün Tanımı', 1, '1682970299.jpg', 0, 'Meta Başlık', 'Meta Açıklama', 'Meta Kelime'),
(37, 'Örnek Kategori 2', '1', 1, '', 0, '1', '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `title`, `message`) VALUES
(3, 'Serkan Karadağ', 'serkan@gmail.com', 'Deneme Konu Başlığı', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, consectetur delectus doloremque enim eos error esse et exercitationem facere fugit illum ipsam iure laborum maxime nam natus nisi numquam odit placeat quia quos sed sequi tempora volupt');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `code` varchar(60) NOT NULL,
  `discount` varchar(60) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `discount`, `status`) VALUES
(6, 'İndirim', 'serkan10', '100', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `managers`
--

CREATE TABLE `managers` (
  `id` int(11) NOT NULL,
  `picture` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `adress` varchar(255) NOT NULL,
  `city` varchar(60) NOT NULL,
  `district` varchar(60) NOT NULL,
  `postCode` int(11) NOT NULL,
  `country` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `managers`
--

INSERT INTO `managers` (`id`, `picture`, `name`, `email`, `password`, `phone`, `description`, `status`, `adress`, `city`, `district`, `postCode`, `country`) VALUES
(2, '1679444743.jpg', 'Serkan Karadağ', 'serkan@gmail.com', '98943a650633c7dc7893f53ef2a79f6b', '536 459 0214', '', 1, 'Samandıra Osmangazi mh. Semerkand sk. No: 5 Daire: 1', 'İstanbul', 'Sancaktepe', 34000, 'TR');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `city` varchar(60) NOT NULL,
  `district` varchar(60) NOT NULL,
  `postCode` int(11) NOT NULL,
  `country` varchar(60) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `members`
--

INSERT INTO `members` (`id`, `name`, `email`, `password`, `phone`, `description`, `adress`, `city`, `district`, `postCode`, `country`, `status`) VALUES
(3, 'Serkan Karadağ', 'serkan@gmail.com', 'b3360cc45c2819fc1ea9b0f16c15fdee', '05364590214', '', 'İstanbul Sancaktepe', '', '', 0, '', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `adres` text NOT NULL,
  `numara` varchar(60) NOT NULL,
  `siparisnot` varchar(255) NOT NULL,
  `toplamTutar` varchar(60) NOT NULL,
  `kuponsuzTutar` varchar(60) NOT NULL,
  `secenek` int(11) NOT NULL,
  `secenekdeger` text NOT NULL,
  `urunbilgi` text NOT NULL,
  `kupon` varchar(60) NOT NULL,
  `uyeId` int(11) NOT NULL,
  `siparisNo` varchar(60) NOT NULL,
  `durum` int(11) NOT NULL DEFAULT 0,
  `tarih` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `adres`, `numara`, `siparisnot`, `toplamTutar`, `kuponsuzTutar`, `secenek`, `secenekdeger`, `urunbilgi`, `kupon`, `uyeId`, `siparisNo`, `durum`, `tarih`) VALUES
(32, 'Serkan Karadağ', 'mserkankradg@gmail.com', 'osmangazi mahallesi semerkand sokak no 5 daire 1 İstanbul / Sancaktepe', '05364590214', 'Örnek Sipariş Notu', '5560', '5460', 60, '[\"Ürün Seçenek 1\",\"Ürün Seçenek 2\",\"Ürün Seçenek 1\"]', '[{\"id\":\"57\",\"adet\":\"2\",\"varyant\":\"39\"},{\"id\":\"58\",\"adet\":\"1\",\"varyant\":\"\"},{\"id\":\"57\",\"adet\":\"4\",\"varyant\":\"41\"}]', '100', 3, '1485039112', 0, '17.05.2023'),
(33, 'Serkan Karadağ', 'mserkankradg@gmail.com', 'osmangazi mahallesi semerkand sokak no 5 daire 1 İstanbul / Sancaktepe', '05364590214', 'dffsdf', '3500', '3500', 0, '', '[{\"id\":\"58\",\"adet\":\"4\",\"varyant\":\"\"},{\"id\":\"58\",\"adet\":\"1\",\"varyant\":\"\"}]', '', 3, '636552610', 0, '17.05.2023');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `productfeature`
--

CREATE TABLE `productfeature` (
  `id` int(11) NOT NULL,
  `variantGroup` varchar(60) NOT NULL,
  `variantContent` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `category` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `picture` varchar(60) NOT NULL,
  `pictures` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `discountType` int(11) NOT NULL DEFAULT 1,
  `discount` int(11) NOT NULL DEFAULT 0,
  `kdv` int(11) NOT NULL,
  `discountedPrice` varchar(60) NOT NULL,
  `stockCode` varchar(60) NOT NULL,
  `barcode` varchar(60) NOT NULL,
  `stockShelf` int(11) NOT NULL,
  `stockTank` int(11) NOT NULL,
  `optionUrun` text NOT NULL,
  `secenekfiyat` varchar(60) NOT NULL,
  `metaTitle` varchar(50) NOT NULL,
  `metaDescription` varchar(255) NOT NULL,
  `metaKeywords` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `status`, `category`, `brand`, `picture`, `pictures`, `price`, `discountType`, `discount`, `kdv`, `discountedPrice`, `stockCode`, `barcode`, `stockShelf`, `stockTank`, `optionUrun`, `secenekfiyat`, `metaTitle`, `metaDescription`, `metaKeywords`) VALUES
(57, 'Örnek Varyantlı Ürün', 'Örnek Varyantlı Ürün Açıklaması', 1, 16, 2, '1684119855.jpg', '[\"16841198550.png\",\"16841198552.jpg\",\"16841198553.png\",\"16841198554.jpg\"]', 1000, 2, 20, 10, '800', 'A523453', '4324324', 100, 1000, '[\"Ürün Seçenek 1\",\"Ürün Seçenek 2\"]', '20', 'ornekurunbaslik', 'ornekurunaciklama', 'ornekurunkelime'),
(58, 'Örnek Ürün', 'Örnek Ürün Açıklaması', 1, 16, 2, '1684218508.png', '[\"16842185080.png\",\"16842185082.jpg\"]', 1000, 3, 300, 10, '700', 'A523454', '4324323', 100, 1000, '[\"\"]', '', 'ornekurun', 'ornekurun', 'ornekurun');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `metaTitle` varchar(60) NOT NULL,
  `metaDescription` varchar(255) NOT NULL,
  `metaKeywords` varchar(255) NOT NULL,
  `logo` varchar(60) NOT NULL,
  `favicon` varchar(60) NOT NULL,
  `shopName` varchar(60) NOT NULL,
  `shopOwner` varchar(60) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `country` varchar(60) NOT NULL,
  `language` varchar(60) NOT NULL,
  `currency` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `metaTitle`, `metaDescription`, `metaKeywords`, `logo`, `favicon`, `shopName`, `shopOwner`, `address`, `mail`, `phone`, `instagram`, `twitter`, `youtube`, `facebook`, `country`, `language`, `currency`) VALUES
(1, '1', '2', '3', '1683946167.png', '1681993134.jpg', 'shopier', 'serkan', 'Osmangazi Mh. Semerkand Sk No 5 İstanbul / Sancaktepe', 'serkan@gmail.com', '5364590214', 'www.instagram.com/mirackrdag/', 'www.twitter.com/mirackrdag', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `variantoptions`
--

CREATE TABLE `variantoptions` (
  `id` int(11) NOT NULL,
  `variantGroup` varchar(60) NOT NULL,
  `variantContent` varchar(60) NOT NULL,
  `groupId` int(11) NOT NULL,
  `productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `variantoptions`
--

INSERT INTO `variantoptions` (`id`, `variantGroup`, `variantContent`, `groupId`, `productId`) VALUES
(62, 'Numaralar', '[\"37\",\"38\",\"39\",\"40\",\"41\"]', 0, 57);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `variants`
--

CREATE TABLE `variants` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `contents` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `picture` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Tablo döküm verisi `variants`
--

INSERT INTO `variants` (`id`, `name`, `contents`, `status`, `picture`) VALUES
(38, 'Numaralar', '[\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\"]', 1, ''),
(39, 'Renkler', '[\"Sarı\",\"Mavi\",\"Yeşil\",\"Kırmızı\",\"Siyah\",\"Beyaz\"]', 1, '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `productfeature`
--
ALTER TABLE `productfeature`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `variantoptions`
--
ALTER TABLE `variantoptions`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `advert`
--
ALTER TABLE `advert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- Tablo için AUTO_INCREMENT değeri `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Tablo için AUTO_INCREMENT değeri `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Tablo için AUTO_INCREMENT değeri `productfeature`
--
ALTER TABLE `productfeature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `variantoptions`
--
ALTER TABLE `variantoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Tablo için AUTO_INCREMENT değeri `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
