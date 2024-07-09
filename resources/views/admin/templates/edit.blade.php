<x-admin.layout title="Edit Template">
    <form action="{{route('admin.templates.update', compact('template'))}}"
          method="post"
          class="col-md-6">
        @csrf
        @method('put')
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Edit Template</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="{{$template->name}}" class="form-control">
                    @error('name')
                    {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <img src="{{asset($template->image)}}" alt="" class="w-100">
                </div>
            </div>
        </div>
        <x-admin.templates.fields :$fieldTypes :$template/>


        <x-admin.buttons.save-delete/>
    </form>
</x-admin.layout>

<x-admin.modals.delete :model="$template"/>

<script>
    function addField(name, typeId, templateId) {
        const wrapper = document.querySelector("#fieldWrapper-" + templateId)

        let field = document.createElement('div')
        field.className = "row my-1"
        let rand = Math.floor(Math.random() * (99)) + 99
        field.id = 'field' + rand
        field.innerHTML = `
                        <div class="col">` + name + `</div>
                        <input type="hidden" name="fields[` + rand + `][template_id]" value="` + templateId + `">
                        <input type="hidden" name="fields[` + rand + `][field_type_id]" value="` + typeId + `">
                        <div class="col">
                            <input type="text" class="form-control" name="fields[` + rand + `][label]" required></div>
                        <div class="col">
                            <input type="text" class="form-control" name="fields[` + rand + `][name]" required></div>
                        <div class="btn btn-block btn-default btn-sm d-flex py-2 handle col-2"
                             style="cursor: move; width: 50px">
                            <i class="fas fa-ellipsis-v"></i>
                            <i class="fas fa-ellipsis-v" style="margin-left: 3px"></i>
                        </div>
                        <div class="col-1"><i class="fa fa-trash"
                            style="cursor: pointer"
                            onclick=deleteField('` + field.id + `')></i></div>
`
        wrapper.append(field)
    }

    function deleteField(id) {
        document.querySelector("#" + id).remove()
    }

    $(function () {
        $(".sortable").sortable({
            handle: ".handle"
        });
    });
</script>

