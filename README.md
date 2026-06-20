
# Back-UAS-Edan
Project UAS Back End Programming
Kelompok LINTAR


Back-UAS-Edan adalah backend berbasis Laravel untuk portal informasi mahasiswa (LINTAR UNTAR). Aplikasi ini menyediakan Authentication untuk admin/staff dan Authentication terpisah untuk mahasiswa, serta fitur dashboard mahasiswa, management pengumuman, nilai (grades), management mata kuliah (matkul), SKPI, dan endpoint terkait pembayaran kuliah.


Authentication
-
- Authentication admin/staff menggunakan middleware `auth` (web guard).
- Authentication mahasiswa menggunakan guard terpisah dan middleware `auth.student`.

Daftar Endpoint


Umum / Auth
- GET  /                 - Halaman welcome (akan redirect jika sudah login)
- GET  /vulnerable        - (debug) query DB mentah (tidak aman; hanya untuk pengembangan)
- GET  /login             - Form login admin
- POST /login             - Proses login admin
- POST /logout            - Logout admin [Auth Required]
- GET  /register          - Form registrasi
- POST /register         - Daftarkan user baru

## [Mahasiswa (Students)](Students.md)
- Resource `students` (beberapa aksi butuh auth):
	- GET    /students               - Daftar mahasiswa
	- GET    /students/create        - Form buat mahasiswa
	- GET    /students/{student}     - Detail mahasiswa
	- GET    /students/{student}/edit - Form edit
	- POST   /students               - Buat mahasiswa [Auth Required]
	- PUT    /students/{studentId}   - Update mahasiswa [Auth Required]
	- DELETE /students/{studentId}   - Hapus mahasiswa [Auth Required]

Grades (Nilai)
- GET  /grades/{studentId}                - Ambil nilai untuk student tertentu (auth)
- Resource `/home/grades` (controller `GradesController`) - resource standar di bawah auth
- GET  /student/grades                    - Daftar nilai untuk mahasiswa (auth.student)
- GET  /student/grades/{studentId}        - Nilai spesifik mahasiswa (auth.student)

Mata Kuliah (Matkul)
- Resource `matkul` (controller `MatkulController`) - CRUD untuk mata kuliah

SKPI
- Resource `skpi` - Endpoint CRUD terkait SKPI

Uang Kuliah / Tuition
- GET  /uang-kuliah/               - Halaman utama uang kuliah
- GET  /uang-kuliah/menu           - Menu uang kuliah
- GET  /uang-kuliah/payment-scheme - Tampilkan skema pembayaran
- POST /uang-kuliah/payment-scheme - Simpan skema pembayaran
- GET  /uang-kuliah/dispensasi     - Form dispensasi
- POST /uang-kuliah/dispensasi    - Simpan permintaan dispensasi

Komentar
- POST /comments - Kirim komentar

IPK
- GET /students/{student}/ipk - Tampilkan IPK mahasiswa

Pengumuman (Announcements)
- Resource `announcements` (controller `AnnouncementController`) - dilindungi middleware `auth` (admin/staff):
	- GET    /announcements            - Daftar pengumuman (tampilan admin)
	- GET    /announcements/create     - Form buat pengumuman
	- POST   /announcements            - Simpan pengumuman baru
	- GET    /announcements/{announcement} - Lihat pengumuman
	- GET    /announcements/{announcement}/edit - Form edit
	- PUT    /announcements/{announcement} - Update pengumuman
	- DELETE /announcements/{announcement} - Hapus pengumuman

Student Only view
- GET /student/login                   - Form login mahasiswa
- POST /student/login                  - Proses login mahasiswa
- POST /student/logout                 - Logout mahasiswa
- GET  /student/home                   - Dashboard mahasiswa (juga menampilkan Announcements)
- GET  /student/announcements          - Daftar pengumuman untuk mahasiswa (read-only)
- GET  /student/announcements/{announcement} - Detail pengumuman (read-only)
- GET  /student/credential             - Form pengecekan kredensial mahasiswa
- POST /student/credential             - Periksa kredensial mahasiswa

Notes
- Resource `announcements` untuk admin memungkinkan aksi create/update/delete dan dilindungi oleh middleware `auth`.
- Halaman pengumuman mahasiswa bersifat read-only dan menggunakan middleware `auth.student`.
- Beberapa route (mis. `/vulnerable`) ada untuk keperluan pengembangan/testing dan sebaiknya dihapus atau diamankan di produksi.



