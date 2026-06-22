# Dokumentasi Endpoint SKPI

Endpoint SKPI menyediakan operasi CRUD (Create, Read, Update, Delete) untuk data SKPI (Surat Keterangan Pendamping Ijazah) mahasiswa. Endpoint mahasiswa (`store`, `show`, `edit`, `update`, `destroy`, `index`) menggunakan guard `student`, sedangkan endpoint admin (`adminIndex`, `adminShow`) digunakan untuk melihat data SKPI seluruh mahasiswa.

## Routes

```php
Route::resource('skpi', SkpiController::class);

Route::middleware('auth')->group(function () {
    Route::get('/admin/skpi', [SkpiController::class, 'adminIndex'])->name('admin.skpi.index');
    Route::get('/admin/skpi/{studentId}', [SkpiController::class, 'adminShow'])->name('admin.skpi.show');
});
```

## Daftar Endpoint

| Method | Route | Middleware | Fungsi |
|--------|-------|-----------|--------|
| GET | `/skpi` | - | Lihat daftar SKPI milik mahasiswa yang login |
| GET | `/skpi/create` | - | Form buat SKPI baru |
| POST | `/skpi` | - | Simpan SKPI baru |
| GET | `/skpi/{id}` | - | Lihat detail SKPI |
| DELETE | `/skpi/{id}` | - | Hapus data SKPI |
| GET | `/admin/skpi` | `auth` | Lihat daftar mahasiswa yang memiliki SKPI |
| GET | `/admin/skpi/{studentId}` | `auth` | Lihat detail SKPI milik satu mahasiswa |

---
## Penjelasan Setiap Method/Function

### 1. **index()** - GET /skpi

**Fungsi:** Menampilkan daftar SKPI milik mahasiswa yang sedang login.

**Endpoint:** `GET /skpi`

**Middleware:** Tidak ada secara eksplisit di route, namun fungsi bergantung pada guard `student` yang sedang login

**Response:** HTML view `skpi.index` dengan list SKPI milik mahasiswa tersebut

**Code:**

```php
public function index()
{
    $studentId = Auth::guard('student')->user()->student_id;
    $skpis = Skpi::where('student_id', $studentId)->get();
    return view('skpi.index', compact('skpis'));
}
```

---

### 2. **create()** - GET /skpi/create

**Fungsi:** Menampilkan form untuk membuat data SKPI baru.

**Endpoint:** `GET /skpi/create`

**Middleware:** Tidak ada (public)

**Response:** HTML view `skpi.create`

**Code:**

```php
public function create()
{
    return view('skpi.create');
}
```

---

### 3. **store()** - POST /skpi

**Fungsi:** Menyimpan data SKPI baru beserta file sertifikat ke storage, untuk mahasiswa yang sedang login.

**Endpoint:** `POST /skpi`

**Middleware:** Tidak ada secara eksplisit di route, namun `student_id` diambil dari guard `student` yang sedang login

**Request Fields:**
- `kategori` (required, string)
- `kegiatan` (required, string)
- `tingkat` (required, string)
- `klasifikasi` (required, string)
- `periode_mulai` (required, date)
- `periode_selesai` (required, date)
- `file_sertifikat` (required, file, mimes: pdf/jpg/jpeg/png, max 10240 KB)

**Response:** Redirect ke `skpi.index`

**Code:**

```php
public function store(Request $request)
{
    $studentId = Auth::guard('student')->user()->student_id;

    $request->validate([
        'kategori'        => 'required|string',
        'kegiatan'        => 'required|string',
        'tingkat'         => 'required|string',
        'klasifikasi'     => 'required|string',
        'periode_mulai'   => 'required|date',
        'periode_selesai' => 'required|date',
        'file_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
    ]);

    $filePath = $request->file('file_sertifikat')->store('skpi', 'public');

    Skpi::create([
        'student_id'      => $studentId,
        'kategori'        => $request->kategori,
        'kegiatan'        => $request->kegiatan,
        'tingkat'         => $request->tingkat,
        'klasifikasi'     => $request->klasifikasi,
        'periode_mulai'   => $request->periode_mulai,
        'periode_selesai' => $request->periode_selesai,
        'file_sertifikat' => $filePath,
    ]);

    return redirect()->route('skpi.index');
}
```

**Penjelasan:** File sertifikat disimpan di disk `public` pada folder `skpi`, lalu path-nya disimpan ke kolom `file_sertifikat`.

---

### 4. **show()** - GET /skpi/{id}

**Fungsi:** Menampilkan detail satu data SKPI berdasarkan `id`.

**Endpoint:** `GET /skpi/{id}`

**Middleware:** Tidak ada (public)

**URL Parameters:**
- `id` (int, required) — ID SKPI

**Response:** HTML view `skpi.show` atau error 404 jika tidak ditemukan

**Code:**

```php
public function show(int $id)
{
    $skpi = Skpi::find($id);
    if (!$skpi) abort(404);
    return view('skpi.show', compact('skpi'));
}
```

---

### 5. **edit()** - GET /skpi/{id}/edit

**Fungsi:** Menampilkan form untuk mengedit data SKPI.

**Endpoint:** `GET /skpi/{id}/edit`

**Middleware:** Tidak ada (public)

**URL Parameters:**
- `id` (int, required)

**Response:** HTML view `skpi.edit` atau error 404 jika tidak ditemukan

**Code:**

```php
public function edit(int $id)
{
    $skpi = Skpi::find($id);
    if (!$skpi) abort(404);
    return view('skpi.edit', compact('skpi'));
}
```

---

### 6. **update()** - PUT /skpi/{id}

**Fungsi:** Mengupdate file sertifikat pada data SKPI (file lama otomatis dihapus dari storage).

**Endpoint:** `PUT /skpi/{id}`

**Middleware:** Tidak ada (public)

**URL Parameters:**
- `id` (int, required)

**Request Fields:**
- `file_sertifikat` (required, file, mimes: pdf/jpg/jpeg/png, max 2048 KB)

**Response:** Redirect ke `skpi.index` atau error 404 jika tidak ditemukan

**Code:**

```php
public function update(Request $request, int $id)
{
    $request->validate([
        'file_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

    $skpi = Skpi::find($id);
    if (!$skpi) abort(404);

    if ($skpi->file_sertifikat) {
        Storage::disk('public')->delete($skpi->file_sertifikat);
    }
    $skpi->file_sertifikat = $request->file('file_sertifikat')->store('skpi', 'public');
    $skpi->save();

    return redirect()->route('skpi.index');
}
```

**Catatan:** Hanya field `file_sertifikat` yang bisa diubah melalui endpoint ini. Field `kategori`, `kegiatan`, `tingkat`, `klasifikasi`, `periode_mulai`, dan `periode_selesai` **tidak** bisa diubah melalui endpoint ini.

---

### 7. **destroy()** - DELETE /skpi/{id}

**Fungsi:** Menghapus data SKPI beserta file sertifikat yang tersimpan di storage.

**Endpoint:** `DELETE /skpi/{id}`

**Middleware:** Tidak ada (public)

**URL Parameters:**
- `id` (int, required)

**Response:** Redirect ke `skpi.index` atau error 404 jika tidak ditemukan

**Code:**

```php
public function destroy(int $id)
{
    $skpi = Skpi::find($id);
    if (!$skpi) abort(404);

    if ($skpi->file_sertifikat) {
        Storage::disk('public')->delete($skpi->file_sertifikat);
    }

    $skpi->delete();

    return redirect()->route('skpi.index');
}
```

---

### 8. **adminIndex()** - GET /admin/skpi

**Fungsi:** Menampilkan daftar mahasiswa yang memiliki data SKPI, dengan opsi pencarian berdasarkan NIM.

**Endpoint:** `GET /admin/skpi`

**Middleware:** `auth` (hanya admin/staff)

**Query Parameters:**
- `nim` (optional, string) — filter pencarian berdasarkan `student_id` (pencarian parsial/like)

**Response:** HTML view `skpi.admin-index` dengan data mahasiswa terpaginasi (10 per halaman)

**Code:**

```php
public function adminIndex(Request $request)
{
    $query = \App\Models\Student::whereHas('skpis');

    if ($request->filled('nim')) {
        $query->where('student_id', 'like', '%' . $request->nim . '%');
    }

    $students = $query->paginate(10)->withQueryString();

    return view('skpi.admin-index', compact('students'));
}
```

---

### 9. **adminShow()** - GET /admin/skpi/{studentId}

**Fungsi:** Menampilkan detail seluruh data SKPI milik satu mahasiswa tertentu (dilihat oleh admin).

**Endpoint:** `GET /admin/skpi/{studentId}`

**Middleware:** `auth` (hanya admin/staff)

**URL Parameters:**
- `studentId` (required) — ID mahasiswa

**Response:** HTML view `skpi.admin-show` dengan data mahasiswa dan seluruh SKPI miliknya, atau error 404 jika mahasiswa tidak ditemukan

**Code:**

```php
public function adminShow($studentId)
{
    $student = \App\Models\Student::where('student_id', $studentId)->firstOrFail();
    $skpis = Skpi::where('student_id', $studentId)->get();
    return view('skpi.admin-show', compact('student', 'skpis'));
}
```

---

## Model - Skpi

```php
namespace App\Models;

class Skpi extends Model
{
    protected $table = 'skpi';

    protected $fillable = [
        'student_id',
        'kategori',
        'kegiatan',
        'tingkat',
        'klasifikasi',
        'periode_mulai',
        'periode_selesai',
        'file_sertifikat',
    ];
}
```

---

## NOTE

1. **Authentication:** Endpoint `index`, `create`, `store`, `show`, `edit`, `update`, dan `destroy` tidak memiliki middleware `auth`/`auth.student` secara eksplisit di route, namun `store` dan `index` tetap mengambil `student_id` dari guard `student` yang sedang login. Endpoint `adminIndex` dan `adminShow` dilindungi middleware `auth` (hanya admin/staff yang bisa akses).
2. **Tidak Ada Validasi Kepemilikan:** Endpoint `show`, `edit`, `update`, dan `destroy` mencari data SKPI hanya berdasarkan `id`, tanpa memvalidasi apakah SKPI tersebut benar-benar milik mahasiswa yang sedang login.
3. **File Sertifikat:** File disimpan di disk `public` pada folder `skpi`. Saat update, file lama otomatis dihapus dari storage sebelum file baru disimpan.
4. **Validasi Ukuran File Tidak Konsisten:** Batas ukuran file pada `store` adalah 10240 KB (10 MB), sedangkan pada `update` adalah 2048 KB (2 MB).
5. **JSON Support:** Tidak ada dukungan response JSON pada controller ini (berbeda dengan endpoint Students), seluruh response berupa HTML view atau redirect.
6. **Fungsi:** Beberapa fungsi di disable atau disembunyikan sesuai dengan fungsi dan otoritas dari login masing-masing.
---