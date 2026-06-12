<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type ?? 'text' }}"
        value="{{ old($name) ?? ($value ?? '') }}"
        placeholder="{{ $placeholder ?? '' }}"
        class="form-control @error($name) is-invalid @enderror"
        {{ ($required ?? false) ? 'required' : '' }}
        @if($validation ?? false)
            data-validation="{{ $validation }}"
        @endif
        {{ $attributes->filter(fn($v, $k) => !in_array($k, ['name', 'label', 'type', 'placeholder', 'required', 'validation', 'value'])) }}
    >
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
