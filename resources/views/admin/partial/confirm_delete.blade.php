<div class="modal fade" id="delete-model">
    <div class="modal-dialog model-sm">
        <div class="modal-content">
            <form action="" method="post" id="confirm-delete-form">
                @csrf
                @method('delete')
                <div class="modal-header"><h6 class="modal-title">تأكيد الحذف</h6></div>
                <div class="modal-body p-5"><h5 class="text-center">هل انت متاكد من عملية الحذف</h5></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>
