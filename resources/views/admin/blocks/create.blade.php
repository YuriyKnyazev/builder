<x-admin.layout title="Add Block">
    <div class="row">
        @foreach($templates as $template)
            <div class="col-md-4">
                <form action="{{route('admin.pages.storeBlock', compact(['page', 'template']))}}"
                      class="card card-dark zoom my-2" style="cursor: pointer"
                onclick="this.submit()" method="post">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">{{$template->name}}</h3>
                    </div>
                    <div class="card-body">
                        <img src="{{asset($template->image)}}" class="w-100" alt="">
                    </div>
                </form>
            </div>
        @endforeach
    </div>
</x-admin.layout>
<style>
    .zoom {
        transition: transform .2s;
        margin: 0 auto;
    }

    .zoom:hover {
        transform: scale(1.05);
    }
</style>

