<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use DB;

class OrderInformationExport implements FromQuery, WithHeadings, WithStyles
{
    use Exportable;

    /**
    * @return export object
    */
    public function query()
    {
        return DB::table('orders')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->leftjoin('deliveries', 'deliveries.preorder_id', '=', 'orders.id')
            ->leftjoin('trucks', 'trucks.id', '=', 'deliveries.truck_id')
            ->leftjoin('staffs', 'staffs.id', '=', 'trucks.staff_id')
            ->select('customers.name as customer_name', 'customers.customerType', 'orders.city', 'orders.township',
            'orders.address', 'orders.orderType', 'orders.products', 'deliveries.delivery_date',
            'trucks.truck_number', 'staffs.name as staff_name', 'orders.remark')
            ->where('deliveries.status', '=', 'pending')
            ->orderBy('deliveries.truck_id', 'asc')
            ->orderBy('deliveries.delivery_date', 'asc');
    }

    public function headings(): array
    {
        return [
            'Customer Name',
            'customer Type',
            'City',
            'Township',
            'Street',
            'Order Type',
            'Product list',
            'Delivery date',
            'Truck number',
            'Staff name',
            'Remark'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'ffffff'], // Set the desired color (e.g., red)
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '2391f7'], // Set the background color (e.g., yellow)
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'], // Border color (e.g., black)
                ],
            ],
        ]);

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(20);
        $sheet->getColumnDimension('B')->setWidth(15);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(15);
        $sheet->getColumnDimension('G')->setWidth(60);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(12);
        $sheet->getColumnDimension('J')->setWidth(15);
        $sheet->getColumnDimension('K')->setWidth(40);
    }
}
