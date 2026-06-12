<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>
    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows ?? 4 }}"
        placeholder="{{ $placeholder ?? '' }}"
        class="form-control @error($name) is-invalid @enderror"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ $attributes->filter(fn($v, $k) => !in_array($k, ['name', 'label', 'placeholder', 'required', 'rows', 'value'])) }}
    >{{ old($name) ?? ($value ?? '') }}</textarea>
    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
    <div id="{{ $name }}-error" class="invalid-feedback" style="display: none;"></div>
    @if($hint ?? false)
        <div class="form-text">{{ $hint }}</div>
    @endif
</div>
