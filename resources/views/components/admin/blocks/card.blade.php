<div class="card card-dark collapsed-card">
    <div class="card-header">
        <h3 class="card-title">{{$block->template->name}}</h3>
        <div class="card-tools d-flex">
            <x-admin.buttons.off :model="$block"/>
            @isset($sort)
            <div class="d-flex handle"
                 style="cursor: move; padding: 3px">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v" style="margin-left: 3px"></i>
            </div>
            @endisset
            <button type="button" class="btn btn-tool"
                    data-toggle="modal"
                    data-target="#modal-delete-block"
                    onclick="document.querySelector('#blockId').value = {{$block->id}}"
            ><i class="fas fa-times"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body" style="display: none;">
        <input type="hidden" class="sortItem" value="{{$block->id}}">
        @foreach($block->template->fields as $field)
            <x-dynamic-component
                :component="'admin.fields.' . str($field->fieldType->name)->camel()"
                :label="$field->label"
                name="fieldContents[{{$field->contentId}}]"
                :id="$block->id"
                :value="$field->value"
            />
        @endforeach
    </div>
</div>
