<x-admin.layout title="Create Page">
    <form action="{{route('admin.pages.store')}}"
          method="post"
          class="col-md-6">
        @csrf
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Create Page</h3>
            </div>
            <div class="card-body">
                <x-admin.fields.input label="Name" id="storeInputName" />
                <x-admin.fields.input label="Path" id="storeInputPath" />
            </div>
        </div>
        <div style="width: 100px">
            <button type="submit" class="btn btn-block btn-dark">Save</button>
        </div>
    </form>
</x-admin.layout>
