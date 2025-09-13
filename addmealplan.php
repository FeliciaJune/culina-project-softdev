<?php
session_start();
include "koneksi.php";

$idresep = $_GET['idresep'] ?? 1;

$stmt = $conn->prepare("SELECT * FROM resep WHERE idresep = ?");
$stmt->bind_param("i", $idresep);
$stmt->execute();
$result = $stmt->get_result();
$resep = $result->fetch_assoc();

$existingday = [];
$res = $conn->query("SELECT hari FROM mealplan");
while ($row = $res->fetch_assoc()) {
    $existingday[] = $row['hari'];
}

$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedday = $_POST['day'];


    if (!in_array($selectedday, $existingday)) {
        $insert = $conn->prepare("INSERT INTO mealplan (idresep, namaresep, namakategori, foto, hari) VALUES (?, ?, ?, ?, ?)");
        $insert->bind_param(
            "issss",
            $resep['idresep'],
            $resep['namaresep'],
            $resep['namakategori'],
            $resep['foto'],
            $selectedday
        );
        if ($insert->execute()) {
            $message = "Recipe added to $selectedday!";
            $existingday[] = $selectedday;
        } else {
            $message = "Failed to add recipe.";
        }
    } else {
        $message = "There is already a recipe for $selectedday!";
    }
}
?>
