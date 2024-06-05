@php
    $name = $name ?? str($label)->snake()->toString()
@endphp

<div class="form-group">
    <label for="{{$label . '-'. $id}}">{{$label}}</label>
    <input id="{{$label . '-'. $id}}" type="number" name="{{$name}}"
           value="{{old($name, $value ?? '')}}"
           class="form-control">
    @error($name)
    {{$message}}
    @enderror
</div>
