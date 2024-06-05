<div class="modal fade" id="modal-delete-block" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{route('admin.blocks.destroy')}}" class="modal-content">
            @csrf
            @method('delete')
            <input type="text" name="blockId" id="blockId">
            <div class="modal-header">
                <h4 class="modal-title">Delete Block</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>
