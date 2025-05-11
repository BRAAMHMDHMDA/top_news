@props([
    'type' => 'text',
    'name' => '',
    'value' => '',
    'placeholder' => '',
    'label'
])


<div class="form-group">
    @isset($label)
        <label>{{$label}} {!!  $attributes->has('required') ? "<span class='required'>*</span>" : ''  !!}</label>
    @endisset
    <input type="{{ $type }}" name="{{$name}}" value="{{ old($name, $value) }}"
           id="{{$name}}" {{ $attributes->has('required') ? 'required' : '' }}
           wire:model="{{$name}}" placeholder="{{$placeholder}}"
        {{ $attributes->class([
                'form-control',
                'is-invalid' => $errors->has($name)
               ])
        }}
    />
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    {{$slot}}
</div>


