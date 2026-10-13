# Starter Project: Latihan Memperbaiki REST API Pendaftaran OSIS

Project starter ini ditujukan untuk latihan siswa kelas XI Rekayasa Perangkat Lunak (RPL) dalam menganalisis, menguji, dan memperbaiki kesalahan logika/perilaku pada REST API berbasis Laravel dan MySQL.

---

## A. Tujuan Latihan

1. Memahami alur kerja REST API (Client-Server, Request-Response, HTTP Method, dan Status Code).
2. Mengidentifikasi bug logika/perilaku pada API berdasarkan spesifikasi kebutuhan.
3. Memperbaiki kode API pada controller dan validasi Laravel sesuai spesifikasi yang ditentukan.
4. Membuktikan hasil perbaikan melalui pengujian di Postman serta verifikasi data pada database MySQL.

---

## B. Prasyarat Perangkat Lunak

Sebelum memulai, pastikan perangkat komputer telah terpasang:
- **PHP** (minimal versi 8.2 atau disarankan PHP 8.3+)
- **Composer** (versi 2.x)
- **Git**
- **MySQL Database Server** (melalui Laragon, XAMPP, Homebrew, atau MySQL Service mandiri)
- **Postman** (Desktop App atau Web Agent)

---

## C. Panduan Instalasi dan Menjalankan Project

Ikuti urutan langkah berikut secara berurutan:

### 1. Fork Repository
Buka repository project ini di GitHub, lalu klik tombol **Fork** di pojok kanan atas untuk membuat salinan repository pada akun GitHub pribadimu.

> **Penjelasan Konsep Git:**
> - **Fork**: Membuat salinan repository guru ke akun GitHub siswa secara online.
> - **Clone**: Mengunduh salinan repository dari GitHub ke komputer lokal siswa.
> - **Push**: Mengirim commit perubahan kode dari komputer lokal kembali ke repository hasil fork di GitHub.

### 2. Clone Repository Hasil Fork
Buka terminal (Git Bash, Terminal macOS/Linux, atau Command Prompt) dan jalankan:
```bash
git clone <URL_REPOSITORY_HASIL_FORK>
```

### 3. Masuk ke Folder Project
```bash
cd latihan-api-2
```

### 4. Install Dependency
```bash
composer install
```

### 5. Salin File Konfigurasi Environment
Salin file `.env.example` menjadi `.env`:

- **macOS / Linux:**
  ```bash
  cp .env.example .env
  ```

### 6. Generate Application Key
```bash
php artisan key:generate
```

### 7. Buat Database MySQL
Buka MySQL CLI, phpMyAdmin, atau MySQL client pilihanmu, lalu buat database baru:
```sql
CREATE DATABASE pendaftaran_osis;
```

### 8. Sesuaikan Konfigurasi Database pada `.env`
Buka file `.env` di text editor (VS Code), lalu pastikan bagian database sudah sesuai:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pendaftaran_osis
DB_USERNAME=root
DB_PASSWORD=
```
*(Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` jika MySQL lokalmu memiliki password)*

### 9. Jalankan Migration dan Seeder
```bash
php artisan migrate --seed
```
Perintah ini akan membuat 4 tabel (`kelas`, `jenis_kelamin`, `siswa`, `pendaftaran_osis`) dan mengisi data awal berupa:
- 4 data kelas
- 2 data jenis kelamin
- 12 data siswa fiktif
- 2 data pendaftaran OSIS awal

### 10. Jalankan Local Server
```bash
php artisan serve
```
Server akan aktif di `http://127.0.0.1:8000`.

---

## D. Alur Pengerjaan Siswa

1. **Jalankan Project & Cek Data Master:** Akses endpoint master (`/api/kelas`, `/api/jenis-kelamin`, `/api/siswa`) untuk memastikan API berjalan.
2. **Uji Coba Awal (Baseline Test):** Uji seluruh skenario di Postman sebelum melakukan perubahan kode apapun. Catat status dan perilakunya.
3. **Telusuri Komentar TODO:** Buka file `app/Http/Controllers/Api/PendaftaranOsisController.php` dan temukan komentar penuntun `TODO LATIHAN L1` sampai `L9`.
4. **Perbaiki Masalah Satu per Satu:** Fokus memperbaiki satu masalah dalam satu waktu.
5. **Uji Ulang Setiap Perbaikan:** Setelah mengubah kode, jalankan request kembali di Postman dan periksa perubahannya di database MySQL.
6. **Catat Bukti:** Ambil tangkapan layar (screenshot) status, header, body respons, dan kondisi data di database.
7. **Commit Bertahap:** Lakukan `git commit` dengan pesan yang jelas untuk setiap masalah yang berhasil diselesaikan.
8. **Push ke GitHub:** Kirim seluruh perbaikan ke repository hasil fork milikmu dengan perintah `git push origin main`.

---

## E. Daftar Masalah dan Spesifikasi yang Harus Dipenuhi

Project starter ini sengaja disisipi **tepat sembilan masalah logika API (L1 – L9)**. Kamu ditugaskan untuk memperbaiki kesembilan masalah tersebut tanpa merusak fungsionalitas lain.

### Daftar Masalah:
- **L1 (GET Daftar Pendaftaran):** Endpoint daftar belum menyertakan data relasi kelas dan jenis kelamin pada objek siswa. *(Spesifikasi: Objek siswa pada daftar pendaftaran harus memuat detail kelas dan jenis kelamin lengkap).*
- **L2 (Validasi POST - Keberadaan Siswa):** Validasi belum memeriksa apakah `siswa_id` benar-benar terdaftar di database. *(Spesifikasi: Harus ditolak dengan HTTP 422 jika `siswa_id` tidak ada pada tabel `siswa`).*
- **L3 (Validasi POST - Duplikasi):** Belum ada pencegahan siswa yang sama mendaftar lebih dari satu kali. *(Spesifikasi: Satu siswa hanya boleh memiliki satu pendaftaran. Pendaftaran kedua harus ditolak dengan HTTP 422).*
- **L4 (Validasi POST & PUT - Pilihan Bidang):** Belum membatasi nilai bidang yang diizinkan. *(Spesifikasi: Hanya menerima: `kepemimpinan`, `keagamaan`, `olahraga`, atau `seni`. Nilai lain harus ditolak dengan HTTP 422).*
- **L5 (Validasi POST & PUT - Panjang Motivasi):** Belum menerapkan batas minimal dan maksimal teks. *(Spesifikasi: Motivasi wajib memiliki panjang minimal 20 karakter dan maksimal 300 karakter. Jika kurang dari 20 atau lebih dari 300 harus ditolak dengan HTTP 422).*
- **L6 (Status Code POST Berhasil):** Pembuatan pendaftaran yang berhasil masih mengembalikan HTTP 200. *(Spesifikasi: Pembuatan resource baru yang berhasil wajib mengembalikan status HTTP 201 Created).*
- **L7 (Validasi PUT - Pengecualian Record Sendiri):** Validasi keunikan `siswa_id` menolak ID siswa milik record pendaftaran itu sendiri. *(Spesifikasi: Saat mengedit pendaftaran, menggunakan `siswa_id` milik sendiri harus diizinkan. Hanya `siswa_id` milik pendaftaran lain yang harus ditolak).*
- **L8 (Penyimpanan PUT):** Respons mengembalikan pesan sukses, tetapi pembaruan nilai `pilihan_bidang` dan `motivasi` tidak tersimpan ke database. *(Spesifikasi: Data `pilihan_bidang` dan `motivasi` yang dikirim wajib diperbarui di database).*
- **L9 (Penghapusan DELETE):** Respons mengembalikan HTTP 204 No Content, tetapi record belum dihapus dari database. *(Spesifikasi: Record pendaftaran terkait wajib terhapus dari tabel `pendaftaran_osis`).*

> **Catatan Penting:** Beberapa masalah dapat saling menutupi (misalnya L7 dan L8). Pastikan untuk menguji ulang seluruh skenario setelah memperbaiki suatu masalah.

---

## F. Panduan Penggunaan Postman

1. **Header Wajib:**
   - Semua request wajib menyertakan header:
     - `Accept`: `application/json`
   - Khusus request dengan body (`POST` dan `PUT`), wajib menambahkan header:
     - `Content-Type`: `application/json`
2. **Body Request:**
   - Pilih tab **Body** > pilih radio button **raw** > pilih format **JSON**.
   - Contoh format JSON body yang valid:
     ```json
     {
       "siswa_id": 2,
       "pilihan_bidang": "keagamaan",
       "motivasi": "Ingin berkontribusi dalam kegiatan keagamaan dan meningkatkan kepedulian sosial di lingkungan sekolah."
     }
     ```
3. **Tips Pengujian:**
   - Ambil `siswa_id` dari endpoint master `GET /api/siswa`, jangan menebak ID.
   - Untuk uji `POST` valid, gunakan siswa yang belum memiliki pendaftaran (misalnya siswa dengan id 2, 3, 5, dst.).
   - Endpoint `GET` dan `DELETE` tidak memerlukan body request.

---

## G. Skenario Pengujian Wajib (20 Skenario)

Isi kolom **Perkiraan Status** sebelum menjalankan request. Jalankan request di Postman, lalu isi hasil pengamatan aktualmu pada tabel berikut:

# Nama : Hanif El Hakim
# Kelas : XI-1 / XI-RPL
# NIS : 252610028

| Nomor | Skenario | Perkiraan Status | Status Aktual | Ringkasan Respons | Perubahan Database | Kesimpulan |
| :---: | :--- | :---: | :---: | :--- | :--- | :--- |
| 1 | GET `/api/kelas` | 200 | 200 | Semua data kelas | - | Berhasil |
| 2 | GET `/api/jenis-kelamin` | 200 | 200 | Semua data jenis kelamin | - | Berhasil |
| 3 | GET `/api/siswa` | 200 | 200 | Semua data siswa | - | Berhasil |
| 4 | GET `/api/pendaftaran-osis` (Daftar pendaftaran & relasi) | 200 | 200 | Semua data pendaftar | - | Berhasil |
| 5 | GET `/api/pendaftaran-osis/1` (Detail pendaftaran ada) | 200 | 200 | Data sesuai id | - | Berhasil |
| 6 | GET `/api/pendaftaran-osis/999` (Detail ID tidak ada) | 404 | 404 | id 999 tidak ada datanya | - | Berhasil |
| 7 | POST valid (siswa belum terdaftar) | 201 | 201 | terdaftar id siswa yang belum terdaftar | - | Berhasil |
| 8 | POST kedua dengan `siswa_id` yang sama | 422 | 422 | id siswa sudah terdaftar | - | Berhasil |
| 9 | POST dengan `siswa_id` tidak ada (misal: 9999) | 422 | 422 | metode post berhasil namun id siswa tidak exist | - | Berhasil |
| 10 | POST dengan `pilihan_bidang` tidak valid (misal: "robotik") | 422 | 422 | metode post berhasil namun pilihan bidang tidak sesuai dengan opsi yang diberikan | - | Berhasil |
| 11 | POST dengan motivasi 19 karakter | 422 | 422 | karakter pada motivasi tidak memenuhi syarat minimum | - | Berhasil |
| 12 | POST dengan motivasi 301 karakter | 422 | 422 | karakter pada motivasi melebihi syarat maksimal | - | Berhasil |
| 13 | PUT valid dengan `siswa_id` tetap sama | 200 | 200 | Berhasil edit data | - | Berhasil |
| 14 | PUT menggunakan `siswa_id` milik pendaftaran lain | 200 | 200 | id siswa terubah | - | Berhasil |
| 15 | PUT dengan `pilihan_bidang` tidak valid | 422 | 422 | pilihan bidang tidak sesuai dengan opsi yang diberikan | -  | Berhasil |
| 16 | PUT dengan motivasi di luar batas panjang | 422 | 422 | Motivasi melebihi maksimal karakter | - | Berhasil |
| 17 | PUT terhadap ID pendaftaran yang tidak tersedia (misal: 999) | 422 | 422 | id siswa tidak terdaftar dalam data | - | Berhasil |
| 18 | DELETE terhadap pendaftaran yang tersedia (misal: ID 2) | 200 | 200 | Data terhapus sesuai id | - | Berhasil |
| 19 | GET detail terhadap ID yang sudah dihapus | 404 | 404 | Data yang dicari tidak ada | - | Berhasil |
| 20 | DELETE kembali terhadap ID yang sudah dihapus | 404 | 404 | id data yang dicari tidak ada | -  | Berhasil |

### Aturan Pembuktian Database:
- **POST valid:** Jumlah record pada tabel `pendaftaran_osis` bertambah tepat satu.
- **POST invalid:** Jumlah record pada tabel `pendaftaran_osis` tidak berubah.
- **PUT valid:** ID record tetap sama, jumlah record tetap, nilai kolom berubah sesuai request.
- **PUT invalid:** Seluruh nilai kolom record di database tidak berubah.
- **DELETE valid:** Jumlah record berkurang tepat satu, data master siswa tetap utuh.

---

## H. Pertanyaan Analisis

Jawab pertanyaan berikut pada laporan akhir tanpa bantuan AI:

1. Saat pengujian melalui Postman, siapa yang bertindak sebagai *client* dan siapa yang bertindak sebagai *server*? Bagian dari HTTP request mana yang menentukan proses yang dijalankan oleh Laravel? 
Jawaban: Postman bertindak sebagai client, Laravel bertindak sebagai server. HTTP request yang ditentukan agar dapat dijalankan oleh laravel ialah http request/endpoint yang terdaftar pada file api.php
2. Mengapa request pendaftaran hanya mengirimkan `siswa_id`, bukan mengirim ulang data nama siswa, kelas, dan jenis kelamin?
Jawaban: Dikarnakan pada siswa_id sudah ada relasi ke tabel data kelas dan jenis kelamin
3. Telusuri satu alur request `POST` dari rute (`routes/api.php`), controller, proses validasi, query database, hingga respon JSON yang dikembalikan. Tunjukkan lokasi kode yang terlibat!
Jawaban:
```laravel
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
          'siswa_id' => ['required', 'integer', "exists:siswa,id", "unique:pendaftaran_osis,siswa_id"],
          'pilihan_bidang' => ['required', 'string', "in:kepemimpinan,keagamaan,olahraga,seni"],
          'motivasi' => ['required', 'string', "min:20", "max:300"],
          ]);

          $pendaftaran = PendaftaranOsis::create([
            'siswa_id' => $validated['siswa_id'],
            'pilihan_bidang' => $validated['pilihan_bidang'],
            'motivasi' => $validated['motivasi'],
        ]);

        $pendaftaran->load(['siswa.kelas', 'siswa.jenisKelamin']);

        return response()->json([
            'message' => 'Pendaftaran berhasil dibuat.',
            'data' => new PendaftaranOsisResource($pendaftaran),
        ], 201);
    }
```
4. Jika `siswa_id` yang dikirim tidak tersedia di tabel `siswa`, apa perbedaan dampak antara menolaknya di tahap validasi API dengan membiarkannya gagal di tahap penyimpanan database?
Jawaban: Dampak terhadap ditolak pada validasi API menyebabkan penyimpanan tertolak karna tidak sesuai dengan validasi.
         Dampak terhadap gagal di tahap penyimpanan database menyebabkan data yang gagal terkirim ke database walaupun sudah berhasil tervalidasi
5. Mengapa pendaftaran kedua dari siswa yang sama perlu ditolak meskipun seluruh format field yang dikirim sudah benar?
Jawaban: Karna pendaftaran OSIS hanya boleh 1 id siswa per pendaftaran, tidak boleh ada redudansi pada id siswa
6. Mengapa pada method `PUT`, `siswa_id` milik record itu sendiri boleh digunakan, sedangkan `siswa_id` milik pendaftaran lain harus ditolak?
Jawaban: Agar siswa hanya boleh mengubah data pendaftaran miliknya sendiri, tidak bisa mengubah milik orang lain agar tidak terjadi manipulasi/perubahan pada data siswa lain tanpa persetujuan siswa tersebut
7. Bagaimana cara membuktikan secara konkret bahwa method `PUT` benar-benar mengubah data, bukan hanya mengembalikan pesan berhasil?
Jawaban: Dengan pengecekan data sesuai id data yang diubah serta dengan status kode berhasil "200"
8. Mengapa proses penghapusan pendaftaran (`DELETE`) tidak boleh sekaligus menghapus data siswa yang bersangkutan?
Jawaban: Karna berbeda fungsi, jika penghapusan memang bertujuan untuk pendaftaran maka untuk pendaftaran itu sendiri, serta dengan memiliki sistem yang berbeda/tidak disatukan penghapusannya, dapat membuat user memilih apa yang ingin ia hapus
9. Mengapa request `DELETE` pertama pada ID tertentu berhasil (204), sedangkan request `DELETE` kedua terhadap ID yang sama menghasilkan 404?
Jawaban: Dikarnakan request pertama data yang ingin dihapus masih ada, setelah request pertama itu selesai maka datanya sudah dihapus/tidak ada. Jadi ketika request kedua dilakukan, id pada data yang dicari tidak ada karna sudah terhapus saat request pertama
10. Pilih satu masalah dari L1–L9 yang kamu perbaiki. Jelaskan secara rinci: perilaku sebelum perbaikan, kode yang diubah, dan bukti pengujian setelah perbaikan!
Jawaban:
- L3
- Perilaku awal = satu siswa masih dapat daftar dengan id yang sama lebih dari 1 kali
- Kode yang diubah = penambahan validasi kalau id_siswa yang diinput harus unique (tidak boleh yang sudah terdaftar pada database)
- Bukti pengujian = satu siswa hanya dapat daftar osis 1 kali saja
11. Apakah status respons berhasil (misal HTTP 200) sudah cukup untuk membuktikan bahwa API bekerja dengan benar? Jelaskan alasanmu berdasarkan temuan selama pengujian!
Jawaban: Tidak hanya lewat status kode 200 saja, perlu ada pengecekan kembali data yang dilakukan request method agar sesuai dengan apa yang diharapkan, karna walaupun status kode muncul berhasil (200) belum tentu sesuai dengan apa yang diharapkan

---

## I. Ketentuan Pengumpulan Tugas

Setiap siswa wajib mengumpulkan tugas melalui repository GitHub hasil fork masing-masing dengan rincian:

1. **Tautan Repository GitHub Hasil Fork:**
   - Memuat kode sumber yang sudah diperbaiki.
   - Seluruh perbaikan sudah di-commit dan di-push.
   - Repository disetel bersifat Publik agar dapat diperiksa oleh guru.
2. **Collection Postman:**
   - Ekspor collection Postman yang kamu gunakan dalam format `.json`.
   - Simpan file collection tersebut ke dalam folder: `docs/postman/`.
   - Pastikan setiap request di dalam collection diberi nama yang jelas sesuai dengan skenario pengujian.
3. **Laporan Praktikum (Format PDF):**
   - Simpan laporan ke dalam folder: `docs/laporan/`.
   - Isi laporan meliputi:
     - Identitas siswa (Nama, Kelas, NIS).
     - Tabel hasil pengujian lengkap (sebelum dan sesudah perbaikan).
     - Screenshot bukti pengujian Postman (Method, URL, Status HTTP, Body Respons).
     - Screenshot bukti pemeriksaan database MySQL.
     - Jawaban lengkap dari 11 Pertanyaan Analisis.

> **PENTING:**
> - **JANGAN** mengunggah file `.env` ke GitHub (pastikan tetap berada di `.gitignore`).
> - **JANGAN** mengunggah folder `vendor/`.
> - Penggunaan AI diizinkan untuk membantu memahami konsep, namun saat verifikasi dan penilaian, kamu wajib menjelaskan kode serta hasil pengujian secara mandiri di hadapan guru.
