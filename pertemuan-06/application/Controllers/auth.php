<?php

class Auth extends Controller
{
    /**
     * P3: Login admin.
     * URL: index.php/auth/login
     */
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view('auth/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: GET, POST');
            exit('Method Not Allowed');
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if (
            $username === '' ||
            strlen($username) > 15 ||
            preg_match('/[\x00-\x1F\x7F]/', $username)
        ) {
            $this->view('auth/login', [
                'error' => 'Username tidak valid.'
            ]);
            return;
        }

        if (!is_string($password) || $password === '') {
            $this->view('auth/login', [
                'error' => 'Password wajib diisi.'
            ]);
            return;
        }

        require_once APPPATH . 'models/Admin_model.php';

        try {
            $model = new Admin_model();
            $admin = $model->findByUsername($username);

            if (
                !$admin ||
                ($admin['status_akun'] ?? '') !== 'aktif' ||
                !isset($admin['password']) ||
                !is_string($admin['password']) ||
                !password_verify($password, $admin['password'])
            ) {
                $this->view('auth/login', [
                    'error' => 'Username atau password tidak sesuai.'
                ]);
                return;
            }

            session_regenerate_id(true);

            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_status'] = $admin['status_akun'];

            header('Location: ' . site_url('admin'));
            exit;
        } catch (Throwable $e) {
            error_log('Login admin gagal: ' . $e->getMessage());

            $this->view('auth/login', [
                'error' => 'Login belum dapat diproses. Silakan coba kembali.'
            ]);
            return;
        }
    }

    /**
     * P3: Logout admin.
     * URL: index.php/auth/logout
     * Form logout harus menggunakan POST.
     */
    public function logout(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: POST');
            exit('Method Not Allowed');
        }

        unset(
            $_SESSION['admin_username'],
            $_SESSION['admin_status']
        );

        session_regenerate_id(true);

        header('Location: ' . site_url('auth/login'));
        exit;
    }

    /**
     * P6: Login penyewa.
     * URL: index.php/auth/login-penyewa
     *
     * Membutuhkan Penyewa_model::findByUserPlg().
     * Password pada database harus berupa hash password.
     */
    public function login_penyewa(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->view('auth/login_penyewa');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: GET, POST');
            exit('Method Not Allowed');
        }

        $userPlg = trim($_POST['user_plg'] ?? '');
        $password = $_POST['sandi'] ?? '';

        if (
            !is_string($userPlg) ||
            !preg_match('/\A[A-Za-z0-9._-]{1,15}\z/', $userPlg)
        ) {
            $this->view('auth/login_penyewa', [
                'error' => 'Username tidak valid.'
            ]);
            return;
        }

        if (!is_string($password) || $password === '') {
            $this->view('auth/login_penyewa', [
                'error' => 'Password wajib diisi.'
            ]);
            return;
        }

        try {
            require_once APPPATH . 'models/Penyewa_model.php';

            $model = new Penyewa_model();
           $penyewa = $model->findForLogin($userPlg);

            if (
                !$penyewa ||
                !isset($penyewa['sandi']) ||
                !is_string($penyewa['sandi']) ||
                !password_verify($password, $penyewa['sandi'])
            ) {
                $this->view('auth/login_penyewa', [
                    'error' => 'Username atau password tidak sesuai.'
                ]);
                return;
            }

            session_regenerate_id(true);

            // Sesi penyewa dipisahkan dari sesi admin.
            $_SESSION['penyewa_user_plg'] = $penyewa['user_plg'];
            $_SESSION['penyewa_nama'] = $penyewa['nm_lngkp'] ?? '';

            header('Location: ' . site_url('katalog'));
            exit;
        } catch (Throwable $e) {
            error_log('Login penyewa gagal: ' . $e->getMessage());

            $this->view('auth/login_penyewa', [
                'error' => 'Login penyewa belum dapat diproses. Silakan coba kembali.'
            ]);
            return;
        }
    }

    /**
     * P6: Registrasi penyewa.
     * URL: index.php/auth/register
     */
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $flash = $_SESSION['flash_penyewa'] ?? null;
            unset($_SESSION['flash_penyewa']);

            $this->view('auth/register', [
                'success' => $flash
            ]);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            header('Allow: GET, POST');
            exit('Method Not Allowed');
        }

        $userPlg = trim($_POST['user_plg'] ?? '');
        $password = $_POST['sandi'] ?? '';
        $confirmPassword = $_POST['konfirmasi_sandi'] ?? '';
        $nik = trim($_POST['nik'] ?? '');
        $nama = trim($_POST['nm_lngkp'] ?? '');
        $noHp = trim($_POST['no_hp'] ?? '');
        $alamat = trim($_POST['almt_lngkp'] ?? '');

        $old = [
            'user_plg' => $userPlg,
            'nik' => $nik,
            'nm_lngkp' => $nama,
            'no_hp' => $noHp,
            'almt_lngkp' => $alamat
        ];

        $error = null;

        if (
            !preg_match('/\A[A-Za-z0-9._-]{1,15}\z/', $userPlg)
        ) {
            $error = 'Username harus terdiri dari 1–15 karakter: huruf, angka, titik, garis bawah, atau tanda hubung.';
        } elseif (
            !is_string($password) ||
            strlen($password) < 8
        ) {
            $error = 'Password minimal 8 karakter.';
        } elseif (
            !is_string($confirmPassword) ||
            $password !== $confirmPassword
        ) {
            $error = 'Konfirmasi password tidak sama.';
        } elseif (!preg_match('/\A[0-9]{16}\z/', $nik)) {
            $error = 'NIK harus terdiri dari 16 digit angka.';
        } elseif ($nama === '' || strlen($nama) > 100) {
            $error = 'Nama lengkap wajib diisi, maksimal 100 karakter.';
        } elseif (
            $noHp === '' ||
            strlen($noHp) > 15 ||
            !preg_match('/\A[0-9+(). -]+\z/', $noHp)
        ) {
            $error = 'Nomor HP wajib diisi dan formatnya tidak valid.';
        } elseif ($alamat === '' || strlen($alamat) > 300) {
            $error = 'Alamat wajib diisi, maksimal 300 karakter.';
        }

        if ($error !== null) {
            $this->view('auth/register', [
                'error' => $error,
                'old' => $old
            ]);
            return;
        }

        try {
            require_once APPPATH . 'models/Penyewa_model.php';

            $model = new Penyewa_model();

            if ($model->findByUserPlg($userPlg) !== null) {
                $this->view('auth/register', [
                    'error' => 'Username sudah digunakan.',
                    'old' => $old
                ]);
                return;
            }

            $hash = password_hash($password, PASSWORD_DEFAULT);

            if ($hash === false) {
                throw new RuntimeException(
                    'Pembuatan hash password gagal.'
                );
            }

            $created = $model->create([
                'user_plg' => $userPlg,
                'sandi' => $hash,
                'nik' => $nik,
                'nm_lngkp' => $nama,
                'no_hp' => $noHp,
                'almt_lngkp' => $alamat
            ]);

            if (!$created) {
                throw new RuntimeException(
                    'Penyimpanan data penyewa gagal.'
                );
            }

            $_SESSION['flash_penyewa'] =
                'Registrasi berhasil. Silakan login menggunakan akun Anda.';

            header('Location: ' . site_url('auth/register'));
            exit;
        } catch (Throwable $e) {
            error_log(
                'Registrasi penyewa gagal: ' . $e->getMessage()
            );

            $this->view('auth/register', [
                'error' => 'Registrasi belum berhasil diproses. Periksa data dan coba kembali.',
                'old' => $old
            ]);
            return;
        }
    }
}