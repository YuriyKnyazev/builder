<div class="card-body">
    <table class="table table-bordered table-sm">
        <thead>
        <tr>
            @foreach($names as $name)
                <th @if(str($name)->upper()->toString() === 'ID') style="width: 40px" @endif>{{str($name)->upper()}}</th>
            @endforeach
            @isset($image)
                <th>{{str($image)->upper()}}</th>
            @endisset
            @isset($off)
                <th>Show</th>
            @endisset
            @isset($sort)
                <th>Sort</th>
            @endisset
            @isset($edit)
                <th>Edit</th>
            @endisset
        </tr>
        </thead>
        <tbody id="sortable">
        @foreach($collection as $model)
            <tr>
                @foreach($names as $name)
                    <td>{{ $model->{$name} }}</td>
                @endforeach
                    @isset($image)
                        <td>
                            <img src="{{asset($model->{$image})}}"  style="height: 150px" alt="">
                        </td>
                    @endisset
                @isset($off)
                    <td style="width: 20px">
                        <x-admin.buttons.off :$model/>
                    </td>
                @endisset
                @isset($sort)
                    <td style="width: 20px">
                        <input type="hidden" class="sortItem" value="{{$model->id}}">
                        <x-admin.buttons.sort/>
                    </td>
                @endisset
                @isset($edit)
                    <td style="width: 20px">
                        <x-admin.buttons.edit :$model/>
                    </td>
                @endisset
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@isset($model)
    <script>
        $(function () {
            $("#sortable").sortable({
                handle: ".handle",
                update: function (event, ui) {
                    let sortInputs = [...document.querySelectorAll('.sortItem')]
                    let sort = sortInputs.map((item) => item.value)
                    let model = '{{class_basename($model)}}'
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

        function changeStatus(id, model) {
            fetch('{{route('admin.status')}}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8',
                    'X-CSRF-Token': '{{csrf_token()}}'
                },
                body: JSON.stringify({
                    id,
                    model
                })
            });
        }
    </script>
@endisset
