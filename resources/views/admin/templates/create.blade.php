@php use App\Enums\TemplateTypeEnum; @endphp
<x-admin.layout title="Create Template">
    <form action="{{route('admin.templates.store')}}"
          method="post"
          enctype="multipart/form-data"
          class="col-md-6">
        @csrf
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Create Template</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Type</label>
                    <select id="" class="form-control" name="template_type">
                    @foreach(TemplateTypeEnum::cases() as $type)
                        <option value="{{$type->value}}">{{$type->name}}</option>
                    @endforeach
                    </select>
                </div>
                <x-admin.fields.input label="Name" id="templName"/>
                <x-admin.fields.image label="Image" id="templImage"/>
            </div>
        </div>
        <div style="width: 100px">
            <button type="submit" class="btn btn-block btn-dark">Save</button>
        </div>
    </form>
</x-admin.layout>
