<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Storage;
use App\Models\Branch;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function getServicesByBranch($branch_id)
    {
        // Ambil data cabang berdasarkan ID
        $branch = Branch::findOrFail($branch_id);

        // Ambil semua layanan yang terkait dengan cabang ini
        $services = Service::where('branch_id', $branch_id)->get();

        // Kirimkan data ke view
        return view('admin.service', compact('branch', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'img_url' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Perbaikan aturan validasi
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);

        // Upload file ke Cloudinary
        $img_url = $request->file('img_url');
        $uploadedimg_url = Cloudinary::upload($img_url->getRealPath())->getSecurePath();

        // Simpan ke database
        $service = Service::create([
            'branch_id' => $validated['branch_id'],
            'name' => $validated['name'],
            'img_url' => $uploadedimg_url, // Gunakan URL dari Cloudinary
            'description' => $validated['description'],
            'price' => $validated['price'],
            'duration' => $validated['duration'],
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
            'img_url' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);

        $service = Service::findOrFail($id);

        // Jika ada gambar baru yang di-upload, upload ke Cloudinary
        if ($request->hasFile('img_url')) {
            // Hapus gambar lama dari Cloudinary
            $oldimg_url = $service->img_url;
            if ($oldimg_url) {
                // Ambil public ID dari URL lama dan hapus gambar
                $publicId = basename(parse_url($oldimg_url, PHP_URL_PATH), '.jpg');
                Cloudinary::destroy($publicId);
            }

            // Upload gambar baru
            $img_url = $request->file('img_url');
            $uploadedimg_url = Cloudinary::upload($img_url->getRealPath());
            $service->img_url = $uploadedimg_url->getSecurePath();
        }

        // Update data lainnya
        $service->branch_id = $validated['branch_id'];
        $service->name = $validated['name'];
        $service->description = $validated['description'];
        $service->price = $validated['price'];
        $service->duration = $validated['duration'];

        $service->save();

        return redirect()->back()->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);

        // Hapus gambar dari Cloudinary
        $oldimg_url = $service->img_url;
        if ($oldimg_url) {
            $publicId = basename(parse_url($oldimg_url, PHP_URL_PATH), '.jpg');
            Cloudinary::destroy($publicId);
        }

        $service->delete();

        return redirect()->back()->with('success', 'Service deleted successfully');
    }
}
