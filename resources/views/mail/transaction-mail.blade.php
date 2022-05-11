@component('mail::message')
# Transaksi Berhasil
## Terima kasih...

Hallo, {{ $username }}<br>
pesanan anda telah berhasil, berikut detailnya:<br>

## Detail Transaksi<br>
No. Invoice : {{ $invoice }}<br>
Produk : {{ $product }} <br>
Alamat Pengiriman : {{ $address }} <br>
Total Harga : Rp {{ total }}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
