<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Daftar seluruh produk (bisa dicari & difilter kategori).
     */
    public function index(Request $request)
    {
        $query = Produk::query();

        if ($request->filled('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $produks = $query->orderBy('nama_produk')->paginate(10)->withQueryString();

        $kategoris = Produk::select('kategori')->distinct()->whereNotNull('kategori')->pluck('kategori');

        return view('admin.products.index', compact('produks', 'kategoris'));
    }

    /**
     * Form tambah produk baru.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Simpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $data = $this->validateProduk($request);

        $data['id_produk'] = $this->generateNextId();
        $data['terjual'] = $data['terjual'] ?? 0;

        if ($request->hasFile('foto_produk')) {
            $data['foto_produk'] = $this->uploadFoto($request->file('foto_produk'));
        }

        Produk::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Form edit produk (ubah nama, kategori, harga, stok, deskripsi, foto).
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        return view('admin.products.edit', compact('produk'));
    }

    /**
     * Update data produk, termasuk mengganti foto & stok.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $data = $this->validateProduk($request);
        $data['terjual'] = $data['terjual'] ?? $produk->terjual;

        if ($request->hasFile('foto_produk')) {
            $this->deleteFoto($produk->foto_produk);
            $data['foto_produk'] = $this->uploadFoto($request->file('foto_produk'));
        }

        $produk->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk beserta foto yang tersimpan di server.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $this->deleteFoto($produk->foto_produk);
        $produk->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Validasi input form produk.
     */
    private function validateProduk(Request $request): array
    {
        return $request->validate([
            'nama_produk' => 'required|string|max:150',
            'kategori' => 'nullable|string|max:255',
            'harga_produk' => 'required|numeric|min:0',
            'stok_produk' => 'required|integer|min:0',
            'terjual' => 'nullable|integer|min:0',
            'desk_produk' => 'nullable|string',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }

    /**
     * Buat id_produk baru berformat PRDxxx berdasarkan id terakhir.
     */
    private function generateNextId(): string
    {
        $lastId = Produk::orderByDesc('id_produk')->value('id_produk');
        $nextNumber = $lastId ? ((int) substr($lastId, 3)) + 1 : 1;

        return 'PRD' . str_pad((string) $nextNumber, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Simpan file foto produk ke public/images/products (mengikuti pola yang sudah ada).
     */
    private function uploadFoto($file): string
    {
        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('images/products'), $filename);

        return 'images/products/' . $filename;
    }

    /**
     * Hapus file foto lama dari server (kalau ada & memang ada di folder produk).
     */
    private function deleteFoto(?string $path): void
    {
        if ($path && str_starts_with($path, 'images/products/') && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}
