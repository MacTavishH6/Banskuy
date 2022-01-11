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
                    <h2>Tipe User</h2>
                </div>
                <div class="col-4">
                    <div class="form-row">
                        <select name="UserType" id="UserType" class="form-control">
                            <option value="">Semua</option>
                            <option value="1">Donatur</option>
                            <option value="2">Yayasan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered" id="table-pengguna">
                        <thead>
                            <tr>
                                <th scope="col">Nama Pengguna</th>
                                <th scope="col">Email</th>
                                <th scope="col">Anggota sejak</th>
                                <th scope="col">Status Laporan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report as $rprt)
                                <tr>
                                    <td>
                                        <a
                                            href="/profile/{{ Crypt::encrypt($rprt->UserTarget->UserID) }}">{{ $rprt->UserTarget->Username }}</a>
                                    </td>
                                    <td>{{ $rprt->UserTarget->Email }}</td>
                                    <td>{{ date('d M Y', strtotime($rprt->UserTarget->RegisterDate)) }}</td>
                                    <td>Terlapor</td>
                                    <td>
                                        <a href="/usersearching/detail/{{$rprt->RoleIDTarget == 1 ? Crypt::encrypt($rprt->UserTarget->UserID) : Crypt::encrypt($rprt->UserTarget->FoundationID)}}" class="btn btn-link report-detail">
                                            <img src="{{ env('FTP_URL') }}/assets/details.png" alt=""
                                                style="max-width: 20px">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$report->links()}}
                </div>
            </div>
        </div>
    </section>
@endsection
