function initialState() {
  return {
    entry: {
      id: null,
      first_name: '',
      middle_name: '',
      last_name: '',
      created_at: '',
      code_ds_gender: null,
      dob: '',
      married: null,
      height: '',
      minimum_income: '',
      date_time: '',
      email: null,
      password: null,
      size: '',
      time: '',
      multiple_file: [],
      single_file: [],
      multiple_photo: [],
      single_photo: [],
      belongs_to_id: null,
      belongs_to_many: [],
      text_area: '',
      checkbox: false,
      updated_at: '',
      deleted_at: '',
      owner_id: null
    },
    lists: {
      code_ds_gender: [],
      married: [],
      belongs_to: [],
      belongs_to_many: [],
      owner: []
    },
    loading: false
  }
}

const route = 'admissions'

const getters = {
  entry: state => state.entry,
  lists: state => state.lists,
  loading: state => state.loading
}

const actions = {
  storeData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = objectToFormData(state.entry, {
        indices: true,
        booleansAsIntegers: true
      })
      axios
        .post(route, params)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          let message = error.response.data.message || error.message
          let errors = error.response.data.errors

          dispatch(
            'Alert/setAlert',
            { message: message, errors: errors, color: 'danger' },
            { root: true }
          )

          reject(error)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    })
  },
  updateData({ commit, state, dispatch }) {
    commit('setLoading', true)
    dispatch('Alert/resetState', null, { root: true })

    return new Promise((resolve, reject) => {
      let params = objectToFormData(state.entry, {
        indices: true,
        booleansAsIntegers: true
      })
      params.set('_method', 'PUT')
      axios
        .post(`${route}/${state.entry.id}`, params)
        .then(response => {
          resolve(response)
        })
        .catch(error => {
          let message = error.response.data.message || error.message
          let errors = error.response.data.errors

          dispatch(
            'Alert/setAlert',
            { message: message, errors: errors, color: 'danger' },
            { root: true }
          )

          reject(error)
        })
        .finally(() => {
          commit('setLoading', false)
        })
    })
  },
  setFirstName({ commit }, value) {
    commit('setFirstName', value)
  },
  setMiddleName({ commit }, value) {
    commit('setMiddleName', value)
  },
  setLastName({ commit }, value) {
    commit('setLastName', value)
  },
  setCreatedAt({ commit }, value) {
    commit('setCreatedAt', value)
  },
  setCodeDsGender({ commit }, value) {
    commit('setCodeDsGender', value)
  },
  setDob({ commit }, value) {
    commit('setDob', value)
  },
  setMarried({ commit }, value) {
    commit('setMarried', value)
  },
  setHeight({ commit }, value) {
    commit('setHeight', value)
  },
  setMinimumIncome({ commit }, value) {
    commit('setMinimumIncome', value)
  },
  setDateTime({ commit }, value) {
    commit('setDateTime', value)
  },
  setEmail({ commit }, value) {
    commit('setEmail', value)
  },
  setPassword({ commit }, value) {
    commit('setPassword', value)
  },
  setSize({ commit }, value) {
    commit('setSize', value)
  },
  setTime({ commit }, value) {
    commit('setTime', value)
  },
  insertMultipleFileFile({ commit }, file) {
    commit('insertMultipleFileFile', file)
  },
  removeMultipleFileFile({ commit }, file) {
    commit('removeMultipleFileFile', file)
  },
  insertSingleFileFile({ commit }, file) {
    commit('insertSingleFileFile', file)
  },
  removeSingleFileFile({ commit }, file) {
    commit('removeSingleFileFile', file)
  },
  insertMultiplePhotoFile({ commit }, file) {
    commit('insertMultiplePhotoFile', file)
  },
  removeMultiplePhotoFile({ commit }, file) {
    commit('removeMultiplePhotoFile', file)
  },
  insertSinglePhotoFile({ commit }, file) {
    commit('insertSinglePhotoFile', file)
  },
  removeSinglePhotoFile({ commit }, file) {
    commit('removeSinglePhotoFile', file)
  },
  setBelongsTo({ commit }, value) {
    commit('setBelongsTo', value)
  },
  setBelongsToMany({ commit }, value) {
    commit('setBelongsToMany', value)
  },
  setTextArea({ commit }, value) {
    commit('setTextArea', value)
  },
  setCheckbox({ commit }, value) {
    commit('setCheckbox', value)
  },
  setUpdatedAt({ commit }, value) {
    commit('setUpdatedAt', value)
  },
  setDeletedAt({ commit }, value) {
    commit('setDeletedAt', value)
  },
  setOwner({ commit }, value) {
    commit('setOwner', value)
  },
  fetchCreateData({ commit }) {
    axios.get(`${route}/create`).then(response => {
      commit('setLists', response.data.meta)
    })
  },
  fetchEditData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}/edit`).then(response => {
      commit('setEntry', response.data.data)
      commit('setLists', response.data.meta)
    })
  },
  fetchShowData({ commit, dispatch }, id) {
    axios.get(`${route}/${id}`).then(response => {
      commit('setEntry', response.data.data)
    })
  },
  resetState({ commit }) {
    commit('resetState')
  }
}

const mutations = {
  setEntry(state, entry) {
    state.entry = entry
  },
  setFirstName(state, value) {
    state.entry.first_name = value
  },
  setMiddleName(state, value) {
    state.entry.middle_name = value
  },
  setLastName(state, value) {
    state.entry.last_name = value
  },
  setCreatedAt(state, value) {
    state.entry.created_at = value
  },
  setCodeDsGender(state, value) {
    state.entry.code_ds_gender = value
  },
  setDob(state, value) {
    state.entry.dob = value
  },
  setMarried(state, value) {
    state.entry.married = value
  },
  setHeight(state, value) {
    state.entry.height = value
  },
  setMinimumIncome(state, value) {
    state.entry.minimum_income = value
  },
  setDateTime(state, value) {
    state.entry.date_time = value
  },
  setEmail(state, value) {
    state.entry.email = value
  },
  setPassword(state, value) {
    state.entry.password = value
  },
  setSize(state, value) {
    state.entry.size = value
  },
  setTime(state, value) {
    state.entry.time = value
  },
  insertMultipleFileFile(state, file) {
    state.entry.multiple_file.push(file)
  },
  removeMultipleFileFile(state, file) {
    state.entry.multiple_file = state.entry.multiple_file.filter(item => {
      return item.id !== file.id
    })
  },
  insertSingleFileFile(state, file) {
    state.entry.single_file.push(file)
  },
  removeSingleFileFile(state, file) {
    state.entry.single_file = state.entry.single_file.filter(item => {
      return item.id !== file.id
    })
  },
  insertMultiplePhotoFile(state, file) {
    state.entry.multiple_photo.push(file)
  },
  removeMultiplePhotoFile(state, file) {
    state.entry.multiple_photo = state.entry.multiple_photo.filter(item => {
      return item.id !== file.id
    })
  },
  insertSinglePhotoFile(state, file) {
    state.entry.single_photo.push(file)
  },
  removeSinglePhotoFile(state, file) {
    state.entry.single_photo = state.entry.single_photo.filter(item => {
      return item.id !== file.id
    })
  },
  setBelongsTo(state, value) {
    state.entry.belongs_to_id = value
  },
  setBelongsToMany(state, value) {
    state.entry.belongs_to_many = value
  },
  setTextArea(state, value) {
    state.entry.text_area = value
  },
  setCheckbox(state, value) {
    state.entry.checkbox = value
  },
  setUpdatedAt(state, value) {
    state.entry.updated_at = value
  },
  setDeletedAt(state, value) {
    state.entry.deleted_at = value
  },
  setOwner(state, value) {
    state.entry.owner_id = value
  },
  setLists(state, lists) {
    state.lists = lists
  },
  setLoading(state, loading) {
    state.loading = loading
  },
  resetState(state) {
    state = Object.assign(state, initialState())
  }
}

export default {
  namespaced: true,
  state: initialState,
  getters,
  actions,
  mutations
}
