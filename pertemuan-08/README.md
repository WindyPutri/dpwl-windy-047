Dokumentasi Pembuatan Manajemen Penyewa

1. Tujuan

Pada tahap ini, saya membuat tampilan halaman Manajemen Penyewa pada sisi admin untuk membantu mengelola data penyewa rental mobil. Pembuatan tampilan mengikuti pola halaman Manajemen Kendaraan yang sudah ada, sehingga desain dan cara penggunaannya tetap konsisten.

2. Perubahan yang Dilakukan

Saya membuat file baru bernama "penyewa_view.php" di folder "application/views/admin/". File ini digunakan untuk menampilkan tabel data penyewa dan formulir untuk menambah atau mengubah data penyewa.

Beberapa bagian yang saya kerjakan, yaitu:

- Menambahkan judul halaman Manajemen Penyewa dan breadcrumb menuju Dashboard.
- Membuat tabel untuk menampilkan username, NIK, nama lengkap, nomor HP, dan alamat penyewa.
- Menambahkan tombol Tambah Penyewa, Ubah, dan Hapus.
- Membuat formulir untuk mengisi data penyewa.
- Menambahkan input foto KTP dan SIM A sesuai kebutuhan tugas.
- Menambahkan pesan notifikasi untuk menampilkan informasi keberhasilan atau kesalahan.
- Menggunakan "htmlspecialchars()" untuk membantu mengamankan tampilan data yang ditampilkan pada halaman.

3. Penyesuaian dari Manajemen Kendaraan

Dalam proses pembuatan, saya menggunakan "mobil_view.php" sebagai referensi. Struktur tampilan seperti "content-wrapper", "content-header", "box", tabel, dan formulir tetap mengikuti pola yang sudah ada.

Selanjutnya, saya menyesuaikan nama variabel, judul halaman, kolom tabel, dan alamat route agar digunakan untuk pengelolaan data penyewa, bukan data kendaraan.

4. Pengujian

Setelah coding selesai, halaman perlu diuji untuk memastikan tabel dan formulir tampil dengan benar. Pengujian juga perlu dilakukan terhadap proses tambah, ubah, hapus, validasi input, password, dan unggah foto KTP serta SIM A.

Hasil pengujian aktual: Diisi setelah pengujian langsung dilakukan pada aplikasi.

5. Kesimpulan

Dengan pembuatan "penyewa_view.php", saya telah menyiapkan bagian tampilan untuk fitur Manajemen Penyewa. Tampilan ini menjadi bagian dari pengembangan aplikasi rental mobil pada sisi admin. Agar seluruh fitur dapat berjalan, View perlu dihubungkan dengan Controller, Model, dan route yang sesuai.