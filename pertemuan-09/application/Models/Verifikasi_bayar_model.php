<?php

class Verifikasi_bayar_model
{
    private mysqli $db;

    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    /**
     * Mengambil pembayaran yang menunggu verifikasi
     * dan sudah memiliki bukti transfer.
     */
    public function getMenungguVerifikasi(): array
    {
        $sql = "SELECT
                    b.kode_bayar,
                    b.tgl_wkt_byr,
                    b.ft_byr,
                    b.mtode_byr,
                    b.jns_byr,
                    b.nominal,
                    b.sttus_byr,
                    b.tgl_wkt_ver,
                    b.kode_sewa,
                    s.status_sewa
                FROM t_bayar AS b
                INNER JOIN t_sewa AS s
                    ON s.kode_sewa = b.kode_sewa
                WHERE b.sttus_byr = ?
                  AND b.ft_byr IS NOT NULL
                  AND b.ft_byr <> ''
                ORDER BY b.tgl_wkt_byr ASC";

        $status = 'pending';
        $stmt = $this->db->prepare($sql);

        if (!$stmt) {
            throw new RuntimeException(
                'Gagal menyiapkan query pembayaran.'
            );
        }

        $stmt->bind_param('s', $status);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $data;
    }

    /**
     * Menerima atau menolak pembayaran.
     * Kedua tabel diperbarui dalam satu transaksi database.
     */
    public function verifikasi(
        string $kodeBayar,
        string $keputusan
    ): bool {
        if (!in_array($keputusan, ['terima', 'tolak'], true)) {
            throw new InvalidArgumentException(
                'Keputusan verifikasi tidak valid.'
            );
        }

        $statusBayar = $keputusan === 'terima'
            ? 'valid'
            : 'invalid';

        $statusSewa = $keputusan === 'terima'
            ? 'disetujui'
            : 'ditolak';

        $this->db->begin_transaction();

        try {
            // Kunci record agar tidak diverifikasi bersamaan.
            $sql = "SELECT kode_sewa, ft_byr, sttus_byr
                    FROM t_bayar
                    WHERE kode_bayar = ?
                    FOR UPDATE";

            $stmt = $this->db->prepare($sql);
            $stmt->bind_param('s', $kodeBayar);
            $stmt->execute();

            $pembayaran = $stmt->get_result()
                ->fetch_assoc();

            $stmt->close();

            if (!$pembayaran) {
                throw new RuntimeException(
                    'Data pembayaran tidak ditemukan.'
                );
            }

            if (
                $pembayaran['sttus_byr'] !== 'pending'
                || empty($pembayaran['ft_byr'])
            ) {
                throw new RuntimeException(
                    'Pembayaran tidak dapat diverifikasi. ' .
                    'Pastikan status masih pending dan bukti tersedia.'
                );
            }

            // Perbarui status pembayaran.
            $sql = "UPDATE t_bayar
                    SET sttus_byr = ?,
                        tgl_wkt_ver = NOW()
                    WHERE kode_bayar = ?
                      AND sttus_byr = ?
                      AND ft_byr IS NOT NULL
                      AND ft_byr <> ''";

            $stmt = $this->db->prepare($sql);
            $pending = 'pending';

            $stmt->bind_param(
                'sss',
                $statusBayar,
                $kodeBayar,
                $pending
            );

            $stmt->execute();
            $jumlahDiubah = $stmt->affected_rows;
            $stmt->close();

            if ($jumlahDiubah !== 1) {
                throw new RuntimeException(
                    'Status pembayaran gagal diperbarui.'
                );
            }

            // Perbarui status transaksi terkait.
            $sql = "UPDATE t_sewa
                    SET status_sewa = ?
                    WHERE kode_sewa = ?";

            $stmt = $this->db->prepare($sql);
            $stmt->bind_param(
                'ss',
                $statusSewa,
                $pembayaran['kode_sewa']
            );

            $stmt->execute();
            $jumlahTransaksi = $stmt->affected_rows;
            $stmt->close();

            if ($jumlahTransaksi !== 1) {
                throw new RuntimeException(
                    'Status transaksi gagal diperbarui.'
                );
            }

            $this->db->commit();

            return true;
        } catch (Throwable $e) {
            $this->db->rollback();
            throw $e;
        }
    }
}