<div>
    <x-label for="name" :value="__('Parent category')" />

    @foreach ($selectArrays as $index=>$selectArr)
        
        @if (count($selectArr))
            <select name="parent" wire:change.prevent="fetchCategory($event.target.value, {{ $index }})" id="parent"
                class="w-full mt-2 rounded-lg bg-orange-100">
                <option value="" selected>Select category</option>
                @foreach ($selectArr as $eachCategory)
                    <option value="{{ $eachCategory['id'] }}">{{ $eachCategory['name'] }}</option>
                @endforeach
            </select>
        @endif
    @endforeach
</div>
