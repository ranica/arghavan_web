Vue.use(Vuex);

const state =
{
	_data:
	{
		data         : [],
		current_page : 1,
		from         : 1,
		last_page    : 1,
		next_page_url: null,
		per_page     : 25,
		prev_page_url: null,
		to           : 1,
		total        : 0,
	}
};


const getters =
{
	/**
	 * Return records list
	 */
	records: state => state._data.data,

	/**
	 * Return all data
	 */
	allData: state => state._data,

	/**
	 * Permissions
	 */
	permissions: state => state._permissions,

	/**
	 * Dashboards
	 */
	dashboards: state => state._dashboards,

	/**
	 * Menu Base
	 */
	menuBases: state => state._menuBases,
	/**
	 * Menu Structure
	 */
	menuStructures: state => state._menuStructures,

	/**
	 * Menu User
	 */
	menuUsers: state => state._menuUsers,

	/**
	 * Menu Gate
	 */
	menuGates: state => state._menuGates,

	/**
	 * Menu Setting Gate
	 */
	menuSettingGates: state => state._menuSettingGates,

	/**
	 * Menu Setting System
	 */
	menuSettingSystems: state => state._menuSettingSystems,

	/**
	 * Menu Report
	 */
	menuReports: state => state._menuReports,

	/**
	 * Menu Referral
	 */
	menuReferrals: state => state._menuReferrals,

	/**
	 * Menu Dormitories
	 */
	menuDormitories: state => state._menuDormitories,

	/**
	 * Menu Requests
	 */
	menuRequests: state => state._menuRequests,

	/**
	 * Menu SMS
	 */
	menuSMS: state => state._menuSMS,

	/**
	 * Menu Parking
	 */
	menuParking: state => state._menuParking,

	/**
	 * List Button
	 */
	listButtons: state => state._listButtons,
};


const mutations =
{
	/**
	 * Set permissions
	 */
	setPermissions: (state, data) => {
		state._permissions = data;
	},

	/**
	 * Set Dashboards
	 */
	setDashboards: (state, data) => {
		state._dashboards = data;
	},

	/**
	 * Set MenuBases
	 */
	setMenuBases: (state, data) => {
		state._menuBases = data;
	},

	/**
	 * Set Menu Structures
	 */
	setMenuStructures: (state, data) => {
		state._menuStructures = data;
	},

	/**
	 * Set Menu Users
	 */
	setMenuUsers: (state, data) => {
		state._menuUsers = data;
	},

	/**
	 * Set Menu Gates
	 */
	setMenuGates: (state, data) => {
		state._menuGates = data;
	},

	/**
	 * Set Menu Setting Gates
	 */
	setMenuSettingGates: (state, data) => {
		state._menuSettingGates = data;
	},

	/**
	 * Set Menu Setting Systems
	 */
	setMenuSettingSystems: (state, data) => {
		state._menuSettingSystems = data;
	},

	/**
	 * Set Menu Report
	 */
	setMenuReports: (state, data) => {
		state._menuReports = data;
	},

	/**
	 * Set Menu Referral
	 */
	setMenuReferrals: (state, data) => {
		state._menuReferrals = data;
	},

	/**
	 * Set Menu Dormitory
	 */
	setMenuDormitories: (state, data) => {
		state._menuDormitories = data;
	},

	/**
	 * Set Menu Request
	 */
	setMenuRequests: (state, data) => {
		state._menuRequests = data;
	},

	/**
	 * Set Menu SMS
	 */
	setMenuSMS: (state, data) => {
		state._menuSMS = data;
	},
	/**
	 * Set Menu Parking
	 */
	setMenuParking: (state, data) => {
		state._menuParking = data;
	},

	/**
	 * Set List Button
	 */
	setListButtons: (state, data) => {
		state._listButtons = data;
	},

	/**
	 * Set data
	 */
	setData: (state, data) => {
		state._data = data;
	},

	/**
	 * Insert a new record
	 */
	insertRecord: (state, record) => {
		let oldRecord = state._data.data.filter(el => el.id == record.id);

        if (null == oldRecord){
            oldRecord == [];
        }

        if (0 == oldRecord.length){
        	state._data.data.push(record);
        }
	},

	/**
	 * Update an existing record
	 */
	updateRecord: (state, payload) => {
		let getters = payload.getters;
        let record  = payload.record;

        let currentRecord   = getters.records.filter(el => el.id == record.id)[0];

        if (null != currentRecord){
			currentRecord.name        = record.name;
			currentRecord.description = record.description;
			currentRecord.state       = record.state;
			currentRecord.permissions = record.permissions;
			currentRecord.stateStr    = record.stateStr;
        }
	},

	/**
	 * Delete a role
	 */
	deleteRecord: (state, index) => {
		state._data.data.splice(index, 1);
	},

	// /**
	//  * Insert a new record
	//  */
	// insertPermissionRecord: (state, record) =>
	// {
 //       	state._data.data.push(record);
	// }
};


const actions = {
	/**
	 * Load Permissions
	 */
	loadPermissions(context){
		return new Promise((resolve, reject) => {
			axios.get('/permissions/data/all')
				.then(res => {

					context.commit ('setPermissions', res.data.all);
					context.commit ('setDashboards', res.data.dashboard);
					context.commit ('setMenuStructures', res.data.menuStructure);
					context.commit ('setMenuUsers', res.data.menuUser);
					context.commit ('setMenuGates', res.data.menuGate);
					context.commit ('setMenuSettingGates', res.data.menuSettingGate);
					context.commit ('setMenuSettingSystems', res.data.menuSettingSystem);
					context.commit ('setMenuReports', res.data.menuReport);
					context.commit ('setMenuReferrals', res.data.menuReferral);
					context.commit ('setMenuDormitories', res.data.menuDormitory);
					context.commit ('setMenuRequests', res.data.menuRequest);
					context.commit ('setMenuSMS', res.data.menuSMS);
					context.commit ('setMenuParking', res.data.menuParking);
					context.commit ('setListButtons', res.data.listButton);
					resolve(res);
				})
				.catch(err => reject(err) );
		});
	},


	/**
	 * Load MenuUsers
	 */
	loadMenuUsers(context){
		return new Promise((resolve, reject) => {
			axios.get('/permissions/data/menuUser')
				.then(res => {
					context.commit ('setMenuUsers', res.data);
					console.log('loadMenuUsers -> res', res);

					resolve(res);
				})
				.catch(err => reject(err) );
		});
	},

	/**
	 * Load MenuUsers
	 */
	// loadMenuUsers(context){
	// 	return new Promise((resolve, reject) => {
	// 		axios.get('/permissions/data/menuUser')
	// 			.then(res => {
	// 				context.commit ('setMenuUsers', res.data);
	// 				console.log('loadMenuUsers -> res', res);

	// 				resolve(res);
	// 			})
	// 			.catch(err => reject(err) );
	// 	});
	// },

	/**
	 * Load records data
	 */
	loadRecords(context, page) {
		return new Promise((resolve, reject) => {
			axios.get('/roles?page=' + page)
				.then(res => {
					// Add "selected" property to items
					let allData = res.data;
					let rowData = allData.data;

					rowData = rowData.map(x => {
						x.selected = false;

						return x;
					});

					// Set data
					context.commit('setData', allData);

					resolve(res);
				})
				.catch(err => {
					// Empty List
					context.commit('setData', []);

					resolve(err);
				});
		});
	},

	/**
	 * save Field
	 */
	saveRecord: (context, record) => {
		return new Promise((resolve, reject) =>	{
			// New record
			if (0 == record.id)	{
				axios.post('/roles', record)
					.then(res => {
						let status   = (0 == res.data.status);
						let newRecord = res.data.role;

						if (null != newRecord) {
							context.commit('insertRecord', newRecord);
						}

						resolve(status);
					})
					.catch(err => reject(err));
			}

			// Update record
			else
			{
				axios.put('/roles/' + record.id, record)
					.then(res =>
					{
						let status       = (0 == res.data.status);
						let updatedRecord = res.data.role;

						if (null != updatedRecord)
						{
							context.commit('updateRecord',
								{
									getters: context.getters,
									record : updatedRecord
								});
						}

						resolve(status);
					})
					.catch(err => reject(err));
			}
		});
	},

	/**
	 * Delete a Record
	 */
	deleteRecord(context, id)
	{
		return new Promise((resolve, reject) =>
		{
			// Get item index
			let index = context.getters.records
				.map(el => el.id)
				.indexOf(id);

			// Record not found!
			if (-1 == index)
			{
				reject({
					message: 'رکورد مورد نظر یافت نشد',
				});

				return;
			}

			// Try to delete
			axios.delete('/roles/' + id)
				.then(res =>
				{
					if (0 == res.data.status)
					{
						// Remove form resources list
						context.commit('deleteRecord', index);

						resolve(res);

						return;
					}

					reject({
						message: 'امکان حذف وجود ندارد'
					});
				})
				.catch(err =>{
					reject(err);
				});
		});
	},


	/**
	 * save Permission
	 */
	savePermissionRecord: (context, record) => {
		return new Promise((resolve, reject) => {
			let url = '/roles/' + record.role_id + '/setPermission';
			let data = { permissions: record.permissions };

			axios.put(url, data)
				.then(res => {
					let status = (0 == res.data.status);
					let record = res.data.role;

					if (null != record) {
						context.commit ('updateRecord', {
									getters: context.getters,
									record : record
								});
					}

					resolve(status);
				})
				.catch(err => reject(err));
		});
	},
};

export default new Vuex.Store({
	state,
	getters,
	mutations,
	actions,
});
