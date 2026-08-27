<?php

function formatNomor($nomor) {
    // Menghilangkan karakter selain angka
    $nomor = preg_replace('/[^0-9]/', '', $nomor);

    // Mengubah awalan '0' menjadi '62'
    if (substr($nomor, 0, 1) == '0') {
        $nomor = '62' . substr($nomor, 1);
    }

    return $nomor;
}

function kirimWhatsApp($target, $pesan) {
    $config = include __DIR__ . '/../config/fonnte.php';
    $token = $config['token'];

    $targetFormatted = formatNomor($target);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $targetFormatted,
            'message' => $pesan,
        ),
        CURLOPT_HTTPHEADER => array(
            "Authorization: $token"
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}