<a type="button"
   href="{{route('admin.'.str(class_basename($model))->camel()->plural().'.edit', [str(class_basename($model))->camel()->toString()=>$model])}}"
   class="btn btn-block btn-default btn-sm">
    <i class="fas fa-edit nav-icon"></i>
</a>
