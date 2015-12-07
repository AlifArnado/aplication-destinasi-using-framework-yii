CREATE DATABASE destinasi;
use destinasi;

create table provinsi(
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    propinsi varchar(50) DEFAULT NULL
) Engine=InnoDB;

INSERT INTO provinsi (id, propinsi) VALUES
(1, 'Daerah Istimewa Yogyakarta'),
(2, 'Jawa Tengah'),
(3, 'Jawa Barat'),
(4, 'Jawa Timur'),
(5, 'Banten');

CREATE TABLE kota (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    propinsi_id int(11) NOT NULL,
    nama_kota varchar(50) DEFAULT NULL,
    KEY FK_kota(propinsi_id),
    CONSTRAINT FK_kota FOREIGN KEY (propinsi_id) REFERENCES provinsi(id) ON DELETE CASCADE ON UPDATE CASCADE
) Engine=InnoDB;

INSERT INTO kota (propinsi_id, nama_kota) VALUES
(1,'Kodya Yogyakarta'),
(1,'Sleman'),
(1,'Bantul'),
(1,'Kulon Progo'),
(2,'Klaten'),
(2,'Magelang');

create table tbl_pegawai(
    nip int(8) not null PRIMARY KEY,
    nama varchar(30) not null,
    alamat varchar(40) NOT NULL,
    tanggal_lahir date,
    agama varchar(20)
);

INSERT INTO tbl_pegawai VALUES
('1038921','Paijo','Bantul','1998-01-30','Islam'),
('1038922','Ahmad','Sleman','1993-05-12','Islam'),
('1038923','Alif Benden Arnado','Klaten','1994-11-13','Islam'),
('1038924','Akbar Bondan Permana','Tangerang','2000-09-01','Islam'),
('1038925','Amelia Brenda SP','Tangerang','2005-07-08','Islam');
