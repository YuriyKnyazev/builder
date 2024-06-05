<x-admin.layout title="Templates">
    <a href="{{route('admin.templates.create')}}" class="btn btn-dark">Create</a>
    <x-admin.table
        :collection="$templates"
        :names="['id', 'name']"
        image="image"
        edit sort off
    />
</x-admin.layout>
