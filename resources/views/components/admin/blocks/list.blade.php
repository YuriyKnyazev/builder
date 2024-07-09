<div class="@if($half) row @endif sortable">
    @foreach($blocks as $block)
        <x-admin.blocks.card :$block :sort="1"
                             :$off :$half
                             :$open :$language
                             :parsedBlock="$parsedBlocks[$block->id]" />
    @endforeach
</div>

