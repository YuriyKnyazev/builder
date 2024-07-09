<div class="modal fade" id="add-blocks" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <form method="post" action="{{route('admin.blocks.bulkStore')}}" class="modal-content">
            @csrf
            @method('post')
            <input type="hidden" name="templateId" id="templateId">
            <input type="hidden" name="blockId" id="modalBlockId">
            <div class="modal-header">
                <h4 class="modal-title">Add Blocks</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="width: 100px">
                    <x-admin.fields.number label="Number" id="addBlock" value="1"/>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
</div>
<script>
    function copyTemplateId(templateId, blockId) {
        document.querySelector('#templateId').value = templateId
        document.querySelector('#modalBlockId').value = blockId
    }
</script>
