<x-frontend.layout :$menus :$languages>

    @foreach($blocks as $block)
        <x-dynamic-component
            component="{{'frontend.sections.' . $block['template']}}"
            :$block
        />
    @endforeach

</x-frontend.layout>
