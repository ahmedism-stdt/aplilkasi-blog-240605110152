DROP DATABASE IF EXISTS db_blog;
CREATE DATABASE db_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_blog;

CREATE TABLE penulis (
  id INT NOT NULL AUTO_INCREMENT,
  nama_depan VARCHAR(100) NOT NULL,
  nama_belakang VARCHAR(100) NOT NULL,
  user_name VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  foto VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY user_name (user_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE kategori_artikel (
  id INT NOT NULL AUTO_INCREMENT,
  nama_kategori VARCHAR(100) NOT NULL,
  keterangan TEXT,
  PRIMARY KEY (id),
  UNIQUE KEY nama_kategori (nama_kategori)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE artikel (
  id INT NOT NULL AUTO_INCREMENT,
  id_penulis INT NOT NULL,
  id_kategori INT NOT NULL,
  judul VARCHAR(255) NOT NULL,
  isi TEXT NOT NULL,
  gambar VARCHAR(255) NOT NULL,
  hari_tanggal VARCHAR(50) NOT NULL,
  PRIMARY KEY (id),
  KEY id_penulis (id_penulis),
  KEY id_kategori (id_kategori),
  CONSTRAINT artikel_penulis_fk FOREIGN KEY (id_penulis) REFERENCES penulis (id) ON UPDATE CASCADE ON DELETE RESTRICT,
  CONSTRAINT artikel_kategori_fk FOREIGN KEY (id_kategori) REFERENCES kategori_artikel (id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO penulis (id, nama_depan, nama_belakang, user_name, password, foto) VALUES
(1, 'Alya', 'Pratama', 'alya', '$2y$10$CwTycUXWue0Thq9StjUM0uJ8d6Ck3Kv9VXuL2x9G9IhL4n5S4R7mG', 'penulis_69f0b2a582df9.jpg'),
(2, 'Bima', 'Saputra', 'bima', '$2y$10$CwTycUXWue0Thq9StjUM0uJ8d6Ck3Kv9VXuL2x9G9IhL4n5S4R7mG', 'default.png');

INSERT INTO kategori_artikel (id, nama_kategori, keterangan) VALUES
(1, 'Teknologi', 'Artikel seputar teknologi, web, dan perangkat lunak.'),
(2, 'Pendidikan', 'Artikel seputar pembelajaran dan pengembangan diri.'),
(3, 'Gaya Hidup', 'Artikel ringan tentang kebiasaan dan produktivitas.');

INSERT INTO artikel (id, id_penulis, id_kategori, judul, isi, gambar, hari_tanggal) VALUES
(1, 1, 1, 'Membangun Website yang Rapi dengan PHP', 'PHP masih banyak digunakan untuk membangun aplikasi web sederhana maupun sistem informasi kampus. Kunci utama agar proyek mudah dikembangkan adalah memisahkan koneksi database, proses penyimpanan, dan tampilan halaman.\n\nDengan struktur yang rapi, fitur seperti tambah data, ubah data, hapus data, dan tampilan publik dapat dipahami lebih cepat. Praktik ini juga membantu saat aplikasi perlu dikembangkan menjadi sistem yang lebih besar.', 'artikel_69f0b3aba7112.jpeg', 'Sabtu, 13 Juni 2026 | 09:10'),
(2, 1, 1, 'Pentingnya Validasi Data pada Aplikasi Web', 'Validasi data membantu memastikan informasi yang masuk ke database sudah sesuai kebutuhan aplikasi. Pada formulir artikel, validasi dapat diterapkan pada judul, penulis, kategori, isi, dan gambar.\n\nSelain menjaga kualitas data, validasi juga membuat pengalaman pengguna menjadi lebih jelas karena sistem dapat memberi pesan ketika ada field yang belum diisi.', 'artikel_69f0b3aba7112.jpeg', 'Sabtu, 13 Juni 2026 | 09:25'),
(3, 2, 2, 'Belajar Konsisten melalui Proyek Kecil', 'Belajar pemrograman akan terasa lebih mudah ketika dilakukan melalui proyek kecil yang berulang. Setiap fitur yang selesai memberi pemahaman baru tentang alur aplikasi.\n\nProyek blog sederhana adalah latihan yang baik karena mencakup database, antarmuka admin, upload gambar, dan halaman untuk pengunjung umum.', 'artikel_69f0b3aba7112.jpeg', 'Sabtu, 13 Juni 2026 | 09:40'),
(4, 2, 2, 'Membaca Dokumentasi dengan Efektif', 'Dokumentasi adalah teman penting saat belajar teknologi baru. Cara terbaik membacanya adalah mulai dari kebutuhan yang sedang dikerjakan, lalu memahami contoh kode yang paling dekat dengan kasus tersebut.\n\nDengan kebiasaan ini, pengembang tidak hanya menyalin kode, tetapi juga memahami alasan di balik setiap langkah implementasi.', 'artikel_69f0b3aba7112.jpeg', 'Sabtu, 13 Juni 2026 | 10:00'),
(5, 1, 3, 'Menata Waktu Saat Mengerjakan Tugas Akhir', 'Pengerjaan tugas akhir membutuhkan pembagian waktu yang jelas. Mulailah dari fitur utama, lanjutkan ke tampilan, kemudian lakukan pengujian dari sisi pengguna.\n\nCatatan kecil tentang fitur yang sudah selesai juga membantu saat membuat video demonstrasi, sehingga alur presentasi menjadi runtut dan tidak ada bagian yang terlewat.', 'artikel_69f0b3aba7112.jpeg', 'Sabtu, 13 Juni 2026 | 10:20'),
(6, 1, 1, 'Halaman Publik untuk Sistem CMS Blog', 'CMS akan lebih lengkap ketika konten yang dikelola admin dapat dibaca oleh pengunjung umum. Halaman publik biasanya menampilkan daftar artikel terbaru, filter berdasarkan kategori, dan halaman detail artikel.\n\nWidget artikel terkait juga membantu pembaca menemukan tulisan lain dari kategori yang sama, sehingga pengalaman membaca menjadi lebih nyaman.', 'artikel_69f0b3aba7112.jpeg', 'Sabtu, 13 Juni 2026 | 10:45'),
(7, 2, 3, 'Kebiasaan Kecil agar Produktif Belajar Coding', 'Produktivitas belajar coding tidak selalu berasal dari durasi yang panjang. Kebiasaan kecil seperti mencatat error, menyimpan referensi, dan menguji fitur satu per satu sering kali lebih berdampak.\n\nDengan ritme yang stabil, proses belajar menjadi tidak terburu-buru dan hasil proyek lebih mudah dijelaskan saat demonstrasi.', 'artikel_69f0b3aba7112.jpeg', 'Sabtu, 13 Juni 2026 | 11:05');
