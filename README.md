<div align="center">

<img src="https://img.shields.io/badge/RigCheck-AI%20PC%20Builder-3ecf8e?style=for-the-badge&logo=data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCI+PGNpcmNsZSBjeD0iMTIiIGN5PSIxMiIgcj0iNiIgZmlsbD0iI2ZmZiIvPjwvc3ZnPg==&logoColor=white" alt="RigCheck" />

# ⚡ RigCheck

### *Rakit PC Impian Anda — Lebih Cerdas, Lebih Cepat.*

Platform merakit PC berbasis AI yang menganalisis kompatibilitas, mendeteksi bottleneck, dan memvalidasi konsumsi daya secara instan.

<br/>

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-v4-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![Gemini AI](https://img.shields.io/badge/Gemini-AI%20Powered-4285F4?style=flat-square&logo=google&logoColor=white)](https://aistudio.google.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

<br/>

[🚀 Demo Live](#) · [📖 Dokumentasi](#cara-instalasi) · [🐛 Laporkan Bug](https://github.com/Sento2/RigCheck/issues) · [💡 Request Fitur](https://github.com/Sento2/RigCheck/issues)

</div>

---

## 📸 Tampilan

<div align="center">

| Landing Page | Katalog Hardware | Garasi Saya |
|:---:|:---:|:---:|
| *Hero section dengan animasi* | *Filter AJAX tanpa reload* | *Simpan & kelola rakitan* |

| Auto Builder | Hardware Guru AI | Admin Panel |
|:---:|:---:|:---:|
| *Rekomendasi otomatis dari budget* | *Analisis bottleneck oleh AI* | *Manajemen komponen* |

</div>

---

## ✨ Fitur Unggulan

<table>
<tr>
<td width="50%">

### 🤖 Hardware Guru AI
Analisis kompatibilitas mendalam oleh Google Gemini AI — mendeteksi **bottleneck CPU/GPU**, memvalidasi **soket & chipset**, dan menghitung **batas konsumsi daya** secara instan.

</td>
<td width="50%">

### 🏗️ Katalog Builder
Telusuri 100+ komponen PC terkurasi dengan filter kategori **tanpa reload halaman** (AJAX). Card komponen dengan icon kontekstual dan animasi hover premium.

</td>
</tr>
<tr>
<td width="50%">

### ⚡ Auto Builder
Masukkan budget, algoritma 2-tahap kami secara otomatis mengalokasikan komponen terbaik di 6 kategori (CPU, GPU, Mobo, RAM, Storage, PSU) dengan efisiensi hingga **100% budget**.

</td>
<td width="50%">

### 🚗 Garasi Saya
Simpan dan kelola rakitan PC Anda. Status **Draft → Tersimpan**, hapus komponen, dan langsung analisis kompatibilitas rakitan yang sudah selesai.

</td>
</tr>
<tr>
<td width="50%">

### 👤 Manajemen Profil
Update nama, email, dan ganti password langsung dari halaman profil. Tombol logout aman di zona terpisah.

</td>
<td width="50%">

### 🛡️ Admin Panel
Dashboard admin terpisah untuk mengelola katalog hardware — tambah komponen baru dengan spesifikasi JSON yang fleksibel.

</td>
</tr>
</table>

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|-------|-----------|
| **Backend** | Laravel 12, PHP 8.2+ |
| **Frontend** | Blade Templates, Tailwind CSS v4 |
| **Database** | MySQL 8.0 |
| **AI Engine** | Google Gemini API |
| **Icons** | Material Symbols (Google) |
| **Font** | Inter (Google Fonts) |
| **Build Tool** | Vite |

---

## 📁 Struktur Proyek

```
RigCheck/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php        # Login, Register, Logout
│   │   ├── RigController.php         # CRUD Rakitan
│   │   ├── ComponentController.php   # Katalog & Builder
│   │   ├── CompatibilityController.php # Analisis AI
│   │   ├── AutoBuilderController.php # Rekomendasi otomatis
│   │   ├── AdminController.php       # Panel Admin
│   │   └── ProfileController.php    # Profil Pengguna
│   ├── Models/
│   │   ├── User.php
│   │   ├── Rig.php
│   │   └── Component.php
│   └── Ai/Agents/
│       └── HardwareGuruAgent.php     # Integrasi Gemini AI
├── resources/
│   ├── views/
│   │   ├── layouts/app.blade.php     # Layout utama
│   │   ├── components/               # Sidebar, Navbar, Footer, Hardware Card
│   │   ├── pages/                    # Builder, Dashboard, Profile, Auth
│   │   └── autobuilder/
│   └── css/app.css                   # Design system + animasi
├── routes/web.php                    # Semua route aplikasi
└── database/
    ├── migrations/                   # Skema tabel
    └── seeders/                      # Data komponen & admin
```

---

## ⚙️ Cara Instalasi

### Prasyarat
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL (atau XAMPP)
- Git

### Setup Langkah Demi Langkah

**1. Clone repository**
```bash
git clone https://github.com/Sento2/RigCheck.git
cd RigCheck
```

**2. Install dependensi**
```bash
composer install
npm install
```

**3. Setup environment**
```bash
# Linux/Mac
cp .env.example .env

# Windows PowerShell
Copy-Item .env.example .env

php artisan key:generate
```

**4. Konfigurasi database** — edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rigcheck
DB_USERNAME=root
DB_PASSWORD=
```

**5. Buat database** di phpMyAdmin dengan nama `rigcheck`

**6. Jalankan migration & seeder**
```bash
php artisan migrate --seed
php artisan db:seed --class=AdminSeeder
```

**7. (Opsional) Isi API Key Gemini** di `.env`:
```env
GEMINI_API_KEY=your_api_key_here
```
> Dapatkan gratis di: https://aistudio.google.com/app/apikey

**8. Jalankan server**
```bash
composer run dev
```

**9. Buka di browser**
```
http://localhost:8000
```

---

## 🔑 Akun Default

| Role | Email | Password |
|------|-------|----------|
| 👑 Admin | `admin@admin.com` | `password` |
| 👤 User | `test@example.com` | `password` |

---

## 🗺️ Route Utama

| Method | URL | Keterangan |
|--------|-----|------------|
| `GET` | `/` | Landing Page |
| `GET` | `/login` | Halaman Login |
| `GET` | `/register` | Halaman Register |
| `GET` | `/builder` | Katalog Hardware |
| `GET` | `/dashboard` | Garasi Saya |
| `GET` | `/autobuilder` | Auto Builder |
| `GET` | `/profile` | Profil Pengguna |
| `GET` | `/admin/dashboard` | Admin Panel |
| `GET` | `/rigs/{id}/compatibility` | Analisis AI |

---

## 🎨 Design System

RigCheck menggunakan **"White Canvas"** design system dengan:

- **Primary Color:** `#3ecf8e` (Hijau Supabase-inspired)
- **Font:** Inter (variable weight)
- **Radius:** xs(4px) → xl(16px)
- **Animasi:** fade-up, float, pulse-green, shimmer
- **Komponen:** `card-lift`, `text-gradient-primary`, `skeleton`

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan:

1. Fork repository ini
2. Buat branch fitur: `git checkout -b fitur/nama-fitur`
3. Commit perubahan: `git commit -m 'feat: tambah fitur X'`
4. Push ke branch: `git push origin fitur/nama-fitur`
5. Buat Pull Request

---

## 👥 Tim Pengembang

<div align="center">

| | Nama | Peran |
|:---:|-----|-------|
| 👨‍💻 | **Sento** | Lead Developer · UI/UX · AI Integration |

</div>

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan **Ujian Akhir Semester (UAS)**.

---

<div align="center">

Dibuat dengan ❤️ dan ☕ menggunakan **Laravel** + **Tailwind CSS** + **Gemini AI**

⭐ **Jangan lupa kasih bintang kalau project ini membantu!** ⭐

</div>
