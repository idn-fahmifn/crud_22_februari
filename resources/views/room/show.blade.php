<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
                {{ __('Daftar Ruangan') }}
            </h2>
            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-room')"
                class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-200 dark:shadow-none transition-all duration-300 transform hover:scale-105">
                Edit Ruangan
            </button>
        </div>
    </x-slot>

    <div class="py-12 bg-[#F8FAFC] dark:bg-slate-950 min-h-screen transition-colors duration-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="bg-white dark:bg-slate-900 py-8 px-8 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <h4 class="text-lg text-slate-600 dark:text-slate-400 font-bold">Detail Ruangan</h4>
                <span class="text-md text-slate-600 dark:text-slate-400">{{ $data->room_name }}</span>
                <div class="mt-8">
                    <p class="text-md text-slate-600 dark:text-slate-400 font-bold">Nama Ruangan</p>
                    <span class="text-md text-slate-600 dark:text-slate-400 font-sm">{{ $data->room_name }}</span>
                </div>
                <div class="mt-2">
                    <p class="text-md text-slate-600 dark:text-slate-400 font-bold">Total Aset</p>
                    <span class="text-md text-slate-600 dark:text-slate-400 font-sm">{{ $data->item_count }}</span>
                </div>
                <div class="mt-2">
                    <p class="text-md text-slate-600 dark:text-slate-400 font-bold">Kapasitas</p>
                    <span class="text-md text-slate-600 dark:text-slate-400 font-sm">{{ $data->size }}</span>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="text-slate-400 dark:text-slate-500 text-[10px] uppercase tracking-[0.2em] font-black bg-slate-50/50 dark:bg-slate-800/50">
                                <th class="px-8 py-5">Nama Barang</th>
                                <th class="px-8 py-5">Stok</th>
                                <th class="px-8 py-5">Kondisi</th>
                                <th class="px-8 py-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                            @forelse ($items as $item)
                                <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                    <td class="px-8 py-6">
                                        <span class="text-sm text-slate-600 dark:text-slate-400 px-3 py-1 rounded-lg">
                                            {{ $item->item_name }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="text-sm text-slate-600 dark:text-slate-400 px-3 py-1 rounded-lg">
                                            {{ $item->stok }} Barang
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span
                                            class="inline-flex items-center text-[10px] font-black uppercase tracking-widest {{ $item->condition === 'good' ? 'text-emerald-500' : ($item->condition === 'maintenance' ? 'text-amber-500' : 'text-rose-500') }}">
                                            <span
                                                class="w-2 h-2 rounded-full mr-2 animate-pulse {{ $item->condition === 'good' ? 'bg-emerald-500' : ($item->condition === 'maintenance' ? 'bg-amber-500' : 'bg-rose-500') }}"></span>
                                            {{ $item->condition }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <a href="{{ route('room.show', $item->uuid) }}"
                                            class="text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors mx-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                <td class="px-8 py-6 text-slate-600 dark:text-slate-400 text-center" colspan="4">
                                    Data barang tidak ditemukan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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

            <form method="post" action="{{ route('room.update', $data->uuid) }}" class="space-y-6">
                @csrf
                @method('put')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" value="Nama Ruangan" class="dark:text-slate-400" />
                        <x-text-input id="name" name="name" value="{{ $data->room_name }}" type="text"
                            class="mt-1 block w-full dark:bg-slate-800 dark:border-slate-700 rounded-xl"
                            placeholder="Contoh: Ruang IT" />
                    </div>

                    <div>
                        <x-input-label for="size" value="Ukuran" class="dark:text-slate-400" />
                        <select id="size" name="size"
                            class="mt-1 block w-full border-slate-300 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                            <option disabled>Pilih Ukuran</option>
                            <option value="small" @selected($data->size === 'small')>Small</option>
                            <option value="medium @selected($data->size === 'medium')">Medium</option>
                            <option value="large" @selected($data->size === 'large')>Large</option>
                        </select>
                    </div>
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
