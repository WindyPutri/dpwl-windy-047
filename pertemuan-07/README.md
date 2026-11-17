A.2. Menyimpan Hasil Praktikum dan Memperbarui Git

1. Hasil Praktikum

Pada tahap A.2, saya menyiapkan hasil pengembangan P6 sebagai baseline untuk melanjutkan pengembangan aplikasi DPWL pada pertemuan P7. Aplikasi dikembangkan secara berkelanjutan menggunakan workspace "dpwl-nim", sedangkan salinan hasil praktikum disimpan pada folder "dpwl-nim-nama/pertemuan-07/".

Sebelum menyimpan hasil praktikum, saya melakukan pemeriksaan dan pengujian terhadap aplikasi P6 untuk memastikan fitur yang telah dibuat dapat berjalan dengan baik. Setelah itu, seluruh isi workspace "dpwl-nim" disalin ke folder "dpwl-nim-nama/pertemuan-07/" dengan menimpa berkas yang sesuai.

2. Perubahan yang Dilakukan

- Memeriksa kesiapan aplikasi P6.
- Memastikan aplikasi dan koneksi basis data dapat berjalan.
- Memperbarui dokumentasi pada file "pertemuan-07/README.md".
- Menyalin seluruh isi workspace "dpwl-nim" ke folder "pertemuan-07".
- Menyimpan perubahan menggunakan Git dan mengirimkannya ke GitHub.

3. Perintah Git

Perintah Git dijalankan secara berurutan melalui terminal VS Code pada folder proyek yang terhubung dengan repositori GitHub.

git add .
git commit -m "Menyiapkan artefak P6 untuk baseline pengembangan P7"
git push

4. Hasil Pengujian

- Pemeriksaan aplikasi P6: Aplikasi diperiksa untuk memastikan fitur yang telah dibuat dapat berjalan dengan baik sebelum digunakan sebagai dasar pengembangan P7.
- Pemeriksaan koneksi basis data: Koneksi basis data diperiksa untuk memastikan aplikasi dapat terhubung dengan basis data yang digunakan.
- Pembaruan README.md: File "pertemuan-07/README.md" diperbarui untuk mencatat hasil praktikum dan perubahan yang dilakukan.
- Git commit: Perubahan disimpan ke repositori lokal menggunakan perintah "git add ." dan "git commit".
- Git push ke GitHub: Perubahan dikirim ke repositori GitHub menggunakan perintah "git push" sebagai penyimpanan hasil praktikum.

5. Kesimpulan

Tahap A.2 bertujuan untuk menyimpan hasil praktikum P6 sebagai dasar pengembangan P7, memperbarui dokumentasi, serta memastikan perubahan pekerjaan tersimpan dalam repositori GitHub. Pengembangan fitur transaksi P7 dilanjutkan setelah aplikasi P6 dipastikan berfungsi dengan baik.

B.2. Membuat Berkas Transaksi_controller.php

1. Hasil Praktikum

Pada tahap B.2, saya membuat berkas "application/controllers/Transaksi_controller.php" untuk menangani proses penambahan kendaraan ke keranjang transaksi. Controller ini menggunakan "Transaksi_model.php" untuk mengelola data transaksi dan memeriksa login penyewa serta metode permintaan yang digunakan.

Controller menerima data nomor polisi kendaraan dan halaman asal, kemudian meneruskan proses penambahan kendaraan ke model. Setelah proses selesai, penyewa diarahkan kembali ke halaman asal dengan pesan keberhasilan atau kesalahan.

2. Perubahan yang Dilakukan

- Membuat berkas "Transaksi_controller.php" pada folder "application/controllers/".
- Menghubungkan controller dengan "Transaksi_model.php".
- Menambahkan method "tambah()" untuk menangani permintaan penambahan kendaraan ke keranjang.
- Memeriksa autentikasi penyewa dan metode permintaan POST.
- Menangani pesan keberhasilan dan kesalahan proses.

3. Hasil Pengujian

- Pemeriksaan berkas controller: Memastikan "Transaksi_controller.php" tersimpan pada folder yang sesuai.
- Pemeriksaan model transaksi: Memastikan controller memanggil "Transaksi_model.php".
- Pengujian penambahan kendaraan: Dilakukan setelah model, controller, route, dan tombol penambahan kendaraan terintegrasi.
- Penanganan pesan: Memastikan proses menyediakan pesan keberhasilan atau kesalahan sesuai hasilnya.

4. Perintah Git

Setelah perubahan dicatat dan pengujian fitur terintegrasi selesai, jalankan perintah berikut melalui terminal pada folder repositori Git:

git add .
git commit -m "Membuat controller transaksi P7"
git push

5. Kesimpulan

Pembuatan "Transaksi_controller.php" bertujuan untuk menangani permintaan penambahan kendaraan ke keranjang dan menghubungkan proses tersebut dengan model transaksi. Pengujian penambahan kendaraan secara menyeluruh dilakukan setelah komponen terkait terintegrasi.

B.3. Menambahkan Route Transaksi

1. Hasil Praktikum

Pada tahap B.3, saya menambahkan route transaksi pada berkas "application/config/routes.php". Route ini berfungsi menghubungkan URL "transaksi/tambah" dengan method "tambah()" pada "Transaksi_controller".

2. Perubahan yang Dilakukan

Menambahkan kode berikut pada bagian route P7 di berkas "application/config/routes.php" tanpa menghapus route yang sudah tersedia.

// Route P7 - Transaksi dan Keranjang
$route['transaksi/tambah'] = 'Transaksi_controller/tambah';

Route tersebut digunakan untuk menerima permintaan POST dari formulir penambahan kendaraan ke keranjang.

3. Hasil Pengujian

- Pemeriksaan route: Memastikan route "transaksi/tambah" sudah ditambahkan pada "application/config/routes.php".
- Pemeriksaan controller: Route diarahkan ke method "tambah()" pada "Transaksi_controller".
- Pengujian fitur: Fitur penambahan kendaraan ke keranjang belum dapat diuji secara fungsional pada tahap ini karena formulir katalog dan detail kendaraan belum diintegrasikan.

4. Perintah Git

Setelah perubahan dicatat pada README dan seluruh isi workspace "dpwl-nim" disalin ke "dpwl-nim-nama/pertemuan-07", jalankan perintah berikut melalui terminal:

git add .
git commit -m "Menambahkan route penambahan kendaraan ke keranjang"
git push

5. Kesimpulan

Penambahan route transaksi bertujuan menghubungkan URL "transaksi/tambah" dengan method "tambah()" pada "Transaksi_controller". Pengujian fitur penambahan kendaraan ke keranjang dilakukan setelah formulir, controller, dan model yang diperlukan telah terintegrasi.

README P7 – Bagian C

Integrasi Tombol Tambah ke Keranjang pada Halaman Detail dan Katalog Kendaraan

1. Tujuan

Pada tahap ini, saya melakukan perubahan pada halaman detail kendaraan dan halaman katalog kendaraan agar tombol Tambah ke Keranjang dapat menyesuaikan dengan status kendaraan dan status login penyewa.

2. Perubahan yang Dilakukan

C.1. Mengubah Formulir pada Halaman Detail Kendaraan

Berkas yang diubah:

- "application/views/katalog/detail.php"

Perubahan yang dilakukan:

1. Menyesuaikan tampilan tombol berdasarkan status kendaraan.
2. Jika kendaraan tidak tersedia, sistem menampilkan pesan bahwa kendaraan tidak dapat ditambahkan ke keranjang.
3. Jika penyewa belum login, sistem menampilkan informasi serta tombol Login Penyewa dan Registrasi.
4. Jika penyewa sudah login dan kendaraan tersedia, tombol Tambah ke Keranjang ditampilkan.
5. Formulir menggunakan metode POST dan mengirimkan nomor kendaraan ("no_plat") ke route "transaksi/tambah".
6. Menambahkan nilai "return_to" dengan isi "detail" agar pengguna kembali ke halaman detail setelah proses penambahan kendaraan.

C.2. Mengubah Tombol pada Halaman Katalog Kendaraan

Berkas yang diubah:

- "application/views/katalog/index.php"

Perubahan yang dilakukan:

1. Menyesuaikan tombol berdasarkan status kendaraan dan status login penyewa.
2. Jika kendaraan tersedia dan penyewa sudah login, tombol Tambah ke Keranjang dapat digunakan.
3. Jika penyewa belum login, tombol Tambah ke Keranjang ditampilkan dalam keadaan nonaktif.
4. Jika kendaraan tidak tersedia, tombol diganti menjadi Tidak Dapat Disewa dan tidak dapat digunakan.
5. Formulir menggunakan metode POST dengan mengirimkan "no_plat" dan "return_to" bernilai "katalog" ke route "transaksi/tambah".

3. Hasil Pengujian

Pengujian dilakukan melalui browser menggunakan localhost untuk memeriksa tampilan dan kondisi tombol.

No.| Skenario Pengujian| Hasil yang Diharapkan
1| Membuka detail kendaraan tanpa login| Informasi login, tombol Login Penyewa, dan Registrasi tampil.
2| Membuka detail kendaraan yang tidak tersedia| Pesan kendaraan tidak dapat ditambahkan ke keranjang tampil.
3| Membuka detail kendaraan setelah login sebagai penyewa| Tombol Tambah ke Keranjang tampil untuk kendaraan yang tersedia.
4| Membuka katalog tanpa login| Tombol Tambah ke Keranjang dalam keadaan nonaktif.
5| Membuka katalog setelah login sebagai penyewa| Tombol Tambah ke Keranjang aktif untuk kendaraan yang tersedia.
6| Membuka katalog dengan kendaraan tidak tersedia| Tombol Tidak Dapat Disewa tampil dalam keadaan nonaktif.

Catatan hasil pengujian aktual: Isi hasil pengujian berdasarkan kondisi yang benar-benar muncul di localhost. Pada bagian C, pengujian difokuskan pada tampilan dan kondisi tombol. Pengiriman formulir serta penyimpanan transaksi diuji setelah integrasi Controller dan Model siap.

4. Kesimpulan

Berdasarkan pekerjaan pada bagian C, halaman detail dan katalog kendaraan telah disesuaikan agar tombol Tambah ke Keranjang mengikuti status ketersediaan kendaraan dan status login penyewa. Formulir juga diarahkan ke route "transaksi/tambah" menggunakan metode POST. Tahap ini menjadi persiapan sebelum pengujian proses penambahan kendaraan ke keranjang secara fungsional.

Bagian D.1

Menampilkan Pesan Notifikasi dan Tautan Keranjang pada Navbar

1. Tujuan

Pada tahap D.1, saya melakukan perubahan pada navbar agar dapat menampilkan pesan notifikasi setelah penyewa melakukan suatu tindakan dan menyediakan tautan menuju halaman keranjang. Saya juga menambahkan tampilan jumlah kendaraan pada ikon keranjang.

2. Berkas yang Diubah

Berkas yang diubah pada tahap ini adalah:

"application/views/katalog/navbar.php"

3. Perubahan yang Dilakukan

Perubahan yang saya lakukan meliputi:

1. Memeriksa status login penyewa menggunakan session "penyewa_user_plg".
2. Mengambil pesan notifikasi dari session "flash_penyewa_nav", kemudian menghapus session tersebut setelah pesannya diambil.
3. Menambahkan variabel "jumlahKeranjang" untuk menampung jumlah kendaraan dalam keranjang.
4. Menambahkan notifikasi transaksi dari session "flash_transaksi" agar pesan berhasil atau gagal dapat ditampilkan pada halaman.
5. Menambahkan tautan pada ikon keranjang yang mengarah ke "transaksi/keranjang".
6. Menampilkan jumlah kendaraan pada ikon keranjang menggunakan variabel "jumlahKeranjang".
7. Menggunakan "htmlspecialchars()" untuk membantu mengamankan teks yang ditampilkan pada halaman.

4. Hasil Pengujian

Pengujian dilakukan melalui browser menggunakan localhost.

No.| Skenario Pengujian| Hasil yang Diharapkan
1| Membuka halaman katalog| Navbar tampil tanpa error.
2| Menampilkan pesan notifikasi| Pesan notifikasi muncul dan dapat ditutup.
3| Mengeklik ikon keranjang| Pengguna diarahkan ke halaman "transaksi/keranjang".
4| Memeriksa jumlah keranjang| Jumlah kendaraan ditampilkan sesuai data yang dikirim Controller setelah integrasi selesai.

Catatan: Hasil aktual disesuaikan dengan pengujian yang dilakukan. Pengujian jumlah kendaraan dilakukan setelah integrasi Controller dan Model selesai.

5. Kesimpulan

Pada tahap D.1, navbar diperbarui agar dapat menampilkan pesan notifikasi, menyediakan tautan menuju halaman keranjang, dan menampilkan jumlah kendaraan. Perubahan ini mempersiapkan tampilan navbar untuk terintegrasi dengan fitur transaksi pada tahap berikutnya.

6. Perintah Git

Setelah perubahan selesai, salin seluruh isi workspace "dpwl-nim" ke folder "dpwl-nim-nama/pertemuan-07", lalu jalankan perintah berikut melalui terminal VS Code.

