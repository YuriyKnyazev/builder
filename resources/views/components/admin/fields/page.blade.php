@php
    $name = $name ?? str($label)->snake()->toString()
@endphp

<div class="form-group">
    <label for="{{$label . '-'. $id}}">{{$label}}</label>
    <select class="form-control" name="{{$name}}" @isset($req) required @endisset>
        id="{{$label . '-'. $id}}">
        @foreach($pages as $page)
            <option value="{{$page->id}}"
                @selected($page->id == old($name, $value ?? ''))
            >{{$page->name}}</option>
        @endforeach
    </select>
    @error($name)
    {{$message}}
    @enderror


</div>
