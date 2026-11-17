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

Bagian D.2

Mengirim Jumlah Keranjang ke Halaman Katalog, Detail Kendaraan, dan Profil Penyewa

1. Tujuan

Pada tahap D.2, saya melakukan perubahan pada Model dan Controller agar jumlah kendaraan yang ada di keranjang dapat ditampilkan pada ikon keranjang di navbar. Jumlah kendaraan dihitung berdasarkan akun penyewa yang sedang login.

2. Berkas yang Diubah

Berkas yang diperbarui pada tahap ini adalah:

1. "application/models/Transaksi_model.php"
2. "application/controllers/Katalog_controller.php"
3. "application/controllers/Penyewa_controller.php"

3. Perubahan yang Dilakukan

D.2.1. Memperbarui Transaksi_model.php

Saya menambahkan method "getJumlahMobilKeranjang()" untuk menghitung jumlah kendaraan dalam keranjang penyewa.

Perubahan yang dilakukan:

- Menghitung jumlah kendaraan menggunakan tabel "t_pilih" dan "t_sewa".
- Menghubungkan kedua tabel melalui "kode_sewa".
- Menghitung kendaraan berdasarkan akun penyewa yang sedang login.
- Hanya menghitung transaksi dengan status "keranjang".
- Menggunakan prepared statement untuk menjalankan query database.
- Mengembalikan nilai 0 jika username penyewa kosong atau tidak ada kendaraan dalam keranjang.

D.2.2. Memperbarui Katalog_controller.php

Saya menyesuaikan Controller katalog agar mengirimkan jumlah keranjang ke halaman katalog dan detail kendaraan.

Perubahan yang dilakukan:

- Menambahkan pemanggilan "Transaksi_model.php".
- Menambahkan properti dan inisialisasi Model transaksi.
- Pada method "index()", mengirimkan data "jumlahKeranjang" ke halaman katalog.
- Pada method "detail()", mengirimkan data "jumlahKeranjang" ke halaman detail kendaraan.
- Jika penyewa belum login, jumlah keranjang diatur menjadi 0.

D.2.3. Memperbarui Penyewa_controller.php

Saya menyesuaikan Controller penyewa agar jumlah keranjang juga ditampilkan ketika penyewa membuka halaman profil.

Perubahan yang dilakukan:

- Menambahkan pemanggilan dan inisialisasi "Transaksi_model".
- Menghitung jumlah kendaraan dalam keranjang berdasarkan akun penyewa.
- Mengirimkan variabel "jumlahKeranjang" ke View profil.
- Memastikan jumlah keranjang tetap dikirim ketika profil menampilkan pesan kesalahan validasi atau kesalahan lainnya.

4. Hasil Pengujian

Pengujian dilakukan melalui browser menggunakan localhost.

No.| Skenario Pengujian| Hasil yang Diharapkan
1| Membuka katalog tanpa login| Halaman tetap tampil dan jumlah keranjang bernilai 0.
2| Membuka detail kendaraan tanpa login| Informasi kendaraan tampil tanpa menampilkan jumlah keranjang milik akun lain.
3| Login sebagai penyewa| Navbar menampilkan jumlah keranjang milik akun tersebut.
4| Membuka katalog setelah login| Jumlah keranjang tampil sesuai data penyewa.
5| Membuka detail kendaraan setelah login| Jumlah keranjang tetap tampil sesuai data penyewa.
6| Membuka halaman profil penyewa| Jumlah keranjang tetap tampil pada navbar profil.
7| Penyewa belum memiliki kendaraan dalam keranjang| Jumlah yang ditampilkan adalah 0.

Catatan: Hasil pengujian aktual harus disesuaikan dengan hasil yang benar-benar muncul saat aplikasi dijalankan.

5. Kesimpulan

Pada tahap D.2, saya mengintegrasikan Model transaksi dengan Controller katalog dan Controller penyewa agar jumlah kendaraan dalam keranjang dapat dikirim ke navbar. Jumlah tersebut dihitung berdasarkan akun penyewa yang sedang login, sehingga informasi keranjang pada halaman katalog, detail kendaraan, dan profil penyewa dapat ditampilkan sesuai data masing-masing akun.

6. Perintah Git

Setelah perubahan selesai, salin seluruh isi workspace "dpwl-nim" ke folder "dpwl-nim-nama/pertemuan-07", lalu jalankan perintah berikut melalui terminal VS Code.

README P7 – Bagian D.2.3

Memperbarui Penyewa_controller.php

1. Tujuan

Pada tahap D.2.3, saya melakukan perubahan pada Controller penyewa agar jumlah kendaraan dalam keranjang tetap ditampilkan pada navbar ketika penyewa membuka halaman profil. Jumlah keranjang juga harus tetap tampil ketika pengguna memperbarui profil atau mengalami kesalahan validasi formulir.

2. Berkas yang Diubah

Berkas yang diperbarui adalah:

"application/controllers/Penyewa_controller.php"

3. Perubahan yang Dilakukan

Perubahan yang saya lakukan meliputi:

1. Menambahkan pemanggilan "Transaksi_model.php" menggunakan "require_once".
2. Menambahkan properti "Transaksi_model $transaksiModel" di dalam class "Penyewa_controller".
3. Menambahkan inisialisasi "Transaksi_model" pada method "__construct()".
4. Pada method "profil()", menghitung jumlah kendaraan dalam keranjang menggunakan method "getJumlahMobilKeranjang($userPlg)".
5. Mengirimkan variabel "jumlahKeranjang" ke View "penyewa/profil".
6. Menambahkan data "jumlahKeranjang" pada tampilan profil ketika validasi formulir gagal.
7. Memperbarui method "renderProfilError()" agar jumlah keranjang tetap dikirim ketika halaman profil menampilkan pesan kesalahan.

4. Hasil Pengujian

Pengujian dilakukan melalui browser menggunakan localhost.

No.| Skenario Pengujian| Hasil yang Diharapkan
1| Login sebagai penyewa| Penyewa berhasil masuk ke aplikasi.
2| Membuka halaman profil| Jumlah keranjang tampil pada navbar sesuai data penyewa.
3| Memperbarui profil dengan data valid| Profil berhasil diperbarui dan jumlah keranjang tetap tampil.
4| Mengisi formulir dengan data tidak valid| Pesan kesalahan validasi muncul dan jumlah keranjang tetap tampil.
5| Membuka kembali halaman katalog dan detail kendaraan| Kedua halaman tetap berjalan dengan baik setelah perubahan Controller profil.

Catatan hasil aktual: Sesuaikan keterangan pengujian dengan hasil yang benar-benar muncul pada aplikasi. Jika belum diuji, jangan menandai pengujian sebagai berhasil.

5. Kesimpulan

Pada tahap D.2.3, saya memperbarui "Penyewa_controller.php" agar jumlah kendaraan dalam keranjang dapat ditampilkan pada navbar halaman profil. Jumlah tersebut tetap dikirim ketika profil berhasil ditampilkan maupun ketika terjadi kesalahan validasi. Dengan demikian, tampilan jumlah keranjang dapat digunakan secara konsisten pada halaman katalog, detail kendaraan, dan profil penyewa.

6. Perintah Git

Setelah perubahan selesai, salin seluruh isi workspace "dpwl-nim" ke folder "dpwl-nim-nama/pertemuan-07", kemudian jalankan perintah berikut melalui terminal VS Code.

README P7 – Bagian E.1


1. Tujuan

Pada tahap E.1, saya menambahkan method "tambahKeKeranjang()" pada Model transaksi. Method ini digunakan untuk menambahkan kendaraan yang dipilih penyewa ke keranjang dengan menyimpan data transaksi ke database menggunakan pola Header-Detail.

Informasi utama transaksi disimpan pada tabel "t_sewa", sedangkan data kendaraan yang dipilih disimpan pada tabel "t_pilih".

2. Berkas yang Diubah

Berkas yang diperbarui adalah:

"application/models/Transaksi_model.php"

3. Perubahan yang Dilakukan

Perubahan yang saya lakukan meliputi:

1. Menambahkan helper "namaKunciKeranjang()" untuk membuat identitas kunci keranjang berdasarkan akun penyewa.
2. Menambahkan helper "kunciKendaraan()" untuk mencari dan mengunci data kendaraan yang dipilih.
3. Menambahkan helper "hitungHariSewa()" untuk menghitung durasi penyewaan.
4. Menambahkan helper normalisasi waktu pengambilan agar format waktu sesuai.
5. Menambahkan method "tambahKeKeranjang()" untuk memproses penambahan kendaraan ke keranjang.
6. Memeriksa username penyewa dan nomor polisi kendaraan agar tidak kosong.
7. Memastikan kendaraan memiliki status "tersedia" sebelum ditambahkan ke keranjang.
8. Memeriksa apakah penyewa sudah memiliki keranjang aktif. Jika sudah ada, transaksi tersebut digunakan kembali. Jika belum ada, sistem membuat transaksi baru.
9. Menggunakan transaksi database dan mekanisme penguncian untuk membantu menjaga konsistensi data serta mencegah pembuatan keranjang aktif ganda.
10. Menambahkan kendaraan ke tabel detail transaksi sesuai dengan struktur database yang digunakan.

Method ini juga memerlukan helper "ambilKunci()", "lepasKunci()", dan "kunciDanBuatKodeSewa()" yang telah dibuat pada bagian B.

4. Hasil Pengujian

Pengujian dilakukan setelah Model transaksi dan integrasi Controller tersedia.

No.| Skenario Pengujian| Hasil yang Diharapkan
1| Menambahkan kendaraan dengan akun penyewa yang valid| Kendaraan dapat diproses untuk ditambahkan ke keranjang.
2| Mengirim username atau nomor polisi kosong| Sistem menolak permintaan dengan pesan kesalahan.
3| Menambahkan kendaraan yang tidak tersedia| Sistem menolak penambahan kendaraan.
4| Penyewa sudah memiliki keranjang aktif| Sistem menggunakan kembali keranjang aktif tersebut.
5| Penyewa belum memiliki keranjang aktif| Sistem membuat transaksi keranjang baru.
6| Terjadi kesalahan ketika proses penambahan berlangsung| Transaksi database dibatalkan agar perubahan tidak tersimpan sebagian.

Catatan: Pada tahap E.1, pengujian fungsional melalui tombol katalog dan detail dilakukan setelah Controller serta formulir terintegrasi. Isi hasil aktual sesuai dengan pengujian yang benar-benar dilakukan.

5. Kesimpulan

Pada tahap E.1, saya mengembangkan Model transaksi dengan menambahkan method "tambahKeKeranjang()" beserta helper yang diperlukan. Method ini memeriksa ketersediaan kendaraan, mencari atau membuat keranjang aktif, dan menambahkan kendaraan ke transaksi. Perubahan ini menjadi dasar agar tombol Tambah ke Keranjang pada halaman katalog dan detail kendaraan dapat berfungsi setelah integrasi selesai.

6. Perintah Git

Setelah perubahan selesai, salin seluruh isi workspace "dpwl-nim" ke folder "dpwl-nim-nama/pertemuan-07", kemudian jalankan perintah berikut pada terminal VS Code.

F.1. Membuat Halaman Isi Keranjang

1. Tujuan

Pada tahap ini, saya membuat halaman isi keranjang untuk menampilkan kendaraan yang telah ditambahkan oleh penyewa. Halaman ini juga menampilkan informasi penyewaan, seperti tanggal mulai, tanggal selesai, waktu pengambilan, harga sewa, durasi, dan total biaya. Selain itu, halaman menyediakan pilihan untuk memperbarui periode sewa, menghapus kendaraan dari keranjang, dan melanjutkan ke proses checkout.

2. Berkas yang Dibuat

Berkas yang dibuat pada tahap ini adalah:

"application/views/transaksi/keranjang.php"

Halaman dibuat menggunakan PHP, HTML, dan komponen tampilan Bootstrap yang mengikuti struktur aplikasi P6. View menggunakan data keranjang yang dikirimkan oleh Controller transaksi.

3. Proses Pengerjaan

Langkah-langkah yang dilakukan:

1. Membuat folder "transaksi" di dalam "application/views" apabila folder tersebut belum tersedia.
2. Membuat berkas "keranjang.php".
3. Menambahkan header, navbar, dan footer dari tampilan katalog yang sudah tersedia.
4. Menampilkan informasi transaksi dan daftar kendaraan yang berada di keranjang.
5. Menampilkan harga sewa, durasi, subtotal, dan total biaya.
6. Menambahkan formulir untuk memperbarui tanggal sewa dan waktu pengambilan.
7. Menambahkan tombol untuk menghapus kendaraan dan melanjutkan ke checkout.
8. Menambahkan validasi pada formulir periode sewa agar tanggal dan waktu yang dipilih sesuai ketentuan.
9. Memastikan data yang ditampilkan melalui HTML diolah menggunakan "htmlspecialchars()" untuk membantu mencegah keluaran HTML yang tidak aman.

4. Pengujian

Pengujian dilakukan melalui browser setelah Controller dan Model transaksi terintegrasi.

No.| Pengujian| Hasil
1| Membuka halaman keranjang sebagai penyewa yang memiliki kendaraan di keranjang.| Isi sesuai hasil pengujian aktual.
2| Memeriksa informasi kendaraan dan biaya sewa.| Isi sesuai hasil pengujian aktual.
3| Memeriksa formulir tanggal sewa dan waktu pengambilan.| Isi sesuai hasil pengujian aktual.
4| Memeriksa tombol hapus kendaraan dan checkout.| Isi sesuai hasil pengujian aktual.
5| Menguji validasi tanggal dan waktu pengambilan.| Isi sesuai hasil pengujian aktual.

Catatan: Hasil pengujian harus diisi berdasarkan pengujian yang benar-benar dilakukan. Jika belum diuji, tuliskan Belum diuji.

5. Kesimpulan

Pada tahap F.1, saya membuat View halaman isi keranjang pada aplikasi penyewaan mobil. Halaman ini digunakan untuk melihat kendaraan yang dipilih beserta rincian periode dan biaya sewa. Fitur tersebut menjadi bagian dari proses transaksi sebelum penyewa melanjutkan ke halaman konfirmasi checkout.

6. Git

Setelah perubahan disimpan dan diuji, saya menyimpan hasil praktikum ke folder "dpwl-nim-nama/pertemuan-07/", lalu menjalankan perintah Git berikut melalui terminal VS Code:

F.2. Menambahkan Method "keranjang()" dan Lainnya pada Controller Transaksi

1. Tujuan

Pada tahap ini, saya memperbarui "Transaksi_controller.php" dengan menambahkan method untuk menampilkan isi keranjang dan mengelola proses transaksi. Controller menghubungkan permintaan dari pengguna dengan Model transaksi dan View keranjang.

2. Berkas yang Diubah

Berkas utama yang diperbarui:

"application/controllers/Transaksi_controller.php"

Selain itu, route transaksi pada berkas berikut perlu diperiksa dan dilengkapi sesuai modul:

"application/config/routes.php"

3. Proses Pengerjaan

Langkah-langkah yang dilakukan:

1. Membuka berkas "Transaksi_controller.php" di Visual Studio Code.
2. Menambahkan method "keranjang()" tanpa menghapus method yang sudah tersedia.
3. Memastikan pengguna harus login sebagai penyewa dan permintaan halaman keranjang menggunakan metode GET.
4. Mengambil kode keranjang aktif milik penyewa melalui Model transaksi.
5. Menampilkan pesan jika keranjang masih kosong dan mengarahkan pengguna kembali ke katalog.
6. Mengambil detail keranjang berdasarkan kode transaksi dan identitas penyewa yang sedang login.
7. Mengirim data keranjang, pesan notifikasi, dan jumlah kendaraan ke View "transaksi/keranjang".
8. Menambahkan method lain sesuai modul, yaitu "perbaruiPeriode()", "hapus()", dan "checkout()" untuk mendukung pengelolaan keranjang dan proses checkout.
9. Memastikan route transaksi telah terdaftar di "routes.php", tanpa menghapus route lain yang sudah digunakan aplikasi.

4. Route yang Digunakan

Route transaksi yang digunakan sesuai tahapan P7 antara lain:

// Route P7 - Transaksi, Keranjang, dan Checkout
$route['transaksi/tambah'] = 'Transaksi_controller/tambah';
$route['transaksi/keranjang'] = 'Transaksi_controller/keranjang';
$route['transaksi/perbarui-periode'] = 'Transaksi_controller/perbaruiPeriode';
$route['transaksi/hapus'] = 'Transaksi_controller/hapus';
$route['transaksi/hapus/(:any)'] = 'Transaksi_controller/hapus/$1';
$route['transaksi/checkout'] = 'Transaksi_controller/checkout';

Route di atas perlu disesuaikan dengan route yang sudah ada agar tidak terjadi duplikasi.

5. Pengujian

Pengujian dilakukan melalui browser setelah Model, Controller, View, dan route terintegrasi.

No.| Pengujian| Hasil
1| Login sebagai penyewa yang memiliki keranjang, lalu buka halaman "transaksi/keranjang".| Isi sesuai pengujian aktual.
2| Login sebagai penyewa yang belum memiliki keranjang aktif.| Isi sesuai pengujian aktual.
3| Memastikan data yang ditampilkan merupakan keranjang milik akun yang sedang login.| Isi sesuai pengujian aktual.
4| Memeriksa jumlah kendaraan pada ikon keranjang di navbar.| Isi sesuai pengujian aktual.
5| Memeriksa fungsi memperbarui periode, menghapus kendaraan, dan melanjutkan checkout.| Isi sesuai pengujian aktual.

Catatan: Jika pengujian belum dilakukan, tuliskan Belum diuji. Jangan menyatakan fitur berhasil sebelum benar-benar dicoba.

6. Kesimpulan

Pada tahap F.2, saya menambahkan method untuk menampilkan keranjang dan melengkapi Controller transaksi agar terhubung dengan Model, View, serta route. Dengan demikian, penyewa dapat mengakses keranjang miliknya dan melanjutkan proses pengelolaan transaksi sebelum checkout.

7. Git

Setelah perubahan disimpan dan pengujian dilakukan, saya menyimpan hasil praktikum ke folder "dpwl-nim-nama/pertemuan-07/", kemudian menjalankan perintah berikut di terminal VS Code:

