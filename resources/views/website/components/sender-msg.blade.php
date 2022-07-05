<div class="rightCont">
    <div class="rightText">
        @if($chat->type == 'text')
            {{$chat->message}}
        @elseif($chat->type == 'image')
            <img height="100" width="110" src="{{setUrl('storage/images/chat/',$chat->message)}}">
        @elseif($chat->type == 'video')
            <video width="320" height="240" controls>
                <source src="{{setUrl('storage/images/chat/',$chat->message)}}" type="video/mp4">
                <source src="{{setUrl('storage/images/chat/',$chat->message)}}" type="video/ogg">
                Your browser does not support the video tag.
            </video>
        @else
            <a href="{{setUrl('storage/images/chat/',$chat->message)}}" target="_blank">
                <img height="100" width="110"   src="{{setAsset('website/img/file.png')}}">
            </a>
        @endif
    </div>
</div>