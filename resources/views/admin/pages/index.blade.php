<x-admin.layout title="Pages">
    <a href="{{route('admin.pages.create')}}" class="btn btn-dark">Create</a>
    <x-admin.table
        :collection="$pages"
        :names="['id', 'name', 'path']"
        edit sort off
    />
</x-admin.layout>
