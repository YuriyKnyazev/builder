<a type="button"
   href="{{route('admin.'.str(class_basename($model))->lower()->plural().'.edit', [str(class_basename($model))->lower()->toString()=>$model])}}"
   class="btn btn-block btn-default btn-sm">
    <i class="fas fa-edit nav-icon"></i>
</a>
