<div class="section-sm bg-light-gray">
    <div class="container text-center">
        <div class="owl-carousel" data-owl-dots="false" data-owl-nav="true" data-owl-margin="50" data-owl-autoPlay="true" data-owl-xs="1" data-owl-sm="2" data-owl-md="3" data-owl-lg="4" data-owl-xl="5">
            @foreach($block['blocks'] as $subBlock)
            <div class="client-box">
                <a href="#">
                    <img src="{{$subBlock['image']}}" alt="{{$subBlock['image_alt']}}">
                </a>
            </div>
            @endforeach
        </div><!-- end owl-carousel -->
    </div><!-- end container -->
</div>
