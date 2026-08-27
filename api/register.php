<?php
require_once 'C:/xampp/htdocs/wa_api/config/database.php';
require_once 'C:/xampp/htdocs/wa_api/functions/fonnte.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $no_hp = trim($_POST['no_hp']);
    $password_raw = $_POST['password'];

    if (empty($nama) || empty($email) || empty($no_hp) || empty($password_raw)) {
        echo "Semua kolom wajib diisi!";
        exit;
    }

    $stmt = $db->prepare("SELECT id FROM users WHERE email = ? OR no_hp = ?");
    $stmt->bind_param("ss", $email, $no_hp);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Registrasi ditolak: Email atau Nomor WhatsApp sudah terdaftar.";
        $stmt->close();
        exit;
    }
    $stmt->close();

    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    $insert = $db->prepare("INSERT INTO users (nama, email, no_hp, password) VALUES (?, ?, ?, ?)");
    $insert->bind_param("ssss", $nama, $email, $no_hp, $password);

    if ($insert->execute()) {
        $pesan = "🎉 *REGISTRASI BERHASIL*\n\n" .
                 "Halo, $nama 👋\n\n" .
                 "Selamat, akun Anda telah berhasil dibuat.\n\n" .
                 "📧 *Email:* $email\n" .
                 "📱 *WhatsApp:* $no_hp\n\n" .
                 "Terima kasih telah melakukan registrasi.";

        $responseFonnte = kirimWhatsApp($no_hp, $pesan);

        echo "Registrasi berhasil! Notifikasi WhatsApp telah diproses.";
    } else {
        echo "Terjadi kesalahan pada sistem saat menyimpan data.";
    }

    $insert->close();
    $db->close();
}