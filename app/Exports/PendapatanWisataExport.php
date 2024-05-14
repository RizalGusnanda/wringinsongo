<?php

namespace App\Exports;

use App\Models\Tours;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Carbon\Carbon;

class PendapatanWisataExport implements FromCollection, WithHeadings, WithMapping, WithColumnFormatting
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $query = Tours::with(['carts' => function ($query) {
            $query->where('status', 'success')
                ->selectRaw('id_tour, sum(tickets.tickets_count) as total_tickets, sum(total_price) as total_pendapatan')
                ->join('tickets', 'carts.id_ticket', '=', 'tickets.id')
                ->groupBy('id_tour');
        }])->where('type', 'wisata bertiket');

        if ($this->request->has('name') && $this->request->name != '') {
            $query->where('name', 'LIKE', '%' . $this->request->name . '%');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nama Wisata',
            'Harga Tiket',
            'Total Tiket',
            'Total Pendapatan',
            'Pendapatan Per Bulan'
        ];
    }

    public function map($tour): array
    {
        $pendapatanPerBulan = [];
        foreach ($tour->carts as $cart) {
            $bulan = Carbon::parse($cart->created_at)->format('Y-m');
            if (!isset($pendapatanPerBulan[$bulan])) {
                $pendapatanPerBulan[$bulan] = 0;
            }
            $pendapatanPerBulan[$bulan] += $cart->total_price;
        }

        $pendapatanPerBulanString = '';
        foreach ($pendapatanPerBulan as $bulan => $pendapatan) {
            $pendapatanPerBulanString .= "$bulan: Rp. " . number_format($pendapatan, 0, ',', '.') . "\n";
        }

        return [
            $tour->name,
            'Rp. ' . number_format($tour->harga_tiket, 0, ',', '.'),
            $tour->carts->sum('total_tickets'),
            'Rp. ' . number_format($tour->carts->sum('total_pendapatan'), 0, ',', '.'),
            $pendapatanPerBulanString,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'D' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }
}
