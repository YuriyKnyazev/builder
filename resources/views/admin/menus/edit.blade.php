<x-admin.layout title="Edit Menu">
    <form action="{{route('admin.menus.update', compact('menu'))}}"
          method="post"
          class="col-md-6">
        @csrf
        @method('put')
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Edit Menu</h3>
            </div>
            <div class="card-body">
                <x-admin.fields.input label="Name" :value="$menu->name" id="nameId"/>
            </div>
        </div>
        @if($menu->block)
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Blocks</h3>
            </div>
            <div class="card-body">
                <x-admin.blocks.card :block="$menu->block"/>
            </div>
        </div>
        @endif
        <div class="d-flex">
            <x-admin.buttons.save-delete/>
            @if(!$menu->block)
                <a class="btn btn-dark"
                   href="{{route('admin.menus.addBlock', compact('menu'))}}">Add Block</a>
            @endif
        </div>
    </form>
</x-admin.layout>

<x-admin.modals.delete :model="$menu"/>
<x-admin.modals.delete-block />
