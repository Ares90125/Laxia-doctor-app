import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'
import utils from './helpers/utilities'
import VueSweetalert2 from 'vue-sweetalert2';
import VueLazyLoad from 'vue-lazyload'
import ToggleButton from 'vue-js-toggle-button'
import Firebase from 'firebase'
import Multiselect from 'vue-multiselect'

require("./firebase_info")

Vue.use(VueLazyLoad)
Vue.use(ToggleButton)
Vue.component('multiselect', Multiselect)

const moment = require('moment')
require('moment/locale/ja')
Vue.use(require('vue-moment'), { moment })

import '~/plugins'
import '~/components'

global.Vue = require('vue')
Vue.prototype.$utils = utils

require('./helpers/directives')

Vue.use(VueSweetalert2, {
  confirmButtonText: 'はい',
  cancelButtonText: 'いいえ',
});

Vue.filter("currency", function (value) {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + "円";
});
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('YYYY年MM月DD日')
  }
});
Vue.filter('formatDateTimeWithDay', function(value) {
  if (value) {
    return moment(String(value)).format('YYYY/MM/DD(ddd) HH:mm')
  }
});
Vue.filter('formatDateWithDay', function(value) {
  if (value) {
    return moment(String(value)).format('YYYY/MM/DD(ddd)')
  }
});
Vue.filter('formatTime', function(value) {
  return value.substr(0, 5);
});
Vue.filter('formatTime12', function(value) {
  if (value) {
    return moment(String(value)).format('h:mm a')
  }
});

Vue.config.productionTip = false

var firebaseApp = Firebase.initializeApp(window.firebaseConfig);
window.firestore = firebaseApp.firestore();

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
