import * as types from '../mutation-types'

// state
export const state = {
  gender_types: null,
  rsv_status_types: null,
  rsv_source_types: null,
  masui: null,
  bleeding: null,
  hospital_need: null,
  hospital_visit: null,
  makeup: null,
  massage: null,
  pain: null,
  shower: null,
  sport_impossible: null,
  basshi: null,
  hare: null,
  treat_time: null,
}

// getters
export const getters = {
  rsv_status_types: state => state.rsv_status_types,
  gender_types: state => state.gender_types,
  rsv_source_types: state => state.rsv_source_types,
  masui: state => state.masui,
  bleeding: state => state.bleeding,
  hospital_need: state => state.hospital_need,
  hospital_visit: state => state.hospital_visit,
  makeup: state => state.makeup,
  massage: state => state.massage,
  pain: state => state.pain,
  shower: state => state.shower,
  sport_impossible: state => state.sport_impossible,
  basshi: state => state.basshi,
  hare: state => state.hare,
  treat_time: state => state.treat_time,
}

// mutations
export const mutations = {
  [types.SAVE_RSV_STATUS_TYPES] (state, { rsv_status_types }) {
    state.rsv_status_types = Object.keys(rsv_status_types)
      .filter(key => key <= 20)
      .reduce((obj, key) => {
        return {
          ...obj,
          [key]: rsv_status_types[key]
        };
      }, {})
  },

  [types.SAVE_GENDER_TYPES] (state, { gender_types }) {
    state.gender_types = gender_types
  },

  [types.SAVE_RSV_SOURCE_TYPES] (state, { rsv_source_types }) {
    state.rsv_source_types = rsv_source_types
  },

  [types.SAVE_MENU_MASUI_TYPES] (state, { masui }) {
    state.masui = masui
  },

  [types.SAVE_MENU_BLEEDING_TYPES] (state, { bleeding }) {
    state.bleeding = bleeding
  },

  [types.SAVE_MENU_HOSPITACL_NEED_TYPES] (state, { hospital_need }) {
    state.hospital_need = hospital_need
  },

  [types.SAVE_MENU_HOSPITAL_VISIT_TYPES] (state, { hospital_visit }) {
    state.hospital_visit = hospital_visit
  },

  [types.SAVE_MENU_MAKEUP_TYPES] (state, { makeup }) {
    state.makeup = makeup
  },

  [types.SAVE_MENU_MASSAGE_TYPES] (state, { massage }) {
    state.massage = massage
  },

  [types.SAVE_MENU_PAIN_TYPES] (state, { pain }) {
    state.pain = pain
  },

  [types.SAVE_MENU_SHOWER_TYPES] (state, { shower }) {
    state.shower = shower
  },

  [types.SAVE_MENU_SPORT_IMPOSSIBLE_TYPES] (state, { sport_impossible }) {
    state.sport_impossible = sport_impossible
  },

  [types.SAVE_MENU_BASSHI_TYPES] (state, { basshi }) {
    state.basshi = basshi
  },

  [types.SAVE_MENU_HARE_TYPES] (state, { hare }) {
    state.hare = hare
  },

  [types.SAVE_MENU_TREAT_TIME_TYPES] (state, { treat_time }) {
    state.treat_time = treat_time
  },
}

// actions
export const actions = {
  saveRsvStatusTypes ({ commit }, payload) {
    commit(types.SAVE_RSV_STATUS_TYPES, payload)
  },

  saveGenderTypes ({ commit }, payload) {
    commit(types.SAVE_GENDER_TYPES, payload)
  },

  saveRsvSourceTypes ({ commit }, payload) {
    commit(types.SAVE_RSV_SOURCE_TYPES, payload)
  },

  saveMenuMasuiTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_MASUI_TYPES, payload)
  },

  saveMenuBleedingTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_BLEEDING_TYPES, payload)
  },

  saveMenuHospitalNeedTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_HOSPITACL_NEED_TYPES, payload)
  },

  saveMenuHospitalVisitTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_HOSPITAL_VISIT_TYPES, payload)
  },

  saveMenuMakeupTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_MAKEUP_TYPES, payload)
  },

  saveMenuMassageTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_MASSAGE_TYPES, payload)
  },

  saveMenuPainTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_PAIN_TYPES, payload)
  },

  saveMenuShowerTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_SHOWER_TYPES, payload)
  },

  saveMenuSportImpossibleTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_SPORT_IMPOSSIBLE_TYPES, payload)
  },

  saveMenuBasshiTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_BASSHI_TYPES, payload)
  },

  saveMenuHareTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_HARE_TYPES, payload)
  },

  saveMenuTreatTimeTypes ({ commit }, payload) {
    commit(types.SAVE_MENU_TREAT_TIME_TYPES, payload)
  },
}
