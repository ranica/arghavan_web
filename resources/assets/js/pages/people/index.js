import Store from './store';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
import VueFormWizard from 'vue-form-wizard';
Vue.use(VueFormWizard)

window.v = new Vue({
    el: '#app',
    store: Store,

    components: {
        persianCalendar: VuePersianDatetimePicker,
    },

    data: {
        wizardSelectedButton:'',
        userCodeExists: false,
        searchWord: null,
        currentTabIndex: 0,
        lastGroupId: 0,
        people_id_parent: 0,
        parent: false,
        term: false,
        gateGroup: false,
        fingerprint: false,
        gatePlan: false,

        modalMode: Enums.FormMode.normalModal,
        formMode: Enums.FormMode.normal,
        grouptype: 0,
        page: 1,
        isLoading: true,
        insertMode: false,
        updateMode: false,
        file: null,
        url: '',
        fingers_right: [
            { index: 0, name: 'شست' },
            { index: 1, name: 'اشاره' },
            { index: 2, name: 'سبابه' },
            { index: 3, name: 'انگشتری' },
            { index: 4, name: 'کوچک' },
        ],
        fingers_left: [
            { index: 5, name: 'شست' },
            { index: 6, name: 'اشاره' },
            { index: 7, name: 'سبابه' },
            { index: 8, name: 'انگشتری' },
            { index: 9, name: 'کوچک' },
        ],
        finger_index: 0,

        tempRecord: {
            user: {},
            people: {},
            student: {},
            teacher: {},
            staff: {},
            card: {},
            parent: {},
            fingerprint: {},
        },

        lastTimerId: -1,
    },

    watch: {
        /**
         * Search word watcher
         */
        searchWord(oldWord, newWord) {
            clearTimeout(this.lastTimerId);

            this.lastTimerId = setTimeout(() => {
                this.loadRecords(1,
                    this.lastGroupId,
                    this.searchWord);
            }, 500);
        }
    },

    created() {
        this.tempRecord.user = this.emptyRecord.user;
        this.tempRecord.people = this.emptyRecord.people;
        this.tempRecord.student = this.emptyRecord.student;
        this.tempRecord.teacher = this.emptyRecord.teacher;
        this.tempRecord.staff = this.emptyRecord.staff;
        this.tempRecord.card = this.emptyRecord.card;
        this.tempRecord.parent = this.emptyRecord.parent;
        this.tempRecord.fingerprint = this.emptyRecord.fingerprint;

        this.prepare();
    },

    mounted() {
        this.filterUsers(document.pageData.people.group_students);
        this.setImageLoader();

        var base = this;
        document.querySelector('[name="nationalId"]')
            .addEventListener('blur', () => {
                base.existsNationalId();
            });

        document.querySelector('[name="code"]')
            .addEventListener('blur', () => {
                base.existCode();
            });
    },

    computed: {
        tempRecordPeopleFullName() {
            if (this.tempRecord == null) {
                return '';
            }

            return this.tempRecord.people.name + ' ' +
                this.tempRecord.people.lastname;
        },

        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,
        isAssignGrouppermit: state => state.formMode == Enums.FormMode.assignGrouppermit,
        isAssignGateGroup: state => state.formMode == Enums.FormMode.assignGateGroup,
        isAssignGatePlan: state => state.formMode == Enums.FormMode.assignGatePlan,
        isAssignTerm: state => state.formMode == Enums.FormMode.assignTerm,
        isAssignFingerPrint: state => state.formMode == Enums.FormMode.assignFingerPrint,

        isNormalModalMode: state => state.modalMode == Enums.FormMode.normal,
        isRegisterParentMode: state => state.modalMode == Enums.FormMode.register,

        isStaff() { return (this.grouptype == 1); },
        isTeacher() { return (this.grouptype == 2); },
        isStudent() { return (this.grouptype == 3); },
        isShowParent() { return this.parent; },
        isShowTerm() { return this.term; },
        isShowGateGroup() { return this.gateGroup; },
        isShowGatePlan() { return this.gatePlan; },
        isShowFingerPrint() { return this.fingerprint; },
        /*
        User Info
        */
        groups: state => state.$store.getters.baseInformation.groups,
        melliats: state => state.$store.getters.baseInformation.melliats,
        genders: state => state.$store.getters.baseInformation.genders,
        provinces: state => state.$store.getters.baseInformation.provinces,
        situations: state => state.$store.getters.baseInformation.situations,
        degrees: state => state.$store.getters.baseInformation.degrees,
        parts: state => state.$store.getters.baseInformation.parts,
        universities: state => state.$store.getters.baseInformation.universities,
        cities: state => state.$store.getters.cities,
        fieldData: state => state.$store.getters.fieldData,
        peopleData: state => state.$store.getters.peopleData,
        /*
        Staff Info
        */
        departments: state => state.$store.getters.baseInformation.departments,
        contracts: state => state.$store.getters.baseInformation.contracts,
        grouppermits: state => state.$store.getters.baseInformation.grouppermits,
        gategroups: state => state.$store.getters.baseInformation.gategroups,
        gateplans: state => state.$store.getters.baseInformation.gateplans,
        cardtypes: state => state.$store.getters.baseInformation.cardtypes,
        terms: state => state.$store.getters.terms,
        /*
        Parents
        */
        kintypes: state => state.$store.getters.baseInformation.kintypes,
        parents: state => state.$store.getters.parents,
        hasParent: state => (0 < state.parents.length),

        records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),

        emptyRecord: () => { return {
                                    id: 0,
                                    user: {
                                        id: 0,
                                        code: '',
                                        email: '',
                                        password: '',
                                        state: 0,
                                        group:{
                                            id:0
                                        },
                                        people: {
                                            id: 0
                                        },
                                        level:{
                                            id :0
                                        },
                                    },
                                    people: {
                                        id: 0,
                                        name: '',
                                        lastname: '',
                                        nationalId: '',
                                        birthdate: '',
                                        // father    : '',
                                        phone: '',
                                        mobile: '',
                                        address: '',
                                        pictureUrl: '',
                                        file: null,

                                        melliat: {
                                            id: 0
                                        },
                                        gender: {
                                            id: 0
                                        },
                                        province: {
                                            id: 0
                                        },
                                        city: {
                                            id: 0
                                        },
                                    },

                                    student: {
                                        id: 0,
                                        term: {
                                            id: 0,
                                            semester: {
                                                id: 0,
                                            }
                                        },
                                        native: 0,
                                        suit: 0,
                                        situation: {
                                            id: 0
                                        },
                                        degree: {
                                            id: 0
                                        },
                                        part: {
                                            id: 0
                                        },
                                        field: {
                                            id: 0
                                        },
                                        university: {
                                            id: 0
                                        },
                                    },

                                    teacher: {
                                        id: 0,
                                        semat: '',
                                    },
                                    staff: {
                                        id: 0,
                                        contract: {
                                            id: 0
                                        },
                                        department: {
                                            id: 0
                                        }
                                    },

                                    card: {
                                        id: 0,
                                        cdn: '',
                                        state: 0,
                                        startDate: '',
                                        endDate: '',
                                        user: {
                                            id: 0,
                                        },
                                        group: {
                                            id: 0
                                        },
                                        cardtype: {
                                            id: 0
                                        },
                                    },

                                    parent: {
                                        id: 0,
                                        name: '',
                                        lastname: '',
                                        phone: '',
                                        mobile: '',
                                        address: '',
                                        kintype: {
                                            id: 0,
                                        },
                                        people: {
                                            id: 0,
                                        },
                                    },

                                    fingerprint: {
                                        id: 0,
                                        user: {
                                            id: 0,
                                        },
                                        code: 0,
                                        imageQuality: 0,
                                        image: null,
                                    },
                                }
                        },
    },


    methods: {
         /**
         * Generate new Empty record
         */
        clearRecord(){
             this.tempRecord.id = 0;

            this.tempRecord.user.id = 0;
            this.tempRecord.user.code = '';
            this.tempRecord.user.password = '';
            this.tempRecord.user.email = '';
            this.tempRecord.user.state = 0;
            this.tempRecord.user.group.id = 0;
            this.tempRecord.user.group.name = '';
            this.tempRecord.user.people.id = 0;

            this.tempRecord.people.id =  0;
            this.tempRecord.people.name = '';
            this.tempRecord.people.lastname = '';
            this.tempRecord.people.nationalId = '';
            this.tempRecord.people.birthdate = '';
            this.tempRecord.people.phone = '';
            this.tempRecord.people.mobile =  '';
            this.tempRecord.people.address = '';
            this.tempRecord.people.pictureUrl= '',
            this.tempRecord.people.file =  null;
            this.tempRecord.people.melliat.id = 0;
            this.tempRecord.people.gender.id = 0;
            this.tempRecord.people.province.id = 0;
            this.tempRecord.people.city.id = 0;

            this.tempRecord.student.id = 0;
            this.tempRecord.student.term.id = 0;
            this.tempRecord.student.term.semester.id = 0;
            this.tempRecord.student.native = 0;
            this.tempRecord.student.suit = 0;
            this.tempRecord.student.situation.id = 0;
            this.tempRecord.student.degree.id = 0;
            this.tempRecord.student.part.id = 0;
            this.tempRecord.student.field.id = 0;
            this.tempRecord.student.university.id = 0;

            this.tempRecord.teacher.id = 0;
            this.tempRecord.teacher.semat = '';

            this.tempRecord.staff.id = 0;
            this.tempRecord.staff.contract.id = 0;
            this.tempRecord.staff.department.id = 0;

            this.tempRecord.card.id = 0;
            this.tempRecord.card.cdn = '';
            this.tempRecord.card.state = 0;
            this.tempRecord.card.startDate = '';
            this.tempRecord.card.endDate = '';
            this.tempRecord.card.user.id = 0;
            this.tempRecord.card.group.id = 0;
            this.tempRecord.card.cardtype.id = 0;

            this.tempRecord.parent.id = 0;
            this.tempRecord.parent.name = '';
            this.tempRecord.parent.lastname = '';
            this.tempRecord.parent.phone = '';
            this.tempRecord.parent.mobile = '';
            this.tempRecord.parent.address = '';
            this.tempRecord.parent.kintype.id = 0;
            this.tempRecord.parent.people.id = 0;

            this.tempRecord.fingerprint.id = 0;
            this.tempRecord.fingerprint.user.id = 0;
            this.tempRecord.fingerprint.code = 0;
            this.tempRecord.fingerprint.image = null;
            this.tempRecord.fingerprint.imageQuality = 0;
        },

        selectFinger(finger) {
            this.finger_index = finger.index;
        },

        /**
         * Gets the national identifier.
         */
        existsNationalId() {
            if (null == this.tempRecord.people.nationalId) {
                return;
        }

            // this.tempRecord.people.mobile = '09120472018';
        this.existsNationalUser(this.tempRecord.people.nationalId)
                .then (res => {})
                .catch(err => $("#reloadRecordModal").modal());
        },

        /**
         * Check Code person
         */
        existCode() {
            if (null != this.tempRecord.user.code) {
                // this.tempRecord.people.mobile = '09120472018';
                this.existsCodeUser(this.tempRecord.user.code)
                       .then (res => this.userCodeExists = false)
                       .catch(err =>{
                         demo.showNotification('شماره دانشجویی یا کد پرسنلی  قبلا ثبت شده است', 'warning');
                         this.userCodeExists = true
                     });
                       // .catch(err => this.userCodeExists = true);
            }
        },
        /**
         * Sets the image loader.
         */
        setImageLoader() {
            let baseVue = this;

            $("#wizard-picture").off('change');
            $("#wizard-picture").on('change', (e) => {
                let t = $("#wizard-picture")[0].files[0];

                if (t) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        baseVue.tempRecord.people.pictureUrl = e.target.result;
                    }

                    reader.readAsDataURL(t);
                }
            });
        },
        /**
         * Determines if it exists code user.
         *
         * @param      {<type>}   code    The code
         * @return     {Promise}  True if exists code user, False otherwise.
         */
        existsCodeUser(code) {
            return new Promise((resolve, reject) => {
                let url = document.pageData.people.check_user;

                let data = {
                    url: url,
                    code: code
                };

                this.$store.dispatch('existsCodeUser', data)
                    .then(res => {
                        if (res.data.exists == false) {
                            resolve(true);
                        } else {
                            reject(false);
                        }
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        /**
         * Determines if it exists national user.
         *
         * @param      {<type>}   data    The data
         * @return     {Promise}  True if exists national user, False otherwise.
         */
        existsNationalUser(nationalCode) {
            return new Promise((resolve, reject) => {
                let url = document.pageData.people.check_national_people;

                let data = {
                    url: url,
                    nationalId: nationalCode
                };

                this.$store.dispatch('existsNationalUser', data)
                    .then(res => {
                        if (res.data.exists == false) {
                            resolve(true);
                        } else {
                            reject(false);
                        }
                    })
                    .catch(err => {
                        reject(err);
                    });
            });
        },
        /**
         * Loads a data by nationa identifier.
         */
        loadRecordByNationalCode(nationalId) {
            let url = document.pageData.people.load_by_national_code;

            let data = {
                url: url,
                nationalId: this.tempRecord.people.nationalId
            };
            this.$store.dispatch('loadDataByNationaId', data)
                .then(res => {
                    let myData = res.data;

                    this.tempRecord.people = {
                        id: myData.people.id,
                        name: myData.people.name,
                        lastname: myData.people.lastname,
                        nationalId: myData.people.nationalId,
                        birthdate: Helper.gregorianToJalaali(myData.people.birthdate),
                        // // father    : myData.people.father,
                        phone: myData.people.phone,
                        mobile: myData.people.mobile,
                        address: myData.people.address,
                        pictureUrl: myData.people.pictureUrl,
                        melliat: {
                            id: myData.people.melliat.id,
                            name: myData.people.melliat.name
                        },
                        gender: {
                            id: myData.people.gender.id,
                            gender: myData.people.gender.gender
                        },
                        province: {
                            id: myData.people.city.province.id,
                            name: myData.people.city.province.name
                        },
                        city: {
                            id: myData.people.city.id,
                            name: myData.people.city.name
                        },
                    };
                })
                .catch(err => {

                })
        },
        /**
         * Prepare
         */
        prepare() {
            this.page = 1;
            this.isLoading = true;
            // this.loadRecords(page, 1);
            this.loadBaseInformation();
            this.loadTerms();
        },

        /**
         * Load Base Information
         */
        loadBaseInformation() {
            let data = {
                url: document.pageData.people.baseInformation
            };
            this.$store.dispatch('loadBaseInformation', data)
                .then(res => {
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },
        /**
         * Enroll Fingerprint
         */
        enroll() {
            console.log('enroll');
            SocketClient.connect('172.20.20.143', 20000,
                (e) => {
                    console.log(e);
                });
            SocketClient.send('[enroll]');
            SocketClient.disconnect()
        },
        /**
         * Identify Fingerprint
         */
        identify() {
            console.log('identify');
        },
        /**
         * Filter users
         * @param  {[type]} id [description]
         * @return {[type]}    [description]
         */
        filterUsers(groupId) {
            this.fingerprint = true;
            this.gatePlan = true;
            if (groupId == document.pageData.people.group_students) {
                this.parent = true;
                this.term = true;
            } else {
                this.parent = false;
                this.term = false;
            }

            if (groupId == document.pageData.people.group_staffs) {
                this.gateGroup = true;
            } else {
                this.gateGroup = false;
            }

            this.lastGroupId = groupId;
            this.loadRecords(1, groupId, this.searchWord);
        },

        /**
         * File Select for Image file
         */
        fileSelect(sender) {
            let file = sender.target.files[0];

            this.file = file;
        },


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
         *
         * @param      {<type>}  formMode  The form mode
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
         * Load Term list
         */
        loadTerms(callback) {
            this.$store.dispatch('loadTerms')
                .then(res => {
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Cities list
         */
        loadCities(provinceId, cityId) {
            this.$store.dispatch('loadCities', provinceId)
                .then(res => {
                    tempRecord.people.city.id = cityId;
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Fields list
         */
        loadFields(universityId, fieldId) {
            this.$store.dispatch('loadFields', universityId)
                .then(res => {
                    tempRecord.student.field.id = fieldId;
                    this.isLoading = false;
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },
        /**
         * Load Records list
        */
        loadRecords(page, id, searchWord) {
            this.isLoading = true;

            id = (id == undefined) ? this.lastGroupId : id;

            let data = {
                page: page,
                id: id,
                searchWord: searchWord
            };

            this.$store.dispatch('loadRecords', data)
                .then(res => {
                    this.isLoading = false;

                    this.showInvisibleItems();
                })
                .catch(err => {
                    this.isLoading = false;

                    this.showInvisibleItems();
                });
        },

        /**
         * Prepare to delete
         */
        readyToDelete(record) {
            this.tempRecord.id = record.id;
        },

        /**
         * Update fields combobox
         */
        updateTabs() {
            switch (this.tempRecord.user.group.id) {
                // Staff
                case 1:
                    this.grouptype = 1;
                    break;

                    // Teacher
                case 2:
                    this.grouptype = 2;
                    break;

                    // Student
                case 3:
                    this.grouptype = 3;
                    break;
            }
        },

        /**
         * Update fields combobox
         */
        updateFields(fieldId) {
            let universityId = this.tempRecord.student.university.id;
            if (universityId > 0) {
                // Load fields by university id
                this.loadFields(universityId, fieldId);
            }
        },

        /**
         * Update cities combobox
         */
        updateCities(cityId) {
            let provinceId = this.tempRecord.people.province.id;
            if (provinceId > 0) {
                // Load cities by province id
                this.loadCities(provinceId, cityId);
            }
        },

        /**
         * New record dialog
         */
        newRecord() {
            this.clearErrors();
            this.userCodeExists = false;

            this.clearRecord();
            $('#wizard-picture').val('');

            this.updateMode = false;

            setTimeout(() => {
                demo.initMaterialWizard();
                Helper.addClass('.card.wizard-card', 'active');
            }, 250);

            this.$refs.register_wizard.reset();

            this.changeFormMode(Enums.FormMode.register);

            this.fillComoboxes();
            this.activeCheckBox();

            // Helper.bootstrapWizardMove($('#wizardProfile'), 'first', 250);
        },

        /**
         * Active all checkboxes
         */
        activeCheckBox() {
            this.tempRecord.user.state = true;
            this.tempRecord.people.gender.id = 1;
            this.tempRecord.card.state = true;
        },

        /**
         * Load first item comboBox
         */
        fillComoboxes() {
            /**
             * Group Combo
             */
            if ((undefined != this.$store.getters.baseInformation.groups[0]) ||
                (null != this.$store.getters.baseInformation.groups[0])) {
                this.tempRecord.user.group.id = this.$store.getters.baseInformation.groups[0].id;
            } else {
                this.tempRecord.user.group.id = 0;
            }
            /**
             * Melliat Combo
             */
            if ((undefined != this.$store.getters.baseInformation.melliats[0]) ||
                (null != this.$store.getters.baseInformation.melliats[0])) {
                this.tempRecord.people.melliat.id = this.$store.getters.baseInformation.melliats[0].id;
            } else {
                this.tempRecord.people.melliat.id = 0;
            }

            /**
             * Situation Combo
             */
            if ((undefined != this.$store.getters.baseInformation.situations[0]) ||
                (null != this.$store.getters.baseInformation.situations[0])) {
                this.tempRecord.student.situation.id = this.$store.getters.baseInformation.situations[0].id;
            } else {
                this.tempRecord.student.situation.id = 0;
            }

            /**
             * Universities Combo
             */
            if ((undefined != this.$store.getters.baseInformation.universities[0]) ||
                (null != this.$store.getters.baseInformation.universities[0])) {
                this.tempRecord.student.university.id = this.$store.getters.baseInformation.universities[0].id;
            } else {
                this.tempRecord.student.university.id = 0;
            }
            /**
             * Fields Combo
             */
            if ((undefined != this.$store.getters.fieldData[0]) ||
                (null != this.$store.getters.fieldData[0])) {
                this.tempRecord.student.field.id = this.$store.getters.fieldData[0].id;
            } else {
                this.tempRecord.student.field.id = 0;
            }
            /**
             * Degree Combo
             */
            if ((undefined != this.$store.getters.baseInformation.degrees[0]) ||
                (null != this.$store.getters.baseInformation.degrees[0])) {
                this.tempRecord.student.degree.id = this.$store.getters.baseInformation.degrees[0].id;
            } else {
                this.tempRecord.student.degree.id = 0;
            }
            /**
             * Part Combo
             */
            if ((undefined != this.$store.getters.baseInformation.parts[0]) ||
                (null != this.$store.getters.baseInformation.parts[0])) {
                this.tempRecord.student.part.id = this.$store.getters.baseInformation.parts[0].id;
            } else {
                this.tempRecord.student.part.id = 0;
            }
            /**
             * Term Combo
             */
            if ((undefined != this.$store.getters.terms[0]) ||
                (null != this.$store.getters.terms[0])) {
                this.tempRecord.student.term.id = this.$store.getters.terms[0].id;
            } else {
                this.tempRecord.student.term.id = 0;
            }
            /**
             * Contracts Combo
             */
            if ((undefined != this.$store.getters.baseInformation.contracts[0]) ||
                (null != this.$store.getters.baseInformation.contracts[0])) {
                this.tempRecord.staff.contract.id = this.$store.getters.baseInformation.contracts[0].id;
            } else {
                this.tempRecord.staff.contract.id = 0;
            }

            /**
             * Department Combo
             */
            if ((undefined != this.$store.getters.baseInformation.departments[0]) ||
                (null != this.$store.getters.baseInformation.departments[0])) {
                this.tempRecord.staff.department.id = this.$store.getters.baseInformation.departments[0].id;
            } else {
                this.tempRecord.staff.department.id = 0;
            }

            /**
             * Card Type Combo
             */
            if ((undefined != this.$store.getters.baseInformation.cardtypes[0]) ||
                (null != this.$store.getters.baseInformation.cardtypes[0])) {
                this.tempRecord.card.cardtype.id = this.$store.getters.baseInformation.cardtypes[0].id;
            } else {
                this.tempRecord.card.cardtype.id = 0;
            }
        },

        /**
         * Edit a record
         */
        editRecord(record) {
            this.tempRecord = Object.assign({}, this.emptyRecord);

            this.clearErrors();

            // this.insertMode = true;
            this.updateMode = true;

            this.tempRecord.id = record.id;
            if (null != record.people) {
                this.tempRecord.people = {
                    id: record.people.id,
                    name: record.people.name,
                    lastname: record.people.lastname,
                    nationalId: record.people.nationalId,
                    birthdate: Helper.gregorianToJalaali(record.people.birthdate),
                    // father    : record.people.father,
                    phone: record.people.phone,
                    mobile: record.people.mobile,
                    address: record.people.address,
                    pictureUrl: record.people.pictureUrl,
                    melliat: {
                        id: record.people.melliat.id,
                        name: record.people.melliat.name
                    },
                    gender: {
                        id: record.people.gender.id,
                        gender: record.people.gender.gender
                    },
                    province: {
                        id: record.people.city.province.id,
                        name: record.people.city.province.name
                    },
                    city: {
                        id: record.people.city.id,
                        name: record.people.city.name
                    },
                };
            }

            this.loadCities(record.people.city.province.id, record.people.city.id);

            this.tempRecord.user = {
                id: record.id,
                code: record.code,
                // password: record.password,
                email: record.email,
                state: record.state,
                group: {
                    id: record.group.id,
                    name: record.group.name
                },

            };

            if (null != record.cards) {
                this.tempRecord.card = {
                    id: record.cards[0].id,
                    cdn: record.cards[0].cdn,
                    state: record.cards[0].state,
                    startDate: Helper.gregorianToJalaali(record.cards[0].startDate),
                    endDate: Helper.gregorianToJalaali(record.cards[0].endDate),
                    cardtype: {
                        id: record.cards[0].cardtype.id,
                        name: record.cards[0].cardtype.name
                    },
                };
            }

            this.updateTabs();

            switch (this.grouptype) {
                // Staff
                case 1:
                    if (null != record.staff) {
                        this.tempRecord.staff = {
                            id: record.staff.id,
                            contract: {
                                id: record.staff.contract.id,
                                name: record.staff.contract.name
                            },
                            department: {
                                id: record.staff.department.id,
                                name: record.staff.department.name
                            },
                        };
                    }
                    break;

                    // Teacher
                case 2:
                    if (null != record.teacher) {
                        this.tempRecord.teacher = {
                            id: record.teacher.id,
                            semat: record.teacher.semat
                        };
                    }
                    break;

                    // Student
                case 3:
                    if (null != record.student) {
                        this.tempRecord.student = {
                            id: record.student.id,
                            term: {
                                id: record.student.term.id,
                            },
                            native: record.student.native,
                            suit: record.student.suit,
                            situation: {
                                id: record.student.situation.id,
                                name: record.student.situation.name
                            },
                            degree: {
                                id: record.student.degree.id,
                                name: record.student.degree.name
                            },
                            field: {
                                id: record.student.field.id,
                                name: record.student.field.name
                            },

                            university: {
                                id: record.student.field.university.id,
                                name: record.student.field.university.name,
                            },

                            part: {
                                id: record.student.part.id,
                                name: record.student.part.name
                            },
                        };
                        this.loadFields(record.student.field.university.id, record.student.field.id);
                    }
                    break;
            } // /Switch

            // setTimeout(() => {
            //     demo.initMaterialWizard();
            //     Helper.addClass('.card.wizard-card', 'active');
            // }, 250);

            // Helper.bootstrapWizardMove($('#wizardProfile'), 'first', 250);
            // this.$refs.register_wizard.changeTab(0,0);
            this.$refs.register_wizard.reset();

            this.removeClass();
            this.formMode = Enums.FormMode.register;
        },

        /**
         * Remove Class input
         */
        removeClass() {
            $('select').each(function(e) {
                if ($(this).val() == null) {
                    return;
                }
                $(this).parent().removeClass('is-empty');
            })


            $('input[type=text],input[type=email]').each(function(e) {
                if ($(this).val() == null) {
                    return;
                }

                $(this).parent().removeClass('is-empty');
            })

        },

        /**
         * Hide insert/update modal
         */
        registerCancel() {
            // this.tempRecord = this.emptyRecord;
            this.tempRecord = Object.assign({}, this.emptyRecord);

            this.changeFormMode(Enums.FormMode.normal);
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
                    this.tempRecord = Object.assign({}, this.emptyRecord);
                   // this.tempRecord = {};
                })
                .catch(err => {
                    demo.showNotification('خطا در حذف رکورد', 'danger');
                });
        },

        /**
         * Save record
         */
        saveRecord() {
            // this.$validator.validateAll()
            //     .then(result => {
            //         if (result) {
                        // Prepare data
                        let data = {
                            lastGroupId: this.lastGroupId,

                            id: this.tempRecord.id,
                            grouptype: this.grouptype,
                            people: {
                                id: this.tempRecord.people.id,
                                name: this.tempRecord.people.name,
                                lastname: this.tempRecord.people.lastname,
                                nationalId: this.tempRecord.people.nationalId,
                                birthdate: this.toGregorian(this.tempRecord.people.birthdate),
                                // father      : this.tempRecord.people.father,
                                phone: this.tempRecord.people.phone,
                                mobile: this.tempRecord.people.mobile,
                                address: this.tempRecord.people.address,
                                gender_id: this.tempRecord.people.gender.id,
                                melliat_id: this.tempRecord.people.melliat.id,
                                city_id: this.tempRecord.people.city.id,
                            },

                            user: {
                                id: this.tempRecord.user.id,
                                code: this.tempRecord.user.code,
                                // name     : this.tempRecord.name,
                                email: this.tempRecord.user.email,
                                password: this.tempRecord.user.password,
                                state: this.tempRecord.user.state,
                                group_id: this.tempRecord.user.group.id,
                            },

                            teacher: {
                                id: this.tempRecord.teacher.id,
                                semat: this.tempRecord.teacher.semat
                            },

                            staff: {
                                id: this.tempRecord.staff.id,
                                contract_id: this.tempRecord.staff.contract.id,
                                department_id: this.tempRecord.staff.department.id
                            },

                            student: {
                                id: this.tempRecord.student.id,
                                term_id: this.tempRecord.student.term.id,
                                native: this.tempRecord.student.native,
                                suit: this.tempRecord.student.suit,
                                degree_id: this.tempRecord.student.degree.id,
                                part_id: this.tempRecord.student.part.id,
                                field_id: this.tempRecord.student.field.id,
                                situation_id: this.tempRecord.student.situation.id,
                            },

                            card: {
                                id: this.tempRecord.card.id,
                                cdn: this.tempRecord.card.cdn,
                                state: this.tempRecord.card.state,
                                startDate: this.toGregorian(this.tempRecord.card.startDate),
                                endDate: this.toGregorian(this.tempRecord.card.endDate),
                                group_id: this.tempRecord.user.group.id,
                                cardtype_id: this.tempRecord.card.cardtype.id,
                            },
                        };

                        this.isLoading = true;

                        // Try to save
                        this.$store.dispatch('saveRecord', data)
                            .then(res => {

                                this.uploadImage(res.register.people_id);


                                this.isLoading = false;

                                if (0 == res.status) {
                                    demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                                    this.registerCancel();
                                } else {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                                }
                            })
                            .catch(err => {
                                this.isLoading = false;

                                if (err.response.status) {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                                } else {
                                    demo.showNotification(err.message, 'danger');
                                }
                            });

                        return;
                    // }

                //     let err = Helper.generateErrorString();

                //     demo.showNotification(err, 'warning');
                // });
        },

        /**
         * Upload Iamge
         */
        uploadImage(peopleId) {
            let formData = new FormData();

            // Add method field
            formData.append('_method', 'post');

            // Add file
            if (this.file != null) {
                formData.append('image', this.file, this.file.name);
                formData.append('peopleId', peopleId);

                // Set header
                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                let data = {
                    config: config,
                    formData: formData,
                };

                this.$store.dispatch('uploadImage', data)
                    .then(res => {
                        // Find proper people
                        let people = this.records.filter(el => el.people_id == peopleId)[0];

                        if (null != people) {
                            people.people.pictureThumbUrl = res.data.pictureThumbUrl;
                            people.people.pictureUrl = res.data.pictureThumb;
                        }

                        this.isLoading = false;
                    })
                    .catch(err => {
                        this.isLoading = false;
                    });
            }
        },

        /**
         * Set Group_Permit to record
         */
        setTerm(record) {
            this.formMode = Enums.FormMode.assignTerm;

            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);

            this.tempRecord.user = {
                id: record.id,
                code: record.code,
                // email: record.email,
                // state: record.state,
                group: {
                    id: record.group.id,
                    name: record.group.name
                },
            };

            // Update terms checked state
            this.terms.forEach(term => {
                term.checked = false;
                let res = record.terms.filter(peopleTerm => peopleTerm.id == term.id);

                term.checked = (res.length > 0);
            });
        },

        /**
         * Save Group permit Record
         */
        saveTermRecord(scope) {
            this.$validator.validateAll(scope)
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            user_id: this.tempRecord.user.id,
                            terms: []
                        };

                        data.terms = this.terms.filter(el => el.checked == true)
                            .map(el => el.id);

                        this.isLoading = true;

                        // Try to save
                        this.$store.dispatch('saveTermRecord', data)
                            .then(res => {
                                this.isLoading = false;

                                if (res) {
                                    demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                                    this.registerCancel();
                                } else {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                                }
                            })
                            .catch(err => {
                                this.isLoading = false;

                                if (err.response.status) {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                                } else {
                                    demo.showNotification(err.message, 'danger');
                                }
                            });

                        return;
                    }
                    let err = Helper.generateErrorString();

                    demo.showNotification(err, 'warning');
                });
        },


        /**
         * Set Group_Permit to record
         */
        setGroupPermit(record) {
            this.formMode = Enums.FormMode.assignGrouppermit;

            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);

            this.tempRecord.user = {
                id: record.id,
                code: record.code,
                email: record.email,
                state: record.state,
                group: {
                    id: record.group.id,
                    name: record.group.name
                },
            };

            // Update grouppermits checked state
            this.grouppermits.forEach(grouppermit => {
                grouppermit.checked = false;
                let res = record.grouppermits.filter(peopleGrouppermit => peopleGrouppermit.id == grouppermit.id);

                grouppermit.checked = (res.length > 0);
            });
        },

        /**
         * Save Group permit Record
         */
        saveGroupPermitRecord(scope) {
            this.$validator.validateAll(scope)
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            user_id: this.tempRecord.user.id,
                            grouppermits: []
                        };

                        data.grouppermits = this.grouppermits.filter(el => el.checked == true)
                            .map(el => el.id);

                        this.isLoading = true;

                        // Try to save
                        this.$store.dispatch('saveGroupPermitRecord', data)
                            .then(res => {
                                this.isLoading = false;

                                if (res) {
                                    demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                                    this.registerCancel();
                                } else {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                                }
                            })
                            .catch(err => {
                                this.isLoading = false;

                                if (err.response.status) {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                                } else {
                                    demo.showNotification(err.message, 'danger');
                                }
                            });

                        return;
                    }
                    let err = Helper.generateErrorString();

                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Set Gate Group to record
         */
        setGateGroup(record) {
            this.formMode = Enums.FormMode.assignGateGroup;

            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);

            this.tempRecord.user = {
                id: record.id,
                code: record.code,
                email: record.email,
                state: record.state,
                group: {
                    id: record.group.id,
                    name: record.group.name
                },
            };

            // Update gategroups checked state
            this.gategroups.forEach(gategroup => {
                gategroup.checked = false;

                let res = record.gategroups.filter(peopleGateGroup => peopleGateGroup.id == gategroup.id);

                gategroup.checked = (res.length > 0);
            });
        },

         /**
         * Set Gate Plan to record
         */
        setGatePlan(record) {
            this.formMode = Enums.FormMode.assignGatePlan;

            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);

            this.tempRecord.user = {
                id: record.id,
                code: record.code,
                email: record.email,
                state: record.state,
                group: {
                    id: record.group.id,
                    name: record.group.name
                },
            };

            // Update gateplans checked state
            this.gateplans.forEach(gateplan => {
                gateplan.checked = false;

                let res = record.gateplans.filter(peopleGatePlan => peopleGatePlan.id == gateplan.id);

                gateplan.checked = (res.length > 0);
            });
        },

        /**
         * Save Gate Group  Record
         */
        saveGateGroupRecord(scope) {
            this.$validator.validateAll(scope)
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            user_id: this.tempRecord.user.id,
                            gategroups: []
                        };

                        data.gategroups = this.gategroups.filter(el => el.checked == true)
                            .map(el => el.id);

                        this.isLoading = true;

                        // Try to save
                        this.$store.dispatch('saveGateGroupRecord', data)
                            .then(res => {

                                this.isLoading = false;

                                if (res) {
                                    demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                                    this.registerCancel();
                                } else {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                                }
                            })
                            .catch(err => {
                                this.isLoading = false;

                                if (err.response.status) {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                                } else {
                                    demo.showNotification(err.message, 'danger');
                                }
                            });

                        return;
                    }
                    let err = Helper.generateErrorString();

                    demo.showNotification(err, 'warning');
                });
        },

         /**
         * Save Gate Plan Record
         */
        saveGatePlanRecord(scope) {
            this.$validator.validateAll(scope)
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            user_id: this.tempRecord.user.id,
                            gateplans: []
                        };

                        data.gateplans = this.gateplans.filter(el => el.checked == true)
                            .map(el => el.id);

                        this.isLoading = true;

                        // Try to save
                        this.$store.dispatch('saveGatePlanRecord', data)
                            .then(res => {

                                this.isLoading = false;

                                if (res) {
                                    demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                                    this.registerCancel();
                                } else {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                                }
                            })
                            .catch(err => {
                                this.isLoading = false;

                                if (err.response.status) {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                                } else {
                                    demo.showNotification(err.message, 'danger');
                                }
                            });

                        return;
                    }
                    let err = Helper.generateErrorString();

                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Sets the finger print.
         */
        setFingerPrint(record) {
            this.loadPicFingerprint(3);
            this.finger_index = 2;
            this.formMode = Enums.FormMode.assignFingerPrint;

            this.errors.clear();
            // this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.tempRecord.user = {
                id: record.id,
                code: record.code,
                group: record.group,
            };

            if (null != record.people) {
                this.tempRecord.people = {
                    id: record.people.id,
                    name: record.people.name,
                    lastname: record.people.lastname,
                    nationalId: record.people.nationalId,
                    birthdate: Helper.gregorianToJalaali(record.people.birthdate),
                    // father    : record.people.father,
                    phone: record.people.phone,
                    mobile: record.people.mobile,
                    address: record.people.address,
                    pictureUrl: record.people.pictureUrl,
                    melliat: {
                        id: record.people.melliat.id,
                        name: record.people.melliat.name
                    },
                    gender: {
                        id: record.people.gender.id,
                        gender: record.people.gender.gender
                    },
                    province: {
                        id: record.people.city.province.id,
                        name: record.people.city.province.name
                    },
                    city: {
                        id: record.people.city.id,
                        name: record.people.city.name
                    },
                };
            }

            if(null != record.fingerprint)
            {
              //  console.log('load pic finger');
                //this.loadPicFingerprint(record.fingerprint.user_id);
                this.tempRecord.fingerprint = {
                    id: record.fingerprint.id,
                    code: record.fingerprint.fingerprint_user_id,
                    imageQuality: record.fingerprint.image_quality,
                    image: null,
                   };
                this.finger_index = record.fingerprint.type_fingerprint;
            }
        },

        /**
         * Loads a picture fingerprint.
         *
         * @param      {<type>}  userId  The user identifier
         */
        loadPicFingerprint(userId)
        {
           // console.log('loadPicFingerprint -> userId', userId);
             let url = document.pageData.people.load_pic_fingerprint;

            let data = {
                url: url,
                userId: userId
            };

           // console.log('loadPicFingerprint -> index -> data', data);

            this.$store.dispatch('loadPicFingerprint', data)
                .then(res => {
                    // let myData = res.data;
                   // console.log('loadPicFingerprint -> res', res);
                    this.tempRecord.fingerprint.image = res;

                })
                .catch(err => {

                })
        },

        /**
         * Parent info
         */

        /**
         * Assign Parent
         */
        assignParent(record) {
            this.people_id_parent = record.people_id;
            this.modalMode = Enums.FormMode.normal;
            this.loadParentRecords(this.people_id_parent);
        },

        /**
         * Load Parent Records list
         */
        loadParentRecords(people_id) {
            //this.page = page;
            this.isLoading = true;

            this.$store.dispatch('loadParentRecords', people_id)
                .then(res => {
                    this.isLoading = false;

                    this.showInvisibleItems();
                })
                .catch(err => {
                    this.isLoading = false;

                    this.showInvisibleItems();
                });
        },

        /**
         * New Parent
         */
        newParentRecord() {
            this.clearErrors();
            this.tempRecord.parent = Object.assign({}, this.emptyRecord.parent);
            this.modalMode = Enums.FormMode.register;
        },

        /**
         * Edit a Parent record
         */
        editParentRecord(record) {
            this.errors.clear();

            this.tempRecord.parent = {
                id: record.id,
                name: record.name,
                lastname: record.lastname,
                phone: record.phone,
                mobile: record.mobile,
                kintype: {
                    id: record.kintype.id,
                    name: record.kintype.name,
                },
                people: {
                    id: record.people_id
                },
            };

            this.modalMode = Enums.FormMode.register;
        },

        /**
         * Hide insert/update modal Parent
         */
        registerParentCancel() {
            this.tempRecord.parent = this.emptyRecord.parent;
            this.modalMode = Enums.FormMode.normal;
        },

        /**
         * Prepare to delete Parent
         */
        readyToDeleteParent(record) {
            if (confirm('؟ﺩیﺭاﺩ ﻥﺎﻧیﻢﻃا ﻑﺬﺣ یاﺮﺑ')) {
                this.tempRecord.parent = record;
                this.deleteParentRecord(record.people_id);
            }
        },

        /**
         * Delete a  Parent recorddeleteParentRecord
         */
        deleteParentRecord(people_id) {
            this.isLoading = true;

            this.$store.dispatch('deleteParentRecord', this.tempRecord.parent.id)
                .then(res => {
                    this.loadParentRecords(people_id);

                    demo.showNotification('ﺪﺷ ﻡﺎﺠﻧا ﺕیﻖﻓﻮﻣ ﺎﺑ ﺩﺭﻭکﺭ ﻑﺬﺣ', 'success');
                    this.tempRecord = {};
                })
                .catch(err => {
                    demo.showNotification('ﺖﻓﺭگ ﺪﻫاﻮﺧ ﺭاﺮﻗ یﺱﺭﺮﺑ ﺩﺭﻮﻣ ﻭ ﺪﺷ ﻩﺭیﺥﺫ ﻪﻧﺎﻣﺎﺳ ﺭﺩ ﺎﻄﺧ ﻥیا !ﺩﺭﻭکﺭ ﻑﺬﺣ ﺭﺩ ﺎﻄﺧ', 'danger');
                });
        },

        /**
         * Save Parent record
         */
        saveParentRecord(scope) {
            this.$validator.validateAll(scope)
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.parent.id,
                            name: this.tempRecord.parent.name,
                            lastname: this.tempRecord.parent.lastname,
                            phone: this.tempRecord.parent.phone,
                            mobile: this.tempRecord.parent.mobile,
                            kintype_id: this.tempRecord.parent.kintype.id,
                            people_id: this.people_id_parent,
                        };

                        this.isLoading = true;

                        // Try to save
                        this.$store.dispatch('saveParentRecord', data)
                            .then(res => {
                                this.isLoading = false;

                                if (res) {
                                    this.loadParentRecords(data.people_id);
                                    demo.showNotification('ثبت اطلاعات با موفقیت انجام شد', 'success');

                                    this.registerParentCancel();
                                } else {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'warning');
                                }
                            })
                            .catch(err => {
                                this.isLoading = false;

                                if (err.response.status) {
                                    demo.showNotification('این نام قبلا ثبت شده است', 'danger');
                                } else {
                                    demo.showNotification(err.message, 'danger');
                                }
                            });

                        return;
                    }

                    let err = Helper.generateErrorString();

                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Upload Image
         */
        uploadImageRecord() {
            this.isLoading = true;

            this.$store.dispatch('uploadImageRecord')
                .then(res => {
                    demo.showNotification('upload با موفقیت انجام شد', 'success');
                })
                .catch(err => {
                    demo.showNotification('خطا در حذف رکورد! این خطا در سامانه ذخیره شد و مورد بررسی قرار خواهد گرفت', 'danger');
                });
        },

        /**
         * Tab Switch user
         */
        tabSwitchUser() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('code'),
                // this.$validator.validate('password'),
                this.$validator.validate('email'),
                this.$validator.validate('group_id'),
                // this.existsCodeUser(this.tempRecord.user.code)
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },

        /**
         * Tab Switch person
         */
        tabSwitchPerson() {
            this.errors.clear();

            if (this.wizardSelectedButton == 'prev'){
                return true;
            }

            return Promise.all([
                this.$validator.validate('name'),
                this.$validator.validate('lastname'),
                this.$validator.validate('nationalId'),
                this.$validator.validate('gender_id'),
                // this.$validator.validate('birthdate'),
                this.$validator.validate('melliat_id'),
                //this.$validator.validate('phone'),
                // this.$validator.validate('city_id'),
                // this.$validator.validate('province_id'),
                // this.$validator.validate('mobile'),
                this.$validator.validate('address')

            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },

        /**
         * ُTab Switch Other
         */
        tabSwitchOther() {
            this.errors.clear();

            switch (this.tempRecord.user.group.id) {
                // Staff
                case 1:
                    return this.tabSwitchStaff();
                    break;

                    // Teacher
                case 2:
                    return this.tabSwitchTeacher();
                    break;

                    // Student
                case 3:
                    return this.tabSwitchStudent();
                    break;
            }
        },

        /**
         * Tab Switch Student
         */
        tabSwitchStudent() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('term_id'),
                this.$validator.validate('field_id'),
                this.$validator.validate('situation_id'),
                this.$validator.validate('university_id'),
                this.$validator.validate('degree_id'),
                this.$validator.validate('part_id')

            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },

        /**
         * Tab Switch Teacher
         */
        tabSwitchTeacher() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('semat'),
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },

        /**
         * Tab Switch Staff
         */
        tabSwitchStaff() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('contract_id'),
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },

        listMode() {
            this.insertMode = false;
            this.updateMode = false;
        },


        changeTab(props, oper){
            this.wizardSelectedButton = oper;

            if (oper === 'next'){
                props.nextTab();
            } else if(oper === 'prev'){
                props.prevTab();
            }
        }
    }
});

$(document).ready(() => {
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
});
