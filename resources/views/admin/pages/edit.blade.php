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
                    <x-admin.fields.input label="Name" :value="$page->name" id="storeInputName"/>
                    <x-admin.fields.input label="Path" :value="$page->path" id="storeInputPath"/>
                </div>
            </div>
        </div>
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
                                @if($blocks[$language->id] ?? false)
                                    <x-admin.blocks.list
                                        :$language
                                        :blocks="$page->blocks"
                                        :parsedBlocks="$blocks[$language->id]"
                                        :half="0" :open="0" :off="1"
                                        :parentLoop="$loop"/>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card -->
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
<x-admin.modals.delete-block/>
<x-admin.modals.add-blocks/>
@if(count($page->blocks))
    <script>
        $(function () {
            $(".sortable").sortable({
                handle: ".handle",
                update: function (event, ui) {
                    let sortInputs = [...document.querySelectorAll('.sortItem')]
                    let sort = sortInputs.map((item) => item.value)
                    let model = 'Block'
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
@endif
