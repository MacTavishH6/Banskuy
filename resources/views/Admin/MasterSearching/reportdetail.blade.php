@extends('layouts.app')

@section('content')
    <section>
        <div class="container">
            <div class="slider">
                @include('Shared.Slider')
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row mb-3">
                <div class="col-12">
                    <h2>{{$report->first()->UserReported->Username}}</h2>
                </div>
                <div class="col-4">
                    Detail Laporan
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Tanggal terlapor</th>
                                <th scope="col">Dilaporkan Oleh</th>
                                <th scope="col">Kategori Pelanggaran</th>
                                <th scope="col">Detail Laporan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report as $rprt)
                                <tr>
                                    <td>{{ date('d M Y', strtotime($rprt->created_at)) }}</td>
                                    <td>{{$rprt->UserSource->Username}}</td>
                                    <td>{{$rprt->ReportCategory->ReportCategoryName}}</td>
                                    <td>{{$rprt->Reason}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-10"></div>
                <div class="col-2">
                    <button type="button" class="btn-banskuy float-right mb-3" data-toggle="modal"
                        data-target="#exampleModalCenter" id="btnBan">Ban</button>
                </div>
            </div>
        </div>
    </section>
    @include('Admin.MasterSearching.Misc.component-modal-banconfirmation')
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
        });
    </script>
@endsection
