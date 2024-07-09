<x-admin.layout title="Languages">
    <a href="{{route('admin.languages.create')}}" class="btn btn-dark">Create</a>
    <x-admin.table
        :collection="$languages"
        :names="['id', 'name', 'code']"
        edit off sort
    />
</x-admin.layout>
