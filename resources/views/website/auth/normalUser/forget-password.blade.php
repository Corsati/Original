<div class="modal fade" id="forgetModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">{{__('web.reset')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{setAsset('website/img/close.png')}}" alt="close">
                </button>
            </div>
            <div class="modal-body" style="overflow: hidden;">
                <form action="{{route('coursati.forgot')}}"  method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="email"  required name="email" class="form-control" id="nameOremailInput" placeholder="{{__('web.email')}}">
                    </div>

                         <button type="submit" class="orangeBtn"  style="width: 100%" >{{__('web.send')}}</button>
                 </form>
            </div>
        </div>
    </div>
</div>
