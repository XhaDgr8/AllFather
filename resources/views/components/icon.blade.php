<svg
    xmlns="http://www.w3.org/2000/svg"
    width="{{ $w != "" ? $w : ''  }}"
    height="{{ $h != "" ? $h : ''  }}"
    focusable="false" role="img"
    {{ $attributes->merge(['class' => "$class"]) }}
    @includeIf("icons.$i")
</svg>

