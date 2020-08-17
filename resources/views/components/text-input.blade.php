<div class="form-group mt-4 mb-2">
    <fieldset class="w-100 position-relative">
        <input id="{{$name}}" type="{{$type}}"
               class="form-control border @error($name) is-invalid @enderror"
               name="{{$name}}" value="{{ old($value) }}"
               placeholder="auto"
               required autocomplete="{{$name}}" autofocus>
        <label for="{{$name}}">{{$label}}</label>
    </fieldset>

    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
