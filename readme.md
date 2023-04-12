# 看房網
## 網頁安裝說明
### 資料庫設定
1. 首先開啟 XAMPP MySQL 使用 phpMyAdmin 匯入以下資料（全部複製到 SQL 貼上）：
```sql
--
-- 資料庫： `vr_house`
--
CREATE DATABASE IF NOT EXISTS `vr_house` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `vr_house`;

-- --------------------------------------------------------

--
-- 資料表結構 `house`
--

CREATE TABLE `house` (
  `id` int(11) NOT NULL,
  `landlord` int(11) NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rent` int(10) NOT NULL,
  `vr_url` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`images`)),
  `enable` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `landlord`
--

CREATE TABLE `landlord` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `tenant`
--

CREATE TABLE `tenant` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`id`),
  ADD KEY `landlord` (`landlord`);

--
-- 資料表索引 `landlord`
--
ALTER TABLE `landlord`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- 資料表索引 `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `house`
--
ALTER TABLE `house`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `landlord`
--
ALTER TABLE `landlord`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `house`
--
ALTER TABLE `house`
  ADD CONSTRAINT `house_ibfk_1` FOREIGN KEY (`landlord`) REFERENCES `landlord` (`id`);
```
![image](https://user-images.githubusercontent.com/84951972/177332272-a116628b-4174-49b7-998c-fb49d6304520.png)
![image](https://user-images.githubusercontent.com/84951972/177333008-56f751bd-23c8-4f34-a594-bee0d08947e4.png)



### 網頁伺服器設定
1. 設定 Apache 的 httpd.conf，找到 ``DocumentRoot`` 將路徑設為 ``vr-house`` 底下的 ``public`` 資料夾。
![image](https://user-images.githubusercontent.com/84951972/177332502-9813cf6b-5fe9-4657-85ac-01b759edd27d.png)
![image](https://user-images.githubusercontent.com/84951972/177332654-a384fbe0-1e96-4c14-a1d8-fb58aec98a0a.png)
1. 再依情況開啟 ``db.php`` 修改資料庫的連線資訊
![image](https://user-images.githubusercontent.com/84951972/177332836-5f4343ca-0e05-4370-9286-50c78a2274ae.png)
1. 重啟 Apache 開啟網頁即完成。


## 程式結構說明
- app: 程式邏輯的部分，依照各網頁對應相關的邏輯，網頁需要用到時才來調用，不公開在網路上
- parital: 網頁共用的元素，Navbar 及後臺側邊欄
- public: 各網頁的入口點，公開在網路上
- src: 開發時產生 css 會用到

## 本地開發說明
本專案 CSS 框架使用 Tailwind CSS，如果有需要自行修改樣式的需求，需要安裝 Node.js，在專案跟目錄輸入 ``npm run dev`` 會自動編譯 css。
