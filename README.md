# Kawal Pilkada

Kawal Pilkada adalah aplikasi berbasis web yang dirancang untuk meningkatkan transparansi dan integritas dalam proses pemilihan kepala daerah (Pilkada). Aplikasi ini memungkinkan masyarakat untuk mengunggah, memverifikasi, dan memantau hasil formulir C1 secara real-time, serta mendorong partisipasi publik dalam menjaga kejujuran pemilu.

---

## Fitur Utama

- **Unggah dan Verifikasi Dokumen C1:**
  Pengguna dapat mengunggah hasil scan atau foto formulir C1, yang akan diverifikasi untuk memastikan keaslian data.

- **Realtime Monitoring:**
  Menampilkan hasil penghitungan suara dari berbagai TPS secara real-time.

---

## Teknologi yang Digunakan

### **Frontend:**
- [Bootstrap 4](https://getbootstrap.com/): Framework CSS untuk desain antarmuka responsif dan modern.
- [SweetAlert2](https://sweetalert2.github.io/): Library untuk menampilkan notifikasi dan popup interaktif.
- **AJAX dan jQuery:** Untuk komunikasi asynchronous dengan server tanpa memuat ulang halaman.

### **Backend:**
- [Laravel](https://laravel.com/): Framework PHP untuk pengelolaan logika aplikasi, routing, dan keamanan.

### **Database:**
- [MySQL](https://www.mysql.com/): Basis data relasional untuk menyimpan dan mengelola data formulir C1 dan hasil Pilkada.

---

## Instalasi dan Pengaturan

1. **Clone Repository:**
   ```bash
   git clone https://github.com/alfatihritonga/kawal-pilkada-app.git
   cd kawal-pilkada-app
   ```

2. **Instal Dependensi Backend:**
   Pastikan Anda telah menginstal Composer, lalu jalankan:
   ```bash
   composer install
   ```

3. **Instal Dependensi Frontend:**
   Jika ada, jalankan perintah berikut untuk mengelola asset frontend:
   ```bash
   npm install && npm run dev
   ```

4. **Konfigurasi Database:**
   - Duplikasi file `.env.example` menjadi `.env`.
   - Atur koneksi database di file `.env`:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=kawal_pilkada
     DB_USERNAME=root
     DB_PASSWORD=yourpassword
     ```

5. **Migrasi Database:**
   Jalankan perintah berikut untuk membuat tabel di database:
   ```bash
   php artisan migrate
   ```

6. **Jalankan Server Lokal:**
   ```bash
   php artisan serve
   ```
   Aplikasi akan tersedia di [http://localhost:8000](http://localhost:8000).

---

## Cara Penggunaan

1. **Pengaturan Awal oleh Admin:**
   - Admin menjalankan aplikasi untuk melengkapi data daerah pemilihan, termasuk data kabupaten/kota, kecamatan, kelurahan/desa, dan TPS.

2. **Pendaftaran Operator:**
   - Operator yang bertugas sebagai penanggung jawab di kecamatan mendaftarkan akun mereka melalui aplikasi.

3. **Pembuatan Akun Saksi:**
   - Operator membuatkan akun untuk masing-masing saksi di kecamatan tempat mereka bertugas.

4. **Login Akun Saksi:**
   - Saksi dapat login ke aplikasi menggunakan akun yang telah dibuatkan oleh operator.

5. **Mengirimkan Laporan C1 oleh Saksi:**
   - Saksi login terlebih dahulu, lalu mengklik tombol "Upload Laporan C1".
   - Saksi melengkapi formulir pengunggahan dan mengklik tombol "Upload" untuk mengirimkan laporan.

6. **Pemantauan oleh Operator:**
   - Operator dapat memantau hasil laporan yang dikirimkan oleh saksi.
   - Jika laporan tidak sesuai atau keliru, operator dapat mengubah status laporan:
     - **Pending:** Status awal saat laporan baru saja dikirim.
     - **Invalid:** Jika laporan keliru atau tidak valid.
     - **Valid:** Jika laporan sudah benar.

7. **Melihat Hasil Quick Count:**
   - Hasil quick count dapat dilihat pada halaman quick count atau dengan mengakses endpoint `/quickcount`.

---

## Rencana Pengembangan

- Menambahkan fitur OCR untuk membaca data formulir C1 secara otomatis.
- Memperluas cakupan aplikasi ke pemilu nasional.
- Meningkatkan pengalaman pengguna dengan desain antarmuka yang lebih intuitif.
- Mengintegrasikan sistem pelaporan kecurangan yang lebih canggih.

---

## Kontribusi

Kontribusi sangat diterima! Jika Anda ingin membantu pengembangan aplikasi ini, silakan:

1. Fork repository ini.
2. Buat branch baru untuk fitur atau perbaikan Anda: `git checkout -b fitur-baru`.
3. Lakukan perubahan dan commit: `git commit -m 'Menambahkan fitur baru'`.
4. Push branch Anda: `git push origin fitur-baru`.
5. Buat Pull Request di GitHub.

---

## Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE). Anda bebas menggunakan, memodifikasi, dan mendistribusikan aplikasi ini sesuai dengan ketentuan lisensi.

---

Terima kasih telah mendukung Kawal Pilkada!
