import Store from '../Stores/SmsStore';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

window.v = new Vue({
    el: '#app',
    store: Store,

    components: {
        persianCalendar: VuePersianDatetimePicker
    },

    data: {
        formMode: Enums.FormMode.normal,
        x:70,
        page: 1,
        lenMessage: 0,
        countMessage: 1,
        cReceive: 0,
        isLoading: true,
        insertMode: false,
        selectedPersonId: null,
        tempRecord: {},
    },

    created() {
        this.tempRecord = this.emptyRecord;
    },

    mounted() {
        //this.filterUsers(document.pageData.group_students);
        this.init();
        this.loadRecords(this.page)
            .then(res => {
                let hValue = Helper.getUrlParameter('send_sms');

                if (hValue == "1") {
                    this.newRecord();
                }
            });
    },

    computed: {
        /**
         * Generate new Empty record
         */
        emptyRecord() {
            return {
                id: 0,
                from: '',
                to: '',
                message: '',
                status: 0,
                response: '',
                user: {
                    id: 0,
                },
            };
        },

        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,
        isSearchMode: state => state.formMode == Enums.FormMode.search,

        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),
    },

    methods: {

        messageLenght() {
            this.lenMessage = this.tempRecord.message.length;
            this.countMessage = Math.floor(this.tempRecord.message.length / this.x) + 1;
            return;
        },

        receiveCount(){
            this.getLenght(this.tempRecord.to);
        },
        //     var format = /[\n\r,]/;
        //     var str = [this.tempRecord.to];
        //     var m;
        //     var result = new Array();

        //     for(var i = 0; i < str.length; i++) {
        //       result[i] = str[i] + "->";
        //       while ((m = format.exec(str[i])) !== null) {
        //           if (m.index === format.lastIndex) {
        //              format.lastIndex++;
        //           }
        //           // View your result using the m-variable.
        //           // eg m[0] etc.
        //         result[i] += m[1];
        //         result[i] += m[2] + ",";
        //       }
        //     }

        // },

        getLenght(str)
        {
            var result,
                count = 1,
                i;
            var format = /[\n\r,]/;

            if (!str) {
                return "";
            }

            //result = str.charAt(0);
            for (i = 1; i < str.length; i++) {
                if (str.charAt(i).match(format)) {
                    result += count + str.charAt(i);
                    count += 1;

                } else {
                    count = 1;
                }
            }

        },


        //     var format = /[\n\r,]/;
        //         let str = this.tempRecord.to;
        //         if (0 != this.tempRecord.to.length)
        //         {
        //             for (var i = 0; i < this.tempRecord.to.length; i++) {

        //                     this.cReceive  =  str.toLowerCase().split("").sort().join("").match(format).length;

        //             }
        //     }
        // },

        init() {
            $('#smartwizard')
                .smartWizard({
                    selected: 0, // Initial selected step, 0 = first step
                    keyNavigation: true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
                    autoAdjustHeight: true, // Automatically adjust content height
                    cycleSteps: false, // Allows to cycle the navigation of steps
                    backButtonSupport: true, // Enable the back button support
                    useURLhash: true, // Enable selection of the step based on url hash
                    lang: { // Language variables
                        next: 'بعدی',
                        previous: 'قبلی'
                    },

                    toolbarSettings: {
                        toolbarPosition: 'bottom', // none, top, bottom, both
                        toolbarButtonPosition: 'right', // left, right
                        showNextButton: true, // show/hide a Next button
                        showPreviousButton: true, // show/hide a Previous button
                        toolbarExtraButtons: [
                            $('<button></button>')
                            .text('پایان')
                            .addClass('btn btn-info')
                            .on('click', () => {
                                this.saveRecord();
                            }),

                            $('<button></button>')
                            .text('انصراف')
                            .addClass('btn btn-danger')
                            .on('click', () => {
                                let ctl = $('#smartwizard');

                                Helper.smartWizardReset(ctl);

                                this.registerCancel();
                            })
                        ]
                    },
                    anchorSettings: {
                        anchorClickable: true, // Enable/Disable anchor navigation
                        enableAllAnchors: false, // Activates all anchors clickable all times
                        markDoneStep: true, // add done css
                        enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                    },
                    contentURL: null, // content url, Enables Ajax content loading. can set as data data-content-url on anchor
                    disabledSteps: [], // Array Steps disabled
                    errorSteps: [], // Highlight step with errors
                    theme: 'circles',
                    transitionEffect: 'fade', // Effect on navigation, none/slide/fade
                    transitionSpeed: '400',
                    // Initialize the leaveStep event
                });

            // $("#smartwizard").on("leaveStep", this.onLeaveSearchStep);
        },

        /**
         * On leave search step
         */
        onLeaveSearchStep() {
            let ctl = $('#smartwizard');
            let currentIndex = Helper.smartWizardCurrentStepIndex(ctl);

            switch (currentIndex) {
                case 0:
                    //this.searchRecord();
                    return true;
                    break;

                case 1:
                    if (null != this.selectedPersonId) {
                        //this.loadCard();

                        return true;
                    } else {
                        return false;
                    }
            }
        },

        /**
         * Convert gregorian date to persian
         */
        toPersian(gDate){
            return window.Helper.gregorianToJalaaliByTime(gDate);
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
         * Load Records list
         */
        loadRecords(page) {
            return new Promise((resolve, reject) => {
                this.page = page;
                this.isLoading = true;

                this.$store.dispatch('loadRecords', page)
                    .then(res => {
                        this.isLoading = false;

                        this.showInvisibleItems();

                        return resolve();
                    })
                    .catch(err => {
                        this.isLoading = false;

                        this.showInvisibleItems();

                        return reject();
                    });
            });
        },

        /**
         * New record dialog
         */
        newRecord() {
            $('#smartwizard')
                .smartWizard()
                .data()
                .smartWizard.reset();
            this.x = 70;
            this.lenMessage = 0;
            this.countMessage = 1;
            this.clearErrors();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.changeFormMode(Enums.FormMode.register);
        },

        /**
         * Save Record
         */
        saveRecord(user_id) {
            this.isLoading = true;
            let data = {
                to: this.tempRecord.to,
                message: this.tempRecord.message,
            }

            this.$store.dispatch('saveRecord', data)
                .then(res => {
                    this.isLoading = false;

                    demo.showNotification('ارسال پیام با موفقیت انجام شد', 'success');
                    this.registerCancel();
                    this.loadRecords(1);
                })
                .catch(err => {
                    demo.showNotification('خطا در ارسال پیام');
                });
        },

        /**
         * Hide insert/update modal
         */
        registerCancel() {
            this.tempRecord = this.emptyRecord;

            this.changeFormMode(Enums.FormMode.normal);
        },

        /**
         * Prepare to delete
         */
        readyToDelete(record){
            this.tempRecord = record;
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
                    this.tempRecord = {};
                })
                .catch(err => {
                    demo.showNotification('خطا در حذف رکورد! این خطا در سامانه ذخیره شد و مورد بررسی قرار خواهد گرفت', 'danger');
                });
        },

    }
});
