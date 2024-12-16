/*
	Judul		: Insert Data Master ke Database Sistem Pencatatan Prestasi Kelompok 4
	Kelas-Prodi : 2G-Teknik Informatika
	Jurusan		: Teknologi Informasi
				  Politeknik Negeri Malang
*/
-- use database
USE SistemPrestasi;

-- insert into tables
INSERT INTO akun(username, password, status, role)
VALUES
('1','admin123', 'aktif', 'admin'),
('2','admin123', 'inaktif', 'admin'),
('2341720104','123','aktif', 'mahasiswa'),
('2341720117','123','aktif', 'mahasiswa'),
('2341720177','123','aktif', 'mahasiswa'),
('2341720254','123','aktif', 'mahasiswa'),
('2341720206','123','aktif', 'mahasiswa'),
('198010102005011001','123', 'aktif', 'dosen'),
('197605152009122001','123', 'aktif', 'dosen'),
('198107052005011002','123', 'aktif', 'dosen'),
('198108102005012002','123', 'aktif', 'dosen'),
('197903132008121002','123', 'aktif', 'dosen'),
('197606252005012001','123', 'aktif', 'dosen'),
('198108092010121002','123', 'aktif', 'dosen');

INSERT INTO admin (idAdmin, nama) 
VALUES 
('1','Andi Permana'),
('2','Budi Santoso');

INSERT INTO jurusan VALUES 
('Teknologi Informasi', 1),
('Akuntansi', 2),
('Administrasi Niaga', 3),
('Teknik Mesin', 4),
('Teknik Elektro', 5),
('Teknik Kimia', 6),
('Teknik Sipil', 7);

INSERT INTO prodi(namaProdi, nipKetuaProdi, namaJurusan) 
VALUES 
('Teknik Informatika','197605152009122001' , 'Teknologi Informasi'),
('Sistem Informasi Bisnis',  '197876676787678798' , 'Teknologi Informasi');

INSERT INTO mahasiswa (nim, nama, email, namaProdi) 
VALUES 
('2341720104','Fahri Zanuar Pradian', 'fpradian24@gmail.com', 'Sistem Informasi Bisnis'),
('2341720117','Oktavian Eka Ramadhan', 'oktavianeka4@gmail.com', 'Teknik Informatika'),
('2341720177','Muhammad Adityo Rahman', 'adityorahman18@gmail.com ', 'Sistem Informasi Bisnis'),
('2341720254','Hanifah Kurniasari', 'hanifahkurniasari0512@gmail.com ', 'Teknik Informatika'),
('2341720206','Abdul Latif Mukhlisin', 'mabdullatifm1127@gmail.com', 'Teknik Informatika');

INSERT INTO dosen (nip, nama, namaJurusan, email) 
VALUES 
('198010102005011001','DR. Eng. Rosa Andrie Asmara, ST, MT','Teknologi Informasi','rosa_andrie@polinema.ac.id'),
('197605152009122001','Ely Setyo Astuti, ST., MT','Teknologi Informasi','ellysetyo@polinema.ac.id'),
('198107052005011002','Ahmadi Yuli Ananta, ST','Teknologi Informasi','ahmadi@polinema.ac.id'),
('198108102005012002','Ariadi Retno Tri Hayati Ririd, S.Kom., M.Kom','Teknologi Informasi','ariadi.retno@polinema.ac.id'),
('197903132008121002','Arief Prasetyo, S.Kom','Teknologi Informasi','arief.prasetyo@polinema.ac.id'),
('197606252005012001','Atiqah Nurul Asri, S.Pd., M.Pd','Teknologi Informasi','atiqah.nurul@polinema.ac.id'),
('198108092010121002','Banni Satria Andoko, S.Kom., M.Si','Teknologi Informasi','ando@polinema.ac.id');

INSERT INTO prestasi (tanggalPengajuan, namaLomba, waktu, penyelenggara, tingkat, bidang, jenis, nipDosenPembimbing, nimMahasiswa, sertifikatPath, dokumentasiPath, suratTugasPath, idAdmin, status, poin, keterangan)
VALUES 
('2024-01-01','ROAD TO IPEC', '2024-01-15', 'ITDEC POLINEMA','Regional', 'Pidato Bahasa Inggris','Juara 1', '198010102005011001', '2341720104',
'assets/filemedia/sertifikat/1_2341720104.jpg', 'assets/filemedia/dokumentasi/1_2341720104.jpg', 'assets/filemedia/suratTugas/1_2341720104.jpg', NULL, 'diproses', NULL, NULL),

('2024-02-10','Kompetisi Robotik Nasional', '2024-02-10', 'Komunitas Robot Indonesia','Nasional', 'Robot Line Follower','Juara 1', '198010102005011001', '2341720104', 
'assets/filemedia/sertifikat/2_2341720104.jpg', 'assets/filemedia/dokumentasi/2_2341720104.jpg', 'assets/filemedia/suratTugas/2_2341720104.jpg', '1', 'diterimaAdmin', 10, NULL),

('2024-03-13','KMIPN', '2024-03-05', 'Puspresnas','Nasional', 'Desain Grafis','Juara 2', '198010102005011001', '2341720104',
'assets/filemedia/sertifikat/3_2341720104.jpg', 'assets/filemedia/dokumentasi/3_2341720104.jpg', 'assets/filemedia/suratTugas/3_2341720104.jpg', '1', 'ditolak', 0, 'Dokumentasi Tidak Sesuai'),

('2024-04-11','KMIPN', '2024-09-30', 'Puspresnas','Nasional', 'Desain Grafis','Juara 2', '197605152009122001', '2341720117',
'assets/filemedia/sertifikat/4_2341720117.jpg', 'assets/filemedia/dokumentasi/4_2341720117.jpg', 'assets/filemedia/suratTugas/4_2341720117.jpg', NULL, 'diproses', NULL, NULL),

('2024-05-01','Tech in Asia', '2024-03-10', 'ITDEC POLINEMA','Nasional', 'Pidato Bahasa Inggris','Juara 2', '197605152009122001', '2341720117',
'assets/filemedia/sertifikat/5_2341720117.jpg', 'assets/filemedia/dokumentasi/5_2341720117.jpg', 'assets/filemedia/suratTugas/5_2341720117.jpg', '1', 'diterimaAdmin', 10, NULL),

('2024-06-13','GEMASTIK', '2024-10-02', 'Puspresnas','Nasional', 'Lomba Esai', 'Juara 3','197605152009122001', '2341720117',
'assets/filemedia/sertifikat/6_2341720117.jpg', 'assets/filemedia/dokumentasi/6_2341720117.jpg', 'assets/filemedia/suratTugas/6_2341720117.jpg', '1', 'ditolak', 0, 'Surat Tugas Tidak Sesuai'),

('2024-07-22','ROAD TO IPEC', '2024-03-10', 'ITDEC POLINEMA','Regional', 'Pidato Bahasa Inggris', 'Juara 2','198107052005011002', '2341720177',
'assets/filemedia/sertifikat/7_2341720177.jpg', 'assets/filemedia/dokumentasi/7_2341720177.jpg', 'assets/filemedia/suratTugas/7_2341720177.jpg', NULL, 'diproses', NULL, NULL),

('2024-08-21','ALSA UGM', '2024-05-20', 'UGM','Nasional', 'Debat', 'Juara 3','198107052005011002', '2341720177',
'assets/filemedia/sertifikat/8_2341720177.jpg', 'assets/filemedia/dokumentasi/8_2341720177.jpg', 'assets/filemedia/suratTugas/8_2341720177.jpg', '2', 'diterimaDosen', NULL, NULL),

('2024-09-12','ALSA UGM', '2024-05-20', 'UGM','Nasional', 'Debat', 'Harapan 1','198107052005011002', '2341720177',
'assets/filemedia/sertifikat/9_2341720177.jpg', 'assets/filemedia/dokumentasi/9_2341720177.jpg', 'assets/filemedia/suratTugas/9_2341720177.jpg', '2', 'diterimaAdmin',10, NULL),

('2024-10-08','4C National Competition', '2024-05-20', 'FILKOM UB','Nasional', 'Penulisan Ilmiah','Harapan 3', '198107052005011002', '2341720177',
'assets/filemedia/sertifikat/10_2341720177.jpg', 'assets/filemedia/dokumentasi/10_2341720177.jpg', 'assets/filemedia/suratTugas/10_2341720177.jpg', '2', 'ditolak', 0, 'Nama Lomba Tidak Sesuai'),

('2024-11-02','GEMASTIK', '2024-05-20', 'Puspresnas','Nasional', 'Hackathon','Juara 2', '198108102005012002', '2341720254',
'assets/filemedia/sertifikat/11_2341720254.jpg', 'assets/filemedia/dokumentasi/11_2341720254.jpg', 'assets/filemedia/suratTugas/11_2341720254.jpg', NULL, 'diproses', NULL, NULL),

('2024-12-10','4C National Competition', '2024-07-01', 'FILKOM UB','Nasional', 'Desain Grafis','Juara 3', '198108102005012002', '2341720254',
'assets/filemedia/sertifikat/12_2341720254.jpg', 'assets/filemedia/dokumentasi/12_2341720254.jpg', 'assets/filemedia/suratTugas/12_2341720254.jpg', '2', 'diterimaAdmin', 10, NULL),

('2024-01-02','Compfest UI', '2024-07-01', 'FILKOM UI','Nasional', 'Cyber Security','Juara 2', '198108102005012002', '2341720254',
'assets/filemedia/sertifikat/13_2341720254.jpg', 'assets/filemedia/dokumentasi/13_2341720254.jpg', 'assets/filemedia/suratTugas/13_2341720254.jpg', '2', 'ditolak', 0, 'Nama Lomba Tidak Sesuai'),

('2024-02-19','Compfest UI', '2024-05-20', 'FILKOM UI','Nasional', 'Cyber Security','Juara 2', '198108092010121002', '2341720206',
'assets/filemedia/sertifikat/14_2341720206.jpg', 'assets/filemedia/dokumentasi/14_2341720206.jpg', 'assets/filemedia/suratTugas/14_2341720206.jpg', NULL, 'diproses', NULL, NULL),

('2024-03-12','KMIPN', '2024-06-15', 'Puspresnas','Nasional', 'Desain Grafis','Harapan 1', '198108092010121002', '2341720206',
'assets/filemedia/sertifikat/15_2341720206.jpg', 'assets/filemedia/dokumentasi/15_2341720206.jpg', 'assets/filemedia/suratTugas/15_2341720206.jpg', '2', 'diterimaAdmin', 10, NULL),

('2024-04-11','ROAD TO IPEC', '2024-10-02', 'ITDEC POLINEMA','Regional', 'Bahasa Inggris','Harapan 1', '198108092010121002', '2341720206',
'assets/filemedia/sertifikat/16_2341720206.jpg', 'assets/filemedia/dokumentasi/16_2341720206.jpg', 'assets/filemedia/suratTugas/16_2341720206.jpg', '2', 'ditolak', 0, 'Tanggal Lomba Tidak Sesuai'),

('2024-05-08','Tech in Asia', '2024-03-10', 'ITDEC POLINEMA','Nasional', 'Pidato Bahasa Inggris','Juara 2', '197605152009122001', '2341720117',
'assets/filemedia/sertifikat/17_2341720117.jpg', 'assets/filemedia/dokumentasi/17_2341720117.jpg', 'assets/filemedia/suratTugas/17_2341720117.jpg', '1', 'diterimaAdmin', 10, NULL),

('2024-06-25','4C National Competition', '2024-05-20', 'FILKOM UB','Nasional', 'Penulisan Ilmiah','Finalis', '198107052005011002', '2341720117',
'assets/filemedia/sertifikat/18_2341720117.jpg', 'assets/filemedia/dokumentasi/18_2341720117.jpg', 'assets/filemedia/suratTugas/18_2341720117.jpg', '2', 'ditolak', 0, 'Kategori Tidak Sesuai'),

('2024-08-13','KMIPN', '2024-03-05', 'Puspresnas','Nasional', 'Desain Grafis','Juara 2', '198010102005011001', '2341720104',
'assets/filemedia/sertifikat/19_2341720104.jpg', 'assets/filemedia/dokumentasi/19_2341720104.jpg', 'assets/filemedia/suratTugas/19_2341720104.jpg', NULL, 'diterimaDosen', NULL, NULL),

('2024-06-13','GEMASTIK', '2024-04-02', 'Puspresnas','Nasional', 'Lomba Esai', 'Juara 3','198010102005011001', '2341720117',
'assets/filemedia/sertifikat/20_2341720117.jpg', 'assets/filemedia/dokumentasi/20_2341720117.jpg', 'assets/filemedia/suratTugas/20_2341720117.jpg', NULL, 'diterimaDosen', NULL, NULL),

('2024-07-02','Compfest UI', '2024-07-01', 'FILKOM UI','Nasional', 'Cyber Security','Juara 2', '198010102005011001', '2341720254',
'assets/filemedia/sertifikat/21_2341720254.jpg', 'assets/filemedia/dokumentasi/21_2341720254.jpg', 'assets/filemedia/suratTugas/21_2341720254.jpg', NULL, 'diterimaDosen', NULL, NULL),

('2024-08-11','ROAD TO IPEC', '2024-10-02', 'ITDEC POLINEMA','Regional', 'Bahasa Inggris','Harapan 1', '198010102005011001', '2341720206',
'assets/filemedia/sertifikat/22_2341720206.jpg', 'assets/filemedia/dokumentasi/22_2341720206.jpg', 'assets/filemedia/suratTugas/22_2341720206.jpg', NULL, 'diterimaDosen', NULL, NULL),

('2024-09-08','4C National Competition', '2024-05-20', 'FILKOM UB','Nasional', 'Penulisan Ilmiah','Harapan 3', '198107052005011002', '2341720177',
'assets/filemedia/sertifikat/23_2341720177.jpg', 'assets/filemedia/dokumentasi/23_2341720177.jpg', 'assets/filemedia/suratTugas/23_2341720177.jpg', NULL, 'diterimaDosen', NULL, NULL);

INSERT INTO kategori (namaKategori, poin) 
VALUES
('Juara 1', 6), ('Juara 2', 5), ('Juara 3', 4), ('Harapan 1', 3), ('Harapan 2', 2), ('Harapan 3', 1), ('Finalis', 0);

INSERT INTO tingkat (namaTingkat) 
VALUES
('Internasional'), ('Nasional'), ('Provinsi'), ('Kabupaten/Kota'), ('Institusi/Universitas'), ('Lembaga Mahasiswa');