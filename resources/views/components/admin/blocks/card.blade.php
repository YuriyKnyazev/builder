<div class="card card-dark @if($open) @else collapsed-card @endif @if($half) col-md-6 @endif">
    <div class="card-header p-0">
        <h3 class="card-title m-1 ml-2">{{$parsedBlock['template']}}</h3>
        <div class="card-tools d-flex">
            @if($off)
                <x-admin.buttons.off :model="$block"/>
            @endif
            @if($sort)
                <div class="d-flex handle"
                     style="cursor: move; padding: 3px">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v" style="margin-left: 3px"></i>
                </div>
            @endif
            <button type="button" class="btn btn-tool"
                    data-toggle="modal"
                    data-target="#modal-delete-block"
                    onclick="document.querySelector('#blockId').value = {{$block->id}}"
            ><i class="fas fa-times"></i>
            </button>
            @if($open)
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i>
                </button>
            @else
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-plus"></i>
                </button>
            @endif
        </div>
    </div>
    <div class="card-body" style="@if($open) display: block; @else display: none; @endif">
        <input type="hidden" class="sortItem" value="{{$block->id}}">
        @foreach($parsedBlock['fields'] ?? [] as $field)
            <x-dynamic-component
                    :component="'admin.fields.' . str($field['type'])->camel()"
                    :label="$field['label']"
                    name="fieldContents[{{$field['id']}}]"
                    :id="$field['id']"
                    :value="$field['value']"
                    :$language
            />
        @endforeach
        @if($block->template->template)
            <x-admin.buttons.add-blocks :$block/>
            @if($parsedBlock['subBlocks'] ?? false)
                <x-admin.blocks.list
                        :blocks="$block->blocks"
                        :half="1" :open="1" :off="0"
                        :$language
                        :parsedBlocks="$parsedBlock['subBlocks']"/>
            @endif
        @endif
    </div>
</div>

