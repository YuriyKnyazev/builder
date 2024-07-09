<x-admin.layout title="Edit Language">
    <form action="{{route('admin.languages.update', compact('language'))}}"
          method="post"
          class="col-md-6">
        @csrf
        @method('put')
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Edit Language</h3>
            </div>
            <div class="card-body">
                <x-admin.fields.input label="Name" id="nameId" :value="$language->name"/>
                <x-admin.fields.input label="Code" id="nameId" :value="$language->code"/>
            </div>
        </div>
        <x-admin.buttons.save-delete/>
    </form>
</x-admin.layout>

<x-admin.modals.delete :model="$language"/>
