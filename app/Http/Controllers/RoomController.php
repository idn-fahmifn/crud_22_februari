<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $data = Room::withCount('item')->paginate(10);
        return view('room.index', compact('data'));
    }

    public function store(Request $request)
    {
        // Validasi
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

        Room::create($save);

        return redirect()->route('room.index')
            ->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function show($parameter)
    {
        $data = Room::where('uuid', $parameter)->withCount('item')->firstOrFail();
        // ada barang apa saja di ruangan yang kita pilih
        $items = Item::where('room_id', $data->id)->get();
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
