<x-admin.layout title="Edit Page">
    <form action="{{route('admin.pages.update', compact('page'))}}"
          method="post"
          enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="col-md-6">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Edit Page</h3>
                </div>
                <div class="card-body">
                    <x-admin.fields.input label="Name" :value="$page->name" id="storeInputName" />
                    <x-admin.fields.input label="Path" :value="$page->path" id="storeInputPath" />
                </div>
            </div>
        </div>
        <div class="p-1">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Blocks</h3>
                </div>
                <div class="card-body" id="sortable">
                    @foreach($page->blocks as $block)
                      <x-admin.blocks.card :$block sort/>
                    @endforeach

                </div>
            </div>
        </div>
        <div class="d-flex">
            <x-admin.buttons.save-delete/>
            <a class="btn btn-dark"
               href="{{route('admin.pages.addBlock', compact('page'))}}">Add Block</a>
        </div>
    </form>
</x-admin.layout>

<x-admin.modals.delete :model="$page"/>
<x-admin.modals.delete-block />
@isset($block)
<script>
    $(function () {
        $("#sortable").sortable({
            handle: ".handle",
            update: function (event, ui) {
                let sortInputs = [...document.querySelectorAll('.sortItem')]
                let sort = sortInputs.map((item) => item.value)
                let model = '{{class_basename($block)}}'
                fetch('{{route('admin.sort')}}', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json;charset=utf-8',
                        'X-CSRF-Token': '{{csrf_token()}}'
                    },
                    body: JSON.stringify({
                        sort,
                        model
                    })
                });
            }
        });
    });
</script>
@endisset
