{{-- <div x-data>
    <span x-show="$wire.showMessage">Aamir</span>
    <button x-on:click="$wire.toggleShowMessage()">Toggle</button>

</div> --}}
<div x-data="{ open: false }">

    <button @click="open = true">Show More...</button>
        {{ $data}}

    <ul x-show="open" @click.outside="open = false">

        <li><button wire:click="archive">Archive</button></li>

        <li><button wire:click="delete">Delete</button></li>

    </ul>

</div>

<div>
    <x-dropdown>
        <x-slot name="trigger">
            <button>Show More...</button>
        </x-slot>
        <ul>
            <li><button wire:click="archive">Archive</button></li>
            <li><button wire:click="delete">Delete</button></li>
        </ul>
    </x-dropdown>
</div>