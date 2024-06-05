<x-admin.layout title="Edit Field Type">
    <form action="{{route('admin.fieldTypes.update', compact('fieldType'))}}"
          method="post"
          class="col-md-6">
        @csrf
        @method('put')
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Edit Field Type</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{$fieldType->name}}" class="form-control">
                    @error('name')
                    {{$message}}
                    @enderror
                </div>
            </div>
        </div>
        <x-admin.buttons.save-delete/>
    </form>
</x-admin.layout>

<x-admin.modals.delete :model="$fieldType"/>
