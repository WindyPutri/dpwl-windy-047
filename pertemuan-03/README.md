### Penerapan Post-Redirect-Get (PRG)
Pada tahap ini dilakukan penelusuran dan pengujian pola
Post-Redirect-Get (PRG) pada proses autentikasi.
Penerapan PRG:
- Login berhasil menggunakan POST untuk proses autentikasi,
kemudian redirect ke /admin dan dilanjutkan dengan GET.
- Logout menggunakan POST untuk mengakhiri session,
kemudian redirect ke /auth/login dan dilanjutkan dengan GET.
Login gagal tidak menggunakan redirect karena Controller
mengembalikan View login beserta pesan kesalahan pada
request tersebut.
Pengujian aktual dilakukan terhadap:
| No. | Skenario Pengujian | Hasil Aktual | Status |
| --: | ----------------------------------- | ---------------- | ----------------------- |
| 1 | Login dengan kredensial valid | `[berhasil login dan masuk ke halaman administrasi]` | `[Sesuai]` |
| 2 | Login dengan kredensial tidak valid | `[login ditolak dan muncul pesan kesalahan]` | `[Sesua]` |
| 3 | Logout melalui halaman administrasi | `berhasil logout dan kembali ke halaman login]` | `[Sesuai]` |
| 4 | Akses halaman admin setelah logout | `[pengguna diarahkan kembali ke halaman login]` | `[Sesuai]` |
Catat hasil berdasarkan eksekusi yang benar-benar dilakukan. Jika ditemukan masalah, dokumentasikan
perbaikan yang dilakukan dan ulangi pengujian yang terdampak.
### Perbaikan
| Masalah yang Ditemukan | Perbaikan yang Dilakukan | Hasil Setelah Perbaikan |
| ---------------------- | ------------------------ | ----------------------- |
| `[tidak ditemukan masalah pada fitur login dan logout]` | `[tidak dilakukan perbaikan karena fitur berjalan sesuai dengan yang diharapkan]` | `[login,logout dan pembatasan akses halaman admin berjalan dengan baik]` |
Jika tidak ditemukan masalah, tuliskan:
> Tidak ditemukan masalah pada saat pengujian M.3.