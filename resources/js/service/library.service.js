import Vue from 'vue';
import Vuex from 'vuex';

import Bus from '@fj-js/common/event.bus';

// FontAwesome
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { library, config } from '@fortawesome/fontawesome-svg-core';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';

import VueDropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';

import CKEditor from '@ckeditor/ckeditor5-vue';
import BootstrapVue from 'bootstrap-vue';
import VueCodemirror from 'vue-codemirror';
import VueCtkDateTimePicker from 'vue-ctk-date-time-picker';
import Draggable from 'vuedraggable';

// FontAwesome
library.add(far);
library.add(fas);
library.add(fab);
Vue.component('fa-icon', FontAwesomeIcon);

// Modules
Vue.use(Vuex);
Vue.use(BootstrapVue);
Vue.use(CKEditor);
Vue.use(VueCodemirror);
Vue.use(Draggable);
Vue.use(VueDropzone);

Vue.component('VueCtkDateTimePicker', VueCtkDateTimePicker);

// prototypes
Vue.prototype.$bus = Bus;