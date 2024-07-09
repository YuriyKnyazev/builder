<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">Fields</h3>
    </div>
    <div class="card-body">
        @foreach($fieldTypes as $fieldType)
            <button type="button"
                    class="btn btn-sm btn-dark mx-2"
                    onclick="addField('{{$fieldType->name}}', '{{$fieldType->id}}', '{{ $template->id }}')"
            >{{$fieldType->name}}</button>
        @endforeach
        <div class="row mt-4">
            <div class="col text-bold">Type</div>
            <div class="col text-bold">Label</div>
            <div class="col text-bold">Name</div>
            <div class="col-2 text-bold">Sort</div>
            <div class="col-1 text-bold"></div>
        </div>
        <div id="fieldWrapper-{{ $template->id }}" class="sortable">
            <input type="hidden" name="templateIds[]" value="{{$template->id}}">
            @foreach($template->fields ?? [] as $field)
                <div class="row my-1" id="field-{{$loop->index}}-{{$template->id}}">
                    <div class="col">{{$field->fieldType->name}}</div>
                    <input type="hidden" name="fields[{{ $template->id }}{{$loop->index}}][id]" value={{"$field->id"}}>
                    <input type="hidden" name="fields[{{ $template->id }}{{$loop->index}}][field_type_id]"
                           value={{"$field->field_type_id"}}>
                    <input type="hidden" name="fields[{{ $template->id }}{{$loop->index}}][template_id]"
                           value={{"$template->id"}}>
                    <div class="col">
                        <input type="text"
                               class="form-control"
                               name="fields[{{ $template->id }}{{$loop->index}}][label]"
                               value="{{$field->label}}"
                               required>
                    </div>
                    <div class="col">
                        <input type="text"
                               class="form-control"
                               name="fields[{{ $template->id }}{{$loop->index}}][name]"
                               value="{{$field->name}}"
                               required>
                    </div>
                    <div class="btn btn-block btn-default btn-sm d-flex py-2 handle col-2"
                         style="cursor: move; width: 50px">
                        <i class="fas fa-ellipsis-v"></i>
                        <i class="fas fa-ellipsis-v" style="margin-left: 3px"></i>
                    </div>
                    <div class="col-1">
                        <i class="fa fa-trash"
                           style="cursor: pointer"
                           onclick=deleteField('field-{{$loop->index}}-{{$template->id}}')>
                        </i>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@if($template->template)
    <x-admin.templates.fields :$fieldTypes :template="$template->template" />
@endif

