<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Detail Barang') }}
            </h2>
            <div class="">

                <form action="{{ route('item.delete', $data->uuid) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" onclick="return confirm('Yakin hapus data?')"
                        class="bg-gradient-to-r from-red-600 to-orange-600 me-4
                    hover:from-red-700 hover:to-orange-700 text-white px-6 py-2.5 rounded-xl text-sm 
                    font-bold shadow-lg shadow-red-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">Hapus</button>

                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-room')"
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                        Edit Barang
                    </button>

                </form>
            </div>

        </div>
    </x-slot>

    <div class="py-12 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen transition-colors duration-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p class="text-white">
                        {{ $error }}
                    </p>
                @endforeach
            @endif

            <div
                class="bg-white dark:bg-slate-900 py-8 px-8 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <h4 class="text-lg text-slate-600 dark:text-slate-400 font-bold">Detail Barang</h4>
                <span class="text-md text-slate-600 dark:text-slate-400">{{ $data->item_name }}</span>
                <div class="mt-8">
                    <p class="text-md text-slate-600 dark:text-slate-400 font-bold">Nama Barang</p>
                    <span class="text-md text-slate-600 dark:text-slate-400 font-sm">{{ $data->item_name }}</span>
                </div>
                <div class="mt-2">
                    <p class="text-md text-slate-600 dark:text-slate-400 font-bold">Lokasi</p>

                    @if ($data->room_id == null)
                        <span class="text-md text-slate-600 dark:text-slate-400 font-sm">Lokasi tidak ditemukan.</span>
                    @else
                        <span
                            class="text-md text-slate-600 dark:text-slate-400 font-sm">{{ $data->room->room_name }}</span>
                    @endif

                </div>
                <div class="mt-2">
                    <p class="text-md text-slate-600 dark:text-slate-400 font-bold">Stok</p>
                    <span class="text-md text-slate-600 dark:text-slate-400 font-sm">{{ $data->stok }}</span>
                </div>
                <div class="mt-2">
                    <p class="text-md text-slate-600 dark:text-slate-400 font-bold">Kategori</p>
                    <span class="text-md text-slate-600 dark:text-slate-400 font-sm">{{ $data->category }}</span>
                </div>
                <div class="mt-2">
                    <p class="text-md text-slate-600 dark:text-slate-400 font-bold">Kondisi</p>
                    <span class="text-md text-slate-600 dark:text-slate-400 font-sm">{{ $data->condition }}</span>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <div class="p-8">
                        <img src="{{ asset('storage/images/items/' . $data->image) }}" alt="gambar item"
                            class="img-fluid w-3/4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="create-room" :show="false" focusable>
        <div class="p-8 dark:bg-slate-900">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-xl font-black text-slate-800 dark:text-white">
                        Ubah Ruangan
                    </h2>
                    <p class="text-sm text-slate-400 dark:text-slate-500 mt-1">{{ $data->room_name }}</p>
                </div>
                <div class="p-3 rounded-2xl bg-blue-50 dark:bg-blue-900/30 text-blue-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>

            <form method="post" action="{{ route('item.update', $data->uuid) }}" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('put')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" value="Nama Barang" class="dark:text-slate-400" />
                        <x-text-input id="name" name="name" type="text" :value="old('name', $data->item_name)"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl"
                            placeholder="Contoh: Ruang IT" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="size" value="Kategori" class="dark:text-slate-400" />
                        <select id="category" name="category"
                            class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                            <option disabled>Pilih kategori</option>
                            <option value="elektronik" @selected($data->category === 'elektronik')>elektronik</option>
                            <option value="kendaraan" @selected($data->category === 'kendaraan')>kendaraan</option>
                            <option value="rumah tangga" @selected($data->category === 'rumah tangga')>rumah tangga</option>
                            <option value="lainnya">lainnya</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('category')" />
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="lokasi" value="Lokasi" class="dark:text-slate-400" />
                        <select id="lokasi" name="lokasi"
                            class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                            <option disabled>Pilih Lokasi</option>
                            {{-- looping semua data room --}}
                            @foreach ($room as $row)
                                <option value="{{ $row->id }}" @selected(old('room_id', $data->room_id) == $row->id)>{{ $row->room_name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('lokasi')" />
                    </div>
                    <div>
                        <x-input-label for="size" value="Kondisi" class="dark:text-slate-400" />
                        <select id="kondisi" name="kondisi"
                            class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                            <option disabled>Pilih Kondisi</option>
                            <option value="good" @selected($data->condition === 'good')>good</option>
                            <option value="broke" @selected($data->condition === 'broke')>broke</option>
                            <option value="maintenance" @selected($data->condition === 'maintenance')>maintenance</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('size')" />
                    </div>
                </div>

                <div>
                    <x-input-label for="stok" value="Stok Barang" class="dark:text-slate-400" />
                    <x-text-input id="stok" name="stok" type="number" :value="old('stok', $data->stok)"
                        class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl" placeholder="" />
                    <x-input-error class="mt-2" :messages="$errors->get('stok')" />
                </div>

                <div>
                    <x-input-label for="image" value="Gambar Barang" class="dark:text-slate-400" />
                    <x-text-input id="image" name="image" type="file"
                        class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl p-4" />
                    <x-input-error class="mt-2" :messages="$errors->get('image')" />
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition transform active:scale-95">
                        Simpan Ruangan
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>
