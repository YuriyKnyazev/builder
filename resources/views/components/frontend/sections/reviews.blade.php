<div class="section">
    <div class="container">
        <div class="row">
            @foreach($block['blocks'] as $subBlock)
                <div class="col-12 col-lg-4" data-sal="fade" data-sal-delay="100">
                    <div class="testimonial-box">
                        <div class="quote">
                            <p>{{$subBlock['text']}}</p>
                        </div>
                        <div class="avatar">
                            <img src="{{$subBlock['avatar']}}" alt="">
                            <div>
                                <h6 class="font-weight-medium">{{$subBlock['name']}}</h6>
                                <span>{{$subBlock['position']}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
