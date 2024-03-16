<?php

namespace App\Exports;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExcelExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $transactionReports = Transaction::leftJoin('users', 'transactions.user_id', '=', 'users.id')
                                    ->leftJoin('transaction_details', 'transactions.id', '=', 'transaction_details.transaction_id')
                                    ->leftJoin('history_products', 'transaction_details.history_purchase_id', '=', 'history_products.id')
                                    ->select(
                                        'transactions.*',
                                        'users.name as customerName', 
                                        'transaction_details.unit as purchaseUnit', 
                                        'history_products.brand as productBrand', 
                                        'history_products.name as productName', 
                                        'history_products.price as productPrice'
                                    )
                                    ->get();

            $i = 1;
            foreach($transactionReports as $transactionReport){
                $transactionReport->id = $i;
                $i++;
            }
        return $transactionReports;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Konsumen',
            'Nama Motor',
            'Merek Motor',
            'Harga Motor',
            'Unit Pembelian',
            'Midtrans Transaksi ID',
            'Pendapatan',
            'Tipe Pembayaran',
            'Tanggal Transaksi',
            'Status Penipuan',
            'Biaya Aplikasi',
            'Biaya Administrasi',
            'No. VA',
            'Bank',
            'Masked Card',
            'Tipe Kartu',
            'Kode Pembayaran',
        ];
    }

    public function map($transactionReport): array
    {
        return [
            'No'=> $transactionReport->id,
            'Nama Konsumen'=>ucwords($transactionReport->customerName),
            'Nama Motor'=>ucwords($transactionReport->productName),
            'Merek Motor'=>ucwords($transactionReport->productBrand),
            'Harga Motor'=>'Rp'.number_format($transactionReport->productPrice, 2, ',', '.'),
            'Unit Pembelian'=>$transactionReport->purchaseUnit,
            'Midtrans Transaksi ID'=>$transactionReport->midtrans_transaction_id,
            'Pendapatan'=>'Rp'.number_format($transactionReport->gross_amount, 2, ',', '.'),
            'Tipe Pembayaran'=>$transactionReport->payment_type,
            'Tanggal Transaksi'=>date('d/m/Y h:i', strtotime($transactionReport->transaction_date)),
            'Status Penipuan'=>$transactionReport->fraud_status,
            'Biaya Aplikasi'=>'Rp'.number_format($transactionReport->application_fee, 2, ',', '.'),
            'Biaya Administrasi'=>'Rp'.number_format($transactionReport->administration_fee, 2, ',', '.'),
            'No. VA'=>$transactionReport->va_number,
            'Bank'=>$transactionReport->bank,
            'Masked Card'=>$transactionReport->masked_card,
            'Tipe Kartu'=>$transactionReport->card_type,
            'Kode Pembayaran'=>$transactionReport->payment_code,
        ];
    }
}
