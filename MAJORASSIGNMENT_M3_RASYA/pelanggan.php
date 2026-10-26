namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        // Jika data kosong, masukkan data default seperti pada script session asli
        if (Pelanggan::count() === 0) {
            Pelanggan::insert([
                [
                    "nama"    => "Budi Santoso", 
                    "telepon" => "081234567890", 
                    "alamat"  => "Jl. Dago No. 10, Bandung",      
                    "catatan" => "Kemeja putih, jangan pakai pemutih",
                    "created_at" => now(), "updated_at" => now()
                ],
                [
                    "nama"    => "Siti Aminah",  
                    "telepon" => "081298765432", 
                    "alamat"  => "Jl. Braga No. 5, Bandung",       
                    "catatan" => "Bahan sutra, cuci lembut",
                    "created_at" => now(), "updated_at" => now()
                ],
                [
                    "nama"    => "Andi Pratama", 
                    "telepon" => "085711223344", 
                    "alamat"  => "Jl. Cihampelas No. 21, Bandung", 
                    "catatan" => "Jaket kulit, jangan diperas",
                    "created_at" => now(), "updated_at" => now()
                ],
            ]);
        }

        $pelanggan = Pelanggan::all();
        return view('pelanggan', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'telepon' => 'required|string|max:255',
            'alamat'  => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        Pelanggan::create($request->only(['nama', 'telepon', 'alamat', 'catatan']));

        return redirect()->route('pelanggan.index');
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        
        $request->validate([
            "nama_$id"    => 'required|string|max:255',
            "telepon_$id" => 'required|string|max:255',
            "alamat_$id"  => 'nullable|string',
            "catatan_$id" => 'nullable|string',
        ]);

        $pelanggan->update([
            'nama'    => $request->input("nama_$id"),
            'telepon' => $request->input("telepon_$id"),
            'alamat'  => $request->input("alamat_$id"),
            'catatan' => $request->input("catatan_$id"),
        ]);

        return redirect()->route('pelanggan.index');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index');
    }
}