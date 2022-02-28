<body>
    <style>
        table,
        th,
        td {
            border: 1px solid grey;
        }

        table {
            width: 95%;
            border-collapse: collapse;
            margin: 20px auto;
        }

    </style>
    <div id="content" class="center" style="background-color: #cfc0fa; ">
        <h2 style="text-align: center;">Rekapan Donasi Yayasan
            {{ Auth::guard() == 'foundations' ? Auth::guard()->user()->FoundationName : '' }}</h2>
        <h2 style="text-align: center;">Tahun {{ date('Y') }}</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Donasi</th>
                    <th>Tipe Donasi</th>
                    <th>Tanggal Donasi</th>
                    <th>Status Donasi</th>
                    <th>Nama Donatur</th>
                    <th>Nomor Telephone Donatur</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $donation)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $donation->DonationDescriptionName }}</td>
                        <td>{{ $donation->DonationTypeDetail->DonationType->DonationTypeName }}</td>
                        <td>{{ date('d M Y', strtotime($donation->TransactionDate)) }}</td>
                        <td>{{ $donation->ApprovalStatus->ApprovalStatusName }}</td>
                        <td>{{ $donation->User->FirstName . ' ' . $donation->User->LastName }}</td>
                        <td>{{ $donation->User->PhoneNumber }}</td>
                        <td>{{ $donation->Quantity . ' ' . $donation->DonationTypeDetail->DonationTypeDetail }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="height: 5%;"></div>
    </div>
</body>
