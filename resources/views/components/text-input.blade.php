<div {{ $attributes->merge(['class' => "$class"]) }} class="form-group">
    <fieldset class="w-100 position-relative">
        <input id="{{$name}}" type="{{$type}}"
               class="form-control border-primary border @error($name) is-invalid @enderror"
               name="{{$name}}" value="{{ old($value) }}"
               placeholder="auto"
               {{$attr}} autocomplete="{{$name}}" autofocus>
        @error($name)
        <div class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </div>
        @enderror
        <label class="small" for="{{$name}}" style="pointer-events: none">
            {{$label}}
        </label>
    </fieldset>
</div>

