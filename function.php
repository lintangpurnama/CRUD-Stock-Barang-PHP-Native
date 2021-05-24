<?php
session_start();
//koneksi db
$conn = mysqli_connect("localhost", "root", "", "db_stock");

//menambah barang baru
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "INSERT INTO stock (namabarang, deskripsi, stock) values ('$namabarang', '$deskripsi', '$stock')");
    if ($addtotable) {
        echo " <script> 
            alert('Data berhasil di input');
            document.location.href = 'barang.php';
            </script>";
    } else {
        echo "<script> 
            alert('Data gagal di input');
            document.location.href = 'barang.php';
            </script>";
    }
}
//menambah barang masuk

if (isset($_POST['masuk'])) {
    $barang = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barang'");
    $ambildata = mysqli_fetch_array($cekstock);

    $stock = $ambildata['stock'];
    $tambahstock = $stock + $qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, keterangan, qty) values ('$barang', '$penerima','$qty')");
    $update = mysqli_query($conn, "UPDATE stock set stock='$tambahstock' WHERE idbarang='$barang' ");
    if ($addtomasuk && $update) {
        echo " <script> 
            alert('Data berhasil di input');
            document.location.href = 'masuk.php';
            </script>";
    } else {
        echo "<script> 
            alert('Data gagal di input');
            document.location.href = 'masuk.php';
            </script>";
    }
}

//menambah barang keluar

if (isset($_POST['keluar'])) {
    $barang = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barang'");
    $ambildata = mysqli_fetch_array($cekstock);

    $stock = $ambildata['stock'];

    if ($stock >= $qty) {

        //kalau barang nya cukup

        $tambahstock = $stock - $qty;

        $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, penerima, qty) values ('$barang', '$penerima','$qty')");
        $update = mysqli_query($conn, "UPDATE stock set stock='$tambahstock' WHERE idbarang='$barang' ");
        if ($addtokeluar && $update) {
            echo " <script> 
                    alert('Data berhasil di input');
                    document.location.href = 'keluar.php';
                    </script>";
        } else {
            echo "<script> 
                    alert('Data gagal di input');
                    document.location.href = 'keluar.php';
                    </script>";
        }
    } else {
        echo "<script> 
                alert('Stock saat ini tidak mencukupi');
                document.location.href = 'keluar.php';
                </script>";
    }
}

//update barang
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $edit = mysqli_query($conn, "UPDATE stock SET namabarang='$namabarang', 
                            deskripsi='$deskripsi' WHERE idbarang='$idb'");

    if ($edit) {
        echo " <script> 
        alert('Data berhasil di input');
        document.location.href = 'barang.php';
        </script>";
    } else {
        echo "<script> 
        alert('Data gagal di input');
        document.location.href = 'barang.php';
        </script>";
    }
}

//hapus barang
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "DELETE FROM stock WHERE idbarang='$idb'");

    if ($hapus) {
        echo " <script> 
        alert('Data berhasil di hapus');
        document.location.href = 'barang.php';
        </script>";
    } else {
        echo "<script> 
        alert('Data gagal di hapus');
        document.location.href = 'barang.php';
        </script>";
    }
}

//mengubah data barang masuk
if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb' ");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stocksekarang = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "SELECT * FROM masuk WHERE idmasuk='$idm' ");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurang = $stocksekarang + $selisih;
        $kuranginstock = mysqli_query($conn, "UPDATE stock SET stock='$kurang' WHERE idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE masuk SET qty='$qty' , keterangan='$deskripsi' WHERE  idmasuk ='$idm'");
        if ($kuranginstock && $updatenya) {
            echo " <script> 
        alert('Data berhasil di input');
        document.location.href = 'masuk.php';
        </script>";
        } else {
            echo "<script> 
        alert('Data gagal di input');
        document.location.href = 'masuk.php';
        </script>";
        }
    } else {

        $selisih = $qtyskrg -= $qty;
        $kurang = $stocksekarang -= $selisih;
        $kuranginstock = mysqli_query($conn, "UPDATE stock SET stock='$kurang' WHERE idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE masuk SET qty='$qty' , keterangan='$deskripsi' WHERE idmasuk ='$idm'");
        if ($kuranginstock && $updatenya) {
            echo " <script> 
        alert('Data berhasil di input');
        document.location.href = 'masuk.php';
        </script>";
        } else {
            echo "<script> 
        alert('Data gagal di input');
        document.location.href = 'masuk.php';
        </script>";
        }
    }
}
//edit barang masuk error!!

//hapus barang masuk

if (isset($_POST['hapusbarangmasuk'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $data = mysqli_fetch_array($getstock);
    $stock = $data['stock'];

    $selisih = $qty - $stock;

    $update = mysqli_query($conn, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM masuk WHERE idmasuk='$idm'");

    if ($update && $hapusdata) {
        echo " <script> 
        alert('Data berhasil di hapus');
        document.location.href = 'masuk.php';
        </script>";
    } else {
        echo "<script> 
        alert('Data gagal di hapus');
        document.location.href = 'masuk.php';
        </script>";
    }
}

//,mengubah data keluar
if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb' ");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stocksekarang = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "SELECT * FROM keluar WHERE idkeluar='$idk' ");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurang = $stocksekarang - $selisih;
        $kuranginstock = mysqli_query($conn, "UPDATE stock SET stock='$kurang' WHERE idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE keluar SET qty='$qty' , penerima='$penerima' WHERE  idkeluar ='$idk'");
        if ($kuranginstock && $updatenya) {
            echo " <script> 
        alert('Data berhasil di input');
        document.location.href = 'keluar.php';
        </script>";
        } else {
            echo "<script> 
        alert('Data gagal di input');
        document.location.href = 'keluar.php';
        </script>";
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurang = $stocksekarang + $selisih;
        $kuranginstock = mysqli_query($conn, "UPDATE stock SET stock='$kurang' WHERE idbarang='$idb'");
        $updatenya = mysqli_query($conn, "UPDATE keluar SET qty='$qty' , penerima='$penerima' WHERE idkeluar ='$idk'");
        if ($kuranginstock && $updatenya) {
            echo " <script> 
        alert('Data berhasil di input');
        document.location.href = 'keluar.php';
        </script>";
        } else {
            echo "<script> 
        alert('Data gagal di input');
        document.location.href = 'keluar.php';
        </script>";
        }
    }
}

//hapus barang keluar

if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getstock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idb'");
    $data = mysqli_fetch_array($getstock);
    $stock = $data['stock'];

    $selisih = $qty + $qty;

    $update = mysqli_query($conn, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "DELETE FROM keluar WHERE idkeluar='$idk'");

    if ($update && $hapusdata) {
        echo " <script> 
        alert('Data berhasil di hapus');
        document.location.href = 'keluar.php';
        </script>";
    } else {
        echo "<script> 
        alert('Data gagal di hapus');
        document.location.href = 'keluar.php';
        </script>";
    }
}


//edit barang masuk - keluar