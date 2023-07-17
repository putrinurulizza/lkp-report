<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExcelExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $kegiatans = Kegiatan::with('detailkegiatans')->get();

        return $kegiatans->map(function ($kegiatan) {
            $tanggal = $kegiatan->tanggal; // Mengambil tanggal dalam format 'Y-m-d'

            $hasil = $kegiatan->detailkegiatans->map(function ($detailKegiatan) {
                return $detailKegiatan->hasil; // Mengambil data 'hasil' dari model DetailKegiatan
            })->implode(', ');

            $Kegiatans = $kegiatan->detailkegiatans->map(function ($detailKegiatan) {
                return $detailKegiatan->kegiatan; // Mengambil data 'hasil' dari model DetailKegiatan
            })->implode(', ');

            return [
                'tanggal' => $tanggal,
                'kegiatan' => $Kegiatans,
                'hasil' => $hasil,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'tanggal',
            'kegiatan',
            'hasil',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Menerapkan gaya bold pada baris pertama (judul kolom)
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => '@', // Mengatur format kolom B sebagai teks (opsional)
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->setCellValue('c' . ($event->sheet->getHighestRow() + 2), '(           )'); // Menambahkan tanda tangan pada kolom D di baris terakhir
                $event->sheet->setCellValue('c' . ($event->sheet->getHighestRow() + 1), 'Tanda Tangan'); // Menambahkan tanda tangan pada kolom D di baris terakhir
            },
        ];
    }
}
