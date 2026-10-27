Tahap A
1. Perubahan yang Dilakukan

Pada tahap A, saya telah menambahkan menu Manajemen Kendaraan pada sidebar AdminLTE dan mengatur route "admin/mobil" agar menu tersebut dapat diarahkan ke halaman manajemen kendaraan.

2. File yang Diubah

- "application/config/routes.php"
- "application/views/templates/sidebar.php"
- "pertemuan-05/README.md"

3. Hasil Pengujian:

Pengujian dilakukan dengan menjalankan aplikasi dan masuk menggunakan akun admin. Setelah itu, saya memeriksa apakah menu Manajemen Kendaraan tampil pada sidebar dan mengklik menu tersebut.

- Menu Manajemen Kendaraan tampil pada sidebar.
- URL berubah menjadi "admin/mobil".
- Halaman kendaraan belum dapat ditampilkan karena file controller mobil belum dibuat.
- Pesan “Controller tidak ditemukan” muncul sesuai dengan kondisi yang diharapkan pada tahap A.

Tahap B
B.3

1. Perubahan yang Dilakukan

Pada tahap B, saya menambahkan tiga route baru untuk operasi Manajemen Kendaraan, yaitu route tambah, ubah, dan hapus kendaraan. Route tersebut digunakan untuk menghubungkan URL dengan method yang sesuai pada "Mobil_controller".

2. Berkas yang Terdampak

- "application/config/routes.php"
- "pertemuan-05/README.md"

3. Hasil Pengujian

Pengujian dilakukan dengan memeriksa konfigurasi route dan mengakses URL yang telah disiapkan. Menu Manajemen Kendaraan mengarah ke URL yang sesuai. Namun, halaman kendaraan belum dapat ditampilkan karena file "Mobil_controller.php" belum dibuat. Pesan "Controller tidak ditemukan" masih muncul dan merupakan kondisi yang diharapkan pada tahap ini.

C.6

## Berkas yang Ditambahkan / Diubah
| Berkas | Keterangan |
|---|---|
| `application/controllers/Mobil_controller.php` | Controller kendaraan: `renderMobil()`, `validateMobilInput()`, `uploadFoto()`, `hapusFotoBaru()` |
| `application/models/Mobil_model.php` | Model data kendaraan, method `getAll()` |
| `application/views/admin/mobil_view.php` | Tampilan daftar kendaraan |
| (tambahkan berkas lain, mis. menu sidebar) | ... |

## Alur READ yang Diimplementasikan
1. Admin klik menu **Manajemen Kendaraan** di sidebar.
2. Request menuju `index.php/admin/mobil`.
3. Controller memanggil `renderMobil()`.
4. `renderMobil()` mengambil data lewat `$this->model->getAll()`.
5. Data dikirim ke view `admin/mobil_view` dan ditampilkan dalam tabel.

## Hasil Pengujian Aktual
| No | Skenario | Hasil yang Diharapkan | Hasil Aktual | Status |
|---|---|---|---|---|
| 1 | Buka menu Manajemen Kendaraan | Daftar kendaraan tampil | (isi) | (Berhasil/Gagal) |
| 2 | Data kosong | Tabel tampil tanpa error | (isi) | (isi) |
| 3 | Akses tanpa login | Diarahkan ke halaman login | (isi) | (isi) |

## Catatan
- Pemeriksaan kode: (isi hasil membaca/meninjau kode)
- Pengujian aktual: (isi hasil menjalankan aplikasi di browser)

P5 — CRUD Kendaraan (INSERT)

Perubahan yang dilakukan

1. Mobil_model.php: Menambahkan proses penyimpanan data kendaraan ke database.
2. Mobil_controller.php: Menambahkan proses INSERT, validasi input kendaraan, dan pengunggahan foto.
3. mobil_view.php: Menambahkan formulir kendaraan, input data, unggah foto, dan pratinjau foto.

Pengujian

- Penambahan data kendaraan: [isi hasil pengujian aktual].
- Validasi input: [isi hasil pengujian aktual].
- Unggah foto kendaraan: [isi hasil pengujian aktual].
- Penyimpanan ke database: [isi hasil pengujian aktual].

Catatan

Hasil pengujian ditulis berdasarkan pengujian yang benar-benar dilakukan pada aplikasi.

E.6. Memperbarui README.md dan Mencatat Perubahan Git

Pada tahap ini, saya memperbarui file "pertemuan-05/README.md" untuk mencatat implementasi fitur UPDATE data kendaraan. Perubahan dilakukan pada file "Mobil_model.php", "Mobil_controller.php", dan "mobil_view.php".

Pengujian dilakukan dengan memeriksa halaman manajemen kendaraan, formulir tambah dan ubah data, validasi input, serta fitur unggah foto. Hasil pengujian dicatat berdasarkan kondisi aplikasi yang benar-benar dijalankan.

Selanjutnya, saya memeriksa perubahan kode menggunakan perintah "git status" dan "git diff", kemudian menyimpan perubahan dengan commit dan mengirimkannya ke repositori GitHub menggunakan "git push".

Kesimpulan: Implementasi UPDATE dan dokumentasi perubahan Git disiapkan sebagai bagian dari penyelesaian Pertemuan 5 sebelum melanjutkan ke tahap DELETE.

F.4. Implementasi DELETE Data Kendaraan

1. Implementasi

Fitur DELETE digunakan untuk menghapus data kendaraan berdasarkan nomor plat. Proses penghapusan dilakukan melalui Controller dan Model menggunakan prepared statement, kemudian halaman menampilkan pesan hasil proses.

2. Perubahan Berkas

- "application/controllers/Mobil_controller.php" — menangani proses penghapusan data kendaraan.
- "application/models/Mobil_model.php" — menjalankan query DELETE menggunakan prepared statement.
- "application/views/admin/mobil_view.php" — menampilkan tombol aksi hapus kendaraan.
- Berkas pendukung lain: sesuaikan dengan perubahan aktual.

3. Pemeriksaan Kode

- [ ] Memeriksa route dan method untuk proses hapus.
- [ ] Memeriksa query DELETE dan parameter nomor plat.
- [ ] Memeriksa tombol hapus dan pesan hasil proses.

### 4. Hasil Pengujian Aktual

- Penghapusan data kendaraan: Berhasil, data kendaraan dapat dihapus melalui tombol Hapus.
- Data terhapus dari tabel: Berhasil, data kendaraan yang dipilih sudah tidak muncul lagi pada daftar kendaraan.
- Pesan berhasil atau gagal: Berhasil, sistem menampilkan pesan bahwa data kendaraan berhasil dihapus.

Catatan: Pemeriksaan kode tidak sama dengan pengujian langsung pada aplikasi. Isi hasil pengujian setelah benar-benar mencoba fitur DELETE.