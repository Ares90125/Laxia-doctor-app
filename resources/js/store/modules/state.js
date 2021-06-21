import * as types from '../mutation-types'

// state
export const state = {
  is_enum_loaded: false,
  is_master_loaded: false,
  is_loading: false,
}

// getters
export const getters = {
  is_enum_loaded: state => state.is_enum_loaded,
  is_master_loaded: state => state.is_master_loaded,
  is_loading: state => state.is_loading,
}

// mutations
export const mutations = {
  [types.SET_IS_ENUM_LOADED] (state) {
    state.is_enum_loaded = true
  },

  [types.SET_IS_MASTER_LOADED] (state) {
    state.is_master_loaded = true
  },

  [types.SET_IS_LOADING] (state) {
    state.is_loading = true
  },

  [types.REMOVE_IS_LOADING] (state) {
    state.is_loading = false
  },
}

// actions
export const actions = {
  setIsEnumLoaded ({ commit }) {
    commit(types.SET_IS_ENUM_LOADED)
  },

  setIsMasterLoaded ({ commit }) {
    commit(types.SET_IS_MASTER_LOADED)
  },

  setIsLoading ({ commit }) {
    commit(types.SET_IS_LOADING)
  },

  removeIsLoading ({ commit }) {
    commit(types.REMOVE_IS_LOADING)
  }
}
