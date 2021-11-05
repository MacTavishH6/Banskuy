@extends('layouts.app')

@section('styles')
    <style>
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey
        }

        #progressbar .active {
            color: #2F8D46
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400
        }

        #progressbar #step1:before {
            content: "1"
        }

        #progressbar #step2:before {
            content: "2"
        }

        #progressbar #step3:before {
            content: "3"
        }

        #progressbar #step4:before {
            content: "4"
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #2F8D46
        }

        .progress {
            height: 20px
        }

        .progress-bar {
            background-color: #2F8D46
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9 col-md-7 
                col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
                <div class="px-0 pt-4 pb-0 mt-3 mb-3">
                    <form id="form">
                        <ul id="progressbar">
                            <li class="active" id="step1">
                                <strong>Step 1</strong>
                            </li>
                            <li id="step2"><strong>Step 2</strong></li>
                            <li id="step3"><strong>Step 3</strong></li>
                            <li id="step4"><strong>Step 4</strong></li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // var currentGfgStep, nextGfgStep, previousGfgStep;
            // var opacity;
            // var current = 1;
            // var steps = $("fieldset").length;

            // setProgressBar(current);

            // $(".next-step").click(function() {

            //     currentGfgStep = $(this).parent();
            //     nextGfgStep = $(this).parent().next();

            //     $("#progressbar li").eq($("fieldset")
            //         .index(nextGfgStep)).addClass("active");

            //     nextGfgStep.show();
            //     currentGfgStep.animate({
            //         opacity: 0
            //     }, {
            //         step: function(now) {
            //             opacity = 1 - now;

            //             currentGfgStep.css({
            //                 'display': 'none',
            //                 'position': 'relative'
            //             });
            //             nextGfgStep.css({
            //                 'opacity': opacity
            //             });
            //         },
            //         duration: 500
            //     });
            //     setProgressBar(++current);
            // });

            // $(".previous-step").click(function() {

            //     currentGfgStep = $(this).parent();
            //     previousGfgStep = $(this).parent().prev();

            //     $("#progressbar li").eq($("fieldset")
            //         .index(currentGfgStep)).removeClass("active");

            //     previousGfgStep.show();

            //     currentGfgStep.animate({
            //         opacity: 0
            //     }, {
            //         step: function(now) {
            //             opacity = 1 - now;

            //             currentGfgStep.css({
            //                 'display': 'none',
            //                 'position': 'relative'
            //             });
            //             previousGfgStep.css({
            //                 'opacity': opacity
            //             });
            //         },
            //         duration: 500
            //     });
            //     setProgressBar(--current);
            // });

            // function setProgressBar(currentStep) {
            //     var percent = parseFloat(100 / steps) * current;
            //     percent = percent.toFixed();
            //     $(".progress-bar")
            //         .css("width", percent + "%")
            // }

            // $(".submit").click(function() {
            //     return false;
            // })
        });
    </script>
@endsection
