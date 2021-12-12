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
                    <h2>Fikri</h2>
                </div>
                <div class="col-4">
                    Report Detail
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Report Date</th>
                                <th scope="col">Report By</th>
                                <th scope="col">Violation Cateory</th>
                                <th scope="col">Report Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>04 Oct 2021</td>
                                <td>Rafli Ganteng</td>
                                <td>Spamming</td>
                                <td>This person keep spamming comment in my post</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-10"></div>
                <div class="col-2">
                    <button type="button" class="btn-banskuy float-right" data-toggle="modal" data-target="#exampleModalCenter" id="btnBan">Ban</button>
                </div>
            </div>
        </div>
    </section>
    @include('MasterSearching.Misc.component-modal-banconfirmation')
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            
        });
    </script>
@endsection