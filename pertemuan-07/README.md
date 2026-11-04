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