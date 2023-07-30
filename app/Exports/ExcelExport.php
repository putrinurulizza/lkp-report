<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Kegiatan;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class ExcelExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $targetYear = Carbon::now()->format('Y');
        $targetMonth = Carbon::now()->format('m');
        $kegiatans = Kegiatan::with(['detailkegiatans', 'users'])->whereYear('tanggal', $targetYear)->whereMonth('tanggal', $targetMonth)->where('id_user', auth()->user()->id)->orderBy('tanggal', 'ASC')->get();

        return $kegiatans->map(function ($kegiatan, $index) {
            $tanggal = $kegiatan->tanggal; // Mengambil tanggal dalam format 'Y-m-d'
            $tanggal = Carbon::parse($tanggal)->locale('id')->isoFormat('dddd, DD MMMM YYYY');

            $data = [
                'No' => $index + 1,
                'HARI/TANGGAL' => $tanggal,
                'RINCIAN KEGIATAN' => [],
                'HASIL' => [],
            ];

            $detailNumber = 1;

            foreach ($kegiatan->detailkegiatans as $detailKegiatan) {
                $data['RINCIAN KEGIATAN'][] = $detailNumber . '. ' . $detailKegiatan->kegiatan;
                $data['HASIL'][] = $detailKegiatan->hasil;
                $detailNumber++;
            }

            return $data;
        });
    }


    public function headings(): array
    {
        $title = 'YOUR TITLE HERE';
        return [
            $title,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $range = 'A1:' . $highestColumn . $highestRow;

        return [
            $range => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER, // Menengahkan teks di tengah kolom
                ],
                'font' => [
                    'name' => 'Bookman Old Style', // Menggunakan font Bookman Old Style
                ],
            ],
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => '@', // Mengatur format kolom B sebagai teks (opsional)
        ];
    }

    public function registerEvents(): array
    {

        return [
            AfterSheet::class => function (AfterSheet $event) {
                $user = auth()->user()->nama;
                $jabatan = auth()->user()->jabatan;
                $bidang = auth()->user()->bidang;

                // title
                $event->sheet->mergeCells('A1:D1');
                $event->sheet->mergeCells('A2:D2');
                $event->sheet->mergeCells('A3:D3');
                $event->sheet->mergeCells('A5:B5');
                $event->sheet->mergeCells('A6:B6');
                $event->sheet->mergeCells('C5:D6');

                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $currentMonth = Carbon::now()->locale('id')->format('F');
                $currentMonth = $this->replaceMonthInIndonesian($currentMonth);
                $currentMonthUpper = strtoupper($currentMonth);
                $currentYear = Carbon::now()->locale('id')->format('Y');
                // Set value for the title (three lines)
                $titleLines = [
                    'LAPORAN KINERJA TENAGA PENDUKUNG / TENAGA AHLI',
                    'DINAS KOMINFO PROVINSI SUMATERA UTARA',
                    'BULAN '. $currentMonthUpper .' TAHUN '. $currentYear,
                ];
                foreach ($titleLines as $index => $titleLine) {
                    $rowIndex = $index + 1;
                    $event->sheet->setCellValue('A' . $rowIndex, $titleLine);
                }

                // header
                // Set value for headers
                $data = $this->collection();
                $event->sheet->setCellValue('A4', ' ' );
                $event->sheet->setCellValue('B4', ' ');
                $event->sheet->setCellValue('D4', ' ');
                $event->sheet->setCellValue('C4', ' ');
                $event->sheet->setCellValue('A5', 'NAMA : ' . $user);
                $event->sheet->setCellValue('A6', 'JABATAN : ' . $jabatan);
                $event->sheet->setCellValue('C5', 'BIDANG :' . $bidang);
                $event->sheet->setCellValue('A7', 'No');
                $event->sheet->setCellValue('B7', 'HARI/TANGGAL');
                $event->sheet->setCellValue('C7', 'RINCIAN KEGIATAN');
                $event->sheet->setCellValue('D7', 'HASIL');

                // Data Kegiatan
                $rowIndex = 8; // Mulai dari baris ke-10 (setelah header)

                foreach ($data as $row) {
                    $event->sheet->setCellValue('A' . $rowIndex, $row['No']);
                    $event->sheet->setCellValue('B' . $rowIndex, $row['HARI/TANGGAL']);

                    // Mengisi data 'RINCIAN KEGIATAN' dan 'HASIL' ke dalam cell
                    $rincianKegiatanCount = count($row['RINCIAN KEGIATAN']);
                    $hasilCount = count($row['HASIL']);
                    $maxCount = max($rincianKegiatanCount, $hasilCount);

                    for ($i = 0; $i < $maxCount; $i++) {
                        $rincian = isset($row['RINCIAN KEGIATAN'][$i]) ? $row['RINCIAN KEGIATAN'][$i] : '';
                        $hasilItem = isset($row['HASIL'][$i]) ? $row['HASIL'][$i] : '';

                        $event->sheet->setCellValue('C' . $rowIndex, $rincian);
                        $event->sheet->setCellValue('D' . $rowIndex, $hasilItem);

                        $rowIndex++;
                    }
                    $rowIndex++;
                }
                // data Kegiatan

                $highestRow = $event->sheet->getHighestRow();
                $highestColumn = $event->sheet->getHighestColumn();
                $range = 'A5:' . $highestColumn . $highestRow;

                $event->sheet->getStyle($range)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('A5:' . $highestColumn . $highestRow)->applyFromArray([
                    'font' => [
                        'name' => 'Bookman Old Style',
                        'size' => 12,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $event->sheet->getStyle('A1:A3')->applyFromArray([
                    'font' => [
                        'name' => 'Bookman Old Style',
                        'size' => 14,
                    ],
                ]);


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

                $event->sheet->getStyle('B' . ($highestRow + 5))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue('B' . ($highestRow + 5), $jabatan);

                $event->sheet->getStyle('B' . ($highestRow + 10))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $event->sheet->setCellValue('B' . ($highestRow + 10), $user);

                // Merge cells for the title
                $highestColumn = $event->sheet->getHighestColumn();
                $event->sheet->mergeCells('A1:' . $highestColumn . '1');

                $event->sheet->getStyle('B' . ($highestRow + 5))->applyFromArray([
                    'font' => [
                        'name' => 'Bookman Old Style',
                        'size' => 12,
                    ],
                ]);

                $event->sheet->getStyle('B' . ($highestRow + 10))->applyFromArray([
                    'font' => [
                        'name' => 'Bookman Old Style',
                        'size' => 12,
                    ],
                ]);

                $event->sheet->getStyle('D' . ($highestRow + 2))->applyFromArray([
                    'font' => [
                        'name' => 'Bookman Old Style',
                        'size' => 12,
                    ],
                ]);

                $event->sheet->getStyle('D' . ($highestRow + 4))->applyFromArray([
                    'font' => [
                        'name' => 'Bookman Old Style',
                        'size' => 12,
                    ],
                ]);

                $event->sheet->getStyle('D' . ($highestRow + 5))->applyFromArray([
                    'font' => [
                        'name' => 'Bookman Old Style',
                        'size' => 12,
                    ],
                ]);

                $event->sheet->getStyle('D' . ($highestRow + 10))->applyFromArray([
                    'font' => [
                        'name' => 'Bookman Old Style',
                        'size' => 12,
                    ],
                ]);

                $event->sheet->getStyle('D' . ($highestRow + 11))->applyFromArray([
                    'font' => [
                        'name' => 'Bookman Old Style',
                        'size' => 12,
                    ],
                ]);

                $event->sheet->getStyle('D' . ($highestRow + 12))->applyFromArray([
                    'font' => [
                        'name' => 'Bookman Old Style',
                        'size' => 12,
                    ],
                ]);


                // // Center-align the title
                // $titleCell = Coordinate::stringFromColumnIndex(1) . '1'; // Cell 'A1'
                // $event->sheet->getStyle($titleCell)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // // Apply style to the title (you can customize this as needed)
                // $event->sheet->getStyle($titleCell)->applyFromArray([
                //     'font' => [
                //         'size' => 14, // Example font size, you can adjust it
                //     ],
                // ]);
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
