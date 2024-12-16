/*
	Judul		: Pembuatan Database Sistem Pencatatan Prestasi Kelompok 4
	Kelas-Prodi : 2G-Teknik Informatika
	Jurusan		: Teknologi Informasi
				  Politeknik Negeri Malang
*/

-- create database
CREATE DATABASE SistemPrestasi;

-- use database
USE SistemPrestasi;

-- create tables
CREATE TABLE akun (
	username VARCHAR(50)  NOT NULL PRIMARY KEY,
	password VARCHAR(50) NOT NULL, 
	status varchar(10) CHECK (status IN ('aktif', 'lulus/pindah', 'inaktif','pending')) NOT NULL,
	role VARCHAR(10) CHECK (role IN ('mahasiswa', 'dosen', 'admin')) NOT NULL,
	profilPath VARCHAR (100) NULL
);

CREATE TABLE mahasiswa (
	nim VARCHAR(50) NOT NULL PRIMARY KEY, 
	nama VARCHAR(100) NOT NULL,
	email VARCHAR(60) NOT NULL UNIQUE, 
	namaProdi VARCHAR(25) NOT NULL
);

CREATE TABLE dosen (
	nip VARCHAR(50) NOT NULL PRIMARY KEY, 
	nama VARCHAR(100) NOT NULL, 
	namaJurusan VARCHAR(25) NOT NULL, 
	email VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE admin (
	idAdmin VARCHAR(50) NOT NULL PRIMARY KEY, 
	nama VARCHAR(100) NOT NULL
);

CREATE TABLE prestasi (
	idPrestasi INT IDENTITY NOT NULL PRIMARY KEY, 
	tanggalPengajuan DATE NOT NULL,
	namaLomba VARCHAR(50) NOT NULL, 
	waktu DATE NULL, 
	penyelenggara VARCHAR(50) NOT NULL, 
	tingkat VARCHAR(25) NOT NULL,
	bidang VARCHAR(25) NOT NULL, 
	jenis VARCHAR(25) NOT NULL,
	nipDosenPembimbing VARCHAR(50) NOT NULL, 
	nimMahasiswa VARCHAR(50) NOT NULL,
	sertifikatPath VARCHAR(100) NOT NULL,
	dokumentasiPath VARCHAR(100) NOT NULL,
	suratTugasPath VARCHAR(100) NOT NULL, 
	idAdmin VARCHAR(50)NULL, 
	status VARCHAR(15) NOT NULL CHECK (status IN ('diproses', 'diterimaDosen','diterimaAdmin', 'ditolak')),
	poin INT NULL,
	keterangan VARCHAR(255) NULL
);

CREATE TABLE jurusan (
	namaJurusan VARCHAR(25) NOT NULL PRIMARY KEY, 
	nipKetuaJurusan VARCHAR(50) NOT NULL UNIQUE, 
);

CREATE TABLE prodi (
	namaProdi VARCHAR(25) NOT NULL PRIMARY KEY, 
	nipKetuaProdi VARCHAR(50) NOT NULL UNIQUE, 
	namaJurusan VARCHAR(25) NOT NULL
);

CREATE TABLE kategori (
	idKategori INT IDENTITY PRIMARY KEY,
	namaKategori VARCHAR(25) NOT NULL,
	poin INT NOT NULL
)

CREATE TABLE tingkat (
	idTingkat INT IDENTITY PRIMARY KEY,
	namaTingkat VARCHAR(25) NOT NULL
)

-- set foreign key
ALTER TABLE prestasi ADD CONSTRAINT FKprestasiMahasiswa FOREIGN KEY (nimMahasiswa) REFERENCES mahasiswa (nim);
ALTER TABLE prestasi ADD CONSTRAINT FKprestasiDosen FOREIGN KEY (nipDosenPembimbing) REFERENCES dosen (nip);
ALTER TABLE prestasi ADD CONSTRAINT FKprestasiAdmin FOREIGN KEY (idAdmin) REFERENCES admin (idAdmin);
ALTER TABLE prodi ADD CONSTRAINT FKprodiJurusan FOREIGN KEY (namaJurusan) REFERENCES jurusan (namaJurusan);
ALTER TABLE mahasiswa ADD CONSTRAINT FKmahasiswaProdi FOREIGN KEY (namaProdi) REFERENCES prodi (namaProdi);
ALTER TABLE dosen ADD CONSTRAINT FKdosenJurusan FOREIGN KEY (namaJurusan) REFERENCES jurusan (namaJurusan);