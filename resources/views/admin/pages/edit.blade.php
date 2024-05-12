<x-admin.layout title="Edit Page">
    <form action="{{route('admin.pages.update', compact('page'))}}"
          method="post"
          class="col-md-6">
        @csrf
        @method('put')
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Edit Page</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{$page->name}}" class="form-control">
                    @error('name')
                    {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Path</label>
                    <input type="text" name="path" value="{{$page->path}}" class="form-control">
                    @error('path')
                         {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <x-admin.buttons.save-delete/>
    </form>
</x-admin.layout>

<x-admin.modals.delete :model="$page"/>
