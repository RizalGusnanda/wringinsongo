@extends('layout-users.layout-main.index')
@section('content')
    <main class="bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mt-4" id="print-content">
                        <div class="card-header text-center text-white" style="background-color: #265073;">
                            <h2 style="color: white;">INVOICE</h2>
                            <p style="color: white;">{{ $response['order_id'] }}</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-weight-bold">Diterbitkan atas nama:</h5>
                                    <p>{{ $payment->cart->ticket->user->name }}</p>
                                </div>
                                <div class="col-6 text-right">
                                    <h5 class="font-weight-bold">Untuk:</h5>
                                    <p>{{ $tour->name }}</p>
                                    <p>Tanggal Kunjungan:
                                        {{ \Carbon\Carbon::parse($ticket->date)->locale('id')->isoFormat('D MMMM YYYY') }}
                                    </p>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <table class="table table-bordered" style="border: 1px solid #dee2e6; width: 100%;">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th style="border: 1px solid #dee2e6;">Info Produk</th>
                                                <th style="border: 1px solid #dee2e6;">Jumlah</th>
                                                <th style="border: 1px solid #dee2e6;">Harga Satuan</th>
                                                <th style="border: 1px solid #dee2e6;">Total Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="border: 1px solid #dee2e6;">{{ $tour->name }}</td>
                                                <td style="border: 1px solid #dee2e6;">{{ $ticket->tickets_count }}</td>
                                                <td style="border: 1px solid #dee2e6;">{{ 'Rp ' . number_format($tour->harga_tiket, 2, ',', '.') }}</td>
                                                <td style="border: 1px solid #dee2e6;">{{ 'Rp ' . number_format($tour->harga_tiket * $ticket->tickets_count, 2, ',', '.') }}</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-right font-weight-bold" style="border: 1px solid #dee2e6;">Jumlah Pembayaran</td>
                                                <td class="font-weight-bold" style="border: 1px solid #dee2e6;">Rp. {{ number_format($response['gross_amount'], 2, ',', '.') }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <h5 class="font-weight-bold">Metode Pembayaran:</h5>
                                    <p>{{ ucfirst($response['payment_type']) }}</p>
                                </div>
                                <div class="col-6 text-right">
                                    <h5 class="font-weight-bold">Status Transaksi:</h5>
                                    <p>
                                        @if (strtolower($response['transaction_status']) == 'settlement')
                                            Transaksi Sukses
                                        @else
                                            {{ ucfirst($response['transaction_status']) }}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center d-print-none">
                            <button class="btn btn-secondary" onclick="window.history.back()">Kembali</button>
                            <button class="btn btn-primary" onclick="printSection()">Cetak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        function printSection() {
            var { jsPDF } = window.jspdf;

            var printContents = document.getElementById('print-content');
            var originalContents = document.body.innerHTML;

            // Sembunyikan tombol saat mencetak
            document.querySelector('.card-footer').style.display = 'none';

            html2canvas(printContents, {
                scale: 2,
                backgroundColor: null
            }).then(canvas => {
                var imgData = canvas.toDataURL('image/png');
                var imgWidth = 210;
                var pageHeight = 295;
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;

                var doc = new jsPDF('p', 'mm', 'a4');
                var position = 0;

                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    doc.addPage();
                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }
                doc.save('invoice.pdf');

                // Tampilkan kembali tombol setelah cetak
                document.querySelector('.card-footer').style.display = 'block';
                document.body.innerHTML = originalContents;
            });
        }
    </script>
@endsection
