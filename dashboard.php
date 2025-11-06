<?php

session_start();

// Cek apakah user sudah login

if ( isset($_SESSION['username'])) {
header("Location: login.php");
exit;

}
?>
<title>Dashboard</title>

</head>

<body>
<h2>Selamat datang, <?php echo $_SESSION['username']; ?>1</h2>
<p>Role: <?php echo $_SESSION['role']; ?></p>
<a href="1ogout .php">Logout</a>

</body>

</html>

<?php
session_start();

// Cek apakah user sudah login
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

// Proses login saat form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Login sederhana (username: admin, password: 123)
    if ($username == 'ayu nandita' && $password === '12345') {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'Dosen';
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Polgan Mart</title>
</head>
<body>
    <h2>Polgan Mart</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>

$beli = [];
$jumlah = [];
$total = [];

for ($i = 0; $i < count($kode_barang); $i++) {
    // Random apakah barang dibeli (0 atau 1)
    $beli[$i] = rand(0, 1);
    if ($beli[$i] == 1) {
        $jumlah[$i] = rand(1, 5); // jumlah acak 1–5
        $total[$i] = $harga_barang[$i] * $jumlah[$i];
    } else {
        $jumlah[$i] = 0;
        $total[$i] = 0;
    }
}
$grandtotal = 0;
echo "<h3>Daftar Pembelian:</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Kode</th><th>Nama Barang</th><th>Harga</th><th>Jumlah</th><th>Total</th></tr>";

foreach ($kode_barang as $i => $kode) {
    if ($beli[$i] == 1) {
        echo "<tr>";
        echo "<td>$kode</td>";
        echo "<td>{$nama_barang[$i]}</td>";
        echo "<td>Rp" . number_format($harga_barang[$i], 0, ',', '.') . "</td>";
        echo "<td>{$jumlah[$i]}</td>";
        echo "<td>Rp" . number_format($total[$i], 0, ',', '.') . "</td>";
        echo "</tr>";
        $grandtotal += $total[$i];
    }
}
