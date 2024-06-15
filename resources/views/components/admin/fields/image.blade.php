@php
    $name = $name ?? str($label)->snake()->toString()
@endphp

<div class="form-group">
    <label>{{$label}}</label>

    <div class="custom-file">
        <input type="file"
               name="{{$name}}"
               class="custom-file-input"
               id="{{$label . '-'. $id}}"
               onchange="loadFile(event, '{{str($label)->camel() . $id. '-image'}}')">
        <label class="custom-file-label"
               for="{{$label . '-'. $id}}">{{$value ?? ''}}</label>
    </div>

        <div class="my-2">
            <img style="max-width: 100%; max-height: 300px"
                id="{{str($label)->camel() . $id. '-image'}}" src="{{asset($value ?? '')}}" alt="">
        </div>

    @error($name)
    {{$message}}
    @enderror
</div>
