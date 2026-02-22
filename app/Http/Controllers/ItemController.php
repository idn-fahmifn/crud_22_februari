<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
            'kondisi' => ['required', 'in:good,broke, maintenance'],
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
            $nama = 'item_image_' . Carbon::now('Asia/jakarta')->format('Ymdhis').'.'.$gambar->getClientOriginalExtension();

            // nama yang dikirim ke database
            $save['image'] = $nama;
        }

        return $save;

        // Room::create($save);

        // return redirect()->route('room.index')
        //     ->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function show($parameter)
    {
        $data = Room::where('uuid', $parameter)->withCount('item')->firstOrFail();
        // ada barang apa saja di ruangan yang kita pilih
        $items = Item::where('uuid', $parameter)->get();
        return view('room.show', compact('data', 'items'));
    }

    public function update(Request $request, $parameter)
    {
        $data = Room::where('uuid', $parameter)->firstOrFail();
        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:20'],
            'size' => ['required', 'in:small,medium,large'],
        ]);

        // array data untuk disimpan : 
        $save = [
            'room_name' => $request->input('name'),
            'size' => $request->input('size'),
            'uuid' => Str::orderedUuid()
        ];

        $data->update($save);

        return redirect()->route('room.show', $data->uuid)
            ->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function delete($parameter)
    {
        $data = Room::where('uuid', $parameter);
        $data->delete();
        return redirect()->route('room.index')
            ->with('success', 'Ruangan berhasil ditambahkan');
    }
}
