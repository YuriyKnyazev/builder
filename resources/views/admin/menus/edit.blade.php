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
            <div class="p-1">
                <div class="card card-dark card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="pt-2 px-3"><h3 class="card-title">Blocks</h3></li>
                            @foreach($languages as $language)
                                <li class="nav-item">
                                    <a class="nav-link @if($loop->first) active @endif"
                                       id="custom-tabs-two-home-tab"
                                       data-toggle="pill"
                                       href="#tab-{{$language->code}}"
                                       role="tab"
                                       aria-controls="custom-tabs-two-home" aria-selected="true">{{$language->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            @foreach($languages as $language)
                                <div class="tab-pane fade @if($loop->first) active show @endif"
                                     id="tab-{{ $language->code }}"
                                     role="tabpanel"
                                     aria-labelledby="custom-tabs-two-home-tab">
                                    @if($parsedBlock[$language->id] ?? false)
                                        <x-admin.blocks.card :block="$menu->block"
                                                             :$parsedBlock
                                                             :open="0"
                                                             :half="0"
                                                             :sort="0"
                                                             :$language
                                                             :off="1"
                                                             :parsedBlock="$parsedBlock[$language->id][$menu->block->id]"/>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
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
<x-admin.modals.delete-block/>
<x-admin.modals.add-blocks/>
