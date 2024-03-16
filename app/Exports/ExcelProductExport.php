<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelProductExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::latest()->get();

        $i = 1;
        foreach ($products as $product) {
            $product->id = $i;
            $i++;
        }

        return $products;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nomor Plat',
            'Tipe',
            'Nomor Mesin',
            'Nomor Rangka',
            'Nama BPKB',
            'Harga Jual',
            'Keterangan'
        ];
    }

    public function map($product): array
    {
        return [
            'No'=>$product->id,
            'Nomor Plat'=>$product->plate_number,
            'Tipe'=>ucwords($product->brand). " " . ucwords($product->name),
            'Nomor Mesin'=>ucwords($product->machine_number),
            'Nomor Rangka'=>$product->frame_number,
            'Nama BPKB'=>$product->bpkb_name,
            'Harga Jual'=>"Rp".number_format($product->price, 2, ',', '.'),
            'Keterangan'=>$product->description
        ];
    }
}
