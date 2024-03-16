<?php

namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelSupplierExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $suppliers = Supplier::latest()->get();

        $i = 1;

        foreach ($suppliers as $supplier) {
            $supplier->id = $i;
            $i++;
        }

        return $suppliers;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Supplier',
            'Alamat',
            'Kota',
            'Provinsi',
            'Kode Pos',
            'Telepon',
            'Email',
            'Nomor Rekening',
            'Nama Rekening',
            'Bank',
            'NPWP',
            'Deskripsi'
        ];
    }

    public function map($supplier): array
    {
        return [
            'No'=>$supplier->id,
            'Nama Supplier'=>ucwords($supplier->name),
            'Alamat'=>ucwords($supplier->address),
            'Kota'=>ucwords($supplier->city),
            'Provinsi'=>ucwords($supplier->province),
            'Kode Pos'=>$supplier->postal_code,
            'Telepon'=>"'".$supplier->phone,
            'Email'=>$supplier->email,
            'Nomor Rekening'=>"'". $supplier->account_number,
            'Nama Rekening'=>$supplier->account_name,
            'Bank'=>$supplier->bank,
            'NPWP'=>"'".$supplier->tax_number,
            'Deskripsi'=>$supplier->description   
        ];
    }
}
