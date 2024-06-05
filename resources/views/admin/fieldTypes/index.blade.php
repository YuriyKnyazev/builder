<x-admin.layout title="Field Types">
    <a href="{{route('admin.fieldTypes.create')}}" class="btn btn-dark">Create</a>
    <x-admin.table
        :collection="$fieldTypes"
        :names="['id', 'name']"
        edit
    />
</x-admin.layout>
