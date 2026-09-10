# Project API WhatsApp - Fonnte

## Deskripsi
Project registrasi user dengan notifikasi WhatsApp otomatis via Fonnte.

## Teknologi
PHP Native, MySQL, cURL, REST API, Fonnte, HTML/CSS

## Fitur
- ✅ Register + Notif WA
- ✅ Login
- ✅ Dashboard Siswa
- ✅ Update Profile + Notif WA
- ✅ Hapus Akun + Notif WA
- ✅ Log Pengiriman WhatsApp

## Alur Sistem
User → Register → Database → Fonnte API → WhatsApp User

## Cara Menjalankan
1. Import database `api_wa_fonnte` (lihat file SQL)
2. Copy `.env.example` ke `.env`, isi token Fonnte
3. Jalankan `php -S localhost:8000` di folder project
4. Buka `http://localhost:8000`

## Catatan Keamanan
- Token Fonnte disimpan di `.env`
- Password di-hash dengan `password_hash()`
- `.env` di-ignore di `.gitignore`