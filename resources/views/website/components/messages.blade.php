@foreach($conversations as $conversation)
    <div class="{{$conversation->s_id == auth()->id() ? 'rightCont' : 'leftCont' }}">
        <div class="rightText">
            @if($conversation->type == 'text')
                {{$conversation->message}}
            @elseif($conversation->type == 'image')
                <img height="100" width="110" class="myImg" data-src="{{setUrl('storage/images/chat/',$conversation->message)}}"  src="{{setUrl('storage/images/chat/',$conversation->message)}}">
            @elseif($conversation->type == 'video')
                <video width="320" height="240" controls>
                    <source src="{{setUrl('storage/images/chat/',$conversation->message)}}" type="video/mp4">
                    <source src="{{setUrl('storage/images/chat/',$conversation->message)}}" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
            @else
                <a href="{{setUrl('storage/images/chat/',$conversation->message)}}" target="_blank">
                    <img height="100" width="110"   src="{{setAsset('website/img/file.png')}}">
                </a>
            @endif
        </div>
        <div class="time">
            <i class="fas fa-check-double"></i>
            {{$conversation->created_at->diffForHumans()}}
        </div>
    </div>
@endforeach