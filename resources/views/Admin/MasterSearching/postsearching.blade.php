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
                    <h2>Post Terlapor</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered" id="table-pengguna">
                        <thead>
                            <tr>
                                <th scope="col">Nama Pembuat</th>
                                <th scope="col">Judul Post</th>
                                <th scope="col">Waktu terbuat</th>
                                <th scope="col">Status Laporan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportedPost as $rprt)
                                <tr>
                                    <td>
                                        {{ $rprt->User->Username }}
                                    </td>
                                    <td>
                                        <a
                                            href="/ViewPost/{{ Crypt::encrypt($rprt->PostID) }}">{{ $rprt->Post->PostTitle }}</a>
                                    </td>
                                    <td>{{ date('d M Y', strtotime($rprt->created_at)) }}</td>
                                    <td>Terlapor</td>
                                    <td>
                                        <a href="/postsearching/detail/{{ Crypt::encrypt($rprt->PostID) }}"
                                            class="btn btn-link report-detail">
                                            <img src="{{ env('FTP_URL') }}/assets/details.png" alt=""
                                                style="max-width: 20px">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $reportedPost->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
