<div class="form-horizontal f-BYekan pad-all-1em pad-rem-top"
      id="fingerPrintForm">
  <div class="card">
    <div class="card-header card-header-icon" data-background-color="rose">
      ثبت و بررسی اثر انگشت
            {{-- @{{ tempRecord.user.code }} --}}
    </div>

    {{-- Card Content --}}
    <div class="card-content f-BYekan">

      <form class="pd-top-35em pd-bottom-2em" data-vv-scope ="FingerPrintScope">
        <div class="col-sm-12 col-md-12  col-12 mr-auto ml-auto">
          <div class="card-body">
            <div class="row justify-content-center">

            <!--   <div class="col-sm-4">
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                  <div class="fileinput-new thumbnail">
                    <img :src="tempRecord.fingerprint.image" alt="...">
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail"></div>
                </div>
              </div> -->
              <!-- If Show Image finger col-sm-8 active
              <div class="col-sm-8">-->
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-md-6">

                    <!-- Code field -->
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">account_box</i>
                      </span>

                      <div class="form-group label-floating">
                        <label class="control-label">شماره کاربری</label>
                        <input name="code"
                                disabled
                                type="text"
                                class="form-control"
                                v-model="tempRecord.user.code">
                      </div>
                    </div>
                    <!--  /Code Field  -->
                  </div>

                  <!-- Name and Lastname field -->
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">face</i>
                      </span>
                      <div class="form-group label-floating">
                        <label class="control-label">نام و نام خانوادگی</label>
                        <input name="code"
                                disabled
                                type="text"
                                class="form-control"
                                v-model="tempRecordPeopleFullName">
                      </div>
                    </div>
                  </div>
                  <!--  / Name and Lastname Field  -->
                </div>

                <!-- Quality field -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">fingerprint</i>
                      </span>
                      <div class="form-group label-floating">
                        <label class="control-label">کد اثرانگشت شما</label>
                        <input name="code"
                                disabled
                                type="text"
                                class="form-control"
                                v-model="tempRecord.fingerprint.code">
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="material-icons">face</i>
                      </span>
                      <div class="form-group label-floating">
                        <label class="control-label">کیفیت اثرانگشت ثبت شده</label>
                        <input name="code"
                                disabled
                                type="text"
                                class="form-control"
                                v-model="tempRecord.fingerprint.imageQuality">
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Finger Right --}}
                <div class="row text-center">
                  <div class="btn-group"
                      data-toggle="buttons">

                    <button type="button"
                          class="col-md-2 col-sm-6 col-xs-12 btn btn-lg btn-round btn-info">
                        &nbsp
                      <div class="ripple-container"></div>
                    </button>

                    <button type="button"
                            @click="selectFinger(finger)"
                            class="col-md-2 col-sm-6 col-xs-12 btn btn-lg btn-round btn-default"
                            :class="{ 'btn-primary': finger_index == finger.index, }"
                            v-for="finger in fingers_right">

                        @{{ finger.name }}

                      <div class="ripple-container"></div>
                    </button>
                  </div>
                </div>

                {{-- Finger Left --}}
                <div class="row text-center">
                  <div class="btn-group"
                      data-toggle="buttons">

                    <button type="button"
                          @click="selectFinger(finger)"
                          class="col-md-2 col-sm-6 col-xs-12 btn btn-lg btn-round btn-default"
                          :class="{ 'btn-primary': finger_index == finger.index, }"
                          v-for="finger in fingers_left">
                        @{{ finger.name }}
                      <div class="ripple-container"></div>
                    </button>

                    <button type="button"
                          class="col-md-2 col-sm-6 col-xs-12 btn btn-lg btn-round btn-info">
                          &nbsp
                      <div class="ripple-container"></div>
                    </button>

                  </div>
                </div>
                <hr>
              </div>

                <div class="row text-center">
                  <input type="submit"
                    value="ثبت اثرانگشت"
                    class="btn btn-fill btn-rose"
                    @click.prevent="enroll()">

                  <input type="button"
                          value="شناسایی اثرانگشت"
                          class="btn btn-fill btn-rose"
                          @click.prevent="identify()">

                  <input type="button"
                          value="انصراف"
                          class="btn btn-fill btn-default"
                          @click.prevent="registerCancel">
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
    {{-- /Card Content --}}
  </div>
</div>


