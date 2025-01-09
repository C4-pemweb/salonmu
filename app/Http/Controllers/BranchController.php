<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Service;
use Illuminate\Support\Str;

class BranchController extends Controller
{
    public function getServices(Branch $branch)
     {
         return response()->json($branch->services);
     }

    public function index()
    {
        $branchCount = Branch::count();

    // Ambil jumlah layanan di semua cabang
        $serviceCount = Service::count();
        
        $data = Branch::withCount('services')->paginate(10);
    
        return view('admin.branch', compact('data','branchCount', 'serviceCount'));
    }
    /**
     * Menampilkan form untuk menambahkan branch.
     */
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('branch');
    }

    /**
     * Menyimpan branch baru ke database.
     */
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        Branch::create([
            'name' => $request->name,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string'
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update([
            'name' => $request->name,
            'province' => $request->province,
            'city' => $request->city,
            'address' => $request->address,
        ]);
        
        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Branch::findOrFail($id);
        $mahasiswa->delete();
        
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
