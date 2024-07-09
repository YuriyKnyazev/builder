<x-admin.layout title="Create Languages">
    <form action="{{route('admin.languages.store')}}"
          method="post"
          class="col-md-6">
        @csrf
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Create Languages</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <x-admin.fields.input label="Name" id="nameId"/>
                    <x-admin.fields.input label="Code" id="nameId"/>
                </div>
            </div>
        </div>
        <div style="width: 100px">
            <button type="submit" class="btn btn-block btn-dark">Save</button>
        </div>
    </form>
</x-admin.layout>
