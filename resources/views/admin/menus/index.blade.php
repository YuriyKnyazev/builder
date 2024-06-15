<x-admin.layout title="Menus">
    <a href="{{route('admin.menus.create')}}" class="btn btn-dark">Create</a>
    <x-admin.table
        :collection="$menus"
        :names="['id', 'name']"
        sort off edit
    />
</x-admin.layout>
