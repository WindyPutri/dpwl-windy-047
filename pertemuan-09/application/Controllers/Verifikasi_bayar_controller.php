<?php

require_once APPPATH . 'models/Verifikasi_bayar_model.php';

class Verifikasi_bayar_controller extends Controller
{
    private Verifikasi_bayar_model $model;

    public function __construct()
    {
        $this->model = new Verifikasi_bayar_model();
    }

    public function index(): void
    {
        if (empty($_SESSION['admin_username'])) {
            header('Location: ' . site_url('login'));
            exit;
        }

        $data = [
            'pembayaran' => $this->model->getMenungguVerifikasi()
        ];

        require APPPATH . 'views/admin/verifikasi_bayar_view.php';
    }

    public function proses(): void
    {
        if (empty($_SESSION['admin_username'])) {
            http_response_code(403);
            exit('Akses ditolak.');
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode permintaan tidak diizinkan.');
        }

        $kodeBayar = trim($_POST['kode_bayar'] ?? '');
        $keputusan = $_POST['keputusan'] ?? '';

        if ($kodeBayar === '') {
            $_SESSION['flash_verifikasi'] =
                'Kode pembayaran wajib diisi.';
        } else {
            try {
                $this->model->verifikasi(
                    $kodeBayar,
                    $keputusan
                );

                $_SESSION['flash_verifikasi'] =
                    $keputusan === 'terima'
                        ? 'Pembayaran berhasil diterima.'
                        : 'Pembayaran berhasil ditolak.';
            } catch (Throwable $e) {
                error_log($e->getMessage());

                $_SESSION['flash_verifikasi'] =
                    'Verifikasi gagal. Periksa status dan bukti pembayaran.';
            }
        }

        header('Location: ' . site_url('admin/verifikasi-bayar'));
        exit;
    }
}