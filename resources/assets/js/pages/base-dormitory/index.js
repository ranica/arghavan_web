import Store from './store';
import RoomMobile from '../Components/RoomWidget';
import CardMobile from '../Components/MobileWidget';
import MaterialMobile from '../Components/MaterialWidget';
import VuePersianDatetimePicker from 'vue-persian-datetime-picker';

window.v = new Vue({
    el: '#app',
    store: Store,
    components: {
        RoomMobile,
        CardMobile,
        MaterialMobile,
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
        this.loadRooms(this.page);
        this.loadBuildings(this.page);
        this.loadGenders(this.page);
        this.loadMaterialTypes(this.page);
        this.loadAllMaterialTypes(this.page);
        this.loadMaterials(this.page);
        this.loadContactTypes(this.page);
        this.loadAllContactTypes(this.page);

    },

    computed: {
        /**
         * Generate new Empty record
         */
        emptyRecord: () => {
            return {
                id: 0,
                name: '',
                code: '',
                type: '',
                material_type: {
                    id: 0,
                },
                 contact_type: {
                    id: 0,
                },
                room: {
					id: 0,
					capacity: 0,
					floor: 0,
					number: 0,
                    gender:{
                        id: 0,
                    },
                    building:{
                        id:0
                    },
				},

            }
        },

        hasRoomRows: state => ((state.$store.getters.rooms != null) &&
            (state.$store.getters.rooms.length > 0)),

        hasMaterialTypeRows: state => ((state.$store.getters.materialTypes != null) &&
            (state.$store.getters.materialTypes.length > 0)),

        hasMaterialRows: state => ((state.$store.getters.materials != null) &&
            (state.$store.getters.materials.length > 0)),

        hasContactTypeRows: state => ((state.$store.getters.contactTypes != null) &&
            (state.$store.getters.contactTypes.length > 0)),

        isAssignMaterial: state => state.formMode == Enums.FormMode.assignMaterial,


        buildings: state => state.$store.getters.buildings,
        genders: state => state.$store.getters.genders,

        rooms: state => state.$store.getters.rooms,
        rooms_paginate: state => state.$store.getters.roomsPaginate,

        materialTypes: state => state.$store.getters.materialTypes,
        materialTypes_paginate: state => state.$store.getters.materialTypesPaginate,
        allMaterialTypes: state => state.$store.getters.allMaterialTypes,

        materials: state => state.$store.getters.materials,
        materials_paginate: state => state.$store.getters.materialsPaginate,

        contactTypes: state => state.$store.getters.contactTypes,
        contactTypes_paginate: state => state.$store.getters.contactTypesPaginate,
        allContactTypes: state => state.$store.getters.allContactTypes,

        isNormalMode: state => state.formMode == Enums.FormMode.normal,
        isRegisterMode: state => state.formMode == Enums.FormMode.register,
    },

    methods: {
        /**
         * Page changed
         */
        pageChanged() {
            this.loadRooms(this.page);
            this.loadBuildings(this.page);
            this.loadGenders(this.page);
            this.loadMaterialTypes(this.page);
            this.loadAllMaterialTypes(this.page);
            this.loadMaterials(this.page);
            this.loadContactTypes(this.page);
            this.loadAllContactTypes(this.page);
        },

        /**
         * Loads Rooms
         */
        loadRooms(page) {
            let url = document.pageData.base_dormitory.pageUrls.rooms_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadRooms', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },



        /**
         * Loads Genders
         */
        loadGenders(page) {
            let url = document.pageData.base_dormitory.pageUrls.genders_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadGenders', data);
            this.isLoading = false;
        },
         /**
         * Loads Building
         */
        loadBuildings(page) {
            let url = document.pageData.base_dormitory.pageUrls.buildings_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadBuildings', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },
         /**
         * Loads Material Types
         */
        loadMaterialTypes(page) {
            let url = document.pageData.base_dormitory.pageUrls.material_types_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadMaterialTypes', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },
        /**
         * Loads All Material Type  page
         */
        loadAllMaterialTypes(page) {
            let url = document.pageData.base_dormitory.pageUrls.material_types_all_index + '?page=' + page;

            let data = {
                url: url
            };
            this.$store.dispatch('loadAllMaterialTypes', data);
        },

         /**
         * Loads Contact Types
         */
        loadContactTypes(page) {
            let url = document.pageData.base_dormitory.pageUrls.contact_types_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadContactTypes', data);
            Helper.scrollToApp ();
            this.isLoading = false;
        },
        /**
         * Loads All contact Type  page
         */
        loadAllContactTypes(page) {
            let url = document.pageData.base_dormitory.pageUrls.contact_types_all_index + '?page=' + page;

            let data = {
                url: url
            };
            this.$store.dispatch('loadAllContactTypes', data);
        },

        /**
         * Loads Material
         */
        loadMaterials(page) {
            let url = document.pageData.base_dormitory.pageUrls.materials_index + '?page=' + page;

            let data = {
                url: url
            };

            this.$store.dispatch('loadMaterials', data);
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
        },
        /**
         * Edit record Main
         */
        editRecord(record) {
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                code: record.code,
                room: {
                    id: 0,
                    building: {
                        id:0
                    },
                    gender:{
                        id:0
                    },
                },
            };

            this.formMode = Enums.FormMode.register;
        },

         /**
         * Edit record Main
         */
        editMaterialRecord(record) {
            this.errors.clear();

            this.tempRecord = {
                id: record.id,
                name: record.name,
                code: record.code,
                material_type: {
                    id: record.material_type.id,
                    name: record.material_type.name,
                },
                room: {
                    id: 0,
                    building: {
                        id:0
                    },
                    gender:{
                        id:0
                    },
                },
            };

            this.formMode = Enums.FormMode.register;
        },

        /**
         * Edit record
         */
        editRoomRecord(record) {
            this.errors.clear();

			// check tempRecord
            this.tempRecord = {
                id: record.id,
				room: {
                    number: record.number,
                    capacity: record.capacity,
                    floor: record.floor,
                    building:{
                        id: record.building.id,
                        name: record.building.name
                    },
                    gender:{
                        id: record.gender.id,
                        gender: record.gender.gender
                    }
				},

            };

            this.formMode = Enums.FormMode.register;
        },

        /**
         * Save Room Record
         */
        saveRoomRecord() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('room_number'),
                this.$validator.validate('room_capacity'),
                this.$validator.validate('room_floor'),
                this.$validator.validate('room_building_id'),
                this.$validator.validate('room_gender_id'),
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    this.saveRoomData();
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },

		/**
		 * Save room data
		 */
        saveRoomData() {
            // Prepare data
            let data = {
                id: this.tempRecord.id,
                capacity: this.tempRecord.room.capacity,
                floor: this.tempRecord.room.floor,
                number: this.tempRecord.room.number,
                building_id: this.tempRecord.room.building.id,
                gender_id: this.tempRecord.room.gender.id,
                url: '/rooms',
                function: 'createRooms',
			};

            this.isLoading = true;
            if (0 == data.id) {
                this.createRecord(data);
            } else {
                data.url = '/rooms/' + data.id;
                data.function = 'updateRooms';
                this.updateRecord(data);
            }

            return;
        },

         /**
         * Save Room Record
         */
        saveMaterialRecord() {
            this.errors.clear();

            return Promise.all([
                this.$validator.validate('material_name'),
                this.$validator.validate('material_code'),
                this.$validator.validate('material_type_id'),
            ]).then((resolve, reject) => {
                var hasErr = this.errors.any();

                if (!hasErr) {
                    this.saveMaterialData();
                    return true;
                }

                let err = this.errors.all();

                err = err.join('<br/>');
                demo.showNotification(err, 'warning');

                return false;
            });
        },

        /**
         * Save Material data
         */
        saveMaterialData() {
            // Prepare data
            let data = {
                id: this.tempRecord.id,
                name: this.tempRecord.name,
                code: this.tempRecord.code,
                material_type_id: this.tempRecord.material_type.id,
                url: '/materials',
                function: 'createMaterials',
            };

            this.isLoading = true;
            if (0 == data.id) {
                this.createRecord(data);
            } else {
                data.url = '/materials/' + data.id;
                data.function = 'updateMaterials';
                this.updateRecord(data);
            }

            return;
        },

        /**
         * Save material type Record
         */
        saveMaterialTypeRecord() {
            this.$validator.validate('name_material_type')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            name: this.tempRecord.name,
                            url: '/materialTypes',
                            function: 'createMaterialTypes',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/materialTypes/' + data.id;
                            data.function = 'updateMaterialTypes';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

         /**
         * Save Contact type Record
         */
        saveContactTypeRecord() {
            this.$validator.validate('type_contact_type')
                .then(result => {
                    if (result) {
                        // Prepare data
                        let data = {
                            id: this.tempRecord.id,
                            type: this.tempRecord.type,
                            url: '/contactTypes',
                            function: 'createContactTypes',
                        };

                        this.isLoading = true;
                        if (0 == data.id) {
                            this.createRecord(data);
                        } else {
                            data.url = '/contactTypes/' + data.id;
                            data.function = 'updateContactTypes';
                            this.updateRecord(data);
                        }

                        return;
                    }
                    let err = Helper.generateErrorString();
                    demo.showNotification(err, 'warning');
                });
        },

        /**
         * Create Record
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
                    this.tempRecord = $.extend(true, {}, this.emptyRecord);
                    this.tempRecord.room = 0;
                     this.emptyRecord.id = 0;
                     this.tempRecord = $.extend(true, {}, this.emptyRecord);
                     this.tempRecord.room.building = this.emptyRecord;
                    // this.tempRecord = {};
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

         /**
         * Set material_room to record
         */
        setMaterial(record) {
            this.formMode = Enums.FormMode.assignMaterial;
            this.tempRecord.id = record.id;

            this.errors.clear();
            this.tempRecord = $.extend(true, {}, this.emptyRecord);
            // Update material-room checked state
            this.materials.forEach(material => {
                material.checked = false;
                let res = record.materials.filter(materialRoom => materialRoom.id == material.id);

                material.checked = (res.length > 0);
            });
        },

        /**
         * Save Material Record
         */
        saveMaterialRoomRecord () {
            // Prepare data
            let data = {
                room_id: this.tempRecord.id,
                materials: []
            };
              // Prepare data
            data.materials = this.materials.filter(el => el.checked == true)
                .map(el => el.id);

            this.isLoading = true;

            // Try to save
            this.$store.dispatch('saveMaterialRoomRecord', data)
                .then(res => {
                    this.isLoading = false;

                    if (res) {
                        demo.showNotification('ﺪﺷ ﻡﺎﺠﻧا ﺕیﻖﻓﻮﻣ ﺎﺑ ﺕﺎﻋﻼﻃا ﺖﺒﺛ', 'success');

                        this.registerCancel();
                    } else {
                        demo.showNotification('ﺖﺳا ﻩﺪﺷ ﺖﺒﺛ ﻼﺒﻗ ﻡﺎﻧ ﻥیا', 'warning');
                    }
                })
                .catch(err => {
                    this.isLoading = false;

                    if (err.response.status) {
                        demo.showNotification('ﺖﺳا ﻩﺪﺷ ﺖﺒﺛ ﻼﺒﻗ ﻡﺎﻧ ﻥیا', 'danger');
                    } else {
                        demo.showNotification(err.message, 'danger');
                    }
                });

            return;
        },
    },
})
