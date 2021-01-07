import Vue from 'vue';
import App from './core/App.vue';

import ElementUI from 'element-ui';
import i18n from './bootstrap/i18n';

import router from './bootstrap/router';
import store from './core/store';

import globalMixin from './includes/mixins/globalMixin';

import './bootstrap/moment';

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
    window._ = require('lodash');
    window.moment = require('moment');
} catch (e) {
    console.log('Error load main libraries');
}


/**
 * Set Vue options
 */
Vue.use(
    ElementUI,
    {
        i18n: (key, value) => i18n.t(key, value)
    }
);

Vue.config.productionTip = false;

Vue.mixin(globalMixin);

/**
 * Start Application
 */
new Vue({
    router,
    store,
    i18n,
    render: h => h(App)
}).$mount('#app');
