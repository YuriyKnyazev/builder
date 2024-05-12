<div class="form-group">
    <div class="custom-control custom-switch">
        <input type="checkbox" class="custom-control-input" id="custom{{ $model->id }}"
               onchange="changeStatus('{{ $model->id }}', '{{ class_basename($model) }}')"
            @checked($model->is_show)>
        <label class="custom-control-label" for="custom{{ $model->id }}"></label>
    </div>
</div>
