<div class="section-lg">
    <div class="container">
        <div class="row align-items-center col-spacing-50">
            <div class="col-12 col-lg-6 order-lg-2">
                <img class="box-shadow-with-hover border-radius-05" src="{{asset($block['image'])}}" alt="">
            </div>
            <div class="col-12 col-lg-6 order-lg-1">
                <ul class="accordion single-open style-3 rounded">
                    <li class="active">
                        <div class="accordion-title">
                            <h6 class="font-weight-medium">{{$block['question_1']}}</h6>
                        </div>
                        <div class="accordion-content">
                            <p>{{$block['answer_1']}}</p>
                        </div>
                    </li>
                    <li>
                        <div class="accordion-title">
                            <h6 class="font-weight-medium">{{$block['question_2']}}</h6>
                        </div>
                        <div class="accordion-content">
                            <p>{{$block['answer_2']}}</p>
                        </div>
                    </li>
                    <li>
                        <div class="accordion-title">
                            <h6 class="font-weight-medium">{{$block['question_3']}}</h6>
                        </div>
                        <div class="accordion-content">
                            <p>{{$block['answer_3']}}</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</div>
