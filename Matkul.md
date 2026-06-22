# Dokumentasi Endpoint Matkul

Endpoint Matkul menyediakan operasi CRUD (Create, Read, Update, Delete) untuk data mata kuliah. Sebagian besar endpoint dilindungi oleh middleware `auth` (admin/staff).

## Routes

```php
// Route /matkul/create harus didaftarkan SEBELUM Route::resource
// agar tidak tertangkap sebagai /matkul/{id}

Route::middleware('auth')->group(function () {
    Route::get('/matkul/create', [MatkulController::class, 'create'])->name('matkul.create');
    Route::post('/matkul', [MatkulController::class, 'store'])->name('matkul.store');
    Route::get('/matkul/{id}/edit', [MatkulController::class, 'edit'])->name('matkul.edit');
    Route::put('/matkul/{id}', [MatkulController::class, 'update'])->name('matkul.update');
    Route::delete('/matkul/{id}', [MatkulController::class, 'destroy'])->name('matkul.destroy');
});

Route::resource('matkul', MatkulController::class)->only(['index', 'show']);
```

## Daftar Endpoint

| Method    | Route              | Middleware | Fungsi                  |
|-----------|--------------------|------------|-------------------------|
| GET       | `/matkul`          | -          | Lihat daftar mata kuliah |
| GET       | `/matkul/create`   | `auth`     | Form buat mata kuliah   |
| POST      | `/matkul`          | `auth`     | Simpan mata kuliah baru |
| GET       | `/matkul/{id}`     | -          | Lihat detail mata kuliah |
| GET       | `/matkul/{id}/edit`| `auth`     | Form edit mata kuliah   |
| PUT/PATCH | `/matkul/{id}`     | `auth`     | Update data mata kuliah |
| DELETE    | `/matkul/{id}`     | `auth`     | Hapus mata kuliah       |

---

## Penjelasan Setiap Method/Function

### 1. **index()** - GET /matkul

**Fungsi:** Menampilkan daftar semua mata kuliah.

**Endpoint:** `GET /matkul`

**Middleware:** Tidak ada (public)

**Response:** HTML: menampilkan view `matkul.index` dengan list mata kuliah.

**Code:**

```php
public function index()
{
    $matkuls = Matkul::all();
    return view('matkul.index', compact('matkuls'));
}
```

---

### 2. **create()** - GET /matkul/create

**Fungsi:** Menampilkan form untuk membuat mata kuliah baru.

**Endpoint:** `GET /matkul/create`

**Middleware:** `auth` (hanya admin/staff)

**Response:** HTML view `matkul.create`

**Code:**

```php
public function create()
{
    return view('matkul.create');
}
```

---

### 3. **store()** - POST /matkul

**Fungsi:** Menyimpan data mata kuliah baru ke database.

**Endpoint:** `POST /matkul`

**Middleware:** `auth` (hanya admin/staff)

**Request Fields:**
- `nama` (required, string, max 255)
- `kodematkul` (required, string, max 50)
- `sks` (required, integer, min 1)
- `deskripsi` (optional, string, max 250)
- `dosen` (required, string, max 255)
- `kodemsteam` (optional, string, max 100)

**Response:** HTML: redirect ke `/matkul` setelah berhasil disimpan.

**Code:**

```php
public function store(Request $request)
{
    $request->validate([
        'nama'       => 'required|string|max:255',
        'kodematkul' => 'required|string|max:50',
        'sks'        => 'required|integer|min:1',
        'deskripsi'  => 'nullable|string|max:250',
        'dosen'      => 'required|string|max:255',
        'kodemsteam' => 'nullable|string|max:100',
    ]);

    Matkul::create($request->only(
        'nama', 'kodematkul', 'sks', 'deskripsi', 'dosen', 'kodemsteam'
    ));

    return redirect()->route('matkul.index');
}
```

---

### 4. **show()** - GET /matkul/{id}

**Fungsi:** Menampilkan detail data satu mata kuliah berdasarkan `id`.

**Endpoint:** `GET /matkul/{id}`

**Middleware:** Tidak ada (public)

**URL Parameters:**
- `id` (int, required) — ID mata kuliah

**Response:** HTML: view `matkul.show` dengan data mata kuliah, atau error 404 jika tidak ditemukan.

**Code:**

```php
public function show($id)
{
    $matkul = Matkul::findOrFail($id);
    return view('matkul.show', compact('matkul'));
}
```

---

### 5. **edit()** - GET /matkul/{id}/edit

**Fungsi:** Menampilkan form untuk mengedit data mata kuliah.

**Endpoint:** `GET /matkul/{id}/edit`

**Middleware:** `auth` (hanya admin/staff)

**URL Parameters:**
- `id` (int, required) — ID mata kuliah

**Response:** HTML view `matkul.edit`, atau error 404 jika tidak ditemukan.

**Code:**

```php
public function edit($id)
{
    $matkul = Matkul::findOrFail($id);
    return view('matkul.edit', compact('matkul'));
}
```

---

### 6. **update()** - PUT /matkul/{id}

**Fungsi:** Mengupdate data mata kuliah yang sudah ada.

**Endpoint:** `PUT /matkul/{id}`

**Middleware:** `auth` (hanya admin/staff)

**URL Parameters:**
- `id` (int, required) — ID mata kuliah

**Request Fields:**
- `nama` (optional, string, max 255)
- `kodematkul` (optional, string, max 50)
- `sks` (optional, integer, min 1)
- `deskripsi` (optional, string, max 250)
- `dosen` (optional, string, max 255)
- `kodemsteam` (optional, string, max 100)

**Response:** HTML: redirect ke `/matkul` setelah berhasil diupdate, atau error 404 jika tidak ditemukan.

**Code:**

```php
public function update(Request $request, $id)
{
    $matkul = Matkul::findOrFail($id);
    $matkul->update($request->only(
        'nama', 'kodematkul', 'sks', 'deskripsi', 'dosen', 'kodemsteam'
    ));
    return redirect()->route('matkul.index');
}
```

**Catatan:** Method `update` saat ini **tidak memiliki validasi eksplisit**. Disarankan menambahkan `$request->validate()` agar konsisten dengan `store()`.

---

### 7. **destroy()** - DELETE /matkul/{id}

**Fungsi:** Menghapus data mata kuliah dari database.

**Endpoint:** `DELETE /matkul/{id}`

**Middleware:** `auth` (hanya admin/staff)

**URL Parameters:**
- `id` (int, required) — ID mata kuliah

**Response:** HTML: redirect ke `/matkul` setelah berhasil dihapus, atau error 404 jika tidak ditemukan.

**Code:**

```php
public function destroy($id)
{
    Matkul::findOrFail($id)->delete();
    return redirect()->route('matkul.index');
}
```

---

## Model - Matkul

```php
namespace App\Models;

class Matkul extends Model
{
    protected $table = 'matkul';

    protected $fillable = [
        'nama',
        'kodematkul',
        'sks',
        'deskripsi',
        'dosen',
        'kodemsteam',
    ];

    public function grades()
    {
        return $this->hasMany(Grades::class);
    }
}
```

---

## NOTE

1. **Authentication:** Endpoint `create`, `store`, `edit`, `update`, dan `destroy` dilindungi middleware `auth` (hanya admin/staff yang bisa akses). Endpoint `index` dan `show` bersifat public.
2. **Urutan Route Penting:** Route `GET /matkul/create` **harus** didaftarkan sebelum `Route::resource` agar tidak tertangkap sebagai `/matkul/{id}` dengan nilai `id = "create"`, yang menyebabkan error 404.
3. **Validasi Update:** Method `update()` saat ini belum memiliki validasi input. Disarankan menambahkan validasi agar konsisten dengan `store()`.
4. **Error Handling:** Semua lookup menggunakan `findOrFail()` yang otomatis mengembalikan error 404 jika data tidak ditemukan.
5. **Relasi:** Model `Matkul` memiliki relasi `hasMany` ke model `Grades`.

---