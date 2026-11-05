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

Dokumentasi Penambahan Data Penyewa

1. Tujuan

Menambahkan fitur untuk memasukkan data penyewa ke dalam sistem rental mobil agar data penyewa dapat tersimpan di database dan ditampilkan pada halaman manajemen penyewa.

2. Langkah Pengerjaan

1. Membuka proyek DPWL menggunakan Visual Studio Code.
2. Memeriksa file "Penyewa_controller.php" untuk menambahkan fungsi pengelolaan data penyewa.
3. Memeriksa file "Penyewa_model.php" untuk memastikan fungsi penyimpanan data terhubung dengan database.
4. Menyiapkan formulir penambahan data penyewa pada halaman "penyewa_view.php" atau view yang digunakan untuk halaman admin.
5. Membuat formulir yang berisi data penyewa, seperti username, NIK, nama lengkap, nomor HP, dan alamat lengkap.
6. Menghubungkan formulir dengan controller agar data yang dikirim dapat diproses dan disimpan ke tabel "t_penyewa".
7. Menguji fitur dengan memasukkan data penyewa baru dan memeriksa hasilnya pada halaman manajemen penyewa serta database.

3. Hasil Pengujian Aktual

- Pengisian formulir: Formulir penambahan data penyewa diisi dengan username, NIK, nama lengkap, nomor HP, dan alamat lengkap.
- Penyimpanan data: Data diproses melalui "Penyewa_controller.php" dan diteruskan ke "Penyewa_model.php" untuk disimpan ke database.
- Data tersimpan di tabel "t_penyewa": Data akan muncul pada tabel penyewa apabila proses penyimpanan berhasil.
- Pesan yang ditampilkan: Sistem menampilkan pesan berhasil apabila data berhasil ditambahkan atau pesan gagal apabila proses penyimpanan mengalami kendala.

4. Kesimpulan

Fitur penambahan data penyewa dibuat agar admin dapat memasukkan data penyewa melalui formulir pada aplikasi rental mobil. Data yang dikirim diproses oleh controller, diteruskan ke model, kemudian disimpan ke database. Pengujian dilakukan untuk memastikan data dapat tersimpan dengan benar.

5. Perubahan File

- "application/controllers/Penyewa_controller.php" — mengatur proses penambahan data penyewa.
- "application/models/Penyewa_model.php" — mengatur penyimpanan data penyewa ke database.
- "application/views/admin/penyewa_view.php" — menampilkan formulir dan tabel data penyewa, jika menggunakan file view tersebut.
- "application/config/routes.php" — menambahkan atau memeriksa route untuk fitur penambahan data penyewa.