<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Http\JsonResponse;
    use App\Models\Matkul;

    class MatkulController extends Controller
    {

        // fungsi untuk GET /Matkul
        public function index(): JsonResponse
        {
            return response()->json(Matkul::all());
        }

        // fungsi untuk GET /Matkul/{id} menggunakan id
        public function show(int $id): JsonResponse
        {
            $matkul = Matkul::find($id);

            // error handling untuk Matkul
            if (!$matkul){
                return response()->json(['message' => 'Mata Kuliah tidak diketahui/didaftarkan.'], 404);
            }

            return response()->json($matkul);
        }

        // fungsi untuk POST Matkul
        public function store(Request $request): JsonResponse
        {
            $request->validate([
                'nama'      => 'required|string|max:255',
                'kodematkul'=> 'required|string|max:50',
                'sks'       => 'required|integer|min:1',
                'deskripsi' => 'nullable|string|max:250',
                'dosen'     => 'required|string|max:255',
                'kodemsteam'=> 'nullable|string|max:100',
            ]);

            $matkul = Matkul::create([
                'nama'      => $request->nama,
                'kodematkul'=> $request->kodematkul,
                'sks'       => $request->sks,
                'deskripsi' => $request->deskripsi,
                'dosen'     => $request->dosen,
                'kodemsteam'=> $request->kodemsteam,
            ]);

            return response()->json($matkul, 201);
        }

        // fungsi untuk PUT Matkul
        public function update(Request $request, int $id): JsonResponse
        {
            $request->validate([
                'nama'      => 'sometimes|string|max:255',
                'kodematkul'=> 'sometimes|string|max:50',
                'sks'       => 'sometimes|integer|min:1',
                'deskripsi' => 'nullable|string|max:250',
                'dosen'     => 'sometimes|string|max:255',
                'kodemsteam'=> 'nullable|string|max:100',
            ]);

            $matkul = Matkul::find($id);

            // error handling PUT
            if (!$matkul){
                return response()->json(['message' => 'Mata Kuliah tidak ada/ tidak ditemukan.'], 404);
            }

            $matkul->update($request->only(
                'nama', 'kodematkul', 'sks', 'deskripsi', 'dosen', 'kodemsteam'
            ));

            return response()->json($matkul);
        }

        // fungsi untuk DELETE Matkul
        public function destroy(int $id): JsonResponse
        {
            $matkul = Matkul::find($id);

            //error handilng DELETE
            if (!$matkul){
                return response()->json(['message' => 'Mata Kuliah tidak ada/ tidak ditemukan.'], 404);
            }

            $matkul->delete();

            return response()->json(['message' => 'Mata Kuliah berhasil dihapus.']);
        }

    }
?>