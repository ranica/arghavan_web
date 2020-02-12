import Store from '../Stores/SearchStore';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

window.v = new Vue({
	el: '#app',
	store: Store,

    components: {
        persianCalendar: VuePersianDatetimePicker
    },

	data:{
        selectRecord:{},
        grouptype: 0,
        people_id_parent: 0,
        parent: false,
        gateGroup: false,
		formMode: Enums.FormMode.normal,
        modalMode: Enums.FormMode.normalModal,
		page      : 1,
		isLoading : true,

        gategroups:[],
        grouppermits:[],

		tempRecord: {
            user: {},
            people: {},
            student: {},
            teacher: {},
            staff: {},
            card: {},
            parent: {},
        }
	},

	created(){
		this.tempRecord  = this.emptyRecord;

        this.tempRecord.user = this.emptyRecord.user;
        this.tempRecord.people = this.emptyRecord.people;
        this.tempRecord.student = this.emptyRecord.student;
        this.tempRecord.teacher = this.emptyRecord.teacher;
        this.tempRecord.staff = this.emptyRecord.staff;
        this.tempRecord.card = this.emptyRecord.card;
        this.tempRecord.parent = this.emptyRecord.parent;

        this.prepare();
	},

	mounted(){
		//this.loadGroups(this.page);
	},

	computed:{
		/**
		 * Generate new Empty record
		 */
		// emptyRecord: () => { return {
		// 						id: 0,
		// 						code: '',
		// 						nationalId: '',
		// 						name: '',
		// 						lastname: '',
		// 						group: {
		// 							id: 0
		// 						},
		// 				}
		// },
        /**
         * Generate new Empty record
         */
        emptyRecord: () => {
            return {
                id: 0,
                user: {
                    id: 0,
                    code: '',
                    password: '',
                    email: '',
                    state: 0,
                    group: {
                        id: 0
                    },
                    people: {
                        id: 0
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
                    year: '',
                    term: '',
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
            };
        },

         isStaff() {
            return (this.grouptype == 1);
        },

        isTeacher() {
            return (this.grouptype == 2);
        },

        isStudent() {
            return (this.grouptype == 3);
        },

        isShowParent() {
            return this.parent;
        },

        isShowGateGroup() {
            return this.gateGroup;
        },

        /*
        User Info
         */
        groups: state => state.$store.getters.groups,

        /*
        People Info
         */
        melliats: state => state.$store.getters.melliats,
        genders: state => state.$store.getters.genders,
        provinces: state => state.$store.getters.provinces,
        cities: state => state.$store.getters.cities,

        /*
        Educational Info
         */
        situations: state => state.$store.getters.situations,
        degrees: state => state.$store.getters.degrees,
        parts: state => state.$store.getters.parts,
        fieldsData: state => state.$store.getters.fields,
        universities: state => state.$store.getters.universities,

        /*
        Staff Info
         */
        departments: state => state.$store.getters.departments,
        contracts: state => state.$store.getters.contracts,

        /*
        Card Info
         */
        cardtypes: state => state.$store.getters.cardtypes,

        //grouppermits: state => state.$store.getters.grouppermits,
       // gategroups: state => state.$store.getters.gategroups,

         /*
        Parents
        */
        kintypes: state => state.$store.getters.kintypes,
        parents: state => state.$store.getters.parents,
        hasParent: state => (0 < state.parents.length),

		isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isSearchMode: state => state.formMode == Enums.FormMode.search,
		isRegisterMode: state => state.formMode == Enums.FormMode.register,

        isAssignGrouppermit: state => state.formMode == Enums.FormMode.assignGrouppermit,
        isAssignGateGroup: state => state.formMode == Enums.FormMode.assignGateGroup,

        isNormalModalMode: state => state.modalMode == Enums.FormMode.normal,
        isRegisterParentMode: state => state.modalMode == Enums.FormMode.register,

		records: state => state.$store.getters.records,
        allData: state => state.$store.getters.allData,
        hasRow: state => (0 < state.records.length),
	},

	methods: {
        prepare() {
            this.page = 1;
            this.isLoading = true;

            this.loadGroups(() => {
                this.loadMelliats(() => {
                    this.loadGenders(() => {
                        this.loadSituations(() => {
                            this.loadProvinces(() => {
                                this.loadDegrees(() => {
                                    this.loadParts(() => {
                                        this.loadUniversities(() => {
                                            this.loadDepartments(() => {
                                                this.loadContracts(() => {
                                                    //this.loadGrouppermits(() => {
                                                        //this.loadGateGroups(() => {
                                                            this.loadKintypes(() => {
                                                                this.loadCardtypes()
                                                            });
                                                        });
                                                    //});
                                               // });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    });
                });
            });
        },

		/**
         * Change form mode
         *
         * @param      {<type>}  formMode  The form mode
         */
        changeFormMode(formMode){
            this.formMode = formMode;
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
         * Load Kintypes list
         */
        loadKintypes(callback) {
            this.$store.dispatch('loadKintypes')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Gate Group list
         */
        loadGateGroups(callback) {
            this.$store.dispatch('loadGateGroups')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

		/**
         * Load Group list
         */
        loadGroups(callback) {
            this.$store.dispatch('loadGroups')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Melliat list
         */
        loadMelliats(callback) {
            this.$store.dispatch('loadMelliats')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Genders list
         */
        loadGenders(callback) {
            this.$store.dispatch('loadGenders')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Situations list
         */
        loadSituations(callback) {
            this.$store.dispatch('loadSituations')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Provinces list
         */
        loadProvinces(callback) {
            this.$store.dispatch('loadProvinces')
                .then(res => {
                    callback();
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
         * Load Degrees list
         */
        loadDegrees(callback) {
            this.$store.dispatch('loadDegrees')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load universities list
         */
        loadUniversities(callback) {
            this.$store.dispatch('loadUniversities')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Parts list
         */
        loadParts(callback) {
            this.$store.dispatch('loadParts')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Contracts list
         */
        loadContracts(callback) {
            this.$store.dispatch('loadContracts')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Departments list
         */
        loadDepartments(callback) {
            this.$store.dispatch('loadDepartments')
                .then(res => {
                    callback();
                })
                .catch(err => {
                    this.isLoading = false;
                });
        },

        /**
         * Load Departments list
         */
        loadCardtypes(callback) {
            this.$store.dispatch('loadCardtypes')
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
         * @param  {[type]} id [description]
         * @return {[type]}    [description]
         */
        filterUsers(groupId) {

            if (groupId == document.pageData.group_students) {
                this.parent = true;
            }
            else {
                this.parent = false;
            }

             if (groupId == document.pageData.group_staffs) {
                this.gateGroup = true;
            }
            else {
                this.gateGroup = false;
            }
        },

        /**
         * Hide insert/update modal
         */
        registerCancel() {
            this.tempRecord = this.emptyRecord;
            this.changeFormMode(Enums.FormMode.normal);
        },


        /**
         * New record dialog
         */
        newSearch() {
            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            this.changeFormMode(Enums.FormMode.search);
        },

		/**
		 * Search Data Record
		 */
		searchRecord() {
			// Prepare data
			let data = {
				code      : this.tempRecord.user.code,
				group_id  : this.tempRecord.user.group.id,
				name      : this.tempRecord.people.name,
				lastname  : this.tempRecord.people.lastname,
				nationalId: this.tempRecord.people.nationalId,
			};

			this.isLoading = true;
            this.filterUsers(this.tempRecord.user.group.id);

			// Try to Search
			this.$store.dispatch('searchRecord', data)
				.then(res => {
					this.isLoading = false;
				})
				.catch(err => {
					this.isLoading = false;

					demo.showNotification(err.message, 'danger');
				});

            this.changeFormMode(Enums.FormMode.normal);

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
         * Edit a record
         */
        editRecord(record) {
            this.selectRecord = record;
            this.$store.dispatch('searchEditRecord', record)
                .then(res => {
                    this.fillData(res.data);
                    this.formMode = Enums.FormMode.register;
                })
                .catch(err => {
                    this.isLoading = false;

                    demo.showNotification(err.message, 'danger');
                });
        },
        /**
         * Fill tempRecord for edit
         */
        fillData(record) {
            this.tempRecord = Object.assign({}, this.emptyRecord);

            this.clearErrors();
            this.tempRecord.id = 1,
            this.tempRecord.people = {
                id: record[0].people.id,
                name: record[0].people.name,
                lastname: record[0].people.lastname,
                nationalId: record[0].people.nationalId,
                birthdate: Helper.gregorianToJalaali(record[0].people.birthdate),
                // father    : record[0].people.father,
                phone: record[0].people.phone,
                mobile: record[0].people.mobile,
                address: record[0].people.address,
                pictureUrl: record[0].people.pictureUrl,
                melliat: {
                    id: record[0].melliat.id,
                    name: record[0].melliat.name
                },
                gender: {
                    id: record[0].gender.id,
                    gender: record[0].gender.gender
                },
                province: {
                    id: record[0].province.id,
                    name: record[0].province.name
                },
                city: {
                    id: record[0].city.id,
                    name: record[0].city.name
                },
            };
            this.loadCities(record[0].province.id, record[0].city.id);
            this.tempRecord.user = {
                id: record[0].user.id,
                code: record[0].user.code,
                // password: record[0].password,
                email: record[0].user.email,
                state: record[0].user.state,
                group: {
                    id: record[0].group.id,
                    name: record[0].group.name
                },
            };

            this.tempRecord.card = {
                id: record[0].card.id,
                cdn: record[0].card.cdn,
                state: record[0].card.state,
                startDate: Helper.gregorianToJalaali(record[0].card.startDate),
                endDate: Helper.gregorianToJalaali(record[0].card.endDate),
                cardtype: {
                    id: record[0].cardtype.id,
                    name: record[0].cardtype.name
                },
            };

            this.updateTabs();

            switch (this.grouptype) {
                // Staff
                case 1:
                    this.tempRecord.staff = {
                        id: record[0].staff.id,
                        contract: {
                            id: record[0].contract.id,
                            name: record[0].contract.name
                        },
                        department: {
                            id: record[0].department.id,
                            name: record[0].department.name
                        },
                    };
                    break;

                    // Teacher
                case 2:
                    this.tempRecord.teacher = {
                        id: record[0].teacher.id,
                        semat: record[0].teacher.semat
                    };
                    break;

                    // Student
                case 3:
                    this.tempRecord.student = {
                        id: record[0].student.id,
                        year: record[0].student.year,
                        term: record[0].student.term,
                        native: record[0].student.native,
                        suit: record[0].student.suit,
                        situation: {
                            id: record[0].situation.id,
                            name: record[0].situation.name
                        },
                        degree: {
                            id: record[0].degree.id,
                            name: record[0].degree.name
                        },
                        field: {
                            id: record[0].field.id,
                            name: record[0].field.name
                        },

                        university: {
                            id: record[0].university.id,
                            name: record[0].university.name,
                        },

                        part: {
                            id: record[0].part.id,
                            name: record[0].part.name
                        },
                    };
                    this.loadFields(record[0].university.id, record[0].field.id);
                    break;
            } // /Switch

            setTimeout(() => {
                demo.initMaterialWizard();
                Helper.addClass('.card.wizard-card', 'active');
            }, 250);
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
         * Save record
         */
        saveRecord(scope) {
            this.$validator.validateAll(scope)
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {

                            id: 1,
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
                                term: this.tempRecord.student.term,
                                year: this.tempRecord.student.year,
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

                                    this.updateData(res);
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
         * Update record after save
         */
        updateData(res) {
            this.selectRecord.people.name = res.register.people.name;
            this.selectRecord.people.lastname = res.register.people.lastname;
            this.selectRecord.people.nationalId = res.register.people.nationalId;
            this.selectRecord.user.code = res.register.code;
            this.selectRecord.group.name = res.register.group.name;
            this.selectRecord.card.cdn = res.register.card.cdn;
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

                        if (null != people){
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
         * Parent info
         */

         /**
         * Assign Parent
         */
        assignParent(record) {
            this.people_id_parent = record.people.id;
            this.modalMode = Enums.FormMode.normal;
            this.loadParentRecords(this.people_id_parent);
        },

        /**
         * Load Parent Records list
         */
        loadParentRecords(people_id) {
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
            if (confirm('برای حذف اطمینان دارید؟')) {
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

                    demo.showNotification('حذف رکورد با موفقیت انجام شد', 'success');
                    this.tempRecord = {};
                })
                .catch(err => {
                    demo.showNotification('خطا در حذف رکورد! این خطا در سامانه ذخیره شد و مورد بررسی قرار خواهد گرفت', 'danger');
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
         * Set Group_Permit to record
         */
        assignGroupPermit(record) {
            this.formMode = Enums.FormMode.assignGrouppermit;

            this.errors.clear();
           this.tempRecord = $.extend(true, {}, this.emptyRecord);

             this.tempRecord.user = {
                id: record.user.id,
                code: record.user.code,
                //email: record.email,
                // //state: record.state,
                // group: {
                //     id: record.group.id,
                //     name: record.group.name
                // },
            };

            this.$store.dispatch('loadGrouppermitsByUserId', record.user.id)
                .then(res => {
                    // Update grouppermits checked state
                   this.grouppermits = res;
                   
                })
                .catch(err => {
                    this.isLoading = false;

                    this.showInvisibleItems();
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

                        data.grouppermits = this.grouppermits.filter(el => el.permit == true)
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
         * Set Gat Group to record
         */
        assignGateGroup(record) {
            this.formMode = Enums.FormMode.assignGateGroup;

            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);

            this.tempRecord.user = {
                id: record.user.id,
                code: record.user.code,
            };

            this.$store.dispatch('loadGateGroupByUserId', record.user.id)
                .then(res => {
                    // Update gategroups checked state
                     this.gategroups = res;
                })
                .catch(err => {
                    this.isLoading = false;

                    this.showInvisibleItems();
                });
        },

        /**
         * Save Group permit Record
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

                        data.gategroups = this.gategroups.filter(el => el.permit == true)
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

	}
});
