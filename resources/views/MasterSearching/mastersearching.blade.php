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
                    <h2>User Type</h2>
                </div>
                <div class="col-4">
                    <div class="form-row">
                        <select name="UserType" id="UserType" class="form-control"></select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Member Since</th>
                                <th scope="col">Report Status</th>
                                <th scope="col">Action</th>
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
                            <tr>
                                <td>Fikri</td>
                                <td>fikri@gmail.com</td>
                                <td>02 Oct 2021</td>
                                <td>Reported</td>
                                <td><a href="#">See Detail</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
