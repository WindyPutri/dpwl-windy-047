<?php
require APPPATH . 'views/templates/header.php';
require APPPATH . 'views/templates/sidebar.php';

$pembayaran = $data['pembayaran'] ?? [];
?>

<!-- Content Wrapper. Berfungsi menyamakan layout AdminLTE -->
<div class="content-wrapper">

    <!-- Pesan notifikasi -->
    <?php if (isset($_SESSION['flash_verifikasi'])): ?>
        <section class="content" style="padding-bottom: 0;">
            <div class="alert alert-info alert-dismissible">
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true">&times;</button>

                <?= htmlspecialchars(
                    (string) $_SESSION['flash_verifikasi'],
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </div>
        </section>

        <?php unset($_SESSION['flash_verifikasi']); ?>
    <?php endif; ?>

    <!-- Judul halaman -->
    <section class="content-header">
        <h1>
            Verifikasi Pembayaran
            <small>Kelola pembayaran penyewa</small>
        </h1>
    </section>

    <!-- Konten utama -->
    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">
                    Daftar Pembayaran Menunggu Verifikasi
                </h3>
            </div>

            <div class="box-body table-responsive">

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Kode Bayar</th>
                            <th>Kode Transaksi</th>
                            <th>Nominal</th>
                            <th>Waktu Pembayaran</th>
                            <th>Bukti Transfer</th>
                            <th>Status</th>
                            <th style="min-width: 160px;">Tindakan</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (empty($pembayaran)): ?>

                            <tr>
                                <td colspan="7" class="text-center">
                                    Belum ada pembayaran untuk diverifikasi.
                                </td>
                            </tr>

                        <?php else: ?>

                            <?php foreach ($pembayaran as $item): ?>
                                <tr>
                                    <td>
                                        <?= htmlspecialchars(
                                            (string) ($item['kode_bayar'] ?? '-'),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(
                                            (string) ($item['kode_sewa'] ?? '-'),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </td>

                                    <td>
                                        Rp <?= number_format(
                                            (float) ($item['nominal'] ?? 0),
                                            0,
                                            ',',
                                            '.'
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars(
                                            (string) ($item['tgl_wkt_byr'] ?? '-'),
                                            ENT_QUOTES,
                                            'UTF-8'
                                        ) ?>
                                    </td>

                                    <td>
                                        <?php if (!empty($item['ft_byr'])): ?>

                                            <?php
                                            $bukti = base_url(
                                                'uploads/bayar/' .
                                                basename($item['ft_byr'])
                                            );
                                            ?>

                                            <a
                                                href="<?= htmlspecialchars(
                                                    $bukti,
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>"
                                                target="_blank"
                                                rel="noopener noreferrer">
                                                <i class="fa fa-eye"></i>
                                                Lihat Bukti
                                            </a>

                                        <?php else: ?>

                                            <span class="text-muted">
                                                Belum ada bukti
                                            </span>

                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php
                                        $status = $item['sttus_byr'] ?? 'pending';
                                        ?>

                                        <?php if ($status === 'pending'): ?>
                                            <span class="label label-warning">
                                                Pending
                                            </span>
                                        <?php elseif ($status === 'valid'): ?>
                                            <span class="label label-success">
                                                Valid
                                            </span>
                                        <?php elseif ($status === 'invalid'): ?>
                                            <span class="label label-danger">
                                                Invalid
                                            </span>
                                        <?php else: ?>
                                            <?= htmlspecialchars(
                                                (string) $status,
                                                ENT_QUOTES,
                                                'UTF-8'
                                            ) ?>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if ($status === 'pending'): ?>

                                            <form
                                                method="post"
                                                action="<?= htmlspecialchars(
                                                    site_url(
                                                        'admin/verifikasi-bayar/proses'
                                                    ),
                                                    ENT_QUOTES,
                                                    'UTF-8'
                                                ) ?>">

                                                <input
                                                    type="hidden"
                                                    name="kode_bayar"
                                                    value="<?= htmlspecialchars(
                                                        (string) $item['kode_bayar'],
                                                        ENT_QUOTES,
                                                        'UTF-8'
                                                    ) ?>">

                                                <button
                                                    type="submit"
                                                    name="keputusan"
                                                    value="terima"
                                                    class="btn btn-success btn-sm"
                                                    onclick="return confirm('Terima pembayaran ini?')">
                                                    <i class="fa fa-check"></i>
                                                    Terima
                                                </button>

                                                <button
                                                    type="submit"
                                                    name="keputusan"
                                                    value="tolak"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Tolak pembayaran ini?')">
                                                    <i class="fa fa-times"></i>
                                                    Tolak
                                                </button>

                                            </form>

                                        <?php else: ?>

                                            <span class="text-muted">
                                                Sudah diverifikasi
                                            </span>

                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </section>
</div>

<?php require APPPATH . 'views/templates/footer.php'; ?>