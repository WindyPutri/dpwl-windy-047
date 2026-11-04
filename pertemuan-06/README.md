## A.6. Pemeriksaan Ketersediaan Aset TemplateMo Zay Shop

Pemeriksaan dilakukan untuk memastikan seluruh folder dan berkas aset TemplateMo Zay Shop tersedia dan siap digunakan dalam tahap integrasi antarmuka aplikasi DPWL.

### 1. Struktur Folder Aset

Lokasi aset yang diperiksa:

```text
dpwl-nim/
└── assets/
    └── zay/
        ├── css/
        ├── img/
        ├── js/
        └── webfonts/
```

### 2. Hasil Pemeriksaan Aset

| No. | Folder/Berkas | Status |
|---|---|---|
| 1 | assets/zay/css/ | Ditemukan |
| 2 | assets/zay/img/ | Ditemukan |
| 3 | assets/zay/js/ | Ditemukan |
| 4 | assets/zay/webfonts/ | Ditemukan |

### 3. Hasil Pemeriksaan

Berdasarkan pemeriksaan yang telah dilakukan, seluruh folder aset yang dibutuhkan telah tersedia dan tidak ditemukan kekurangan berkas pada folder yang diperiksa.

Folder CSS berisi berkas untuk pengaturan tampilan, folder img berisi gambar, folder JS berisi berkas JavaScript, sedangkan folder webfonts berisi berkas font yang digunakan oleh template.

### 4. Ketidaksesuaian Jalur

Seluruh folder aset yang diperiksa telah tersedia pada lokasi yang diharapkan, yaitu `assets/zay/`. Tidak ditemukan ketidaksesuaian jalur berdasarkan pemeriksaan folder.

### 5. Kesimpulan Pemeriksaan

Berdasarkan hasil pemeriksaan, aset TemplateMo Zay Shop telah lengkap dan tersedia untuk digunakan pada tahap integrasi ke dalam aplikasi DPWL. Pemeriksaan ini baru memastikan ketersediaan aset dan kesesuaian lokasi folder. Keberhasilan tampilan, navigasi, dan pemuatan aset pada aplikasi belum dapat dinyatakan sebelum integrasi dan pengujian melalui aplikasi MVC dilakukan.

## B.4. Pengujian Integrasi Model, Controller, View, dan Navigasi Katalog

### 1. Tujuan Pengujian

Pengujian ini dilakukan untuk memastikan Model, Controller, View, dan Routing dapat bekerja sama dalam menampilkan katalog kendaraan pada aplikasi DPWL. Pengujian juga bertujuan memastikan data kendaraan dari database dapat diambil dan ditampilkan melalui halaman katalog.

### 2. Langkah Pengujian

Pengujian dilakukan dengan langkah-langkah berikut:

1. Menjalankan Apache dan MySQL melalui Laragon.
2. Memastikan database aplikasi DPWL sudah tersedia dan dapat diakses.
3. Membuka browser.
4. Mengakses halaman katalog melalui URL:

   `http://localhost/dpwl-[NIM]/index.php/katalog`

5. Memeriksa apakah halaman katalog dapat dibuka dan data kendaraan ditampilkan.
6. Memeriksa informasi kendaraan, seperti nama mobil, foto, jenis kendaraan, kapasitas, harga sewa, dan status ketersediaan.
7. Memastikan data yang ditampilkan berasal dari database melalui Model dan diproses oleh Controller sebelum ditampilkan oleh View.

### 3. Hasil Pengujian

| No. | Skenario Pengujian | Hasil yang Diharapkan | Hasil Aktual |
|---|---|---|---|
| 1 | Membuka URL katalog | Halaman katalog dapat diakses | [Isi sesuai hasil pengujian] |
| 2 | Mengambil data kendaraan | Data kendaraan berhasil diambil dari database | [Isi sesuai hasil pengujian] |
| 3 | Menampilkan daftar kendaraan | Informasi kendaraan ditampilkan pada halaman katalog | [Isi sesuai hasil pengujian] |
| 4 | Menampilkan foto kendaraan | Foto kendaraan ditampilkan sesuai data yang tersedia | [Isi sesuai hasil pengujian] |
| 5 | Memeriksa status kendaraan | Status ketersediaan kendaraan ditampilkan sesuai data | [Isi sesuai hasil pengujian] |

### 4. Hasil dan Analisis

Pengujian dilakukan untuk memeriksa hubungan antara Model, Controller, dan View dalam fitur katalog kendaraan. Model bertugas mengambil data kendaraan dari tabel `t_mobil` menggunakan method `getKatalog()`. Controller menerima request melalui route `katalog`, memanggil Model untuk mendapatkan data, kemudian mengirimkan data tersebut ke View. View bertugas menampilkan data kendaraan kepada pengguna.

Apabila seluruh pengujian berhasil, berarti integrasi Model, Controller, View, dan Routing pada halaman katalog telah berjalan sesuai kebutuhan. Jika ditemukan kesalahan, lakukan pemeriksaan pada route, method Controller, query Model, koneksi database, dan pemanggilan View.

### 5. Kesimpulan

Berdasarkan pengujian yang dilakukan, hasil integrasi fitur katalog kendaraan dicatat sesuai kondisi aktual aplikasi. Pengujian ini digunakan untuk memastikan proses pengambilan data kendaraan dari database hingga ditampilkan pada halaman katalog berjalan dengan benar.