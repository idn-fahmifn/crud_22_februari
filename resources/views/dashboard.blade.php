<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#F8FAFC] dark:bg-slate-950 transition-colors duration-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                
                <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 flex items-center hover:shadow-md transition-all">
                    <div class="p-4 rounded-2xl bg-blue-50 dark:bg-blue-900/30 text-blue-500 dark:text-blue-400 mr-5">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Total Barang</p>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ number_format($stats['total_assets']) }}</h3>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-6 rounded-3xl shadow-lg shadow-blue-200 dark:shadow-none text-white hover:opacity-90 transition-opacity">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-blue-100 text-xs font-bold uppercase tracking-widest">Kondisi Baik</p>
                            <h3 class="text-3xl font-black mt-1">{{ number_format($stats['good_condition']) }}</h3>
                        </div>
                        <span class="bg-white/20 p-2 rounded-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </div>
                    <div class="mt-4 flex items-center text-xs text-blue-100">
                        <span class="bg-blue-400/30 px-2 py-1 rounded-md mr-2">92% Efisiensi</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 flex items-center transition-all">
                    <div class="p-4 rounded-2xl bg-rose-50 dark:bg-rose-900/20 text-rose-500 dark:text-rose-400 mr-5">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Perlu Cek</p>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ $stats['needs_repair'] }}</h3>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 flex items-center transition-all">
                    <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 dark:text-emerald-400 mr-5">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">Lokasi</p>
                        <h3 class="text-2xl font-black text-slate-800 dark:text-white">{{ $stats['locations_count'] }} Titik</h3>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
                    <div class="px-8 py-7 border-b border-slate-50 dark:border-slate-800 flex justify-between items-center">
                        <div>
                            <h3 class="font-bold text-slate-800 dark:text-white text-lg">Aktivitas Terbaru</h3>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">Log pergerakan barang terakhir</p>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-slate-400 dark:text-slate-500 text-[10px] uppercase tracking-[0.2em] font-black bg-slate-50/50 dark:bg-slate-800/50">
                                    <th class="px-8 py-4">Informasi Barang</th>
                                    <th class="px-8 py-4">Tujuan / Lokasi</th>
                                    <th class="px-8 py-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                                @foreach($recent_movements as $move)
                                <tr class="group hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 mr-4 group-hover:bg-white dark:group-hover:bg-slate-700 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" /></svg>
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-700 dark:text-slate-200 text-sm">{{ $move->asset->name }}</div>
                                                <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">{{ $move->asset->serial_number }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-sm font-medium text-slate-600 dark:text-slate-400 flex items-center">
                                            <svg class="w-3.5 h-3.5 mr-2 text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                                            {{ $move->new_location }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-wider {{ $move->status === 'Masuk' ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400' : 'bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400' }}">
                                            <span class="w-1.5 h-1.5 rounded-full mr-2 {{ $move->status === 'Masuk' ? 'bg-emerald-500' : 'bg-amber-500' }}"></span>
                                            {{ $move->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-100 dark:border-slate-800 p-8">
                        <h3 class="font-bold text-slate-800 dark:text-white text-lg mb-6 text-center">Analisa Kondisi</h3>
                        <div class="relative flex items-center justify-center">
                            <div class="w-32 h-32 rounded-full border-[12px] border-slate-50 dark:border-slate-800 border-t-blue-500 flex items-center justify-center">
                                <span class="text-2xl font-black text-slate-800 dark:text-white">88%</span>
                            </div>
                        </div>
                        <div class="mt-8 space-y-4">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase">Baik</span>
                                <span class="font-black text-slate-700 dark:text-slate-200">1.102</span>
                            </div>
                            <div class="w-full bg-slate-50 dark:bg-slate-800 rounded-full h-1.5">
                                <div class="bg-blue-500 h-1.5 rounded-full" style="width: 88%"></div>
                            </div>
                            <div class="flex items-center justify-between text-sm mt-4">
                                <span class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase">Rusak</span>
                                <span class="font-black text-slate-700 dark:text-slate-200">146</span>
                            </div>
                            <div class="w-full bg-slate-50 dark:bg-slate-800 rounded-full h-1.5">
                                <div class="bg-rose-400 h-1.5 rounded-full" style="width: 12%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-slate-900 dark:bg-blue-600 rounded-[2rem] p-8 text-white relative overflow-hidden transition-colors">
                        <div class="relative z-10">
                            <h4 class="font-bold text-lg mb-2">Pusat Bantuan</h4>
                            <p class="text-slate-400 dark:text-blue-100 text-xs leading-relaxed mb-4">Laporkan kerusakan aset atau permintaan pemindahan barang secara cepat.</p>
                            <button class="bg-white text-slate-900 dark:text-blue-600 px-5 py-2 rounded-xl text-xs font-black hover:bg-slate-100 transition">Buka Tiket</button>
                        </div>
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 dark:bg-blue-500 rounded-full"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>