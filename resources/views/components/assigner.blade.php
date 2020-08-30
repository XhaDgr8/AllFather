{{--{{dd($assigner)}}--}}
@foreach($assigner['to'] as $to)
    <form type="hidden" action="{{route($assigner['route'])}}"
          method="post" class="d-inline">
        @csrf
        @if ($assigner['forName'] == 'user')
            <input type="hidden" value="{{$assigner['for']->id}}" name="{{$assigner['forName']}}">
            <input type="hidden" value="{{$to->name}}" name="{{$assigner['toName']}}">
            <button {{$assigner['for']->id == 1 ? $to->name == 'admin' ? 'disabled' : '' : ''}}
                    class="anime hover-delete btn-sm btn my-1 px-2
                rounded-pill btn-primary shadow-sm-primary"
                {{ $attributes->merge(['class' => "$class"]) }}>
                <h6 class="m-0">{{$to->label}}</h6>
            </button>
        @else
            <input type="hidden" value="{{$assigner['for']->id}}" name="{{$assigner['forName']}}">
            <input type="hidden" value="{{$to->name}}" name="{{$assigner['toName']}}">
            <button {{$assigner['for']->name == 'admin' ? 'disabled' : ''}}
                    class="anime hover-delete btn-sm btn my-1 px-2
                    rounded-pill btn-primary shadow-sm-primary">
                <h6 class="m-0">{{$to->label}}</h6>
            </button>
        @endif
    </form>
@endforeach
