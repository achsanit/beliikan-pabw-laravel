@component('mail::message')
# Transaksi Berhasil

## Terima kasih...

Hallo, <br>
pesanan anda telah berhasil, berikut detailnya:<br>

## Detail Transaksi<br>
No. Invoice : <br>
Produk :  <br>
Jumlah :  <br>
Alamat Pengiriman : <br>
Total Harga : Rp <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
