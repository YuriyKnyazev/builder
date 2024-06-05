@php
    $name = $name ?? str($label)->snake()->toString()
@endphp

<div class="form-group">
    <label>{{$label}}</label>

    <div class="custom-file">
        <input type="file"
               name="{{$name}}"
               class="custom-file-input"
               id="{{$label . '-'. $id}}">
        <label class="custom-file-label"
               for="{{$label . '-'. $id}}">{{$value ?? ''}}</label>
    </div>
    @error($name)
    {{$message}}
    @enderror
</div>
