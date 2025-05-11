
<button type="submit"
        {{ $attributes->class(['btn']) }}
        wire:loading.attr="disabled"
>
    <span>
        {{$slot}}
    </span>
    <span class="spinner-border spinner-border-sm text-white ms-1"
          role="status" wire:loading>
    </span>
</button>
