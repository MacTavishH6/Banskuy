<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document Review Result</title>

    <style>
    
    </style>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Donation History Detail</title>

    <style>
        .pagetitle{
            font-size: 300%;
            text-align: center;
        }
    </style>

</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="pagetitle">
            <p>
                Document Review Result
            </p>
        </div>

        <div class="d-flex justify-content-around">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-center" style="font-size:140%">
                        Your Document Result Detail
                    </div>

                    <div class="reviewresultbodycontent d-flex justify-content-around">

                        <div class="col-3"></div>

                        <div class="card-body">
                            <form action="">
                                <div class="">
                                    <label for="">Document Type</label> 
                                    <input type="text">
                                </div>   
                                <div class="">
                                    <label for="">File Name</label> 
                                    <input type="text">
                                </div>
                                <div class="">
                                    <label for="">Upload Date</label> 
                                    <input type="text">
                                </div>
                                <div class="">
                                    <label for="">Review Date</label> 
                                    <input type="text">
                                </div>
                                <div class="">
                                    <label for="">Review Status</label> 
                                    <input type="text">
                                </div>  
                                <div class="">
                                    <label for="">Reupload Document</label> 
                                    <input type="file">
                                </div>
                            </form>             
                        </div>

                        <div class="col-3"></div>

                        <div class="col-3"></div>
            
                    </div>
                    
                    <div class="d-flex justify-content-around">
                        <div class="col-3"></div>
                        <div class="col-3">
                            <div class="text-center">
                                <button type="submit" class="mb-3 mt-5 py-1 px-4 text-white" style="border-radius: 20px; background-color: #AC8FFF; border: none;">Save
                                </button>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text-center">
                                <button type="submit" class="mb-3 mt-5 py-1 px-4 text-white" style="border-radius: 20px; background-color: #FF0000; border: none;">Close
                                </button>
                            </div>
                        </div>           
                        <div class="col-3"></div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endsection

</body>

</html>
</body>
</html>