<div class="modal fade" id="messageOneModel">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <div class="modal-header"><h6 class="modal-title">مراسلة</h6></div>


            <div class="card card-primary card-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs text-md notify-ul" id="custom-tabs-two-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#email-one-tab" role="tab" aria-controls="to-email" aria-selected="true">ايميل</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#sms-one-tab" role="tab" aria-controls="to-sms" aria-selected="false">رساله SMS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#notify-one-tab" role="tab" aria-controls="to-notify" aria-selected="false">اشعار</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">


                    <div class="tab-content" id="custom-tabs-two-tab">

                        <!---------------- Email ------------------>
                        <div class="tab-pane fade show active" id="email-one-tab" role="tabpanel"
                             aria-labelledby="to-main">
                            <form action="{{route('admin.settings.message.one','email')}}" method="POST">
                                @csrf

                                <input type="hidden" name="user_id"  class="notify_user_id">
                                <div class="col-sm-12">
                                    <textarea rows="15" name="message" class="form-control" placeholder="نص رسالة الـ Email "  required></textarea>
                                </div>1
                                <div class="col-sm-12" style="margin-top: 10px">
                                    <button type="submit" class="btn btn-primary addCategory">ارسال</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">أغلاق</button>
                                </div>
                            </form>
                        </div>

                        <!---------------- SMS ------------------>
                        <div class="tab-pane fade" id="sms-one-tab" role="tabpanel" aria-labelledby="to-social">

                            <form action="{{route('admin.settings.message.one','sms')}}" method="POST">
                                @csrf

                                <input type="hidden" name="user_id"  class="notify_user_id">
                                <div class="col-sm-12">
                                    <textarea rows="15" name="message" class="form-control" placeholder="نص رسالة الـ SMS "></textarea>
                                </div>
                                <div class="col-sm-12" style="margin-top: 10px">
                                    <button type="submit" class="btn btn-primary addCategory">ارسال</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">أغلاق</button>
                                </div>
                            </form>
                        </div>

                        <!---------------- Notification ------------------>
                        <div class="tab-pane fade" id="notify-one-tab" role="tabpanel" aria-labelledby="to-social">
                            <form action="{{route('admin.settings.message.one','notification')}}" method="POST">
                                @csrf

                                <input type="hidden" name="user_id" class="notify_user_id">
                                <div class="col-sm-12">
                                    <textarea rows="15" name="body" class="form-control" placeholder="نص رسالة الـ Notification " required></textarea>
                                </div>
                                <div class="col-sm-12" style="margin-top: 10px">
                                    <button type="submit" class="btn btn-primary addCategory">ارسال</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">أغلاق</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

