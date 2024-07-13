<?php
include 'koneksi.php';

$sql = "SELECT tanggal, suhu, kelembaban FROM tabel_sensor ORDER BY id DESC LIMIT 10";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    // Mengambil data baris demi baris
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>