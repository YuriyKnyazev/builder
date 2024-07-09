                    <li class="m-item">
                        <a class="m-link" href="#">{{$menu['label']}}</a>
                        <ul class="m-dropdown">
                            @foreach($menu['blocks'] as $block)
                            <li class="m-dropdown-item"><a class="m-dropdown-link" href="{{$block['link']}}">{{$block['label']}}</a></li>
                            @endforeach
                        </ul>
                    </li>
{{--                    <li class="m-item">--}}
                    {{--                        <a class="m-link" href="#">Subdropdown</a>--}}
                    {{--                        <ul class="m-dropdown">--}}
                    {{--                            <li class="m-dropdown-item">--}}
                    {{--                                <a class="m-dropdown-link" href="#">Dropdown Item</a>--}}
                    {{--                                <ul class="m-subdropdown">--}}
                    {{--                                    <li class="m-subdropdown-item"><a class="m-subdropdown-link" href="#">Subdropdown Item</a></li>--}}
                    {{--                                    <li class="m-subdropdown-item"><a class="m-subdropdown-link" href="#">Subdropdown Item</a></li>--}}
                    {{--                                    <li class="m-subdropdown-item"><a class="m-subdropdown-link" href="#">Subdropdown Item</a></li>--}}
                    {{--                                    <li class="m-subdropdown-item"><a class="m-subdropdown-link" href="#">Subdropdown Item</a></li>--}}
                    {{--                                </ul>--}}
                    {{--                            </li>--}}
                    {{--                            <li class="m-dropdown-item">--}}
                    {{--                                <a class="m-dropdown-link" href="#">Dropdown Item</a>--}}
                    {{--                                <ul class="m-subdropdown">--}}
                    {{--                                    <li class="m-subdropdown-item"><a class="m-subdropdown-link" href="#">Subdropdown Item</a></li>--}}
                    {{--                                    <li class="m-subdropdown-item"><a class="m-subdropdown-link" href="#">Subdropdown Item</a></li>--}}
                    {{--                                    <li class="m-subdropdown-item"><a class="m-subdropdown-link" href="#">Subdropdown Item</a></li>--}}
                    {{--                                    <li class="m-subdropdown-item"><a class="m-subdropdown-link" href="#">Subdropdown Item</a></li>--}}
                    {{--                                </ul>--}}
                    {{--                            </li>--}}
                    {{--                            <li class="m-dropdown-item"><a class="m-dropdown-link" href="#">Dropdown Item</a></li>--}}
                    {{--                            <li class="m-dropdown-item"><a class="m-dropdown-link" href="#">Dropdown Item</a></li>--}}
                    {{--                        </ul>--}}
                    {{--                    </li>--}}
