<img src="{{$for != "" ? asset('storage/'.$for) : asset('storage/sa/subProducts.png')}}" alt="{{$alt}}"
     {{ $attributes->merge(['class' => "$class"]) }}
     class="m-0 p-0"
     style="vertical-align: middle;width: {{$w}};height: {{$h}};border-radius: {{$radius}}">
