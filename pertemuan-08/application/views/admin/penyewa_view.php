<?php
require APPPATH . '/views/templates/header.php';
require APPPATH . '/views/templates/sidebar.php';

$penyewa = $penyewa ?? [];
$flash = $flash ?? null;
$error = $error ?? null;

$mode = $mode ?? null;
$penyewa_dipilih = $penyewa_dipilih ?? null;

$isForm = in_array($mode, ['tambah', 'ubah'], true);
$isEdit = $mode === 'ubah';

$userPlgDipilih = $penyewa_dipilih['user_plg'] ?? '';

$formAction = $isEdit
    ? site_url('admin/penyewa/ubah/' . rawurlencode((string) $userPlgDipilih))
    : site_url('admin/penyewa/tambah');

$flashClass = (($flash['type'] ?? '') === 'success')
    ? 'alert-success'
    : 'alert-danger';
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Manajemen Penyewa
            <small>Kelola data penyewa</small>
        </h1>

        <ol class="breadcrumb">
            <li>
                <a href="<?= htmlspecialchars(site_url('admin'), ENT_QUOTES, 'UTF-8') ?>">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
            </li>
            <li class="active">Manajemen Penyewa</li>
        </ol>
    </section>

    <section class="content">

        <?php if (!empty($flash)): ?>
            <div class="alert <?= $flashClass ?> alert-dismissible">
                <button type="button" class="close"
                    data-dismiss="alert">&times;</button>
                <?= htmlspecialchars($flash['message'] ?? '', ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if ($error !== null): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- Tabel data penyewa -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data Penyewa</h3>

                <div class="box-tools">
                    <a href="<?= htmlspecialchars(site_url('admin/penyewa/tambah'), ENT_QUOTES, 'UTF-8') ?>"
                       class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah Penyewa
                    </a>
                </div>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped js-data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>No. HP</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($penyewa as $no => $item): ?>
                            <tr>
                                <td><?= (int) $no + 1 ?></td>
                                <td><?= htmlspecialchars($item['user_plg'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($item['nik'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($item['nm_lngkp'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($item['no_hp'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($item['almt_lngkp'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                <td>
                                    <a class="btn btn-warning btn-xs"
                                       href="<?= htmlspecialchars(site_url('admin/penyewa/ubah/' . rawurlencode((string) ($item['user_plg'] ?? ''))), ENT_QUOTES, 'UTF-8') ?>">
                                        <i class="fa fa-edit"></i> Ubah
                                    </a>

                                    <form method="post" style="display:inline"
                                          action="<?= htmlspecialchars(site_url('admin/penyewa/hapus/' . rawurlencode((string) ($item['user_plg'] ?? ''))), ENT_QUOTES, 'UTF-8') ?>"
                                          onsubmit="return confirm('Hapus data penyewa ini?')">
                                        <button type="submit" class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form tambah dan ubah -->
        <?php if ($isForm): ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?= $isEdit ? 'Ubah Data Penyewa' : 'Tambah Penyewa' ?>
                    </h3>
                </div>

                <form method="post" enctype="multipart/form-data"
                      action="<?= htmlspecialchars($formAction, ENT_QUOTES, 'UTF-8') ?>">
                    <div class="box-body">

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="user_plg" class="form-control"
                                   maxlength="15" required
                                   value="<?= htmlspecialchars($penyewa_dipilih['user_plg'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                   <?= $isEdit ? 'readonly' : '' ?>>
                        </div>

                        <div class="form-group">
                            <label>Password <?= $isEdit ? '(kosongkan jika tidak diubah)' : '' ?></label>
                            <input type="password" name="sandi" class="form-control"
                                   <?= $isEdit ? '' : 'required' ?>>
                        </div>

                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control"
                                   maxlength="16" pattern="[0-9]{16}" required
                                   value="<?= htmlspecialchars($penyewa_dipilih['nik'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nm_lngkp" class="form-control"
                                   maxlength="100" required
                                   value="<?= htmlspecialchars($penyewa_dipilih['nm_lngkp'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control"
                                   maxlength="15" required
                                   value="<?= htmlspecialchars($penyewa_dipilih['no_hp'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                        </div>

                        <div class="form-group">
                            <label>Alamat Lengkap</label>
                            <textarea name="almt_lngkp" class="form-control"
                                      maxlength="300" required><?= htmlspecialchars($penyewa_dipilih['almt_lngkp'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Foto KTP</label>
                            <input type="file" name="foto_ktp" class="form-control"
                                   accept=".jpg,.jpeg,.png,.webp">
                        </div>

                        <div class="form-group">
                            <label>Foto SIM A</label>
                            <input type="file" name="foto_sim_a" class="form-control"
                                   accept=".jpg,.jpeg,.png,.webp">
                        </div>

                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan Penyewa
                        </button>

                        <a href="<?= htmlspecialchars(site_url('admin/penyewa'), ENT_QUOTES, 'UTF-8') ?>"
                           class="btn btn-default">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        <?php endif; ?>

    </section>
</div>

<?php require APPPATH . '/views/templates/footer.php'; ?>