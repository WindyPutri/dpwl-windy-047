<?php

require_once APPPATH . 'models/Penyewa_model.php';
require_once APPPATH . 'models/Transaksi_model.php';
require_once APPPATH . 'helpers/auth_helper.php';
require_once APPPATH . 'helpers/flash_helper.php';

class Penyewa_controller extends Controller
{
    private Penyewa_model $model;
    private Transaksi_model $transaksiModel;

    public function __construct()
    {
        $this->model = new Penyewa_model();
        $this->transaksiModel = new Transaksi_model();
    }

    /* =====================================================
       P8 - MANAJEMEN PENYEWA ADMIN
       ===================================================== */

    public function index(): void
    {
        require_admin_login();

        try {
            $this->renderPenyewa();
        } catch (Throwable $e) {
            error_log('Daftar penyewa gagal: ' . $e->getMessage());
            http_response_code(500);
            exit('Data penyewa gagal ditampilkan. Periksa model dan database.');
        }
    }

    public function tambah(): void
    {
        require_admin_login();

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->renderPenyewa('tambah');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: GET, POST');
            exit('Metode request tidak diizinkan.');
        }

        $data = [
            'user_plg' => trim((string) ($_POST['user_plg'] ?? '')),
            'sandi' => (string) ($_POST['sandi'] ?? ''),
            'nik' => trim((string) ($_POST['nik'] ?? '')),
            'nm_lngkp' => trim((string) ($_POST['nm_lngkp'] ?? '')),
            'no_hp' => trim((string) ($_POST['no_hp'] ?? '')),
            'almt_lngkp' => trim((string) ($_POST['almt_lngkp'] ?? '')),
        ];

        $error = $this->validateDataAdmin($data, true);

        if ($error !== null) {
            $this->renderPenyewa('tambah', $data, $error);
            return;
        }

        $uploadedFiles = [];

        try {
            if ($this->model->findByUserPlg($data['user_plg']) !== null) {
                $this->renderPenyewa(
                    'tambah',
                    $data,
                    'Username penyewa sudah digunakan.'
                );
                return;
            }

            $ktp = $this->uploadFotoPenyewa('ft_ktp');

            if (!$ktp['success']) {
                $this->renderPenyewa('tambah', $data, $ktp['error']);
                return;
            }

            if ($ktp['filename'] !== null) {
                $uploadedFiles[] = $ktp['filename'];
            }

            $sim = $this->uploadFotoPenyewa('ft_sim_a');

            if (!$sim['success']) {
                $this->hapusFotoPenyewa($uploadedFiles);
                $this->renderPenyewa('tambah', $data, $sim['error']);
                return;
            }

            if ($sim['filename'] !== null) {
                $uploadedFiles[] = $sim['filename'];
            }

            $hash = password_hash($data['sandi'], PASSWORD_DEFAULT);

            if ($hash === false) {
                throw new RuntimeException('Hash password gagal dibuat.');
            }

            $berhasil = $this->model->createAdmin([
                'user_plg' => $data['user_plg'],
                'sandi' => $hash,
                'nik' => $data['nik'],
                'nm_lngkp' => $data['nm_lngkp'],
                'no_hp' => $data['no_hp'],
                'almt_lngkp' => $data['almt_lngkp'],
                'ft_ktp' => $ktp['filename'],
                'ft_sim_a' => $sim['filename'],
            ]);

            if (!$berhasil) {
                $this->hapusFotoPenyewa($uploadedFiles);
                $this->renderPenyewa(
                    'tambah',
                    $data,
                    'Data penyewa gagal disimpan.'
                );
                return;
            }

            set_flash_message('success', 'Data penyewa berhasil ditambahkan.');
            header('Location: ' . site_url('admin/penyewa'));
            exit;
        } catch (Throwable $e) {
            error_log('Tambah penyewa gagal: ' . $e->getMessage());
            $this->hapusFotoPenyewa($uploadedFiles);
            $this->renderPenyewa(
                'tambah',
                $data,
                'Data gagal disimpan. Periksa kembali database dan data penyewa.'
            );
        }
    }

    public function ubah(string $userPlg): void
    {
        require_admin_login();

        $userPlg = rawurldecode($userPlg);
        $lama = $this->model->getProfil($userPlg);

        if ($lama === null) {
            set_flash_message('danger', 'Data penyewa tidak ditemukan.');
            header('Location: ' . site_url('admin/penyewa'));
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->renderPenyewa('ubah', $lama);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: GET, POST');
            exit('Metode request tidak diizinkan.');
        }

        $data = [
            'user_plg' => $userPlg,
            'sandi' => (string) ($_POST['sandi'] ?? ''),
            'nik' => trim((string) ($_POST['nik'] ?? '')),
            'nm_lngkp' => trim((string) ($_POST['nm_lngkp'] ?? '')),
            'no_hp' => trim((string) ($_POST['no_hp'] ?? '')),
            'almt_lngkp' => trim((string) ($_POST['almt_lngkp'] ?? '')),
        ];

        $error = $this->validateDataAdmin($data, false);

        if ($error !== null) {
            $this->renderPenyewa(
                'ubah',
                array_merge($lama, $data),
                $error
            );
            return;
        }

        $uploadedFiles = [];
        $fotoLama = [];

        try {
            $ktp = $this->uploadFotoPenyewa('ft_ktp');

            if (!$ktp['success']) {
                $this->renderPenyewa(
                    'ubah',
                    array_merge($lama, $data),
                    $ktp['error']
                );
                return;
            }

            if ($ktp['filename'] !== null) {
                $uploadedFiles[] = $ktp['filename'];
            }

            $sim = $this->uploadFotoPenyewa('ft_sim_a');

            if (!$sim['success']) {
                $this->hapusFotoPenyewa($uploadedFiles);
                $this->renderPenyewa(
                    'ubah',
                    array_merge($lama, $data),
                    $sim['error']
                );
                return;
            }

            if ($sim['filename'] !== null) {
                $uploadedFiles[] = $sim['filename'];
            }

            $ftKtp = $ktp['filename'] ?? ($lama['ft_ktp'] ?? null);
            $ftSim = $sim['filename'] ?? ($lama['ft_sim_a'] ?? null);

            if ($ktp['filename'] !== null && !empty($lama['ft_ktp'])) {
                $fotoLama[] = ['ft_ktp', $lama['ft_ktp']];
            }

            if ($sim['filename'] !== null && !empty($lama['ft_sim_a'])) {
                $fotoLama[] = ['ft_sim_a', $lama['ft_sim_a']];
            }

            $hash = null;

            if ($data['sandi'] !== '') {
                if (
                    strlen($data['sandi']) < 8 ||
                    strlen($data['sandi']) > 72
                ) {
                    $this->hapusFotoPenyewa($uploadedFiles);
                    $this->renderPenyewa(
                        'ubah',
                        array_merge($lama, $data),
                        'Password baru harus terdiri dari 8 sampai 72 byte.'
                    );
                    return;
                }

                $hash = password_hash($data['sandi'], PASSWORD_DEFAULT);

                if ($hash === false) {
                    throw new RuntimeException('Hash password gagal dibuat.');
                }
            }

            $berhasil = $this->model->updateAdmin(
                $userPlg,
                $data['nik'],
                $data['nm_lngkp'],
                $data['no_hp'],
                $data['almt_lngkp'],
                $ftKtp,
                $ftSim,
                $hash
            );

            if (!$berhasil) {
                $this->hapusFotoPenyewa($uploadedFiles);
                $this->renderPenyewa(
                    'ubah',
                    array_merge($lama, $data),
                    'Data penyewa gagal diperbarui.'
                );
                return;
            }

            $this->hapusFotoPenyewa($fotoLama);

            set_flash_message('success', 'Data penyewa berhasil diperbarui.');
            header('Location: ' . site_url('admin/penyewa'));
            exit;
        } catch (Throwable $e) {
            error_log('Ubah penyewa gagal: ' . $e->getMessage());
            $this->hapusFotoPenyewa($uploadedFiles);
            $this->renderPenyewa(
                'ubah',
                array_merge($lama, $data),
                'Data gagal diperbarui. Periksa kembali database.'
            );
        }
    }

    public function hapus(string $userPlg): void
    {
        require_admin_login();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: POST');
            exit('Metode request tidak diizinkan.');
        }

        $userPlg = rawurldecode($userPlg);
        $penyewa = $this->model->getProfil($userPlg);

        if ($penyewa === null) {
            set_flash_message('danger', 'Data penyewa tidak ditemukan.');
            header('Location: ' . site_url('admin/penyewa'));
            exit;
        }

        try {
            $berhasil = $this->model->deleteAdmin($userPlg);
        } catch (Throwable $e) {
            error_log('Hapus penyewa gagal: ' . $e->getMessage());
            $berhasil = false;
        }

        if (!$berhasil) {
            set_flash_message(
                'danger',
                'Data gagal dihapus. Penyewa mungkin masih terhubung dengan transaksi.'
            );
            header('Location: ' . site_url('admin/penyewa'));
            exit;
        }

        $this->hapusFotoPenyewa([
            ['ft_ktp', $penyewa['ft_ktp'] ?? ''],
            ['ft_sim_a', $penyewa['ft_sim_a'] ?? ''],
        ]);

        set_flash_message('success', 'Data penyewa berhasil dihapus.');
        header('Location: ' . site_url('admin/penyewa'));
        exit;
    }

    private function renderPenyewa(
        ?string $mode = null,
        ?array $penyewaDipilih = null,
        ?string $error = null
    ): void {
        $this->view('admin/penyewa_view', [
            'username' => $_SESSION['admin_username'],
            'penyewa' => $this->model->getAll(),
            'flash' => $mode === null ? get_flash_message() : null,
            'mode' => $mode,
            'penyewa_dipilih' => $penyewaDipilih,
            'error' => $error,
        ]);
    }

    private function validateDataAdmin(
        array $data,
        bool $passwordWajib
    ): ?string {
        if (
            $data['user_plg'] === '' ||
            strlen($data['user_plg']) > 50 ||
            !preg_match('/\A[a-zA-Z0-9_.-]+\z/', $data['user_plg'])
        ) {
            return 'Username wajib diisi, maksimal 50 karakter, dan hanya boleh menggunakan huruf, angka, titik, garis bawah, atau tanda hubung.';
        }

        if (
            ($passwordWajib || $data['sandi'] !== '') &&
            (strlen($data['sandi']) < 8 || strlen($data['sandi']) > 72)
        ) {
            return 'Password harus terdiri dari 8 sampai 72 byte.';
        }

        if (!preg_match('/\A[0-9]{16}\z/', $data['nik'])) {
            return 'NIK wajib terdiri dari tepat 16 digit.';
        }

        if (
            $data['nm_lngkp'] === '' ||
            mb_strlen($data['nm_lngkp']) > 100
        ) {
            return 'Nama lengkap wajib diisi dan maksimal 100 karakter.';
        }

        if (
            $data['no_hp'] === '' ||
            strlen($data['no_hp']) > 15 ||
            !preg_match('/\A[0-9+(). -]+\z/', $data['no_hp']) ||
            !preg_match('/[0-9]/', $data['no_hp'])
        ) {
            return 'Nomor HP tidak valid atau melebihi 15 karakter.';
        }

        if (
            $data['almt_lngkp'] === '' ||
            mb_strlen($data['almt_lngkp']) > 300
        ) {
            return 'Alamat wajib diisi dan maksimal 300 karakter.';
        }

        return null;
    }

    /* =====================================================
       PROFIL PENYEWA
       ===================================================== */

    public function profil(): void
    {
        if (empty($_SESSION['penyewa_user_plg'])) {
            $_SESSION['flash_penyewa_nav'] =
                'Silakan login terlebih dahulu untuk mengakses profil.';

            header('Location: ' . site_url('auth/login-penyewa'));
            exit;
        }

        $userPlg = (string) $_SESSION['penyewa_user_plg'];

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            try {
                $profil = $this->model->getProfil($userPlg);

                if ($profil === null) {
                    unset($_SESSION['penyewa_user_plg']);

                    $_SESSION['flash_penyewa_nav'] =
                        'Data akun tidak ditemukan. Silakan login kembali.';

                    header('Location: ' . site_url('auth/login-penyewa'));
                    exit;
                }

                $flash = $_SESSION['flash_profil_penyewa'] ?? null;
                unset($_SESSION['flash_profil_penyewa']);

                $jumlahKeranjang =
                    $this->transaksiModel->getJumlahMobilKeranjang($userPlg);

                $this->view('penyewa/profil', [
                    'profil' => $profil,
                    'flash' => $flash,
                    'error' => null,
                    'old' => [],
                    'jumlahKeranjang' => $jumlahKeranjang,
                ]);

                return;
            } catch (Throwable $e) {
                error_log('Pengambilan profil penyewa gagal: ' . $e->getMessage());
                http_response_code(500);
                exit('Profil belum dapat ditampilkan. Silakan coba kembali.');
            }
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: GET, POST');
            exit('Method Not Allowed');
        }

        $nik = trim((string) ($_POST['nik'] ?? ''));
        $nama = trim((string) ($_POST['nm_lngkp'] ?? ''));
        $noHp = trim((string) ($_POST['no_hp'] ?? ''));
        $alamat = trim((string) ($_POST['almt_lngkp'] ?? ''));
        $passwordSaatIni = (string) ($_POST['password_saat_ini'] ?? '');
        $passwordBaru = (string) ($_POST['password_baru'] ?? '');
        $konfirmasiPassword = (string) ($_POST['konfirmasi_password'] ?? '');

        $old = [
            'nik' => $nik,
            'nm_lngkp' => $nama,
            'no_hp' => $noHp,
            'almt_lngkp' => $alamat,
        ];

        $error = $this->validateProfilInput($nik, $nama, $noHp, $alamat);
        $uploadedFiles = [];
        $profil = [];

        try {
            $profil = $this->model->getProfil($userPlg);

            if ($profil === null) {
                unset($_SESSION['penyewa_user_plg']);
                $_SESSION['flash_penyewa_nav'] =
                    'Data akun tidak ditemukan. Silakan login kembali.';
                header('Location: ' . site_url('auth/login-penyewa'));
                exit;
            }

            $passwordHashBaru = null;
            $inginGantiPassword =
                $passwordSaatIni !== '' ||
                $passwordBaru !== '' ||
                $konfirmasiPassword !== '';

            if ($inginGantiPassword) {
                if (
                    $passwordSaatIni === '' ||
                    $passwordBaru === '' ||
                    $konfirmasiPassword === ''
                ) {
                    $error = 'Untuk mengganti password, ketiga kolom password wajib diisi.';
                } elseif (strlen($passwordBaru) < 8 || strlen($passwordBaru) > 72) {
                    $error = 'Password baru harus terdiri dari 8 sampai 72 byte.';
                } elseif ($passwordBaru !== $konfirmasiPassword) {
                    $error = 'Konfirmasi password baru tidak sama.';
                } elseif (!$this->model->verifikasiPassword($userPlg, $passwordSaatIni)) {
                    $error = 'Password saat ini tidak sesuai.';
                } else {
                    $passwordHashBaru = password_hash(
                        $passwordBaru,
                        PASSWORD_DEFAULT
                    );

                    if ($passwordHashBaru === false) {
                        throw new RuntimeException('Hash password baru gagal dibuat.');
                    }
                }
            }

            $jumlahKeranjang =
                $this->transaksiModel->getJumlahMobilKeranjang($userPlg);

            if ($error !== null) {
                $this->view('penyewa/profil', [
                    'profil' => $profil,
                    'flash' => null,
                    'error' => $error,
                    'old' => $old,
                    'jumlahKeranjang' => $jumlahKeranjang,
                ]);
                return;
            }

            $uploadKtp = $this->uploadFotoPenyewa('ft_ktp');

            if (!$uploadKtp['success']) {
                $this->renderProfilError($profil, $old, $uploadKtp['error']);
                return;
            }

            if ($uploadKtp['filename'] !== null) {
                $uploadedFiles[] = $uploadKtp['filename'];
            }

            $uploadSim = $this->uploadFotoPenyewa('ft_sim_a');

            if (!$uploadSim['success']) {
                $this->hapusFotoPenyewa($uploadedFiles);
                $this->renderProfilError($profil, $old, $uploadSim['error']);
                return;
            }

            if ($uploadSim['filename'] !== null) {
                $uploadedFiles[] = $uploadSim['filename'];
            }

            $ftKtpBaru = $uploadKtp['filename'] ?? ($profil['ft_ktp'] ?? null);
            $ftSimBaru = $uploadSim['filename'] ?? ($profil['ft_sim_a'] ?? null);

            $success = $this->model->updateProfil(
                $userPlg,
                $nik,
                $nama,
                $noHp,
                $alamat,
                $ftKtpBaru,
                $ftSimBaru,
                $passwordHashBaru
            );

            if (!$success) {
                $this->hapusFotoPenyewa($uploadedFiles);
                $this->renderProfilError(
                    $profil,
                    $old,
                    'Profil gagal diperbarui. Periksa kembali data Anda.'
                );
                return;
            }

            $fotoLama = [];

            if ($uploadKtp['filename'] !== null && !empty($profil['ft_ktp'])) {
                $fotoLama[] = ['ft_ktp', $profil['ft_ktp']];
            }

            if ($uploadSim['filename'] !== null && !empty($profil['ft_sim_a'])) {
                $fotoLama[] = ['ft_sim_a', $profil['ft_sim_a']];
            }

            $this->hapusFotoPenyewa($fotoLama);

            $_SESSION['flash_profil_penyewa'] = 'Profil berhasil diperbarui.';
            header('Location: ' . site_url('penyewa/profil'));
            exit;
        } catch (Throwable $e) {
            error_log('Update profil penyewa gagal: ' . $e->getMessage());
            $this->hapusFotoPenyewa($uploadedFiles);

            $this->renderProfilError(
                $profil,
                $old,
                'Profil belum berhasil diperbarui. Silakan coba kembali.'
            );
        }
    }

    private function validateProfilInput(
        string $nik,
        string $nama,
        string $noHp,
        string $alamat
    ): ?string {
        if (!preg_match('/\A[0-9]{16}\z/', $nik)) {
            return 'NIK wajib terdiri dari tepat 16 digit angka.';
        }

        if (
            $nama === '' ||
            mb_strlen($nama) > 100 ||
            !preg_match("/\A[\p{L}\p{M}]+(?:[ .'-][\p{L}\p{M}]+)*\z/u", $nama)
        ) {
            return 'Nama lengkap wajib diisi, maksimal 100 karakter, dan hanya berisi huruf serta pemisah nama yang wajar.';
        }

        if (
            $noHp === '' ||
            strlen($noHp) > 15 ||
            !preg_match('/\A[0-9+(). -]+\z/', $noHp) ||
            !preg_match('/[0-9]/', $noHp)
        ) {
            return 'Nomor HP wajib diisi, maksimal 15 karakter, dan hanya boleh berisi angka serta tanda +, titik, kurung, spasi, atau tanda hubung.';
        }

        if (
            $alamat === '' ||
            mb_strlen($alamat) > 300 ||
            preg_match('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', $alamat)
        ) {
            return 'Alamat wajib diisi, maksimal 300 karakter, dan tidak boleh mengandung karakter kontrol.';
        }

        return null;
    }

    private function renderProfilError(
        array $profil,
        array $old,
        string $error
    ): void {
        $userPlg = trim((string) ($_SESSION['penyewa_user_plg'] ?? ''));
        $jumlahKeranjang = $userPlg === ''
            ? 0
            : $this->transaksiModel->getJumlahMobilKeranjang($userPlg);

        $this->view('penyewa/profil', [
            'profil' => $profil,
            'flash' => null,
            'error' => $error,
            'old' => $old,
            'jumlahKeranjang' => $jumlahKeranjang,
        ]);
    }

    /* =====================================================
       UNGGAH DAN HAPUS FOTO KTP/SIM A
       ===================================================== */

    private function uploadFotoPenyewa(string $field): array
    {
        if (!in_array($field, ['ft_ktp', 'ft_sim_a'], true)) {
            return [
                'success' => false,
                'filename' => null,
                'error' => 'Field foto tidak valid.',
            ];
        }

        if (
            !isset($_FILES[$field]) ||
            ($_FILES[$field]['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE
        ) {
            return ['success' => true, 'filename' => null, 'error' => null];
        }

        $file = $_FILES[$field];

        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            return [
                'success' => false,
                'filename' => null,
                'error' => 'Unggah foto gagal. Periksa ukuran file dan konfigurasi PHP.',
            ];
        }

        if (
            !isset($file['tmp_name'], $file['size']) ||
            !is_uploaded_file($file['tmp_name']) ||
            (int) $file['size'] < 1 ||
            (int) $file['size'] > 5 * 1024 * 1024
        ) {
            return [
                'success' => false,
                'filename' => null,
                'error' => 'Foto harus berukuran lebih dari 0 byte dan maksimal 5 MB.',
            ];
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($file['tmp_name']);

        $allowed = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
        ];

        if (!isset($allowed[$mime]) || @getimagesize($file['tmp_name']) === false) {
            return [
                'success' => false,
                'filename' => null,
                'error' => 'Format foto harus JPEG, PNG, atau WEBP yang valid.',
            ];
        }

        $uploadDir = dirname(APPPATH) . DIRECTORY_SEPARATOR . 'uploads'
            . DIRECTORY_SEPARATOR . 'penyewa' . DIRECTORY_SEPARATOR;

        if (
            !is_dir($uploadDir) &&
            !mkdir($uploadDir, 0755, true) &&
            !is_dir($uploadDir)
        ) {
            return [
                'success' => false,
                'filename' => null,
                'error' => 'Folder penyimpanan foto tidak dapat dibuat.',
            ];
        }

        if (!is_writable($uploadDir)) {
            return [
                'success' => false,
                'filename' => null,
                'error' => 'Folder penyimpanan foto tidak dapat ditulis.',
            ];
        }

        try {
            $filename = $field . '_' . date('YmdHis') . '_'
                . bin2hex(random_bytes(8)) . '.' . $allowed[$mime];
        } catch (Throwable $e) {
            return [
                'success' => false,
                'filename' => null,
                'error' => 'Nama file foto gagal dibuat.',
            ];
        }

        if (!move_uploaded_file($file['tmp_name'], $uploadDir . $filename)) {
            return [
                'success' => false,
                'filename' => null,
                'error' => 'Foto gagal dipindahkan ke folder penyimpanan.',
            ];
        }

        return ['success' => true, 'filename' => $filename, 'error' => null];
    }

    private function hapusFotoPenyewa(array $files): void
    {
        $uploadDir = dirname(APPPATH) . DIRECTORY_SEPARATOR . 'uploads'
            . DIRECTORY_SEPARATOR . 'penyewa' . DIRECTORY_SEPARATOR;

        foreach ($files as $item) {
            if (is_array($item)) {
                [$field, $filename] = $item;
            } else {
                $filename = $item;
                $field = is_string($filename)
                    ? (str_starts_with($filename, 'ft_ktp_') ? 'ft_ktp' : 'ft_sim_a')
                    : '';
            }

            if (
                !in_array($field, ['ft_ktp', 'ft_sim_a'], true) ||
                !is_string($filename)
            ) {
                continue;
            }

            $pattern = '/^' . preg_quote($field, '/') .
                '_\d{14}_[a-f0-9]{16}\.(jpg|png|webp)$/';

            if (!preg_match($pattern, $filename)) {
                continue;
            }

            $path = $uploadDir . $filename;

            if (is_file($path)) {
                @unlink($path);
            }
        }
    }
}