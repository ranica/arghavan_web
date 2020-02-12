import Store from './store';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import VueFormWizard from 'vue-form-wizard';
import CardSearch from '../Components/CardSearchWidget';
Vue.use(VueFormWizard)

window.v = new Vue({
    el: '#app',
    store: Store,

    components: {
        CardSearch,
        persianCalendar: VuePersianDatetimePicker
    },

    data: {
        searchWord: null,
        lastGroupId: 0,
        formMode: Enums.FormMode.normal,
        format: 1,
        page: 1,
        isLoading: true,
        insertMode: false,
        selectedPersonId: null,
        tempRecord: {},
        lastTimerId: -1,
    },

     watch:{
        /**
         * Search word watcher
         */
        searchWord(oldWord, newWord) {
            clearTimeout(this.lastTimerId);

            this.lastTimerId = setTimeout (() => {
                this.loadRecords(1,
                                 this.lastGroupId,
                                 this.searchWord);
            }, 500);
        }
    },

    created() {
        this.tempRecord = this.emptyRecord;
    },

    mounted() {
        this.filterUsers(document.pageData.group_students);
        this.loadGroups(),
        this.loadCardtypes()
    },

    computed: {
        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,
        isSearchMode: state => state.formMode == Enums.FormMode.search,
        isAssignGatedevice: state => state.formMode == Enums.FormMode.assignGatedevice,


        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),

        groups: state => state.$store.getters.groups,
        cardtypes: state => state.$store.getters.cardtypes,
        searchdata: state => state.$store.getters.searchdata,
        searchDataCard: state => state.$store.getters.searchDataCard,
        hasSearchDataCard: state => (0 < state.searchDataCard.length),
        hasSearch: state => (0 < state.searchdata.length),

        carddata: state => state.$store.getters.carddata,
        gatedevices: state => state.$store.getters.gatedevices,

        emptyRecord() {
            return {
                id: 0,
                cdn: '',
                state: 0,
                startDate: '',
                endDate: '',
                user: { id: 0 },
                group: { id: 0 },
                cardtype: {id: 0 },
            };
        },
    },

    methods: {
        /**
         * Convert gregorian date to persian
         */
        toPersian(gDate) {
            return window.Helper.gregorianToJalaali(gDate);
        },
        /**
         * Convert persian date to gregorian
         */
        toGregorian(pDate) {
            return window.Helper.jalaaliToGregorian(pDate);
        },
         /**
         * Change form mode
         */
        changeFormMode(formMode) {
            this.formMode = formMode;
        },
        /**
         * Show Invisible items
         */
        showInvisibleItems() {
            document.querySelectorAll('.invisible')
                .forEach(item => {
                    item.classList.remove('invisible');
                });
        },
        /**
         * Clear errors
         */
        clearErrors() {
            this.errors.clear();
            document.querySelectorAll('.form-control')
                .forEach(x => {
                    $(x).removeClass('has-error')
                        .parent()
                        .addClass('label-floating is-empty');
                });
        },
        /**
         * Filter users
         */
        filterUsers(groupId) {
            this.lastGroupId = groupId;
            this.loadRecords(1, groupId, this.searchWord);
        },
         /**
         * Load Records list
         */
        loadRecords(page, id, searchWord) {
            id = (id == undefined) ? this.lastGroupId : id;

            if (this.$store.getters.searchMode){
                this.searchCard(page);
                return;
            }
            this.$store.dispatch('loadGatedevices');

            let data = {
                page: page,
                id: id,
                searchWord: searchWord
            };
            this.$store.dispatch('loadRecords', data)
                .then(res => {
                    Helper.scrollToApp ();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },
         /**
         * New record dialog
         */
        newRecord() {
            var today = new Date();
            var year = today.getFullYear();
            var month = today.getMonth();
            var day = today.getDate();

            var nextYear = new Date(year + 1, month, day);
            this.tempRecord = Object.assign({}, this.emptyRecord);
            this.$refs.register_wizard.reset();

            this.tempRecord.startDate = window.DateTime.toPersianDate (new Date());
            this.tempRecord.endDate = window.DateTime.toPersianDate (nextYear );
            this.clearErrors();
            // this.fillComoboxes();
            this.changeFormMode(Enums.FormMode.register);
        },
         /**
         * Hide insert/update modal
         */
        registerCancel() {
            this.tempRecord = this.emptyRecord;
            this.changeFormMode(Enums.FormMode.normal);
        },
         /**
         * Load Groups list
         */
        loadGroups() {
            this.$store.dispatch('loadGroups')
                .then(res => {
                    Helper.scrollToApp ();

                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },
        /**
         * Load Cardtypes list
         */
        loadCardtypes() {
            this.$store.dispatch('loadCardtypes')
                .then(res => {
                    Helper.scrollToApp ();

                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },
         /**
        *Fill Combobox when load form
        */
        fillComoboxes() {
            /**
             * Card Type Combo
             */
            if ( (undefined != this.$store.getters.cardtypes[0]) ||
                    (null != this.$store.getters.cardtypes[0]) ){
                this.tempRecord.cardtype.id = this.$store.getters.cardtypes[0].id;
            }
            else {
                this.tempRecord.cardtype.id = 0;
            }

            /**
             *  Group Combo
             */
            if ( (undefined != this.$store.getters.groups[0]) ||
                   (null != this.$store.getters.groups[0]) ){
                this.tempRecord.group.id = this.$store.getters.groups[0].id;
            }
            else {
                this.tempRecord.group.id = 0;
            }
        },
         /**
        *  Prapare Edit data
        */
        prepareEdit(record){
            let data = {
                id: record.id,
                cdn: record.cdn,
                state: record.state,
                startDate: record.startDate,
                endDate: record.endDate,

                user: {
                    id: record.users[0].id,
                     group: {
                         id: record.users[0].group.id,
                    },
                },
                cardtype: {
                    id: record.cardtype.id,
                    name: record.cardtype.name
                }
            };
            this.editRecord(data);
        },
         /**
         * Edit a record
         */
        editRecord(record) {
            this.clearErrors();
            this.insertMode = true;

            this.tempRecord = {
                id: record.id,
                cdn: record.cdn,
                state: record.state,
                startDate: Helper.gregorianToJalaali(record.startDate),
                endDate: Helper.gregorianToJalaali(record.endDate),
                user: {
                    id: record.user.id,
                },
                group: {
                    id: record.user.group.id,
                },
                cardtype: {
                    id: record.cardtype.id,
                    name: record.cardtype.name
                }
            };
            // Show register mode
            this.$refs.register_wizard.changeTab(0,2);
            this.formMode = Enums.FormMode.register;
        },
        /**
         * Delete a record
         */
        deleteRecord() {
            this.isLoading = true;

            this.$store.dispatch('deleteRecord', this.tempRecord.id)
                .then(res => {
                    this.isLoading = false;

                    demo.showNotification('حذف رکورد با موفقیت انجام شد', 'success');
                    this.tempRecord = $.extend(true, {}, this.emptyRecord);
                })
                .catch(err => {
                    demo.showNotification('خطا در حذف رکورد! این خطا در سامانه ذخیره شد و مورد بررسی قرار خواهد گرفت', 'danger');
                });
        },

        /**
         * Save record
         */
        saveRecord() {
            return Promise.all([
                this.$validator.validate('cardtype_id'),
                this.$validator.validate('cdn'),
                this.$validator.validate('startDate'),
                this.$validator.validate('endDate'),
              ]).then ((resolve, reject) => {
                    var hasErr = this.errors.any ();
                    if (! hasErr)
                    {
                        this.createRecord();
                        return true;
                  }

                  let err = this.errors.all ();

                  err = err.join ('<br/>');
                  demo.showNotification(err, 'warning');

                return false;
              });
        },
         /**
         * Tab Switch Search
         */
        tabSwitchSearch(){
            this.errors.clear ();

            return Promise.all([
                this.$validator.validate('group_id'),
                this.$validator.validate('search')
              ]).then ((resolve, reject) => {
                    var hasErr = this.errors.any ();

                    if (! hasErr)
                    {
                        this.searchRecord();
                        return true;
                    }

                  let err = this.errors.all ();

                  err = err.join ('<br/>');
                  demo.showNotification(err, 'warning');

                return false;
              });
        },
        /**
         * Search Data Record
         */
        searchRecord() {
            // Prepare data
            let data = {
                search: this.tempRecord.search,
                group_id: this.tempRecord.group.id,
            };

            this.isLoading = true;

            // Try to Search
            this.$store.dispatch('searchRecord', data)
                .then(res => {
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;

                    demo.showNotification(err.message, 'danger');
                });
        },
         /**
         * Tab Switch Search
         */
        tabSwitchUser(){
            this.errors.clear ();
            if (null != this.selectedPersonId) {
                return true;
            }
            else{
                demo.showNotification('شخص مورد نظر را انتخاب نمایید', 'warning');
            }
        },
        /**
         * Tab Switch Card
         */
        tabSwitchCard (){
            this.errors.clear ();

            return Promise.all([
                this.$validator.validate('cardtype_id'),
                this.$validator.validate('cdn'),
                this.$validator.validate('startDate'),
                this.$validator.validate('endDate'),

              ]).then ((resolve, reject) => {
                  var hasErr = this.errors.any ();

                  if (! hasErr)
                  {
                      return true;
                  }
                  let err = this.errors.all ();
                  err = err.join ('<br/>');
                  demo.showNotification(err, 'warning');

                return false;
              });
        },
        /**
        *  show Modal list card
        */
        showCard(userData){
            if (userData.cards.length > 0){
                this.modalMode = Enums.FormMode.normal;
                $("#cardModal").modal('show');
            }
        },
        /**
         * Selection Changed
         */
        selectionChanged(userData) {
            this.selectedPersonId = userData.id;
            this.tempRecord.user.id = userData.id;
        },
         /**
        * Craete and Update Record
        */

        createRecord(){
            // Prepare data
            let data = {
                id: this.tempRecord.id,
                card:{
                    id: this.tempRecord.id,
                    cdn: this.tempRecord.cdn,
                    state: this.tempRecord.state,
                    startDate: Helper.jalaaliToGregorian(this.tempRecord.startDate),
                    endDate: Helper.jalaaliToGregorian(this.tempRecord.endDate),
                    cardtype_id: this.tempRecord.cardtype.id,
                },
                user:{
                    id: this.tempRecord.user.id,
                    group_id: this.tempRecord.group.id,
                }
            };

            this.isLoading = true;

            // Try to save
            this.$store.dispatch('saveRecord', data)
                .then(res => {
                    this.isLoading = false;

                    if (res) {
                        demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                        this.registerCancel();
                    }
                    else {
                        demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                    }
                })
                .catch(err => {
                    this.isLoading = false;

                    if (err.response.status) {
                        demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                    }
                    else {
                        demo.showNotification(err.message, 'danger');
                    }
                });
            return;
        },
         /**
         * Prepare to delete
         */
        readyToDelete(record) {
            this.tempRecord.id = record.id;
        },

        /**
         * Set Gatedevice to record
         */
        setGatedeviceRecord(record) {
            console.log(' setGateDEvice -> record', record);
            this.formMode = Enums.FormMode.assignGatedevice;

            this.errors.clear();
            this.tempRecord.id = record.id;
            // this.tempRecord = Object.assign({}, record);
            // this.tempRecord.group.id =0;
            // this.tempRecord.user.id = 0;
            // this.tempRecord.cardtype.id = 0;

            // Update Gatedevices checked state
            this.gatedevices.forEach(gatedevice => {
                gatedevice.checked = false;

                let res = record.gatedevices.filter(groupDevice => groupDevice.id == gatedevice.id);

                gatedevice.checked = (res.length > 0);
            });
        },

        /**
         * Save Gatedevice Record
         */
        saveGatedeviceRecord(){
            console.log('saveGatedeviceRecord');
            // this.$validator.validateAll()
            //     .then(result => {
            //         if (result) {

                        // Prepare data
                        let data = {
                            card_id: this.tempRecord.id,
                            gatedevices: []
                        };

                        data.gatedevices = this.gatedevices.filter(el => el.checked == true)
                                                           .map(el => el.id);
                        this.isLoading = true;

                        // Try to save
                        console.log('save gate device -> data', data);
                        this.$store.dispatch('saveGatedeviceRecord', data)
                            .then(res => {
                                this.isLoading = false;

                                if (res) {
                                    demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                                    this.registerCancel();
                                }
                                else {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                                }
                            })
                            .catch(err => {
                                this.isLoading = false;

                                if (err.response.status) {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                                }
                                else {
                                    demo.showNotification(err.message, 'danger');
                                }
                            });
                        return;
                    // }
                    // demo.showNotification('خطا', 'خطاها را بر طرف نمایید');
                // });
        }


    }
});
