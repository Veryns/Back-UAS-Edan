<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Matkul;

    class MatkulController extends Controller
    {

        public function index()
        {
            $matkuls = Matkul::all();
            return view('matkul.index', compact('matkuls'));
        }

        public function create()
        {
            return view('matkul.create');
        }

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
                'nama', 'kodematkul', 'sks', 'deskripsi', 'dosen', 'kodemsteam'));
            return redirect()->route('matkul.index');
        }

        public function show($id)
        {
            $matkul = Matkul::findOrFail($id);
            return view('matkul.show', compact('matkul'));
        }

        public function edit($id)
        {
            $matkul = Matkul::findOrFail($id);
            return view('matkul.edit', compact('matkul'));
        }

        public function update(Request $request, $id)
        {
            $matkul = Matkul::findOrFail($id);
            $matkul->update($request->only(
                'nama', 'kodematkul', 'sks', 'deskripsi', 'dosen', 'kodemsteam'
            ));
            return redirect()->route('matkul.index');
        }

        public function destroy($id)
        {
            Matkul::findOrFail($id)->delete();
            return redirect()->route('matkul.index');
        }
    }
?>