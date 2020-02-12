Vue.use(Vuex);

const state =
{
};

const getters =
{
};

const mutations =
{
};

const actions =
{
	login({commit, state}, loginData)
	{
		return axios.post('/login', loginData);
	}
};

export default new Vuex.Store(
{
	state,
	getters,
	mutations,
	actions,
});
