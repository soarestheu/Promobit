import { createApp } from 'vue'

import App from './App.vue'
import router from './router'
import navBar from "@/components/NavBar.vue";

import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faUserPlus } from '@fortawesome/free-solid-svg-icons'
import { faPortrait } from '@fortawesome/free-solid-svg-icons'
import { faUserEdit } from '@fortawesome/free-solid-svg-icons'
import { faIdBadge } from '@fortawesome/free-solid-svg-icons'
import { faSyncAlt } from '@fortawesome/free-solid-svg-icons'
import { faMinusCircle } from '@fortawesome/free-solid-svg-icons'
import { faArrowLeft } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

library.add(faUserPlus)
library.add(faUserEdit)
library.add(faPortrait)
library.add(faMinusCircle)
library.add(faArrowLeft)
library.add(faSyncAlt)
library.add(faIdBadge)



createApp(App)
    .use(router)
    .component('font-awesome-icon', FontAwesomeIcon)
    .component('nav-bar', navBar)
    .mount('#app');