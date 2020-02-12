import Store from './store';
import CardMobile from '../Components/MobileWidget';
import TermMobile from '../Components/TermWidget';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

window.v = new Vue({
    el: '#app',
    store: Store,
    components: {
        CardMobile,
        TermMobile,
        persianCalendar: VuePersianDatetimePicker
    },

    data: {
        formMode: Enums.FormMode.normal,
        page: 1,
        isLoading: true,
        tempRecord: {},
    },

    created() {
        this.tempRecord = this.emptyRecord;
    },

    mounted() {
        this.loadSemesters(this.page);
        this.loadTerms(this.page);
        this.loadUniversities(this.page);
        this.loadAllUniversities(this.page);
        this.loadFields(this.page);
        this.loadDegrees(this.page);
        this.loadParts(this.page);
        this.loadSituations(this.page);
    },

    computed: {
        /**
         * Generate new Empty record
         */
        emptyRecord: () => {
            return {
                id      : 0,
                name: '',
                year    : '',
                startDate  : '',
                endDate    : '',
                state: 0,
                semester:   {
                    id: 0
                },
                university:   {
                    id: 0
                }
            }
        },

        hasTermRows: state => ((state.$store.getters.terms != null) &&
            (state.$store.getters.terms.length > 0)),

        hasUniversityRows: state => ((state.$store.getters.universities != null) &&
            (state.$store.getters.universities.length > 0)),

        hasFieldRows: state => ((state.$store.getters.fieldDatas != null) &&
            (state.$store.getters.fieldDatas.length > 0)),

        hasDegreeRows: state => ((state.$store.getters.degrees != null) &&
            (state.$store.getters.degrees.length > 0)),

        hasPartRows: state => ((state.$store.getters.parts != null) &&
            (state.$store.getters.parts.length > 0)),

        hasSituationRows: state => ((state.$store.getters.situations != null) &&
            (state.$store.getters.situations.length > 0)),

        semesters: state => state.$store.getters.semesters,

        terms: state => state.$store.getters.terms,
        terms_paginate: state => state.$store.getters.termsPaginate,

        universities: state => state.$store.getters.universities,
        allUniversities: state => state.$store.getters.allUniversities,

        universities_paginate: state => state.$store.getters.universitiesPaginate,

        fieldDatas: state => state.$store.getters.fieldDatas,
        fields_paginate: state => state.$store.getters.fieldsPaginate,

        degrees: state => state.$store.getters.degrees,
        degrees_paginate: state => state.$store.getters.degreesPaginate,

        parts: state => state.$store.getters.parts,
        parts_paginate: state => state.$store.getters.partsPaginate,

        situations: state => state.$store.getters.situations,
        situations_paginate: state => state.$store.getters.situationsPaginate,

        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,
    },

    methods: {
        /**
         * Page changed
         */
        pageChanged() {
            this.loadSemesters(this.page);
            this.loadTerms(this.page);
            this.loadUniversities(this.page);
            this.loadAllUniversities(this.page);
            this.loadFields(this.page);
            this.loadDegrees(this.page);
            this.loadParts(this.page);
            this.loadSituations(this.page);
        },

        fillComoboxes() {
            /**
             * University Combo in field form
             */
            if ((undefined != this.$store.getters.universities[0]) ||
                (null != this.$store.getters.universities[0])) {
                this.tempRecord.university.id = this.$store.getters.universities[0].id;
            } else {
                this.tempRecord.university.id = 0;
            }
        },

        /**
         * Loads Semester
         */
        loadSemesters(page) {
            let url = document.pageData.base_education.pageUrls.semesters_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadSemesters', data);
            this.isLoading = false;
        },

        /**
         * Loads Terms
         */
        loadTerms(page) {
            let url = document.pageData.base_education.pageUrls.terms_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadTerms', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },
        /**
         * Loads universities.
         *
         * @param      {string}  page    The page
         */
        loadUniversities(page) {
            let url = document.pageData.base_education.pageUrls.universities_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadUniversities', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },

        /**
         * Loads All Universities for city page
         */
        loadAllUniversities(page) {
            let url = document.pageData.base_education.pageUrls.universities_all_index + '?page=' + page;

            let data = {
                url: url
            };
            this.$store.dispatch('loadAllUniversities', data);
        },

        /**
         * Loads fields.
         *
         * @param      {string}  page    The page
         */
        loadFields(page) {
            let url = document.pageData.base_education.pageUrls.fields_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadFields', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },

         /**
         * Loads Degrees
         */
        loadDegrees(page) {
            let url = document.pageData.base_education.pageUrls.degrees_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadDegrees', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },

        /**
         * Loads Parts
         */
        loadParts(page) {
            let url = document.pageData.base_education.pageUrls.parts_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadParts', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },
        /**
         * Loads Situations
         */
        loadSituations(page) {
            let url = document.pageData.base_education.pageUrls.situations_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadSituations', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },

        /**
         * New record dialog
         */
        newRecord() {
            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.changeFormMode(Enums.FormMode.register);
            this.fillComoboxes();
        },

        /**
         * Edit record
         *
         * @param      {<type>}  record  The record
         */
        editRecord(record) {
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                semester: {
                    id: 0
                },
                university: {
                    id: 0
                },
            };

            if (record.university.id != 0){
                this.tempRecord.university.id = record.university.id;
                this.tempRecord.university.name = record.university.name;
            }

            this.formMode = Enums.FormMode.register;
        },
        /**
         * edit situation record
         *
         * @param      {<type>}  record  The record
         */
        editSituationRecord(record) {
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                state: record.state,
                semester: {
                    id: 0
                },
                university: {
                    id: 0
                },
            };

            this.formMode = Enums.FormMode.register;
        },

        /**
         * edit semester record
         *
         * @param      {<type>}  record  The record
         */
        editSemesterRecord(record){
            this.errors.clear();
            this.tempRecord = {
                id: record.id,
                year: record.year,
                startDate: Helper.gregorianToJalaali(record.startDate),
                endDate: Helper.gregorianToJalaali(record.endDate),
                semester: {
                    id: record.semester.id,
                    name: record.semester.name,
                },
            };

            this.formMode = Enums.FormMode.register;
        },

        /**
         * Save Term Record
         */
        saveTermRecord() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('term_year'),
                this.$validator.validate('term_startDate'),
                this.$validator.validate('term_endDate'),
                this.$validator.validate('semester_id'),
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    this.saveTerm();
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },
        /**
         * Saves a term.
         */
        saveTerm() {
            // Prepare data
            let data = {
                id: this.tempRecord.id,
                year: this.tempRecord.year,
                startDate: Helper.jalaaliToGregorian(this.tempRecord.startDate),
                endDate: Helper.jalaaliToGregorian(this.tempRecord.endDate),
                semester_id: this.tempRecord.semester.id,
                url: '/terms',
                function: 'createTerms',
            };
            this.isLoading = true;
            if (0 == data.id) {
                this.createRecord(data);
            } else {
                data.url = '/terms/' + data.id;
                data.function = 'updateTerms';
                this.updateRecord(data);
            }

            return;
        },

        /**
        * Save Field Record
        */
         saveFieldRecord() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('name_field'),
                this.$validator.validate('university_id'),
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    this.saveDataField();
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },

        saveDataField() {
            // Prepare data
            let data = {
                id: this.tempRecord.id,
                name: this.tempRecord.name,
                university_id: this.tempRecord.university.id,
                url: '/fields',
                function: 'createFields',
            };
            this.isLoading = true;
            if (0 == data.id) {
                this.createRecord(data);
            } else {
                data.url = '/fields/' + data.id;
                data.function = 'updateFields';
                this.updateRecord(data);
            }

            return;
        },

         /**
         * Save University Record
         */
        saveUniversityRecord() {
            this.$validator.validate('name_university')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/universities',
                            function: 'createUniversities',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/universities/' + data.id;
                            data.function = 'updateUniversities';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Saves a field record.
         */

        /**
         * Saves a degree record.
         */
        saveDegreeRecord() {
            this.$validator.validate('name_degree')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/degrees',
                            function: 'createDegrees',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/degrees/' + data.id;
                            data.function = 'updateDegrees';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

         /**
         * Save Part Record
         */
        savePartRecord() {
            this.$validator.validate('name_part')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/parts',
                            function: 'createParts',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/parts/' + data.id;
                            data.function = 'updateParts';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

         /**
         * Save Situation Record
         */
        saveSituationRecord() {
            this.$validator.validate('name_situation')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            state: this.tempRecord.state,
                            url: '/situations',
                            function: 'createSituations',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/situations/' + data.id;
                            data.function = 'updateSituations';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },
        /**
         *
         * @param {*} data
         */
        createRecord(data) {
            this.$store.dispatch(data.function, data)
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
        },
        /**
         * Update Record
         *
         * @param      {<type>}  data    The data
         */
        updateRecord(data) {
            this.$store.dispatch(data.function, data)
                .then(res => {
                    this.isLoading = false;
                    if (res) {
                        demo.showNotification('ویرایش اطلاعات با موفقیت انجام شد', 'success');

                        this.registerCancel();
                    } else {
                        demo.showNotification('این نام قبلا ویرایش شده است', 'warning');
                    }
                })
                .catch(err => {
                    this.isLoading = false;

                    if (err.response.status) {
                        demo.showNotification('این نام قبلا ویرایش شده است', 'danger');
                    } else {
                        demo.showNotification(err.message, 'danger');
                    }
                });
        },

        /**
         * Prepare to delete
         */
        readyToDelete(record) {
            this.tempRecord.id = record.id;
        },
        /**
         * Delete a record
         */
        deleteRecord(namePage) {

            this.isLoading = true;
            let funName = 'delete' + namePage;
            let url = '/' + namePage + '/' + this.tempRecord.id;
            let data = {
                url: url,
                record: this.tempRecord
            };


            this.$store.dispatch(funName, data)
                .then(res => {
                    this.isLoading = false;

                    demo.showNotification('حذف رکورد با موفقیت انجام شد', 'success');
                    this.tempRecord = {};
                })
                .catch(err => {
                    demo.showNotification('خطا در حذف رکورد! این خطا در سامانه ذخیره شد و مورد بررسی قرار خواهد گرفت', 'danger');
                });
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
         * Hide insert/update modal
         */
        registerCancel() {
            this.tempRecord = this.emptyRecord;

            this.changeFormMode(Enums.FormMode.normal);
        },
    },
})
