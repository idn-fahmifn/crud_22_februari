<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index()
    {
        $data = Item::paginate(10);
        $room = Room::all();
        return view('item.index', compact('data', 'room'));
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:20'],
            'category' => ['required', 'in:elektronik,kendaraan,rumah tangga, lainnya'],
            'lokasi' => ['required', 'integer', 'exists:rooms,id'],
            'kondisi' => ['required', 'in:good,broke,maintenance'],
            'stok' => ['required', 'integer', 'min:0', 'max:999'],
            'image' => ['required', 'file', 'max:10240', 'mimes:png,jpg,webp,svg'],

        ]);

        // array data untuk disimpan : 
        $save = [
            'item_name' => $request->input('name'),
            'room_id' => $request->input('lokasi'),
            'category' => $request->input('category'),
            'condition' => $request->input('kondisi'),
            'stok' => $request->input('stok'),
            'uuid' => Str::orderedUuid()
        ];

        if ($request->hasFile('image')) {
            $gambar = $request->file('image');
            $path = 'public/images/items';
            $nama = 'item_image_' . Carbon::now('Asia/jakarta')
                ->format('Ymdhis') . '.' . $gambar
                    ->getClientOriginalExtension();
            // nama yang dikirim ke database
            $save['image'] = $nama;

            // simpan ke storage : 
            $gambar->storeAs($path, $nama);
        }

        // return $save;

        Item::create($save);

        return redirect()->route('item.index')
            ->with('success', 'Barang berhasil ditambahkan');
    }

    public function show($parameter)
    {
        $data = Item::where('uuid', $parameter)->firstOrFail();
        $room = Room::all();
        return view('item.show', compact('data', 'room'));
    }

    public function update(Request $request, $parameter)
    {
        $data = Item::where('uuid', $parameter)->firstOrFail();

        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:20'],
            'category' => ['required', 'in:elektronik,kendaraan,rumah tangga, lainnya'],
            'lokasi' => ['required', 'integer', 'exists:rooms,id'],
            'kondisi' => ['required', 'in:good,broke,maintenance'],
            'stok' => ['required', 'integer', 'min:0', 'max:999'],
            'image' => ['file', 'max:10240', 'mimes:png,jpg,webp,svg'],

        ]);

        // array data untuk disimpan : 
        $save = [
            'item_name' => $request->input('name'),
            'room_id' => $request->input('lokasi'),
            'category' => $request->input('category'),
            'condition' => $request->input('kondisi'),
            'stok' => $request->input('stok'),
            'uuid' => Str::orderedUuid()
        ];

        if ($request->hasFile('image')) {


            // cek data gambar lama masih tersedia 
            $path_lama = 'public/images/items/' . $data->image;

            if ($data->image && Storage::exists($path_lama)) {
                Storage::delete($path_lama);
            }

            $gambar = $request->file('image');
            $path = 'public/images/items';
            $nama = 'item_image_' . Carbon::now('Asia/jakarta')
                ->format('Ymdhis') . '.' . $gambar
                    ->getClientOriginalExtension();
            // nama yang dikirim ke database
            $save['image'] = $nama;

            // simpan ke storage : 
            $gambar->storeAs($path, $nama);
        }

        $data->update($save);

        return redirect()->route('item.show', $data->uuid)
            ->with('success', 'Barang berhasil diubah');
    }

    public function delete($parameter)
    {
        $data = Item::where('uuid', $parameter)->firstOrFail();
        
        $path_lama = 'public/images/items/' . $data->image;

            if ($data->image && Storage::exists($path_lama)) {
                Storage::delete($path_lama);
            }
        $data->delete();
        return redirect()->route('item.index')
            ->with('success', 'Barang berhasil dihapus');
    }
}
