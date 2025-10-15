<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportsExport implements FromCollection, WithHeadings, WithStyles, WithCustomStartCell
{
    protected $data;
    protected $title;

    public function __construct($data, $title = 'Report Summary')
    {
        $this->data = $data;
        $this->title = $title;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return array_keys(reset($this->data));
    }

    public function startCell(): string
    {
        return 'A2'; // Start headings from row 2
    }

    public function styles(Worksheet $sheet)
    {
        $columnCount = count($this->headings()); // Get the number of columns
        $lastColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($columnCount); // Convert number to letter

        // Merge the first row across all columns
        $sheet->mergeCells("A1:{$lastColumn}1");
        $sheet->setCellValue('A1', $this->title); // Set the title text

        $rowCount = count($this->data) + 2; // +2 because title and heading rows are added
        $lastRow = $rowCount;
        $secondLastRow = $rowCount - 1;

        return [
            1 => ['font' => ['bold' => true, 'size' => 14], 'alignment' => ['horizontal' => 'center']], // Title row bold & centered
            2 => ['font' => ['bold' => true]], // Headings row bold
            $secondLastRow => ['font' => ['bold' => true]], // Second last row bold
            $lastRow => ['font' => ['bold' => true]], // Last row bold
        ];
    }
}
