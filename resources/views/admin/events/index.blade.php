<x-admin.layout title="History">
    <section class="content">
        <div class="container-fluid">

            <div class="row col-md-6">
                <div class="col-md-12">
                    <div class="timeline">
                        @foreach($days as $day)
                            <div class="time-label">
                                <span class="bg-dark">{{$day->first()->created_at->format('d M Y')}}
                                    <i class="fas fa-trash mx-2" style="cursor: pointer"
                                       onclick="document.querySelector('#dayForm-{{$loop->index}}').submit()"></i>
                                </span>
                            </div>
                            <form action="{{route('admin.events.deleteByDay')}}"
                                  method="post" id="dayForm-{{$loop->index}}">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="date" value="{{$day->first()->created_at->toDateString()}}">
                            </form>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            @foreach($day as $event)
                                <div>
                                    <i class="fas {{$event->type->icon()}} bg-{{$event->type->iconColor()}}"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fas fa-clock"></i> {{$event->created_at->format('H:i')}}</span>
                                        <h3 class="timeline-header">{{$event->title}} by <b>{{$event->user->name}}</b>
                                        </h3>
                                        <div class="timeline-body">
                                            @if($event->old_values)
                                                <div class="card card-dark collapsed-card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">OLD VALUES</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool"
                                                                    data-card-widget="collapse"><i
                                                                    class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body" style="display: none;">
                                                        <ul>
                                                            @foreach($event->old_values as $key => $value)
                                                                <li><b>{{$key}}</b> - {{$value}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                            @if($event->new_values)
                                                <div class="card card-dark collapsed-card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">NEW VALUES</h3>
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool"
                                                                    data-card-widget="collapse"><i
                                                                    class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="card-body" style="display: none;">
                                                        <ul>
                                                            @foreach($event->new_values as $key => $value)
                                                                <li><b>{{$key}}</b> - {{$value}}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="timeline-footer">
                                            @if($event->link)
                                                <a href="{{$event->link}}" class="btn btn-primary btn-sm">Link</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-admin.layout>
