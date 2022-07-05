<div class="modal fade" id="sendEmailModel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header"><h6 class="modal-title">ارسال ايميل ل {{$email}}</h6></div>
            <div class="modal-body p-2">
                <form action="{{route('admin.settings.send_email')}}" method="POST">
                    @csrf

                    <input type="hidden" name="email" value="{{$email}}">
                    <div class="col-sm-12">
                        <textarea rows="15" name="message" class="form-control" placeholder="نص رسالة الـ Email "  required></textarea>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-primary">ارسال</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

