# Dokumentasi Endpoint Students

Endpoint Students menyediakan operasi CRUD (Create, Read, Update, Delete) untuk data mahasiswa. Sebagian besar endpoint dilindungi oleh middleware `auth` (admin/staff).

## Routes

```php
Route::resource('students', StudentController::class)->except(['store', 'update', 'destroy']);

Route::middleware('auth')->group(function () {
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::put('/students/{studentId}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{studentId}', [StudentController::class, 'destroy'])->name('students.destroy');
});
```

## Daftar Endpoint

| Method | Route | Middleware | Fungsi |
|--------|-------|-----------|--------|
| GET | `/students` | - | Lihat daftar mahasiswa |
| GET | `/students/create` | - | Form buat mahasiswa |
| POST | `/students` | `auth` | Simpan mahasiswa baru |
| GET | `/students/{studentId}` | - | Lihat detail mahasiswa |
| GET | `/students/{studentId}/edit` | - | Form edit mahasiswa |
| PUT | `/students/{studentId}` | `auth` | Update data mahasiswa |
| DELETE | `/students/{studentId}` | `auth` | Hapus mahasiswa |

---

## Penjelasan Setiap Method

### 1. **index()** - GET /students

**Fungsi:** Menampilkan daftar semua mahasiswa.

**Endpoint:** `GET /students`

**Middleware:** Tidak ada (public)

**Response:**
- HTML: menampilkan view `students.index` dengan list mahasiswa
- JSON: return array mahasiswa (jika `Accept: application/json`)

**Code:**

```php
public function index(Request $request)
{
    $students = Student::all();

    if ($request->wantsJson()) {
        return response()->json($students);
    }

    return view('students.index', ['students' => $students]);
}
```

---

### 2. **create()** - GET /students/create

**Fungsi:** Menampilkan form untuk membuat mahasiswa baru.

**Endpoint:** `GET /students/create`

**Middleware:** Tidak ada (public)

**Response:** HTML view `students.create`

**Code:**

```php
public function create()
{
    return view('students.create');
}
```


---

### 3. **store()** - POST /students

**Fungsi:** Menyimpan data mahasiswa baru ke database. Menghasilkan `student_id` otomatis berdasarkan program studi dan tahun ajaran.

**Endpoint:** `POST /students`

**Middleware:** `auth` (hanya admin/staff)

**Request Fields:**
- `name` (required, string, max 255)
- `email` (required, email, unique)
- `password` (required, string, min 6) — akan di-hash
- `program_studi` (required, in: "Sistem Informasi" atau "Teknik Informatika")
- `address` (optional, string, max 500)
- `phone_number` (optional, string, max 20)

**Response:**
- HTML: redirect ke `/students` dengan pesan sukses
- JSON: return data mahasiswa yang baru dibuat (status 201)

**Code:**

```php
public function store(Request $request)
{
    $request->validate([
        'name'         => 'required|string|max:255',
        'address'      => 'nullable|string|max:500',
        'phone_number' => 'nullable|string|max:20',
        'program_studi'=> 'required|string|in:Sistem Informasi,Teknik Informatika',
        'email'        => 'required|email|unique:students,email',
        'password'     => 'required|string|min:6',
    ]);

    $student = Student::create([
        'student_id'    => $this->generateStudentId($request->program_studi),
        'name'          => $request->name,
        'address'       => $request->address,
        'phone_number'  => $request->phone_number,
        'program_studi' => $request->program_studi,
        'email'         => $request->email,
        'password'      => Hash::make($request->password),
    ]);

    if ($request->wantsJson()) {
        return response()->json($student, 201);
    }

    return redirect()->route('students.index')->with('success', 'Student added successfully.');
}
```


**Helper Function - generateStudentId():**

```php
private function generateStudentId(string $programStudi): int
{
    $prefixMap = [
        'Sistem Informasi' => 825,
        'Teknik Informatika' => 535,
    ];

    if (! isset($prefixMap[$programStudi])) {
        throw new \InvalidArgumentException('Invalid program studi selection.');
    }

    $prefix = $prefixMap[$programStudi];
    $year = (int) date('y');
    $start = ($prefix * 100_000_000) + ($year * 1_000_000);
    $end = $start + 999_999;

    $last = Student::where('student_id', '>=', $start)
        ->where('student_id', '<=', $end)
        ->orderByDesc('student_id')
        ->value('student_id');

    $next = $last ? $last + 1 : $start;

    if ($next > $end) {
        throw new \RuntimeException('Maximum student_id reached for '.$programStudi.' in '.$year.'.');
    }

    return $next;
}
```

**Penjelasan:** Menghasilkan ID unik 9 digit dengan format: `[prefix][tahun][nomor urut]`.
- Prefix "Sistem Informasi": 825
- Prefix "Teknik Informatika": 535
- Contoh: 825260000001 (Sistem Informasi, tahun 26, mahasiswa pertama)

---

### 4. **show()** - GET /students/{studentId}

**Fungsi:** Menampilkan detail data satu mahasiswa berdasarkan `student_id`.

**Endpoint:** `GET /students/{studentId}`

**Middleware:** Tidak ada (public)

**URL Parameters:**
- `studentId` (int, required) — ID mahasiswa

**Response:**
- HTML: view `students.show` dengan data mahasiswa
- JSON: array data mahasiswa (status 200) atau error 404

**Code:**

```php
public function show(Request $request, $studentId)
{
    $studentId = (int) $studentId;
    $student = Student::where('student_id', $studentId)->first();

    if (! $student) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Student does not exist.'], 404);
        }

        abort(404, 'Student does not exist.');
    }

    if ($request->wantsJson()) {
        return response()->json($student);
    }

    return view('students.show', ['student' => $student]);
}
```


---

### 5. **edit()** - GET /students/{studentId}/edit

**Fungsi:** Menampilkan form untuk mengedit data mahasiswa.

**Endpoint:** `GET /students/{studentId}/edit`

**Middleware:** Tidak ada (public)

**URL Parameters:**
- `studentId` (int, required)

**Response:** HTML view `students.edit` atau error 404

**Code:**

```php
public function edit(Request $request, $studentId)
{
    $studentId = (int) $studentId;
    $student = Student::where('student_id', $studentId)->first();

    if (! $student) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Student not found.'], 404);
        }

        abort(404, 'Student not found.');
    }

    if ($request->wantsJson()) {
        return response()->json($student);
    }

    return view('students.edit', ['student' => $student]);
}
```


---

### 6. **update()** - PUT /students/{studentId}

**Fungsi:** Mengupdate data mahasiswa (hanya `address` dan `phone_number` yang bisa diubah).

**Endpoint:** `PUT /students/{studentId}`

**Middleware:** `auth` (hanya admin/staff)

**URL Parameters:**
- `studentId` (int, required)

**Request Fields:**
- `address` (optional, string, max 500)
- `phone_number` (optional, string, max 20)

**Response:**
- HTML: redirect ke `/students` dengan pesan sukses
- JSON: data mahasiswa yang sudah diupdate

**Code:**

```php
public function update(Request $request, $studentId)
{
    $studentId = (int) $studentId;
    $request->validate([
        'address'      => 'nullable|string|max:500',
        'phone_number' => 'nullable|string|max:20',
    ]);

    $student = Student::where('student_id', $studentId)->first();

    if (! $student) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Student not found.'], 404);
        }

        return redirect()->route('students.index')->with('error', 'Student not found.');
    }

    $student->update($request->only('address', 'phone_number'));

    if ($request->wantsJson()) {
        return response()->json($student);
    }

    return redirect()->route('students.index')->with('success', 'Data updated successfully.');
}
```

**Catatan:** Field `name`, `email`, `password`, dan `program_studi` **tidak** bisa diubah melalui endpoint ini.


---

### 7. **destroy()** - DELETE /students/{studentId}

**Fungsi:** Menghapus data mahasiswa dari database.

**Endpoint:** `DELETE /students/{studentId}`

**Middleware:** `auth` (hanya admin/staff)

**URL Parameters:**
- `studentId` (int, required)

**Response:**
- HTML: redirect ke `/students` dengan pesan sukses
- JSON: pesan sukses atau error 404

**Code:**

```php
public function destroy(Request $request, $studentId)
{
    $studentId = (int) $studentId;
    $student = Student::where('student_id', $studentId)->first();
 
    if (! $student) {
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Student not found.'], 404);
        }

        return redirect()->route('students.index')->with('error', 'Student not found.');
    }
 
    $student->delete();
 
    if ($request->wantsJson()) {
        return response()->json(['message' => 'Student deleted successfully.']);
    }

    return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
}
```


---

## Model - Student

```php
namespace App\Models;

class Student extends Model
{
    protected $fillable = [
        'student_id',
        'name',
        'email',
        'password',
        'address',
        'phone_number',
        'program_studi',
    ];
}
```

---

## NOTE

1. **Authentication:** Endpoint `store`, `update`, dan `destroy` dilindungi middleware `auth` (hanya admin/staff yang bisa akses).
2. **Student ID Automatic:** Saat membuat mahasiswa, system otomatis generate `student_id` berdasarkan program studi dan tahun.
3. **Keamanan Password:** Password disimpan dalam bentuk hash menggunakan `Hash::make()`.
4. **JSON Support:** Semua endpoint support baik HTML maupun JSON response (gunakan header `Accept: application/json` untuk JSON).
5. **Update Terbatas:** Endpoint update hanya mengizinkan perubahan `address` dan `phone_number`.

---
