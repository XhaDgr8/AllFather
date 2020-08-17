<img src="{{ \App\Helper\Helper::avatar() }}" alt="User Avatar"
     class="m-0 p-0"
     {{ $attributes->merge(['class' => "$class"]) }}
     style="vertical-align: middle;width: {{$w}};height: {{$h}};border-radius: {{$radius}}">
