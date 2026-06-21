<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan_Data_Transaksi_<?= date('Y-m-d') ?></title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
            font-size: 11pt;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px double #224abe;
            padding-bottom: 15px;
        }
        .header h2 {
            margin: 0;
            color: #224abe;
            text-transform: uppercase;
            font-size: 18pt;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 10pt;
        }
        .meta-info {
            margin-bottom: 15px;
            font-size: 9pt;
            color: #555;
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #e6f2ff;
            color: #224abe;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            font-size: 10pt;
            border: 1px solid #b3d1ff;
        }
        td {
            padding: 8px 10px;
            border: 1px solid #e0e0e0;
            font-size: 9.5pt;
            vertical-align: middle;
        }
        tr:nth-child(even) td {
            background-color: #fcfdfe;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .badge {
            font-weight: bold;
            font-size: 9pt;
        }
        .status-y { color: #00a65a; }
        .status-n { color: #ff4d4f; }

        @media print {
            @page {
                size: A4 landscape;
                margin: 15mm 10mm 15mm 10mm;
            }
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
        
        .btn-print-floating {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #224abe;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 11pt;
            font-weight: bold;
            border-radius: 20px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <button class="btn-print-floating no-print" onclick="window.print();">Cetak / Simpan PDF</button>

    <div class="header">
        <h2>Laporan Data Transaksi Penjualan</h2>
        <p>Sistem Informasi Manajemen Toko Laptop</p>
    </div>

    <div class="meta-info">
        Tanggal Cetak: <?= date('d F Y H:i') ?> WIB
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="12%">Tgl. Transaksi</th>
                <th>Nama User</th>
                <th>Merk Laptop</th>
                <th>Jenis Laptop</th>
                <th width="6%">Qty</th>
                <th>Metode Pembayaran</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $n = 1;
            foreach ($transaksi as $key): 
            ?>
                <tr>
                    <td class="text-center"><?= $n++ ?></td>
                    <td class="text-center"><?= date('d M Y', strtotime($key->tgl_transaksi)); ?></td>
                    <td><?= htmlspecialchars($key->nama_user) ?></td>
                    <td class="text-center"><?= htmlspecialchars($key->nama_merk) ?></td>
                    <td><?= htmlspecialchars($key->jenis_laptop) ?></td>
                    <td class="text-center"><?= htmlspecialchars($key->jumlah) ?></td>
                    <td class="text-center">
                        <?php
                        $metode = isset($key->metode_pembayaran) ? $key->metode_pembayaran : '-';
                        echo ($metode == 'Transfer') ? 'Transfer Bank' : htmlspecialchars($metode);
                        ?>
                    </td>
                    <td class="text-center badge">
                        <?php if ($key->status == 'Y'): ?>
                            <span class="status-y">Sudah Dikonfirmasi</span>
                        <?php else: ?>
                            <span class="status-n">Belum Dikonfirmasi</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

            <?php if (empty($transaksi)): ?>
                <tr>
                    <td colspan="8" class="text-center" style="color: #999; padding: 20px;">Tidak ada data transaksi tersedia.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>