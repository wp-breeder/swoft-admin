(function(e){function t(t){for(var r,a,i=t[0],u=t[1],c=t[2],l=0,d=[];l<i.length;l++)a=i[l],o[a]&&d.push(o[a][0]),o[a]=0;for(r in u)Object.prototype.hasOwnProperty.call(u,r)&&(e[r]=u[r]);f&&f(t);while(d.length)d.shift()();return s.push.apply(s,c||[]),n()}function n(){for(var e,t=0;t<s.length;t++){for(var n=s[t],r=!0,a=1;a<n.length;a++){var i=n[a];0!==o[i]&&(r=!1)}r&&(s.splice(t--,1),e=u(u.s=n[0]))}return e}var r={},a={app:0},o={app:0},s=[];function i(e){return u.p+"js/"+({}[e]||e)+"."+{"chunk-0a81e278":"4a531a71","chunk-19d46710":"44f3a7d8","chunk-3fcab054":"dd40b7bd","chunk-c2759cc8":"8c1ca896","chunk-2d0d9fbf":"243d0da1","chunk-2d237d51":"6b9a509b","chunk-79ab9501":"19546166"}[e]+".js"}function u(t){if(r[t])return r[t].exports;var n=r[t]={i:t,l:!1,exports:{}};return e[t].call(n.exports,n,n.exports,u),n.l=!0,n.exports}u.e=function(e){var t=[],n={"chunk-0a81e278":1,"chunk-3fcab054":1,"chunk-c2759cc8":1,"chunk-79ab9501":1};a[e]?t.push(a[e]):0!==a[e]&&n[e]&&t.push(a[e]=new Promise(function(t,n){for(var r="css/"+({}[e]||e)+"."+{"chunk-0a81e278":"8008b31c","chunk-19d46710":"31d6cfe0","chunk-3fcab054":"479ddfd2","chunk-c2759cc8":"a2f5448e","chunk-2d0d9fbf":"31d6cfe0","chunk-2d237d51":"31d6cfe0","chunk-79ab9501":"d05620bf"}[e]+".css",o=u.p+r,s=document.getElementsByTagName("link"),i=0;i<s.length;i++){var c=s[i],l=c.getAttribute("data-href")||c.getAttribute("href");if("stylesheet"===c.rel&&(l===r||l===o))return t()}var d=document.getElementsByTagName("style");for(i=0;i<d.length;i++){c=d[i],l=c.getAttribute("data-href");if(l===r||l===o)return t()}var f=document.createElement("link");f.rel="stylesheet",f.type="text/css",f.onload=t,f.onerror=function(t){var r=t&&t.target&&t.target.src||o,s=new Error("Loading CSS chunk "+e+" failed.\n("+r+")");s.code="CSS_CHUNK_LOAD_FAILED",s.request=r,delete a[e],f.parentNode.removeChild(f),n(s)},f.href=o;var p=document.getElementsByTagName("head")[0];p.appendChild(f)}).then(function(){a[e]=0}));var r=o[e];if(0!==r)if(r)t.push(r[2]);else{var s=new Promise(function(t,n){r=o[e]=[t,n]});t.push(r[2]=s);var c,l=document.createElement("script");l.charset="utf-8",l.timeout=120,u.nc&&l.setAttribute("nonce",u.nc),l.src=i(e),c=function(t){l.onerror=l.onload=null,clearTimeout(d);var n=o[e];if(0!==n){if(n){var r=t&&("load"===t.type?"missing":t.type),a=t&&t.target&&t.target.src,s=new Error("Loading chunk "+e+" failed.\n("+r+": "+a+")");s.type=r,s.request=a,n[1](s)}o[e]=void 0}};var d=setTimeout(function(){c({type:"timeout",target:l})},12e4);l.onerror=l.onload=c,document.head.appendChild(l)}return Promise.all(t)},u.m=e,u.c=r,u.d=function(e,t,n){u.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:n})},u.r=function(e){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},u.t=function(e,t){if(1&t&&(e=u(e)),8&t)return e;if(4&t&&"object"===typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(u.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)u.d(n,r,function(t){return e[t]}.bind(null,r));return n},u.n=function(e){var t=e&&e.__esModule?function(){return e["default"]}:function(){return e};return u.d(t,"a",t),t},u.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},u.p="/",u.oe=function(e){throw console.error(e),e};var c=window["webpackJsonp"]=window["webpackJsonp"]||[],l=c.push.bind(c);c.push=t,c=c.slice();for(var d=0;d<c.length;d++)t(c[d]);var f=l;s.push([0,"chunk-vendors"]),n()})({0:function(e,t,n){e.exports=n("56d7")},"0418":function(e,t,n){"use strict";var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-toolbar",{attrs:{"clipped-left":"",absolute:"",app:""}},[e.primaryDrawer.type?n("v-toolbar-side-icon",{on:{click:function(t){return t.stopPropagation(),e.setModel(t)}}}):e._e(),n("v-toolbar-title",{staticClass:"headline text-uppercase"},[n("span",[e._v("SWOFT")]),n("span",{staticClass:"font-weight-light"},[e._v(e._s(e.$t("Sys.title")))])]),e.primaryDrawer.type?n("UserCenter",{attrs:{setDialog:e.dialog},on:{closeDialog:e.close}}):e._e(),n("v-spacer"),e.primaryDrawer.type?n("v-text-field",{staticClass:"hidden-sm-and-down",attrs:{flat:"","solo-inverted":"","hide-details":"","prepend-inner-icon":"search",label:e.$t("Sys.search")}}):e._e(),n("v-menu",{attrs:{"offset-y":""},scopedSlots:e._u([{key:"activator",fn:function(t){var r=t.on;return[n("v-btn",e._g({attrs:{flat:""}},r),[e._v("\n        "+e._s(e.$t("Sys.theme"))+"\n      ")])]}}])},[n("v-list",e._l(e.themeItems,function(t,r){return n("v-list-tile",{key:r,on:{click:function(t){return e.theme(r)}}},[n("v-list-tile-title",[e._v(e._s(e.$t(t.title)))])],1)}),1)],1),n("v-menu",{attrs:{"offset-y":""},scopedSlots:e._u([{key:"activator",fn:function(t){var r=t.on;return[n("v-btn",e._g({attrs:{flat:""}},r),[e._v("\n        "+e._s(e.$t("Sys.lang"))+"\n      ")])]}}])},[n("v-list",e._l(e.langItems,function(t,r){return n("v-list-tile",{key:r,on:{click:function(t){return e.lang(r)}}},[n("v-list-tile-title",[e._v(e._s(t.title))])],1)}),1)],1),e.primaryDrawer.type?n("v-menu",{attrs:{"offset-y":""},scopedSlots:e._u([{key:"activator",fn:function(t){var r=t.on;return[n("v-btn",e._g({attrs:{icon:"",flat:"",large:""}},r),[n("v-avatar",{attrs:{size:"32px",tile:""}},[n("img",{attrs:{src:"https://cdn.vuetifyjs.com/images/logos/logo.svg",alt:"Vuetify"}})])],1)]}}],null,!1,2671772195)},[n("v-list",e._l(e.userItems,function(t,r){return n("v-list-tile",{key:r,on:{click:function(t){return e.user(r)}}},[n("v-list-tile-title",[e._v(e._s(e.$t(t.title)))])],1)}),1)],1):e._e(),e.primaryDrawer.type?e._e():n("v-btn",{attrs:{flat:"",href:"https://github.com/vuetifyjs/vuetify/releases/latest",target:"_blank"}},[n("span",{staticClass:"mr-2"},[e._v("Latest Release")])]),n("a",{staticClass:"github-corner",attrs:{href:"https://github.com/vuetifyjs/vuetify/releases/latest",target:"_blank","aria-label":"View source on GitHub"}},[n("svg",{staticStyle:{fill:"#151513",color:"#fff",position:"absolute",top:"0",border:"0",right:"0"},attrs:{width:"60",height:"60",viewBox:"0 0 250 250","aria-hidden":"true"}},[n("path",{attrs:{d:"M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"}}),n("path",{staticClass:"octo-arm",staticStyle:{"transform-origin":"130px 106px"},attrs:{d:"M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2",fill:"currentColor"}}),n("path",{staticClass:"octo-body",attrs:{d:"M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z",fill:"currentColor"}})])])],1)},a=[],o=n("0e72"),s=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-app",[n("v-layout",{attrs:{row:"","justify-center":""}},[n("v-dialog",{attrs:{persistent:"","max-width":"600px"},model:{value:e.dialog,callback:function(t){e.dialog=t},expression:"dialog"}},[n("v-tabs",{attrs:{"fixed-tabs":""},model:{value:e.tab,callback:function(t){e.tab=t},expression:"tab"}},[n("v-tab",{key:"userProfile"},[n("i",{staticClass:"material-icons"},[e._v("\n            account_circle\n          ")]),e._v("\n             "+e._s(e.$t("App.userProfile")))]),n("v-tab",{key:"editPwd"},[n("i",{staticClass:"material-icons"},[e._v("\n            edit\n          ")]),e._v("\n             "+e._s(e.$t("App.editPwd")))])],1),n("v-tabs-items",{model:{value:e.tab,callback:function(t){e.tab=t},expression:"tab"}},[n("v-tab-item",{key:"userProfile"},[n("v-card",[n("v-card-title",[n("span",{staticClass:"headline"},[e._v(e._s(e.$t("App.userProfile")))])]),n("v-form",[n("v-card-text",[n("v-container",{attrs:{"grid-list-md":""}},[n("v-layout",{attrs:{wrap:""}},[n("v-flex",{attrs:{xs12:""}},[n("v-text-field",{attrs:{label:e.$t("App.nickname"),required:""},model:{value:e.user.nickname,callback:function(t){e.$set(e.user,"nickname",t)},expression:"user.nickname"}})],1),n("v-flex",{attrs:{xs12:"",sm6:""}},[n("v-text-field",{attrs:{label:e.$t("App.email"),required:""},model:{value:e.user.email,callback:function(t){e.$set(e.user,"email",t)},expression:"user.email"}})],1),n("v-flex",{attrs:{xs12:"",sm6:""}},[n("v-text-field",{attrs:{label:e.$t("App.phone"),type:"phone",required:""},model:{value:e.user.phone,callback:function(t){e.$set(e.user,"phone",t)},expression:"user.phone"}})],1)],1)],1),n("small",[e._v(e._s(e.$t("Sys.requireMsg")))])],1)],1),n("v-card-actions",[n("v-spacer"),n("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:e.close}},[e._v(e._s(e.$t("Sys.close")))]),n("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:e.saveInfo}},[e._v(e._s(e.$t("Sys.save")))])],1)],1)],1),n("v-tab-item",{key:"editPwd"},[n("v-card",[n("v-card-title",[n("span",{staticClass:"headline"},[e._v(e._s(e.$t("App.editPwd")))])]),n("v-form",[n("v-card-text",[n("v-container",{attrs:{"grid-list-md":""}},[n("v-layout",{attrs:{wrap:""}},[n("v-flex",{attrs:{xs12:""}},[n("v-text-field",{attrs:{label:e.$t("App.newPwd")+"*",required:"",type:"password"},model:{value:e.edit.newPwd,callback:function(t){e.$set(e.edit,"newPwd",t)},expression:"edit.newPwd"}})],1),n("v-flex",{attrs:{xs12:""}},[n("v-text-field",{attrs:{label:e.$t("App.confimPwd")+"*",required:"",type:"password"},model:{value:e.edit.confimPwd,callback:function(t){e.$set(e.edit,"confimPwd",t)},expression:"edit.confimPwd"}})],1)],1)],1),n("small",[e._v(e._s(e.$t("Sys.requireMsg")))])],1)],1),n("v-card-actions",[n("v-spacer"),n("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:e.close}},[e._v(e._s(e.$t("Sys.close")))]),n("v-btn",{attrs:{color:"blue darken-1",flat:""},on:{click:e.savePwd}},[e._v(e._s(e.$t("Sys.save")))])],1)],1)],1)],1)],1)],1)],1)},i=[],u={name:"UserCenter",data:function(){return{tab:null,dialog:!1,user:{nickname:"",email:"",phone:""},edit:{newPwd:"",confimPwd:""}}},props:{setDialog:{type:Boolean,default:!1}},methods:{close:function(){this.$data.dialog=!1,this.$emit("closeDialog")},saveInfo:function(){var e=this;this.$api.account.editInfo(this.$data.user).then(function(){e.$notify.success("edit success"),e.$store.commit("setUserInfo",e.$data.user)}),this.close()},savePwd:function(){var e=this;8<=this.$data.edit.newPwd.length&&this.$data.edit.newPwd===this.$data.edit.confimPwd?this.$api.account.editPwd(this.$data.edit.newPwd).then(function(){e.$notify.success("edit success"),e.$store.commit("delToken"),e.$router.push({path:"/login"}),e.close()}):this.$notify.warn("Password length is not 8-20 or Two passwords are different, please check in")}},watch:{setDialog:function(e){this.$data.dialog=e}},created:function(){this.$data.user=this.$store.getters.userInfo}},c=u,l=n("2877"),d=n("6544"),f=n.n(d),p=n("7496"),m=n("8336"),h=n("b0af"),g=n("99d9"),v=n("12b2"),y=n("a523"),b=n("169a"),w=n("0e8f"),k=n("4bd4"),_=n("a722"),$=n("9910"),P=n("71a3"),M=n("c671"),x=n("fe57"),O=n("aac8"),S=n("2677"),T=Object(l["a"])(c,s,i,!1,null,null,null),C=T.exports;f()(T,{VApp:p["a"],VBtn:m["a"],VCard:h["a"],VCardActions:g["a"],VCardText:g["b"],VCardTitle:v["a"],VContainer:y["a"],VDialog:b["a"],VFlex:w["a"],VForm:k["a"],VLayout:_["a"],VSpacer:$["a"],VTab:P["a"],VTabItem:M["a"],VTabs:x["a"],VTabsItems:O["a"],VTextField:S["a"]});var V={name:"Header",components:{UserCenter:C},data:function(){return{themeItems:[{title:"Sys.dark"},{title:"Sys.light"}],langItems:[{title:"简体中文"},{title:"English"}],userItems:[{title:"Sys.personalCenter"},{title:"Sys.logout"}],primaryDrawer:{type:!0,model:!0},dialog:!1}},methods:{theme:function(e){var t=0===e;this.$store.commit("changeTheme",t)},lang:function(e){var t="";t=1===e?"en":"zh",this.$i18n.locale=t,o["a"].set("lang",t)},setModel:function(){this.$data.primaryDrawer.model=!this.$data.primaryDrawer.model,this.$emit("changeDrawerModel",this.$data.primaryDrawer.model)},user:function(e){var t=this;if(0===e)return this.$data.dialog=!0;this.$api.account.logout().then(function(){t.$store.commit("delToken"),t.$router.push({path:"/login"})})},close:function(){this.$data.dialog=!1}},props:{primaryDrawerType:{default:!0,type:Boolean},primaryDrawerModel:{default:!0,type:Boolean}},created:function(){this.$data.primaryDrawer.type=this.$props.primaryDrawerType},watch:{primaryDrawerModel:function(e){this.$data.primaryDrawer.model=e}}},j=V,A=(n("8baf"),n("8212")),I=n("8860"),D=n("ba95"),N=n("5d23"),E=n("e449"),R=n("71d9"),F=n("706c"),L=n("2a7f"),U=Object(l["a"])(j,r,a,!1,null,null,null);t["a"]=U.exports;f()(U,{VAvatar:A["a"],VBtn:m["a"],VList:I["a"],VListTile:D["a"],VListTileTitle:N["c"],VMenu:E["a"],VSpacer:$["a"],VTextField:S["a"],VToolbar:R["a"],VToolbarSideIcon:F["a"],VToolbarTitle:L["a"]})},"0cfc":function(e,t,n){},"0e72":function(e,t,n){"use strict";n("456d"),n("ac6a");var r=window.localStorage,a={set:function(e,t){r.setItem(e,t)},get:function(e){return r.getItem(e)},sets:function(e){var t=this;Object.keys(e).forEach(function(n){return t.set(n,e[n])})},gets:function(e){var t=this;return e.map(function(e){return t.get(e)})},setJson:function(e,t){r.setItem(e,JSON.stringify(t))},getJson:function(e){return JSON.parse(this.get(e))},del:function(e){return r.removeItem(e)},key:function(e){return r.key(e)},has:function(e){return null!==this.get(e)},len:function(){return r.length},clear:function(e){var t=this;e?e.forEach(function(e){return t.del(e)}):r.clear()}};t["a"]=a},"1a5d":function(e,t,n){var r={"./Dashboard.vue":["7277","chunk-3fcab054"],"./Login.vue":["a55b"],"./error/NotFound.vue":["d31a","chunk-0a81e278"],"./system/Menu.vue":["a85d","chunk-19d46710"],"./system/Resource.vue":["fd96","chunk-c2759cc8","chunk-2d237d51"],"./system/Role.vue":["10e1","chunk-c2759cc8","chunk-79ab9501"],"./system/User.vue":["6a53","chunk-c2759cc8","chunk-2d0d9fbf"]};function a(e){var t=r[e];return t?Promise.all(t.slice(1).map(n.e)).then(function(){var e=t[0];return n(e)}):Promise.resolve().then(function(){var t=new Error("Cannot find module '"+e+"'");throw t.code="MODULE_NOT_FOUND",t})}a.keys=function(){return Object.keys(r)},a.id="1a5d",e.exports=a},"56d7":function(e,t,n){"use strict";n.r(t);n("cadf"),n("551c"),n("f751"),n("097d");var r=n("2b0e"),a=n("bc3a"),o=n.n(a),s={},i=o.a.create(s);i.interceptors.request.use(function(e){return e},function(e){return Promise.reject(e)}),i.interceptors.response.use(function(e){return e},function(e){return Promise.reject(e)}),Plugin.install=function(e){e.axios=i,window.axios=i,Object.defineProperties(e.prototype,{axios:{get:function(){return i}},$axios:{get:function(){return i}}})},r["a"].use(Plugin);Plugin;var u=n("0e72"),c=n("c276"),l=window.api;o.a.defaults.baseURL=l.serverHost+":"+l.serverPort+l.baseUri;var d=o.a.create({timeout:3e3,params:{_time:Date.parse(new Date)/1e3}});d.interceptors.request.use(function(e){console.log("load ...");var t=u["a"].get("token");return t&&(e.headers["Authorization"]="Bearer ".concat(t)),e},function(e){return Promise.reject(e)}),d.interceptors.response.use(function(e){return 200===e.status?Promise.resolve(e.data):(Object(c["a"])(e.status,respone.data),Promise.reject(e))},function(e){console.log("load fail");var t=e.response;return t?Object(c["a"])(t.status,t.data):r["a"].prototype.$notify.err("The Network error or Api not request!!!"),Promise.reject(e)});var f={getToken:function(e,t){return d.post("/account/token",{identity:e,credential:t})},refreshToken:function(){return d.post("/account/refresh")},logout:function(){return d.get("/account/logout")},getInfo:function(){return d.get("/account/info")},editInfo:function(e){return d.put("/account/info",e)},editPwd:function(e){return d.put("/account/password",{credential:e})},getMenus:function(){return d.get("/account/menu")}},p={get:function(){return d.get("/resource")},fresh:function(){return d.put("/resource")}},m={get:function(){return d.get("/user")},setState:function(e,t){return d.put("/user/"+e+"/status?status="+t)},editPwd:function(e,t){return d.put("/user/"+e,t)},resetPwd:function(e){return d.put("/user/"+e+"/password")},getUserById:function(e){return d.get("/user/"+e)},editUser:function(e,t){return d.put("/user/"+e,t)},createUser:function(e){return d.post("/user",e)}},h={get:function(){return d.get("/role")},update:function(e,t){return d.put("/role/"+e,t)},create:function(e){return d.post("/role",e)},del:function(e){return d.delete("/role/"+e)},updateRoleMenu:function(e,t){return d.put("/role/"+e+"/menus",t)}},g={get:function(){return d.get("/menu")},setState:function(e,t){return d.put("/menu/"+e+"/status?status="+t)},del:function(e){return d.delete("/menu/"+e)},updateMenuById:function(e,t){return d.put("/menu/"+e,t)},create:function(e){return d.post("/menu",e)}},v={account:f,resource:p,user:m,role:h,menu:g,install:function(e){v.install.installed||(v.install.installed=!0,Object.defineProperties(e.prototype,{$api:{get:function(){return v}}}))}},y=v;r["a"].use(y);n("055b");var b=n("160c"),w=(n("0723"),n("0020")),k=(n("564f"),n("768f")),_=(n("3e86"),n("7571"));r["a"].use(_["a"]),r["a"].use(k["a"]),r["a"].use(w["a"]),r["a"].use(b["a"]);var $=n("d225"),P=n("b0b4"),M=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-snackbar",{attrs:{bottom:"bottom"===e.state.y,color:e.state.msgType.color,left:"left"===e.state.x,"multi-line":"multi-line"===e.state.mode,right:"right"===e.state.x,timeout:e.state.timeout,top:"top"===e.state.y,vertical:"vertical"===e.state.mode},model:{value:e.state.snackbar,callback:function(t){e.$set(e.state,"snackbar",t)},expression:"state.snackbar"}},[n("i",{staticClass:"material-icons",staticStyle:{"padding-right":"10px"}},[e._v("\n    "+e._s(e.state.msgType.sentiment)+"\n  ")]),e._v("\n  "+e._s(e.state.msg)+"\n  "),n("v-btn",{staticClass:"v-btn--flat v-btn--text",attrs:{dark:""},on:{click:function(t){e.state.snackbar=!1}}},[e._v("\n    "+e._s(e.state.close)+"\n  ")])],1)},x=[],O={name:"Notify",data:function(){return{state:{msgType:{sentiment:"sentiment_satisfied",color:"blue"},mode:"",snackbar:!0,msg:"content",close:"Close",timeout:3e3,x:null,y:"top"}}},methods:{commit:function(e){this.$data.state=Object.assign(this.$data.state,e)}}},S=O,T=(n("ed11"),n("2877")),C=n("6544"),V=n.n(C),j=n("8336"),A=n("2db4"),I=Object(T["a"])(S,M,x,!1,null,"30037787",null),D=I.exports;V()(I,{VBtn:j["a"],VSnackbar:A["a"]});var N={success:{sentiment:"sentiment_very_satisfied",color:"green lighten-1"},info:{sentiment:"sentiment_satisfied",color:"light-blue lighten-1"},warn:{sentiment:"sentiment_dissatisfied",color:"orange darken-2"},error:{sentiment:"sentiment_very_dissatisfied",color:"red lighten-1"}},E=function(){function e(t){Object($["a"])(this,e),this.Vue=t,this.mounted=!1,this.$root={}}return Object(P["a"])(e,[{key:"mountIfNotMounted",value:function(){var e=this;!0!==this.mounted&&(this.$root=function(){var t=e.Vue.extend(D),n=document.createElement("div");return document.querySelector("body").appendChild(n),(new t).$mount(n)}(),this.mounted=!0)}},{key:"destroy",value:function(){if(this.mounted){var e=this.$root.$el;this.$root.$destroy(),this.$root.$off(),e.remove(),this.mounted=!1}}},{key:"open",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"info",n=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};if("string"===typeof t&&N.hasOwnProperty(t)){this.mountIfNotMounted();var r={};r.msgType=N[t],r.msg=e,r.snackbar=!0,this.$root.commit(Object.assign({},r,n))}else console.warn("notify type is error")}},{key:"success",value:function(e,t){this.open(e,"success",t)}},{key:"warn",value:function(e,t){this.open(e,"warn",t)}},{key:"info",value:function(e,t){this.open(e,"info",t)}},{key:"err",value:function(e,t){this.open(e,"error",t)}}],[{key:"install",value:function(t,n){t.component("Notify",D),t.vuetifyNotify=new e(t,n),Object.defineProperties(t.prototype,{$notify:{get:function(){return t.vuetifyNotify}}})}}]),e}(),R=E;r["a"].use(R);var F=n("bb71"),L=n("7496"),U=n("fe57"),q=n("71a3"),B=n("c671"),H=n("b0af"),J=n("99d9"),z=n("169a"),G=n("0798"),W=n("8212"),Y=n("c6a6"),Z=n("b56d"),K=n("67b6"),Q=n("43a6");n("da64");r["a"].use(F["a"],{iconfont:"md",components:{VApp:L["a"],VTabs:U["a"],VTab:q["a"],VTabItem:B["a"],VCard:H["a"],VCardText:J["b"],VBtn:j["a"],VDialog:z["a"],VAlert:G["a"],VAvatar:W["a"],VAutocomplete:Y["a"],VSelect:Z["a"],VRadio:K["a"],VRadioGroup:Q["a"]}});var X=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("router-view")},ee=[],te={name:"App",data:function(){return{}}},ne=te,re=(n("64c4"),Object(T["a"])(ne,X,ee,!1,null,"041f48f4",null)),ae=re.exports,oe=n("c0d6"),se=n("9883"),ie=n("a925"),ue={Sys:{hello:"你好, 世界！",title:" 后台管理系统",loginForm:"系统登录",login:"登录",light:"浅色",dark:"深色",theme:"主题",lang:"语言",account:"用户名",password:"密码",close:"关闭",save:"保存",requireMsg:"*为必填项",personalCenter:"个人中心",logout:"退出",notfound:"抱歉，未能找到该页面",goHome:"返回首页",search:"搜索",createTime:"创建时间",updateTime:"更新时间",edit:"修改",del:"删除",resetPwd:"重置密码",operation:"操作",reset:"重置",remark:"备注",resetPwdMsg:"是否重置该密码?",delRoleMsg:"是否删除该角色?",delMenuMsg:"是否删除该菜单?",yes:"是",no:"否",folder:"目录",menu:"菜单",button:"按钮",enable:"正常",disable:"禁用",status:"状态"},App:{userProfile:"用户信息",nickname:"用户昵称",email:"邮箱",phone:"手机",identity:"用户登录名称",credential:"密码",editPwd:"修改密码",newPwd:"新密码",confimPwd:"再次输入新密码",resourceManager:"资源管理",freshResource:"刷新资源",isLogin:"需要登录",isAuthority:"需要鉴权",openAuthority:"无需鉴权",resourceName:"资源名称",method:"请求方式",pathMapping:"路径映射",authType:"权限类型",perm:"权限标识",perPageText:"每页显示条数:",role:"角色",userManager:"用户管理",createUser:"新增用户",userStatus:"用户状态",menuAuthority:"菜单授权",allMenus:"所有菜单",selectMenuMsg:"请选择需要授权的菜单",createRole:"新增角色",editRole:"修改角色",roleManager:"角色管理",roleName:"角色名",menuManager:"菜单管理",addMenu:"添加菜单",menuName:"菜单名称",menuIcon:"菜单图标",menuPath:"菜单路径",menuRouter:"菜单路由",menuType:"菜单类型",menuStatus:"菜单状态",menuInfo:"菜单信息",menuAuthAlias:"权限别名",menuIconPicker:"选择图标",parentMenu:"上级菜单",menuResourceMapping:"对应资源"}},ce={Sys:{hello:"hello world!",title:" ADMIN",loginForm:"Login Form",login:"Login",light:"Light",dark:"Dark",theme:"THEME",lang:"LANGUAGE",account:"Account",password:"Password",close:"Close",save:"Save",requireMsg:"*indicates required field",personalCenter:"Personal Center",logout:"Logout",notfound:"Sorry, page not found",goHome:"Go Home",search:"Search",createTime:"Create Time",updateTime:"Update Time",edit:"Edit",del:"Delete",resetPwd:"Reset Password",operation:"Action",reset:"Reset",remark:"Remark",resetPwdMsg:"Do you want to reset the password?",delRoleMsg:"Do you want to delete the role?",delMenuMsg:"Do you want to delete the menu?",yes:"Yes",no:"No",folder:"Folder",menu:"Menu",button:"Button",enable:"Enable",disable:"Disable",status:"Status"},App:{userProfile:"User Profile",nickname:"Nick name",email:"Email",phone:"Phone",identity:"Identity",credential:"Credential",editPwd:"Edit Password",newPwd:"New Password",confimPwd:"Enter the new password again",resourceManager:"Resource Manager",freshResource:"Fresh",isLogin:"Login",isAuthority:"Authorization",openAuthority:"Open",resourceName:"Resource Name",method:"Method",pathMapping:"Path Mapping",authType:"Auth Type",perm:"Authorization Identify",perPageText:"Rows per page:",role:"Role",userManager:"User Manager",createUser:"New User",userStatus:"User State",menuAuthority:"Menus authority",allMenus:"All Menus",selectMenuMsg:"Select your menus",createRole:"New Role",editRole:"Edit Role",roleManager:"Role Manager",roleName:"Role Name",menuManager:"Menu Manager",addMenu:"New Menu",menuName:"Menu Name",menuIcon:"Menu Icon",menuPath:"Menu Path",menuRouter:"Menu Router",menuType:"Menu Type",menuStatus:"Menu Status",menuInfo:"Menu Information",menuAuthAlias:"Menu Auth Alias",menuIconPicker:"Icon Picker",parentMenu:"Parent Menu",menuResourceMapping:"Menu Resource Mapping"}},le={zh:ue,en:ce},de=le;r["a"].config.productionTip=!1,r["a"].use(ie["a"]);var fe=new ie["a"]({locale:u["a"].get("lang")?u["a"].get("lang"):"zh",messages:de});new r["a"]({store:oe["a"],router:se["a"],i18n:fe,render:function(e){return e(ae)}}).$mount("#app")},"64c4":function(e,t,n){"use strict";var r=n("0cfc"),a=n.n(r);a.a},8076:function(e,t,n){},"8baf":function(e,t,n){"use strict";var r=n("f10e"),a=n.n(r);a.a},9883:function(e,t,n){"use strict";n("8e6e"),n("ac6a"),n("456d");var r=n("bd86"),a=n("2b0e"),o=n("a55b"),s=[{path:"/login",component:o["default"]},{path:"/",component:function(){return n.e("chunk-3fcab054").then(n.bind(null,"7277"))}},{path:"/404",component:function(){return n.e("chunk-0a81e278").then(n.bind(null,"d31a"))}},{path:"*",component:function(){return n.e("chunk-0a81e278").then(n.bind(null,"d31a"))}}],i=n("8c4f"),u=n("c0d6"),c=n("0e72"),l=n("c276"),d=n("323e"),f=n.n(d);function p(e,t){var n=Object.keys(e);return Object.getOwnPropertySymbols&&n.push.apply(n,Object.getOwnPropertySymbols(e)),t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),n}function m(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?p(n,!0).forEach(function(t){Object(r["a"])(e,t,n[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):p(n).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))})}return e}a["a"].use(i["a"]);var h=new i["a"]({mode:"history",base:"/",scrollBehavior:function(){return{y:0}},routes:s}),g=0;h.beforeEach(function(e,t,n){if("/login"===e.path)n();else{var r=c["a"].get("token");r?(0==g&&(h.addRoutes(Object(l["b"])(u["a"].getters.menus)),g++,n(m({},e,{replace:!0}))),f.a.start(),n()):n("/login")}}),h.afterEach(function(){f.a.done()});t["a"]=h},a55b:function(e,t,n){"use strict";n.r(t);var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-app",{attrs:{id:"inspire",dark:e.theme}},[n("Header",{attrs:{primaryDrawerType:e.primaryDrawerType}}),n("v-content",[n("v-container",{attrs:{fluid:"","fill-height":""}},[n("v-layout",{attrs:{"align-center":"","justify-center":""}},[n("v-flex",{attrs:{xs12:"",sm8:"",md4:""}},[n("v-card",{staticClass:"elevation-12"},[n("v-toolbar",{attrs:{dark:"",color:"grey"}},[n("v-toolbar-title",[e._v(" "+e._s(e.$t("Sys.loginForm"))+" ")])],1),n("v-card-text",[n("v-form",[n("v-text-field",{attrs:{"prepend-icon":"person",name:"login",label:e.$t("Sys.account")+"*",type:"text",required:""},model:{value:e.loginForm.identity,callback:function(t){e.$set(e.loginForm,"identity",t)},expression:"loginForm.identity"}}),n("v-text-field",{attrs:{id:"password","prepend-icon":"lock",name:"password",label:e.$t("Sys.password")+"*",type:"password",required:""},model:{value:e.loginForm.credential,callback:function(t){e.$set(e.loginForm,"credential",t)},expression:"loginForm.credential"}})],1)],1),n("v-card-actions",[n("small",[e._v(e._s(e.$t("Sys.requireMsg")))]),n("v-spacer"),n("v-btn",{attrs:{color:"grey",loading:e.loading},on:{click:e.login}},[e._v(e._s(e.$t("Sys.login")))])],1)],1)],1)],1)],1)],1),n("Footer")],1)},a=[],o=n("0418"),s=n("fd2d"),i=n("bc3a"),u=n.n(i),c={data:function(){return{dark:!1,drawer:null,primaryDrawerType:!1,loginForm:{identity:"test",credential:"00000000"},loading:!1}},components:{Header:o["a"],Footer:s["a"]},computed:{theme:function(){return this.$store.state.dark}},methods:{login:function(){var e=this;if(this.$data.loading=!0,""===this.loginForm.identity||""===this.loginForm.credential)return this.$notify.err("Account or password cannot be empty"),void(this.$data.loading=!1);this.$api.account.getToken(this.loginForm.identity,this.loginForm.credential).then(function(t){e.$store.commit("setToken",t.data),u.a.all([e.$api.account.getMenus(),e.$api.account.getInfo()]).then(u.a.spread(function(t,n){e.$store.commit("setMenus",t.data),e.$store.commit("setUserInfo",n.data),e.$router.push({path:"/"})}))}).catch(function(){e.$data.loading=!1})}}},l=c,d=n("2877"),f=n("6544"),p=n.n(f),m=n("7496"),h=n("8336"),g=n("b0af"),v=n("99d9"),y=n("a523"),b=n("549c"),w=n("0e8f"),k=n("4bd4"),_=n("a722"),$=n("9910"),P=n("2677"),M=n("71d9"),x=n("2a7f"),O=Object(d["a"])(l,r,a,!1,null,null,null);t["default"]=O.exports;p()(O,{VApp:m["a"],VBtn:h["a"],VCard:g["a"],VCardActions:v["a"],VCardText:v["b"],VContainer:y["a"],VContent:b["a"],VFlex:w["a"],VForm:k["a"],VLayout:_["a"],VSpacer:$["a"],VTextField:P["a"],VToolbar:M["a"],VToolbarTitle:x["a"]})},c0d6:function(e,t,n){"use strict";var r=n("2b0e"),a=n("2f62"),o=n("0e72");r["a"].use(a["a"]),t["a"]=new a["a"].Store({state:{token:o["a"].get("token")?o["a"].get("token"):"",dark:"false"!==o["a"].get("dark"),menus:o["a"].get("menus")?o["a"].get("menus"):"{}",userInfo:o["a"].get("userInfo")?o["a"].get("userInfo"):"{}"},mutations:{setToken:function(e,t){e.token=t,o["a"].set("token",t.token)},delToken:function(e){e.token="",e.menus="{}",e.userInfo="{}",o["a"].clear(["token","menus","userInfo"])},setMenus:function(e,t){e.menus=JSON.stringify(t),o["a"].set("menus",e.menus)},setUserInfo:function(e,t){e.userInfo=JSON.stringify(t),o["a"].set("userInfo",e.userInfo)},changeTheme:function(e,t){e.dark=t,o["a"].set("dark",t)}},getters:{menus:function(e){return JSON.parse(e.menus)},userInfo:function(e){return JSON.parse(e.userInfo)}}})},c276:function(e,t,n){"use strict";n.d(t,"a",function(){return l}),n.d(t,"b",function(){return f}),n.d(t,"d",function(){return m}),n.d(t,"c",function(){return h});n("8e6e"),n("456d");var r=n("bd86"),a=(n("ac4d"),n("8a81"),n("ac6a"),n("55dd"),n("a481"),n("2b0e")),o=n("9883");function s(e,t){var n=Object.keys(e);return Object.getOwnPropertySymbols&&n.push.apply(n,Object.getOwnPropertySymbols(e)),t&&(n=n.filter(function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable})),n}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?s(n,!0).forEach(function(t){Object(r["a"])(e,t,n[t])}):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):s(n).forEach(function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))})}return e}var u=function(){o["a"].replace({path:"/login",query:{redirect:o["a"].currentRoute.fullPath}})},c=function(){o["a"].replace({path:"/404",query:{redirect:o["a"].currentRoute.fullPath}})},l=function(e,t){switch(e){case 401:u();break;case 403:u();break;case 404:c();break;default:a["a"].prototype.$notify.warn(t.msg,{timeout:6e3});break}},d=function(e){return function(){return n("1a5d")("./"+e+".vue")}},f=function e(t){return t.filter(function(t){if(t.path&&t.router)t.component=d(t.router);else{if(3===t.menu_type)return!1;t.component=function(){return n.e("chunk-3fcab054").then(n.bind(null,"7277"))},t.path="/"}return t.children&&t.children.length&&(t.children=e(t.children)),!0})},p=function(e){switch(e.menu_type){case 0:e.icon="keyboard_arrow_up",e["icon-alt"]="keyboard_arrow_down";break;case 1:break;default:break}return e},m=function(e){return e.filter(function(e,t){return 3!==e.menu_type&&(e=p(e),0===t&&(e.model=!0,e.jump=e.path+e.children[0].path),e.children&&e.children.length&&(e.children=f(e.children)),!0)})},h=function e(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:0,r=[],a=!0,o=!1,s=void 0;try{for(var u,c=t[Symbol.iterator]();!(a=(u=c.next()).done);a=!0){var l=u.value;if(l.parent_id===n){var d=e(t,l.menu_id);0<d.length&&(l.children=d),r.push(i({},l))}}}catch(f){o=!0,s=f}finally{try{a||null==c.return||c.return()}finally{if(o)throw s}}return r.sort(function(e,t){return e.menu_name>t.menu_name?1:-1})}},ed11:function(e,t,n){"use strict";var r=n("8076"),a=n.n(r);a.a},f10e:function(e,t,n){},fd2d:function(e,t,n){"use strict";var r=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("v-footer",{attrs:{inset:e.footer.inset,app:""}},[n("span",{staticClass:"px-3"},[e._v("Copyright © "+e._s((new Date).getFullYear())+" SWOFT-ADMIN All rights reserved")])])},a=[],o={name:"Footer",data:function(){return{footer:{inset:!0}}}},s=o,i=n("2877"),u=n("6544"),c=n.n(u),l=n("553a"),d=Object(i["a"])(s,r,a,!1,null,null,null);t["a"]=d.exports;c()(d,{VFooter:l["a"]})}});
//# sourceMappingURL=app.31587cfb.js.map