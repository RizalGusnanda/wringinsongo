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
        $headings = [
            'Nama Wisata',
            'Harga Tiket',
            'Total Tiket',
            'Total Pendapatan'
        ];

        $year = Carbon::now()->year;
        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::createFromDate($year, $i, 1)->translatedFormat('F Y');
            $headings[] = "Pendapatan {$month}";
        }

        return $headings;
    }

    public function map($tour): array
    {
        $pendapatanPerBulan = array_fill(1, 12, 0);

        foreach ($tour->carts as $cart) {
            $bulan = Carbon::parse($cart->created_at)->month;
            $tahun = Carbon::parse($cart->created_at)->year;
            if ($tahun == Carbon::now()->year) { 
                $pendapatanPerBulan[$bulan] += $cart->total_price;
            }
        }

        $data = [
            $tour->name,
            'Rp. ' . number_format($tour->harga_tiket, 0, ',', '.'),
            $tour->carts->sum('total_tickets'),
            'Rp. ' . number_format($tour->carts->sum('total_pendapatan'), 0, ',', '.')
        ];

        foreach ($pendapatanPerBulan as $pendapatan) {
            $data[] = 'Rp. ' . number_format($pendapatan, 0, ',', '.');
        }

        return $data;
    }


    public function columnFormats(): array
    {
        $formats = [
            'B' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'D' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];

        for ($i = 'E'; $i <= 'P'; $i++) {
            $formats[$i] = NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE;
        }

        return $formats;
    }
}
