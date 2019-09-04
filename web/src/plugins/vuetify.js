import Vue from 'vue'
import Vuetify, {
    VApp, // required
    VTabs,
    VTab,
    VTabItem,
    VCard,
    VCardText,
    VBtn,
    VDialog,
    VAlert,
    VAvatar,
    VAutocomplete,
    VSelect,
    VRadio,
    VRadioGroup
} from 'vuetify/lib'
import 'vuetify/src/stylus/app.styl'

Vue.use(Vuetify, {
    iconfont: 'md',
    components: {
        VApp,
        VTabs,
        VTab,
        VTabItem,
        VCard,
        VCardText,
        VBtn,
        VDialog,
        VAlert,
        VAvatar,
        VAutocomplete,
        VSelect,
        VRadio,
        VRadioGroup
    }
})