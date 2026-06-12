<div class="mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
        @if($required ?? false)
            <span class="text-danger">*</span>
        @endif
    </label>
    <select
        id="{{ $name }}"
        name="{{ $name }}"
        class="form-select @error($name) is-invalid @enderror"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ $attributes->filter(fn($v, $k) => !in_array($k, ['name', 'label', 'required', 'options', 'value', 'placeholder'])) }}
    >
        @if($placeholder ?? false)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($options ?? [] as $value => $text)
            <option value="{{ $value }}" {{ old($name) == $value || ($selectedValue ?? null) == $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
    <div id="{{ $name }}-error" class="invalid-feedback" style="display: none;"></div>
</div>
