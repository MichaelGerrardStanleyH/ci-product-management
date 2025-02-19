## CodeIgniter 4 - Product Management Application

### Feature
- Login/Logout, NOTE: LOGIN MENGGUNAKAN USERNAME: admin, PASSWORD: admin
- CRUD ElectronicProduct extends dari BaseProduct
- CRUD FashionProduct extends dari BaseProduct
- Upload image

### Config database
- databaseName = ci4
- port: 3306
- username: root
- password: 12345
- jika ingin menggunakan konfigurasi sendiri bisa diubah pada file Electronic & Fashion di folder controller dan .env

### SQL DDL Query
CREATE TABLE base_product(
	id_base_product int AUTO_INCREMENT,
	name varchar(255),
    image varchar(255),
    PRIMARY KEY (id_base_product)
);

CREATE TABLE electronic_product(
	id_electronic_product int  AUTO_INCREMENT,
    electric int,
    id_base_product int,
    PRIMARY KEY(id_electronic_product)
);

ALTER TABLE electronic_product
ADD CONSTRAINT fk_base_product
FOREIGN KEY(id_base_product)
REFERENCES base_product(id_base_product) ON DELETE CASCADE;

CREATE TABLE fashion_product(
	id_fashion_product int  AUTO_INCREMENT,
    type varchar(255),
    id_base_product int,
    PRIMARY KEY(id_fashion_product)
);

ALTER TABLE fashion_product
ADD CONSTRAINT fk_base_product_fashion_product
FOREIGN KEY(id_base_product)
REFERENCES base_product(id_base_product) ON DELETE CASCADE;

### Git Command

- git clone: mengunggah project backend ke local
- git pull: mengambil perubahan berdasarkan commmitan terbaru

### Composer & Codeigniter Command
- composer install: install dependency-dependency yang dibutuhkan
- php spark serve: menjalankan aplikasi CodeIgniter4
- jalankan aplikasi di http://localhost:8080

