<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <form wire:submit.prevent='createPoll'>
        <label>Poll Title</label>
        <input type="text" wire:model.live="title"/>

        @error('title')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        {{-- Current Title: {{ $title }} --}}

        <div class="mt-4 mb-4">
            <button class="btn" wire:click.prevent='addOption'>Add Option</button>
        </div>
        {{-- @dd($options) --}}
        <div class="mt-4">
            @foreach ($options as $index => $option)
                <div class="mb-4">
                    <label>Option {{ $index + 1 }}</label>
                    <div class="flex">
                        <input type="text" wire:model.live='options.{{ $index }}'>
                        <button class="btn" wire:click.prevent='removeOption({{ $index }})'>Remove</button>
                    </div>
                    @error("options.{$index}")
                        <div class="text-red-500">{{ $message }}</div>
                    @enderror
                </div>
                
            @endforeach
        </div>
        <button type="submit" class="btn">Create Poll</button>
    </form>

</div>