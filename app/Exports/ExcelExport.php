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
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Font;


class ExcelExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $kegiatans = Kegiatan::with('detailkegiatans')->orderBy('tanggal', 'ASC')->get();

        return $kegiatans->map(function ($kegiatan) {
            $tanggal = $kegiatan->tanggal; // Mengambil tanggal dalam format 'Y-m-d'
            $tanggal = Carbon::parse($tanggal)->locale('id')->isoFormat('dddd, DD MMMM YYYY');

            $hasil = $kegiatan->detailkegiatans->map(function ($detailKegiatan) {
                return $detailKegiatan->hasil; // Mengambil data 'hasil' dari model DetailKegiatan
            })->implode(', ');

            $Kegiatans = $kegiatan->detailkegiatans->map(function ($detailKegiatan) {
                return $detailKegiatan->kegiatan; // Mengambil data 'hasil' dari model DetailKegiatan
            })->implode(', ');

            return [
                'HARI/TANGGAL' => $tanggal,
                'RINCIAN KEGIATAN' => $Kegiatans,
                'HASIL' => $hasil,
            ];
        });
    }


    public function headings(): array
    {
        return [
            // 'NO',
            'HARI/TANGGAL',
            'RINCIAN KEGIATAN',
            'HASIL',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER, // Menengahkan teks di tengah kolom
                ],
                'font' => [
                    'name' => 'Bookman Old Style', // Menggunakan font Bookman Old Style
                ],
            ],
        ];
    }


    // public function styles(Worksheet $sheet)
    // {
    //     return [
    //         1 => ['font' => ['bold' => true]], // Menerapkan gaya bold pada baris pertama (judul kolom)
    //     ];
    // }

    public function columnFormats(): array
    {
        return [
            'B' => '@', // Mengatur format kolom B sebagai teks (opsional)
        ];
    }

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function (AfterSheet $event) {
    //             $event->sheet->setCellValue('c' . ($event->sheet->getHighestRow() + 2), '(           )'); // Menambahkan tanda tangan pada kolom D di baris terakhir
    //             $event->sheet->setCellValue('c' . ($event->sheet->getHighestRow() + 1), 'Tanda Tangan'); // Menambahkan tanda tangan pada kolom D di baris terakhir
    //         },
    //     ];
    // }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $highestColumn = $event->sheet->getHighestColumn();
                $range = 'A1:' . $highestColumn . $highestRow;

                $event->sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                    'font' => [
                        'name' => 'Bookman Old Style',
                    ],
                ]);

                // $event->sheet->getStartRow($highestRow . ($highestRow + 1), 'LAPORAN KINERJA TENAGA PENDUKUNG / TENAGA AHLI');

                $currentDate = Carbon::now()->locale('id')->format('d F Y');
                $currentDate = $this->replaceMonthInIndonesian($currentDate);
                $event->sheet->getStyle($highestColumn . ($highestRow + 2))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue($highestColumn . ($highestRow + 2), 'MEDAN, ' . $currentDate);

                $event->sheet->getStyle($highestColumn . ($highestRow + 4))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue($highestColumn . ($highestRow + 4), 'Diketahui');

                $event->sheet->getStyle($highestColumn . ($highestRow + 5))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue($highestColumn . ($highestRow + 5), 'Kepala Bidang APTIKA');

                $event->sheet->getStyle($highestColumn . ($highestRow + 10))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue($highestColumn . ($highestRow + 10), 'Rismawati, ST. M.Si');

                $event->sheet->getStyle($highestColumn . ($highestRow + 11))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue($highestColumn . ($highestRow + 11), 'Penata TK I');

                $event->sheet->getStyle($highestColumn . ($highestRow + 12))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue($highestColumn . ($highestRow + 12), 'NIP. 19720303 199803 2 006');
            },
        ];
    }

    private function replaceMonthInIndonesian(string $date): string
    {
        $monthNames = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        foreach ($monthNames as $englishMonth => $indonesianMonth) {
            $date = str_replace($englishMonth, $indonesianMonth, $date);
        }

        return $date;
    }
}
