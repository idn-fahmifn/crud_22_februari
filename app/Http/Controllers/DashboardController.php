<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
         $stats = [
            'total_assets' => Item::count(),
            'good_condition' => Item::where('condition', 'good')->count(),
            'needs_repair' => Item::where('condition', 'maintenance')->count(),
            'locations_count' => Room::count(),
        ];

        // Data Riwayat Pergerakan Dummy (Manual Collection)
        $recent_movements = collect([
            (object)[
                'id' => 1,
                'status' => 'Masuk',
                'new_location' => 'Gudang Utama - Rak A1',
                'created_at' => Carbon::now()->subMinutes(15),
                'asset' => (object)[
                    'name' => 'MacBook Pro M2 2023',
                    'serial_number' => 'APP-MBP-9901'
                ]
            ],
            (object)[
                'id' => 2,
                'status' => 'Keluar',
                'new_location' => 'Ruang Meeting Lt. 2',
                'created_at' => Carbon::now()->subHours(2),
                'asset' => (object)[
                    'name' => 'Proyektor Epson EB-X400',
                    'serial_number' => 'EPS-PRJ-2231'
                ]
            ],
            (object)[
                'id' => 3,
                'status' => 'Masuk',
                'new_location' => 'Laboratorium Komputer',
                'created_at' => Carbon::now()->subDays(1),
                'asset' => (object)[
                    'name' => 'Monitor Dell UltraSharp 24',
                    'serial_number' => 'DEL-MON-5542'
                ]
            ],
            (object)[
                'id' => 4,
                'status' => 'Keluar',
                'new_location' => 'Area Coworking',
                'created_at' => Carbon::now()->subDays(2),
                'asset' => (object)[
                    'name' => 'Ergonomic Chair Herman Miller',
                    'serial_number' => 'HM-CHR-0082'
                ]
            ],
            (object)[
                'id' => 5,
                'status' => 'Masuk',
                'new_location' => 'Studio Kreatif',
                'created_at' => Carbon::now()->subDays(3),
                'asset' => (object)[
                    'name' => 'iPad Pro 12.9 Inch',
                    'serial_number' => 'APP-IPD-1120'
                ]
            ],
        ]);
        return view('dashboard', [
            'stats' => $stats,
            'recent_movements' => $recent_movements,
        ]);
    }
}
