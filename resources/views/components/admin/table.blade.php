<div class="card-body">
    <table class="table table-bordered table-sm">
        <thead>
        <tr>
            @foreach($names as $name)
                <th>{{str($name)->upper()}}</th>
            @endforeach
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
                @isset($off)
                    <td style="width: 20px">
                        <x-admin.buttons.off :$model />
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
                        <x-admin.buttons.edit :$model />
                    </td>
                @endisset
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
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
