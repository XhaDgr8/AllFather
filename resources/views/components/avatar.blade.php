<img src="{{ \App\Helper\Helper::avatar($for) }}" alt="User Avatar"
     {{ $attributes->merge(['class' => "$class"]) }}
     class="m-0 p-0"
     style="vertical-align: middle;width: {{$w}};height: {{$h}};border-radius: {{$radius}}">
