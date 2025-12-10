<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Booking & Pendapatan</title>
    <style>
        body { font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; font-size: 12px; }
        h1, h2, h3 { margin: 0 0 10px 0; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mb-1 { margin-bottom: 4px; }
        .mb-2 { margin-bottom: 8px; }
        .mb-3 { margin-bottom: 12px; }
        .mb-4 { margin-bottom: 16px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        th, td { border: 1px solid #ccc; padding: 4px 6px; }
        th { background: #f3f4f6; }
        .small { font-size: 11px; }
    </style>
</head>
<body onload="window.print()">
    <h1 class="text-center mb-2">Laporan Booking & Pendapatan</h1>

    <div class="mb-3 small">
        <div><strong>Periode:</strong>
            @if($filters['start_date'] || $filters['end_date'])
                {{ $filters['start_date'] ? \Carbon\Carbon::parse($filters['start_date'])->format('d/m/Y') : '...' }}
                -
                {{ $filters['end_date'] ? \Carbon\Carbon::parse($filters['end_date'])->format('d/m/Y') : '...' }}
            @else
                Semua tanggal
            @endif
        </div>
        <div><strong>Tanggal cetak:</strong> {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <h3 class="mb-2">Ringkasan Pendapatan</h3>
    <table>
        <tr>
            <th class="text-right">Total Booking</th>
            <th class="text-right">Total Pendapatan (Dikonfirmasi)</th>
        </tr>
        <tr>
            <td class="text-right">{{ $bookings->count() }}</td>
            <td class="text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
        </tr>
    </table>

    <h3 class="mb-2">Detail Booking</h3>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tgl Kunjungan</th>
                <th>Destinasi</th>
                <th>Pengguna</th>
                <th class="text-right">Orang</th>
                <th class="text-right">Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->booking_code_232136 }}</td>
                    <td>{{ optional($booking->visit_date_232136)->format('d/m/Y') }}</td>
                    <td>{{ $booking->destination->name_232136 ?? '-' }}</td>
                    <td>{{ $booking->user->name_232136 ?? '-' }}</td>
                    <td class="text-right">{{ $booking->number_of_people_232136 }}</td>
                    <td class="text-right">Rp {{ number_format($booking->total_price_232136, 0, ',', '.') }}</td>
                    <td>{{ $booking->getStatusText() }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="small">Catatan: Untuk menyimpan sebagai PDF, gunakan fitur "Print" di browser lalu pilih "Save as PDF".</p>
</body>
</html>
