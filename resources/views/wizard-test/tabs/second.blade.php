<!-- Fifth Tab : Image -->
<tab-content title="ثبت تصویر"
             icon="far fa-image">
    <div class="card">
    <!-- Card Content -->
        <div class="card-content f-BYekan">
            <div class="col-lg-10 col-lg-offset-1">
                <form>
                    <div class="row">
                        <div class="text-center">
                            <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                <div class="fileinput-new thumbnail">
                                    <img src="" alt="...">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                <div>
                                    <span class="btn btn-rose btn-round btn-file">
                                        <span class="fileinput-new">انتخاب تصویر</span>
                                        <span class="fileinput-exists">ویرایش</span>
                                        <input type="file"
                                                name="picture"
                                                @change="fileSelect"
                                                id="wizard-picture">
                                    </span>
                                    <a href="#"
                                        class="btn btn-danger btn-round fileinput-exists"
                                        data-dismiss="fileinput">
                                        <i class="fa fa-times"></i> حذف
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</tab-content>

<!-- /Fifth Tab : Image -->
