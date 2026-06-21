# Dokumentasi Endpoint Announcements

Endpoint Announcements menyediakan operasi CRUD (Create, Read, Update, Delete) untuk mengelola pengumuman. Semua endpoint dilindungi oleh middleware `auth` (admin/staff). Selain itu, tersedia endpoint read-only terpisah untuk mahasiswa (dihandle oleh `StudentAuthController`).

## Routes

```php
//Admin
Route::middleware('auth')->group(function () {
    Route::resource('announcements', AnnouncementController::class);
});

//Student
Route::middleware('auth.student')->group(function () {
    Route::get('/student/announcements', [StudentAuthController::class, 'announcements'])->name('student.announcements.index');
    Route::get('/student/announcements/{announcement}', [StudentAuthController::class, 'announcementShow'])->name('student.announcements.show');
});
```

## Daftar Endpoint (Admin)

| Method | Route | Middleware | Fungsi |
|--------|-------|-----------|--------|
| GET | `/announcements` | `auth` | Lihat daftar pengumuman |
| GET | `/announcements/create` | `auth` | Form buat pengumuman |
| POST | `/announcements` | `auth` | Simpan pengumuman baru |
| GET | `/announcements/{id}` | `auth` | Lihat detail pengumuman |
| GET | `/announcements/{id}/edit` | `auth` | Form edit pengumuman |
| PUT | `/announcements/{id}` | `auth` | Update pengumuman |
| DELETE | `/announcements/{id}` | `auth` | Hapus pengumuman |

## Daftar Endpoint (Student)

| Method | Route | Middleware | Fungsi |
|--------|-------|-----------|--------|
| GET | `/student/announcements` | `auth.student` | Daftar pengumuman (view-only) |
| GET | `/student/announcements/{id}` | `auth.student` | Detail pengumuman (view-only) |

---

## Penjelasan Setiap Method (Admin)

### 1. **index()** - GET /announcements

**Fungsi:** Menampilkan daftar semua pengumuman, diurutkan dari yang terbaru.

**Endpoint:** `GET /announcements`

**Middleware:** `auth` (admin/staff)

**Response:** HTML view `announcements.index` dengan list pengumuman

**Code:**

```php
public function index()
{
    $announcements = Announcement::latest()->get();
    return view('announcements.index', compact('announcements'));
}
```

---

### 2. **create()** - GET /announcements/create

**Fungsi:** Menampilkan form untuk membuat pengumuman baru.

**Endpoint:** `GET /announcements/create`

**Middleware:** `auth` (admin/staff)

**Response:** HTML view `announcements.create` dengan form input

**Code:**

```php
public function create()
{
    return view('announcements.create');
}
```

---

### 3. **store()** - POST /announcements

**Fungsi:** Menyimpan pengumuman baru ke database. Mendukung upload gambar (image file).

**Endpoint:** `POST /announcements`

**Middleware:** `auth` (admin/staff)

**Request Fields (multipart/form-data):**
- `title` (required, string, max 255) — judul pengumuman
- `content` (required, string) — isi pengumuman
- `image` (optional, file, mimes: jpeg/png/jpg/gif/svg/webp, max 5MB)

**Response:** Redirect ke `/announcements` dengan pesan success

**Code:**

```php
public function store(Request $request)
{
    $request->validate([
        'title'   => 'required|string|max:255',
        'content' => 'required|string',
        'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
    ]);

    $data = $request->only('title', 'content');

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('announcements', 'public');
    }

    Announcement::create($data);

    return redirect()->route('announcements.index')
                     ->with('success', 'Pengumuman berhasil dibuat.');
}
```

**Catatan:** 
- Image disimpan di storage folder `announcements` (public disk)
- Image path disimpan di database sebagai relative path
- Jika tidak ada image, tetap bisa membuat pengumuman

---

### 4. **show()** - GET /announcements/{id}

**Fungsi:** Menampilkan detail satu pengumuman secara lengkap (admin view dengan tombol edit/hapus).

**Endpoint:** `GET /announcements/{id}`

**Middleware:** `auth` (admin/staff)

**URL Parameters:**
- `id` (int, required) — ID pengumuman (route-model binding)

**Response:** HTML view `announcements.show` dengan detail pengumuman + edit/delete buttons

**Code:**

```php
public function show(Announcement $announcement)
{
    return view('announcements.show', compact('announcement'));
}
```

---

### 5. **edit()** - GET /announcements/{id}/edit

**Fungsi:** Menampilkan form untuk mengedit pengumuman yang sudah ada.

**Endpoint:** `GET /announcements/{id}/edit`

**Middleware:** `auth` (admin/staff)

**URL Parameters:**
- `id` (int, required) — ID pengumuman

**Response:** HTML view `announcements.edit` dengan form preevaluated (title, content, image saat ini)

**Code:**

```php
public function edit(Announcement $announcement)
{
    return view('announcements.edit', compact('announcement'));
}
```

---

### 6. **update()** - PUT /announcements/{id}

**Fungsi:** Mengupdate pengumuman yang sudah ada (title, content, image). Jika ada image baru, image lama dihapus.

**Endpoint:** `PUT /announcements/{id}`

**Middleware:** `auth` (admin/staff)

**URL Parameters:**
- `id` (int, required) — ID pengumuman

**Request Fields (multipart/form-data):**
- `title` (required, string, max 255)
- `content` (required, string)
- `image` (optional, file, mimes: jpeg/png/jpg/gif/svg/webp, max 5MB)
- `_method=PUT` (required untuk form HTML, jika POST)

**Response:** Redirect ke `/announcements` dengan pesan success

**Code:**

```php
public function update(Request $request, Announcement $announcement)
{
    $request->validate([
        'title'   => 'required|string|max:255',
        'content' => 'required|string',
        'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
    ]);

    $data = $request->only('title', 'content');

    if ($request->hasFile('image')) {
        if ($announcement->image) {
            Storage::disk('public')->delete($announcement->image);
        }
        $data['image'] = $request->file('image')->store('announcements', 'public');
    }

    $announcement->update($data);

    return redirect()->route('announcements.index')
                     ->with('success', 'Pengumuman berhasil diperbarui.');
}
```

---

### 7. **destroy()** - DELETE /announcements/{id}

**Fungsi:** Menghapus pengumuman dari database. Image juga dihapus dari storage jika ada.

**Endpoint:** `DELETE /announcements/{id}`

**Middleware:** `auth` (admin/staff)

**URL Parameters:**
- `id` (int, required) — ID pengumuman

**Response:** Redirect ke `/announcements` dengan pesan success

**Code:**

```php
public function destroy(Announcement $announcement)
{
    if ($announcement->image) {
        Storage::disk('public')->delete($announcement->image);
    }

    $announcement->delete();

    return redirect()->route('announcements.index')
                     ->with('success', 'Pengumuman berhasil dihapus.');
}
```

**Catatan:** Gambar yang terkait juga dihapus dari storage

---

## Endpoint Read-Only untuk Mahasiswa

Mahasiswa dapat melihat daftar dan detail pengumuman tanpa akses untuk membuat, mengubah, atau menghapus.

### 1. **announcements()** - GET /student/announcements

Dihandle oleh `StudentAuthController@announcements` (dapat dilihat di dokumentasi terpisah atau view di `resources/views/student/announcements/index.blade.php`)

### 2. **announcementShow()** - GET /student/announcements/{id}

Dihandle oleh `StudentAuthController@announcementShow` (dapat dilihat di dokumentasi terpisah atau view di `resources/views/student/announcements/show.blade.php`)

---

## Model - Announcement

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    protected $fillable = ['title', 'content', 'image'];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
```

**Attributes:**
- `id` — primary key
- `title` — judul pengumuman
- `content` — isi pengumuman
- `image` — path relatif gambar (stored di `storage/app/public/announcements/`)
- `created_at` — timestamp pembuatan
- `updated_at` — timestamp update terakhir

**Accessor:**
- `image_url` — full URL gambar (menggunakan `asset()` helper)

---

## Database Schema

```sql
CREATE TABLE announcements (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    image VARCHAR(255) NULLABLE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

---

## File Upload Storage

Gambar pengumuman disimpan di:
```
storage/app/public/announcements/{filename}
```

Accessible via:
```
http://localhost:8000/storage/announcements/{filename}
```

---

## Catatan Penting

1. **Authentication:** Semua endpoint admin dilindungi middleware `auth` (hanya admin/staff).
2. **Image Handling:** 
   - Tipe file: JPEG, PNG, JPG, GIF, SVG, WebP
   - Max ukuran: 5 MB
   - Image optional (bisa buat pengumuman tanpa gambar)
   - Image lama dihapus saat update dengan image baru

3. **Route Model Binding:** Endpoint menggunakan route-model binding untuk `Announcement`, jadi parameter bisa `{announcement}` atau `{id}`.

4. **Timestamps:** Model otomatis track `created_at` dan `updated_at`.

5. **Ordering:** Saat index, pengumuman diurutkan dari yang terbaru (`latest()`).

6. **CSRF Protection:** Form submit perlu include CSRF token (Laravel otomatis handle jika pakai form Blade dengan `@csrf`).

---

## Integration dengan Student Dashboard

Pengumuman juga ditampilkan di student dashboard (`/student/home`) sebagai read-only cards yang clickable. Mahasiswa hanya bisa:
- Melihat daftar pengumuman
- Melihat detail pengumuman

