@php
    $name = $name ?? str($label)->snake()->toString()
@endphp

<div class="form-group">
    <label for="{{$label . '-'. $id}}">{{$label}}</label>
    <textarea id="{{$label . '-'. $id}}"
              class="form-control"
              name="{{$name}}"
              @isset($req) required @endisset
    >{{old($name, $value ?? '')}}</textarea>

    @error($name)
    {{$message}}
    @enderror
</div>
