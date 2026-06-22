# Dokumentasi Endpoint Uang Kuliah

Endpoint Uang Kuliah menyediakan operasi untuk melihat tagihan, mengatur skema pembayaran, dan mengajukan dispensasi. Sebagian besar proteksi otorisasi (antara Admin dan Mahasiswa) dilakukan secara manual di dalam Controller menggunakan pengecekan `auth()->guard('student')->check()`.

## Routes

```php
Route::prefix('uang-kuliah')->group(function () {
    Route::get('/', [UangKuliahController::class, 'index']);
    Route::get('/menu', [UangKuliahController::class, 'menu']);
    Route::get('/payment-scheme', [UangKuliahController::class, 'showScheme']);
    Route::post('/payment-scheme', [UangKuliahController::class, 'saveScheme']);
    Route::get('/dispensasi', [DispensationController::class, 'index']);
    Route::post('/dispensasi', [DispensationController::class, 'store']);
    Route::post('/dispensasi/{id}/approve', [DispensationController::class, 'approve']);
    Route::post('/dispensasi/{id}/reject', [DispensationController::class, 'reject']);
});
```

## Daftar Endpoint

| Method | Route | Middleware | Fungsi |
|--------|-------|-----------|--------|
| GET | `/uang-kuliah` | - | Lihat daftar tagihan dan pembayaran mahasiswa |
| GET | `/uang-kuliah/menu` | - | Halaman menu utama uang kuliah |
| GET | `/uang-kuliah/payment-scheme` | - | Tampilkan pilihan skema pembayaran |
| POST | `/uang-kuliah/payment-scheme` | - | Simpan/ubah pilihan skema pembayaran |
| GET | `/uang-kuliah/dispensasi` | - | Form pengajuan dan riwayat dispensasi |
| POST | `/uang-kuliah/dispensasi` | - | Simpan pengajuan dispensasi baru |
| POST | `/uang-kuliah/dispensasi/{id}/approve` | - | Setujui pengajuan dispensasi |
| POST | `/uang-kuliah/dispensasi/{id}/reject` | - | Tolak pengajuan dispensasi |

---
## Penjelasan Setiap Method/Function

### 1. **menu()** - GET /uang-kuliah/menu

**Fungsi:** Menampilkan halaman menu utama uang kuliah.

**Endpoint:** `GET /uang-kuliah/menu`

**Middleware:** Tidak ada (Public, Admin mengirimkan `student_id` via parameter)

**Response:** HTML view `uangkuliah.menu`

**Code:**

```php
public function menu(){
    return view('uangkuliah.menu');
}
```

---

### 2. **index()** - GET /uang-kuliah

**Fungsi:** Menampilkan daftar semua tagihan mahasiswa berserta rincian denda keterlambatan jika ada.

**Endpoint:** `GET /uang-kuliah`

**Middleware:** Tidak ada (Controller mendeteksi user aktif atau via parameter `student_id`)

**Response:** HTML view `uangkuliah.uangkuliah` dengan data `bills` dan `student`.

**Code:**

```php
public function index(Request $request){
    if(auth()->guard('student')->check()){
        $student = auth()->guard('student')->user();
    }else{
        $student = Student::where('student_id', $request->student_id)->firstOrFail();
    }
    $bills = Bill::where('student_id', $student->id)->with('payments')->get();
    $bills->each(function($bill){
        $bill->terlambat = $bill->hitungDenda(Carbon::today()->toDateString()) > 0;
    });
    return view('uangkuliah.uangkuliah', compact('bills','student'));
}
```

---

### 3. **showScheme()** - GET /uang-kuliah/payment-scheme

**Fungsi:** Menampilkan form informasi skema pembayaran mahasiswa (Full/Installment).

**Endpoint:** `GET /uang-kuliah/payment-scheme`

**Middleware:** Tidak ada 

**Response:** HTML view `uangkuliah.payment_scheme`

**Code:**

```php
public function showScheme(Request $request){
    if(auth()->guard('student')->check()){
        $student = auth()->guard('student')->user();
    }else{
        $student = Student::where('student_id', $request->student_id)->firstOrFail();
    }
    $scheme = PaymentScheme::where('student_id', $student->id)->first();
    return view('uangkuliah.payment_scheme', compact('scheme', 'student'));
}
```

---

### 4. **saveScheme()** - POST /uang-kuliah/payment-scheme

**Fungsi:** Menyimpan skema pembayaran mahasiswa. Mengganti skema akan menghapus tagihan "Belum Lunas" dan membuat rincian tagihan yang baru.

**Endpoint:** `POST /uang-kuliah/payment-scheme`

**Middleware:** Pengecekan manual `auth()->guard('student')->check()` (Hanya mahasiswa)

**Request Fields:**
- `scheme` (required, in: "FULL" atau "INSTALLMENT")

**Response:** Redirect kembali ke halaman `/uang-kuliah` atau dengan parameter `student_id`.

**Code:**

```php
public function saveScheme(Request $request){
    if(!auth()->guard('student')->check()){
        abort(403);
    }
    if(auth()->guard('student')->check()){
        $student = auth()->guard('student')->user();
        $hasPayment = Bill::where('student_id', $student->id)->whereHas('payments')->exists();
        if($hasPayment){
            return back()->with('error', 'Skema pembayaran tidak dapat diubah karena sudah terdapat pembayaran.');
        }
    }else{
        $student = Student::where('student_id', $request->student_id)->firstOrFail();
    }
    PaymentScheme::updateOrCreate(
        ['student_id' => $student->id],
        ['scheme_type' => $request->scheme]
    );
    
    $billIds = Bill::where('student_id', $student->id)->pluck('id');
    Dispensation::whereIn('bill_id', $billIds)->delete();
    Bill::where('student_id', $student->id)->where('status', 'Belum Lunas')->delete();

    $bppBase = 9000000;
    $sksBase = 8000000;

    if ($request->scheme == 'FULL') {
        $this->createNewBill($student->id, 'BPP - Full Payment', $bppBase, 30);
        $this->createNewBill($student->id, 'SKS - Full Payment', $sksBase, 90);
    }

    if ($request->scheme == 'INSTALLMENT') {
        $bppTotalTermin = $bppBase + ($bppBase * 0.025);
        $this->createNewBill($student->id, 'BPP - Termin 1', $bppTotalTermin * 0.60, 30);
        $this->createNewBill($student->id, 'BPP - Termin 2', $bppTotalTermin * 0.40, 60);

        $sksTotalTermin = $sksBase + ($sksBase * 0.025);
        $this->createNewBill($student->id, 'SKS - Termin 1', $sksTotalTermin * 0.60, 90);
        $this->createNewBill($student->id, 'SKS - Termin 2', $sksTotalTermin * 0.40, 120);
    }

    if(auth()->guard('student')->check()){
        return redirect('/uang-kuliah');
    }

    return redirect('/uang-kuliah?student_id=' . $request->student_id);
}
```

**Helper Function - createNewBill():**

```php
private function createNewBill($studentId, $jenisTagihan, $total, $daysToDeadline) {
    $semester = 2;
    $virtualAccount = '18888' . $studentId . '0' . $semester;
    Bill::create([
        'student_id'      => $studentId,
        'jenis'           => $jenisTagihan,
        'virtual_account' => $virtualAccount,
        'deadline'        => now()->addDays($daysToDeadline),
        'semester'        => $semester,
        'total_tagihan'   => $total,
        'status'          => 'Belum Lunas'
    ]);
}
```

---

### 5. **index() (Dispensasi)** - GET /uang-kuliah/dispensasi

**Fungsi:** Menampilkan riwayat dispensasi dan form pengajuan dispensasi baru (berdasarkan tagihan yang belum lunas).

**Endpoint:** `GET /uang-kuliah/dispensasi`

**Middleware:** Tidak ada

**Response:** HTML view `uangkuliah.dispensasi`

**Code:**

```php
public function index(Request $request){
    if(auth()->guard('student')->check()){
        $student = auth()->guard('student')->user();
    }else{
        $student = Student::where('student_id',$request->student_id)->firstOrFail();
    }
    $bills = Bill::where('student_id',$student->id)->where('status','Belum Lunas')->get();
    $dispensations = Dispensation::where('student_id',$student->id)->whereHas('bill')->latest()->get();

    return view('uangkuliah.dispensasi',compact('student','bills','dispensations'));
}
```

---

### 6. **store() (Dispensasi)** - POST /uang-kuliah/dispensasi

**Fungsi:** Mahasiswa mengajukan dispensasi perpanjangan hari pembayaran untuk suatu tagihan.

**Endpoint:** `POST /uang-kuliah/dispensasi`

**Middleware:** Pengecekan manual `auth()->guard('student')->check()` (Hanya mahasiswa)

**Request Fields:**
- `bill_id` (required, exists:bills,id)
- `extension_days` (required, integer, min 1)
- `reason` (required, string)

**Response:** Redirect kembali (`back()`)

**Code:**

```php
public function store(Request $request){

    if(!auth()->guard('student')->check()){
        abort(403);
    }

    $request->validate([
        'bill_id' => 'required|exists:bills,id',
        'extension_days' => 'required|integer|min:1',
        'reason' => 'required|string',
    ]);
    
    $student = auth()->guard('student')->user();

    Dispensation::create([
        'student_id' => $student->id,
        'bill_id' => $request->bill_id,
        'reason' => $request->reason,
        'extension_days' => $request->extension_days,
        'status' => 'Pending'
    ]);

    return back();
}
```

---

### 7. **approve()** - POST /uang-kuliah/dispensasi/{id}/approve

**Fungsi:** Admin menyetujui pengajuan dispensasi. Akan otomatis menambah hari deadline pada `Bill` terkait.

**Endpoint:** `POST /uang-kuliah/dispensasi/{id}/approve`

**Middleware:** Otorisasi manual (Hanya Admin, abort jika mahasiswa)

**URL Parameters:**
- `id` (int, required)

**Response:** Redirect kembali (`back()`)

**Code:**

```php
public function approve($id){
    if(auth()->guard('student')->check()){
        abort(403);
    }
    $dispensation = Dispensation::findOrFail($id);
    $dispensation->update(['status' => 'Approved']);

    $bill = $dispensation->bill;
    $bill->deadline =Carbon::parse($bill->deadline)->addDays($dispensation->extension_days);
    $bill->save();

    return back();
}
```

---

### 8. **reject()** - POST /uang-kuliah/dispensasi/{id}/reject

**Fungsi:** Admin menolak pengajuan dispensasi.

**Endpoint:** `POST /uang-kuliah/dispensasi/{id}/reject`

**Middleware:** Otorisasi manual (Hanya Admin, abort jika mahasiswa)

**URL Parameters:**
- `id` (int, required)

**Response:** Redirect kembali (`back()`)

**Code:**

```php
public function reject($id){
    if(auth()->guard('student')->check()){
        abort(403);
    }
    $dispensation = Dispensation::findOrFail($id);
    $dispensation->update(['status' => 'Rejected']);

    return back();
}
```

---

## Model - Uang Kuliah & Dispensasi

**Model `Bill`**
```php
namespace App\Models;

class Bill extends Model
{
    protected $fillable = ['student_id','semester','jenis','virtual_account','deadline','total_tagihan','status'];
}
```

**Model `Dispensation`**
```php
namespace App\Models;

class Dispensation extends Model
{
    protected $fillable = ['student_id','bill_id','reason','status','extension_days'];
}
```

**Model `PaymentScheme`**
```php
namespace App\Models;

class PaymentScheme extends Model
{
    protected $fillable = ['student_id','scheme_type'];
}
```

---

## NOTE

1. **Dual Guard Authentication:** Endpoint menggunakan pendekatan otorisasi di dalam *Controller* (`auth()->guard('student')` vs `auth()`). Jika bukan mahasiswa, sistem mengharuskan adanya input/parameter `student_id`.
2. **Perhitungan Denda:** Tagihan otomatis dihitung keterlambatannya (3% per bulan) jika melewati `deadline` menggunakan fungsi `hitungDenda` pada model `Bill`.
3. **Validasi Perubahan Skema:** Mahasiswa tidak bisa sembarangan mengubah skema (dari FULL ke INSTALLMENT atau sebaliknya) jika **sudah ada pembayaran masuk** pada salah satu tagihan.
4. **Otomatisasi Dispensasi:** Ketika dispensasi di-Approve oleh Admin, kolom `deadline` pada tabel `bills` akan otomatis diperpanjang sesuai dengan field `extension_days`.
5. **View Management:** Semua *response html* dilokalisasi di dalam direktori `resources/views/uangkuliah/`.