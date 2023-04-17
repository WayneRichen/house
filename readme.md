# 找好屋
## 網頁安裝說明
### 資料庫設定
1. 首先開啟 XAMPP MySQL 使用 phpMyAdmin 匯入 house.sql 檔案

### 網頁伺服器設定
1. 設定 Apache 的 httpd.conf，找到 ``DocumentRoot`` 將路徑設為 ``house`` 底下的 ``public`` 資料夾。
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
