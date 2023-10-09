# IKOMERS
<h2 align="center">
    IKOMERS : Website Jual Beli Produk<br/>
</h2>
<hr>

> Disusun untuk memenuhi Tugas Milestone 1 - Monolithic PHP & Vanilla Web Application IF3110 Pengembangan Aplikasi Berbasis Web tahun 2023/2024 

## Table of Contents
1. [General Info](#general-information)
2. [Creator Info](#creator-information)
3. [Features](#features)
4. [Technologies Used](#technologies-used)
5. [Setup](#setup)
6. [Usage](#usage)
7. [Screenshots](#screenshots)
8. [Structure](#structure)
9. [Job Description](#jobdesc)
10. [Lighthouse Evidence](#lighthouse)

<a name="general-information"></a>

## General Information
**IKOMERS** merupakan sebuah _website_ jual beli produk yang dibangun untuk memenuhi kebutuhan pengguna dalam melakukan sebuah transaksi jual beli. _Website_ IKOMERS dibangun dengan memanfaatkan teknolgi pembangunan _web_ standar seperti HTML, CSS, dan JavaScript vanilla, serta didukung oleh DBMS (PostgreSQL/MariaDB/MySQL). Aplikasi ini memiliki dua _role user_ , yaitu: **User Biasa** sebagai pembeli dan **Admin** sebagai penjual. Setiap peran memiliki akses dan fungsi yang berbeda-beda. Pembeli dapat membeli suatu barang dengan skema: melihat barang yang ada di _product list_, menambahkannya ke _cart_, lalu melakukan _checkout_. Pembeli dapat melihat apakah transaksinya telah disetujui penjual (admin) atau belum pada *page order*. Sementara admin, dapat menambahkan dan melakukan edit pada produk, menyetujui atau menggagalkan transaksi produk, serta melihat daftar seluruh pesanan yang ada. Kedua _role user_ juga dapat melakukan _edit profile_ pada _page setting_. Selain itu, aplikasi IKOMERS telah menerapkah kaidah _Responsive Web_ sehingga tampilan antarmuka dapat digunakan pada berbagai macam resolusi.

<a name="creator-information"></a>

## Creator Information

| Nama                        | NIM      | E-Mail                      |
| --------------------------- | -------- | --------------------------- |
| Michael Utama               | 13521137 | 13521137@std.stei.itb.ac.id |
| Edia Zaki Naufal Ilman      | 13521141 | 13521141@std.stei.itb.ac.id |
| Mohammad Rifqi Farhansyah   | 13521166 | 13521166@std.stei.itb.ac.id |

<a name="features"></a>

## Features
1. Cart Page (Daftar produk yang hendak dibeli oleh pembeli) - diakses oleh Pembeli
2. Checkout Page (Halaman untuk pembeli menyelesaikan pemesanan) - diakses oleh Pembeli
3. History Page (Halaman untuk menampilkan seluruh daftar transaksi) - diakses oleh Admin
4. Home (Halaman awal dari website) - diakses oleh Admin dan Pembeli
5. Not-Found Page (Halaman untuk menampilkan page yang tidak tersedia) - diakses oleh Admin dan Pembeli
6. Order Page (Halaman untuk menampilkan status transaksi oleh pembeli) - diakses oleh Pembeli
7. Product List Page (Halaman untuk menampilkan daftar produk) - diakses oleh Pembeli
8. Product Detail Page (Halaman detail dari tiap produk) - diakses oleh Pembeli
9. Product Search Page (Halaman untuk mencari produk) - diakses oleh Pembeli
10. Product Add Page (Halaman untuk menambahkan Produk) - diakses oleh Admin
11. Product Edit Page (Halaman untuk melakukan edit Produk) - diakses oleh Admin
12. Transaction Page (Halaman untuk memberikan konfirmasi penyelesaian transaksi) - diakses oleh Admin
13. Login Page (Halaman untuk melakukan login) - diakses oleh Admin dan Pembeli
14. Register Page (Halaman untuk melakukan register) - diakses oleh Admin dan Pembeli
15. Setting Page (Halaman untuk melakukan pengaturan profil) - diakses oleh Admin dan Pembeli
16. Navbar & Sidebar (Komponen tambahan pada _website_) - diakses oleh Admin dan Pembeli

<a name="technologies-used"></a>

## Technologies Used
- PHP
- HTML
- CSS
- Javascript
- MySQL
- Docker

<a name="setup"></a>

## Setup
### Cara Instalasi
1. Unduh dan _install_ seluruh kakas yang diperlukan untuk menjalankan _website_ ini
2. _Clone repository_ ini dengan menggunakan perintah `https://github.com/Michaelu670/IF3110-Milestone1.git` pada terminal komputer Anda.
4. Buka _directory_ hasil _clone repository_ Anda di terminal.
3. Lakukan pembuatan _image_ Docker yang akan digunakan oleh aplikasi ini dengan menjalankan perintah `docker build -t tubes-1:latest .` pada terminal Anda.
4. Buatlah sebuah file `.env` yang bersesuaian dengan penggunaan (contoh file tersebut dapat dilihat pada `.env.example`).

### Cara Menjalankan _Server_
1. Anda dapat menjalankan program ini dengan menggunakan perintah `docker-compose up` pada terminal Anda.
2. Aplikasi _web_ dapat diakses dengan menggunakan browser pada URL `http://localhost:8080/public/user/login`.
3. Secara default aplikasi _web_ akan dijalankan pada `PORT:8080`.
4. Aplikasi _web_ dapat dihentikan dengan menjalankan perintah `docker-compose down` pada terminal Anda.

<a name="usage"></a>

## Usage
1. Ikuti langkah instalasi aplikasi dan server pada poin [Setup](#setup).
2. Lakukan proses _login_ apabila sudah memiliki akun serta _register_ apabila belum memiliki akun.
3. Akses halaman dan fungsionalitas sesuai dengan _role user_ yang dimiliki.

<a name="screenshots"></a>

## Screenshots
<p>
  <p>Gambar 1. Login Page</p>
  <img src="/img/tampilan/ssLogin.png/">
  <nl>
  <p>Gambar 2. Register Page</p>
  <img src="/img/tampilan/ssRegister.png/">
  <nl>
  <p>Gambar 3. Cart Page</p>
  <img src="/img/tampilan/ssCart.png/">
  <nl>
  <p>Gambar 4. Checkout Page</p>
  <img src="/img/tampilan/ssCheckout.png/">
  <nl>
  <p>Gambar 5. History Page</p>
  <img src="/img/tampilan/ssHistory.png/">
  <nl>
  <p>Gambar 6. Not Found Page</p>
  <img src="/img/tampilan/ssNotFound.png/">
  <nl>
  <p>Gambar 7. Order Page</p>
  <img src="/img/tampilan/ssOrder.png/">
  <nl>
  <p>Gambar 8. ProductList Page</p>
  <img src="/img/tampilan/ssProductList.png/">
  <nl>
  <p>Gambar 9. ProductDetail Page</p>
  <img src="/img/tampilan/ssProductDetail.png/">
  <nl>
  <p>Gambar 10. ProductSearch Page</p>
  <img src="/img/tampilan/ssProductSearch.png/">
  <nl>
  <p>Gambar 14. Transaction Page</p>
  <img src="/img/tampilan/ssTransaction.png/">
  <nl>
</p>

<a name="structure"></a>

## Structure
```bash
│   .env.example
│   .gitignore
│   docker-compose.yml
│   Dockerfile
│   README.md
│
├───img
│   ├───lighthouse
│   │       ssCart.png
│   │       ssCheckout.png
│   │       ssHistory.png
│   │       ssHome.png
│   │       ssLogin.png
│   │       ssOrder.png
│   │       ssProductAdd.png
│   │       ssProductDetail.png
│   │       ssProductList.png
│   │       ssProductSearch.png
│   │       ssRegister.png
│   │       ssSettings.png
│   │       ssTransaction.png
│   │
│   └───tampilan
│           ssCart.png
│           ssCheckout.png
│           ssHistory.png
│           ssHome.png
│           ssLogin.png
│           ssNotFound.png
│           ssOrder.png
│           ssProductAdd.png
│           ssProductDetail.png
│           ssProductList.png
│           ssProductSearch.png
│           ssRegister.png
│           ssSettings.png
│           ssTransaction.png
│
├───migrations
│       init.sql
│
├───scripts
│       build-image.sh
│
└───src
    ├───app
    │   │   .htaccess
    │   │   init.php
    │   │
    │   ├───component
    │   │   ├───cart
    │   │   │       CartItem.php
    │   │   │       CartPage.php
    │   │   │
    │   │   ├───checkout
    │   │   │       CartSummary.php
    │   │   │       CheckoutPage.php
    │   │   │
    │   │   ├───history
    │   │   │       HistoryItem.php
    │   │   │       HistoryPage.php
    │   │   │
    │   │   ├───home
    │   │   │       HomePage.php
    │   │   │
    │   │   ├───not-found
    │   │   │       ExceptionPage.php
    │   │   │       NotFoundPage.php
    │   │   │
    │   │   ├───order
    │   │   │       OrderItem.php
    │   │   │       OrderPage.php
    │   │   │
    │   │   ├───product
    │   │   │       AddProductPage.php
    │   │   │       AdminProductPage.php
    │   │   │       ProductCard.php
    │   │   │       ProductDetailPage.php
    │   │   │       ProductSearchPage.php
    │   │   │       ProductSearchResult.php
    │   │   │       TagCheckbox.php
    │   │   │       TagOption.php
    │   │   │
    │   │   ├───template
    │   │   │       Navbar.php
    │   │   │       Pagination.php
    │   │   │       Sidebar.php
    │   │   │       SlideshowContent.php
    │   │   │
    │   │   ├───transaction
    │   │   │       TransactionItem.php
    │   │   │       TransactionPage.php
    │   │   │
    │   │   └───user
    │   │           LoginPage.php
    │   │           RegisterPage.php
    │   │           SettingPage.php
    │   │
    │   ├───config
    │   │       config.php
    │   │
    │   ├───controllers
    │   │       CartController.php
    │   │       CheckoutController.php
    │   │       HistoryController.php
    │   │       HomeController.php
    │   │       NotFoundController.php
    │   │       OrderController.php
    │   │       ProductController.php
    │   │       SearchController.php
    │   │       TransactionController.php
    │   │       UserController.php
    │   │
    │   ├───core
    │   │       App.php
    │   │       Controller.php
    │   │       database.php
    │   │       StorageAccess.php
    │   │
    │   ├───exceptions
    │   │       LoggedException.php
    │   │
    │   ├───interface
    │   │       ControllerInterface.php
    │   │       ViewInterface.php
    │   │
    │   ├───middleware
    │   │       AuthenticationMiddleware.php
    │   │       TokenMiddleware.php
    │   │
    │   ├───model
    │   │       CartModel.php
    │   │       HistoryModel.php
    │   │       OrderModel.php
    │   │       ProductModel.php
    │   │       TagModel.php
    │   │       TransactionModel.php
    │   │       UserModel.php
    │   │
    │   └───view
    │       ├───cart
    │       │       CartView.php
    │       │
    │       ├───checkout
    │       │       CheckoutView.php
    │       │
    │       ├───history
    │       │       HistoryView.php
    │       │
    │       ├───home
    │       │       MainView.php
    │       │
    │       ├───not-found
    │       │       ExceptionView.php
    │       │       NotFoundView.php
    │       │
    │       ├───order
    │       │       OrderView.php
    │       │
    │       ├───product
    │       │       ProductDetailView.php
    │       │       ProductEditView.php
    │       │       ProductSearchTemplateView.php
    │       │       ProductSearchView.php
    │       │
    │       ├───transaction
    │       │       TransactionView.php
    │       │
    │       └───user
    │               LoginView.php
    │               RegisterView.php
    │               SettingView.php
    │
    ├───public
    │   │   .htaccess
    │   │   index.php
    │   │
    │   ├───images
    │   │   ├───assets
    │   │   │       bars.svg
    │   │   │       logo-color.png
    │   │   │       logo-color.svg
    │   │   │       logo-light.png
    │   │   │       logo-light.svg
    │   │   │       logo-teks-color.png
    │   │   │       logo-text-color.svg
    │   │   │       logo-text-light.png
    │   │   │       logo-text-light.svg
    │   │   │       search.svg
    │   │   │
    │   │   └───icon
    │   │           android-chrome-192x192.png
    │   │           android-chrome-512x512.png
    │   │           apple-touch-icon.png
    │   │           avatar-icon.png
    │   │           favicon-16x16.png
    │   │           favicon-32x32.png
    │   │           favicon.ico
    │   │           site.webmanifest
    │   │
    │   ├───javascript
    │   │   ├───checkout
    │   │   │       checkout.js
    │   │   │
    │   │   ├───component
    │   │   │       navbar.js
    │   │   │       searchpage.js
    │   │   │       searchresult.js
    │   │   │       slideshow.js
    │   │   │
    │   │   ├───home
    │   │   │       home.js
    │   │   │
    │   │   ├───lib
    │   │   │       debounce.js
    │   │   │       xhr.js
    │   │   │
    │   │   ├───product
    │   │   │       AddProduct.js
    │   │   │       AdminProductDetail.js
    │   │   │
    │   │   ├───setting
    │   │   │       setting.js
    │   │   │
    │   │   └───user
    │   │           login.js
    │   │           register.js
    │   │
    │   └───styles
    │       ├───cart
    │       │       cart.css
    │       │
    │       ├───checkout
    │       │       checkout.css
    │       │
    │       ├───history
    │       │       history.css
    │       │
    │       ├───home
    │       │       home.css
    │       │
    │       ├───not-found
    │       │       not-found.css
    │       │
    │       ├───order
    │       │       order.css
    │       │
    │       ├───product
    │       │       adminProduct-detail.css
    │       │       product-detail.css
    │       │       search-result.css
    │       │       searchPage.css
    │       │
    │       ├───setting
    │       │       setting.css
    │       │
    │       ├───template
    │       │       global.css
    │       │       navbar.css
    │       │       sidebar.css
    │       │
    │       ├───transaction
    │       │       transaction.css
    │       │
    │       └───user
    │               login.css
    │               register.css
    │               user-list.css
    │
    └───storage
        ├───images
        │   │   .gitkeep
        │   │   02d5b23d0b7d78ec558e0aa682096a72.png
        │   │   user.svg
        │   │
        │   └───product
        │       ├───media
        │       │       Spongebob_sepatu_dua.png
        │       │       Spongebob_sepatu_satu.png
        │       │
        │       └───thumbnail
        │               default.jpg
        │
        └───videos
                .gitkeep
                Ini adalah video.mp4
```

<a name="jobdesc">

## Job Description

### _Server Side_

| Fitur                    | NIM      |
| ------------------------ | -------- |
| Login                    | 13521166 |
| Register                 | 13521166 |
| Home                     | 13521166 |
| Cart                     | 13521137 |
| Checkout                 | 13521141 |
| History                  | 13521166 |
| Not-Found                | 13521166 |
| Order                    | 13521166 |
| Product List             | 13521137 |
| Product Detail           | 13521137 |
| Product Search           | 13521137 |
| Product Add              | 13521141 |
| Product Edit             | 13521141 |
| Transaction              | 13521166 |
| Setting                  | 13521141 |
| Navbar & Sidebar         | 13521166 |

### _Server Side_

| Fitur                    | NIM      |
| ------------------------ | -------- |
| Login                    | 13521166 |
| Register                 | 13521166 |
| Home                     | 13521166 |
| Cart                     | 13521137 |
| Checkout                 | 13521141 |
| History                  | 13521166 |
| Not-Found                | 13521166 |
| Order                    | 13521166 |
| Product List             | 13521137 |
| Product Detail           | 13521137 |
| Product Search           | 13521137 |
| Product Add              | 13521141 |
| Product Edit             | 13521141 |
| Transaction              | 13521166 |
| Setting                  | 13521141 |
| Navbar & Sidebar         | 13521166 |

<a name="lighthouse">

## Lighthouse Evidence

<p>
  <p>Gambar 1. Login Page</p>
  <img src="/img/lighthouse/ssLogin.png/">
  <nl>
  <p>Gambar 2. Register Page</p>
  <img src="/img/lighthouse/ssRegister.png/">
  <nl>
  <p>Gambar 3. Home Page</p>
  <img src="/img/lighthouse/ssHome.png/">
  <nl>
  <p>Gambar 4. Cart Page</p>
  <img src="/img/lighthouse/ssCart.png/">
  <nl>
  <p>Gambar 5. Checkout Page</p>
  <img src="/img/lighthouse/ssCheckout.png/">
  <nl>
  <p>Gambar 6. History Page</p>
  <img src="/img/lighthouse/ssHistory.png/">
  <nl>
  <p>Gambar 7. Order Page</p>
  <img src="/img/lighthouse/ssOrder.png/">
  <nl>
  <p>Gambar 8. ProductList Page</p>
  <img src="/img/lighthouse/ssProductList.png/">
  <nl>
  <p>Gambar 9. ProductSearch Page</p>
  <img src="/img/lighthouse/ssProductSearch.png/">
  <nl>
  <p>Gambar 10. Transaction Page</p>
  <img src="/img/lighthouse/ssTransaction.png/">
  <nl>
</p>