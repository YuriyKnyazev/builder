@php
    $name = $name ?? str($label)->snake()->toString()
@endphp

<div class="form-group">
    <label for="{{$label . '-'. $id}}">{{$label}}</label>
    <input id="{{$label . '-'. $id}}"
           type="text"
           name="{{$name}}"
           value="{{old($name, $value ?? '')}}"
           class="form-control"
           @isset($req) required @endisset>
    @error($name)
    {{$message}}
    @enderror
</div>
