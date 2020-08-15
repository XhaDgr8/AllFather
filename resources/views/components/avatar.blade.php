<img src="{{ Auth::user()->avatar != '' ? Auth::user()->avatar : asset('storage/sa/img_avatar.png') }}" alt="User Avatar"
     class="mx-1 m-0 p-0 {{$shadow}}"
     style="vertical-align: middle;width: {{$w}};height: {{$h}};border-radius: 50%;">
