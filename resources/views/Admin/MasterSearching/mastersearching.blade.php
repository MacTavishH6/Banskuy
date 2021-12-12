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
                        <select name="UserType" id="UserType" class="form-control"></select>
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
                            <tr>
                                <td>Wira</td>
                                <td>wira@gmail.com</td>
                                <td>02 Oct 2021</td>
                                <td>None</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('Scripts')
<script>
    $(document).ready(function () {

    });
</script>
@endsection