<x-admin.layout title="Create Menu">
    <form action="{{route('admin.menus.store')}}"
          method="post"
          class="col-md-6">
        @csrf
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Create Menu</h3>
            </div>
            <div class="card-body">
                <x-admin.fields.input label="Name" id="nameId"/>
            </div>
        </div>
        <div style="width: 100px">
            <button type="submit" class="btn btn-block btn-dark">Save</button>
        </div>
    </form>
</x-admin.layout>
