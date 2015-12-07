<style type="text/css" media="screen">
    table.dataGrid {
        border-collapse: collapse;
        border: 1px solid balck;
        width: 100%;
        #font-size: 8px;
    }

    table.dataGrid td {
        border: 1px solid black;
        padding: 5px 5px 5px 5px;
    }
</style>

<h2 align="center">DAFTAR KOTA KABUPATEN</h2>
<table class="dataGrid">
    <tr>
        <th>NO</th>
        <th>KOTA</th>
        <th>PROVINSI</th>
    </tr>
    <?php $no = 1; foreach ($rows as $kota): ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $kota['nama_kota']; ?></td>
            <td><?php echo $kota['propinsi']; ?></td>
        </tr>
    <?php endforeach ?>
</table>
