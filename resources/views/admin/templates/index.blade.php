<x-admin.layout title="Templates">
    <a href="{{route('admin.templates.create')}}" class="btn btn-dark">Create</a>
    @foreach($types as $key => $templates)
        <h3>{{$key}} Templates</h3>
        <x-admin.table
            :collection="$templates"
            :names="['id', 'name']"
            image="image"
            edit sort off
        />
    @endforeach
</x-admin.layout>
