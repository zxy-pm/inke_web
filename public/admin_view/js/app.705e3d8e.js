(function(t){function e(e){for(var a,i,l=e[0],c=e[1],r=e[2],u=0,h=[];u<l.length;u++)i=l[u],Object.prototype.hasOwnProperty.call(s,i)&&s[i]&&h.push(s[i][0]),s[i]=0;for(a in c)Object.prototype.hasOwnProperty.call(c,a)&&(t[a]=c[a]);d&&d(e);while(h.length)h.shift()();return o.push.apply(o,r||[]),n()}function n(){for(var t,e=0;e<o.length;e++){for(var n=o[e],a=!0,i=1;i<n.length;i++){var l=n[i];0!==s[l]&&(a=!1)}a&&(o.splice(e--,1),t=c(c.s=n[0]))}return t}var a={},i={app:0},s={app:0},o=[];function l(t){return c.p+"admin_view/js/"+({}[t]||t)+"."+{"chunk-350d1b36":"fe51ba01","chunk-3849b418":"47561731","chunk-421ecf58":"87ce0437","chunk-4e090bf7":"a9b6d91c","chunk-761652f2":"f96765f1","chunk-78bd3595":"3909101a","chunk-b115cbfe":"b5bef675"}[t]+".js"}function c(e){if(a[e])return a[e].exports;var n=a[e]={i:e,l:!1,exports:{}};return t[e].call(n.exports,n,n.exports,c),n.l=!0,n.exports}c.e=function(t){var e=[],n={"chunk-350d1b36":1,"chunk-3849b418":1,"chunk-421ecf58":1,"chunk-4e090bf7":1,"chunk-761652f2":1,"chunk-78bd3595":1,"chunk-b115cbfe":1};i[t]?e.push(i[t]):0!==i[t]&&n[t]&&e.push(i[t]=new Promise((function(e,n){for(var a="admin_view/css/"+({}[t]||t)+"."+{"chunk-350d1b36":"83d956b5","chunk-3849b418":"d65177c0","chunk-421ecf58":"ad0652c1","chunk-4e090bf7":"32364992","chunk-761652f2":"b9425559","chunk-78bd3595":"27a52fcf","chunk-b115cbfe":"766c84ce"}[t]+".css",s=c.p+a,o=document.getElementsByTagName("link"),l=0;l<o.length;l++){var r=o[l],u=r.getAttribute("data-href")||r.getAttribute("href");if("stylesheet"===r.rel&&(u===a||u===s))return e()}var h=document.getElementsByTagName("style");for(l=0;l<h.length;l++){r=h[l],u=r.getAttribute("data-href");if(u===a||u===s)return e()}var d=document.createElement("link");d.rel="stylesheet",d.type="text/css",d.onload=e,d.onerror=function(e){var a=e&&e.target&&e.target.src||s,o=new Error("Loading CSS chunk "+t+" failed.\n("+a+")");o.code="CSS_CHUNK_LOAD_FAILED",o.request=a,delete i[t],d.parentNode.removeChild(d),n(o)},d.href=s;var m=document.getElementsByTagName("head")[0];m.appendChild(d)})).then((function(){i[t]=0})));var a=s[t];if(0!==a)if(a)e.push(a[2]);else{var o=new Promise((function(e,n){a=s[t]=[e,n]}));e.push(a[2]=o);var r,u=document.createElement("script");u.charset="utf-8",u.timeout=120,c.nc&&u.setAttribute("nonce",c.nc),u.src=l(t);var h=new Error;r=function(e){u.onerror=u.onload=null,clearTimeout(d);var n=s[t];if(0!==n){if(n){var a=e&&("load"===e.type?"missing":e.type),i=e&&e.target&&e.target.src;h.message="Loading chunk "+t+" failed.\n("+a+": "+i+")",h.name="ChunkLoadError",h.type=a,h.request=i,n[1](h)}s[t]=void 0}};var d=setTimeout((function(){r({type:"timeout",target:u})}),12e4);u.onerror=u.onload=r,document.head.appendChild(u)}return Promise.all(e)},c.m=t,c.c=a,c.d=function(t,e,n){c.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},c.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},c.t=function(t,e){if(1&e&&(t=c(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(c.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var a in t)c.d(n,a,function(e){return t[e]}.bind(null,a));return n},c.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return c.d(e,"a",e),e},c.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},c.p="/",c.oe=function(t){throw console.error(t),t};var r=window["webpackJsonp"]=window["webpackJsonp"]||[],u=r.push.bind(r);r.push=e,r=r.slice();for(var h=0;h<r.length;h++)e(r[h]);var d=u;o.push([0,"chunk-vendors"]),n()})({0:function(t,e,n){t.exports=n("56d7")},"034f":function(t,e,n){"use strict";n("85ec")},"1a97":function(t,e,n){"use strict";n("88bc")},"1afd":function(t,e,n){},"2b04":function(t,e,n){"use strict";n("1afd")},3507:function(t,e,n){},"396a":function(t,e,n){"use strict";n("3507")},4894:function(t,e,n){"use strict";n("949b")},"56d7":function(t,e,n){"use strict";n.r(e);var a=n("a649"),i=(n("e260"),n("e6cf"),n("cca6"),n("a79d"),n("2b0e")),s=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"app"}},[n("router-view")],1)},o=[],l={},c=l,r=(n("034f"),n("2877")),u=Object(r["a"])(c,s,o,!1,null,null,null),h=u.exports,d=(n("d3b7"),n("3ca3"),n("ddb0"),n("8c4f")),m=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"home"},[n("el-container",{attrs:{"my-class":"out-box"}},[n("el-aside",{attrs:{width:"auto"}},[n("el-menu",{staticClass:"el-menu-vertical-demo",attrs:{"default-active":"2",router:"",collapse:t.isCollapse,"my-class":"aside-menu"}},[n("el-menu-item",{attrs:{index:"/home/sta"}},[n("i",{staticClass:"el-icon-s-home"}),n("span",{attrs:{slot:"title"},slot:"title"},[t._v("我的信息")])]),n("el-menu-item",{attrs:{index:"/home/order"}},[n("i",{staticClass:"el-icon-s-order"}),n("span",{attrs:{slot:"title"},slot:"title"},[t._v("我的订单")])]),n("el-menu-item",{attrs:{index:"/home/change"}},[n("i",{staticClass:"el-icon-coin"}),n("span",{attrs:{slot:"title"},slot:"title"},[t._v("我的充值")])]),1==t.type?n("el-menu-item",{attrs:{index:"/home/all_sta"}},[n("i",{staticClass:"el-icon-s-data"}),n("span",{attrs:{slot:"title"},slot:"title"},[t._v("全局统计")])]):t._e(),1==t.type?n("el-menu-item",{attrs:{index:"/home/all_order"}},[n("i",{staticClass:"el-icon-s-grid"}),n("span",{attrs:{slot:"title"},slot:"title"},[t._v("全局订单")])]):t._e(),1==t.type?n("el-menu-item",{attrs:{index:"/home/user"}},[n("i",{staticClass:"el-icon-user-solid"}),n("span",{attrs:{slot:"title"},slot:"title"},[t._v("客户管理")])]):t._e(),1==t.type?n("el-menu-item",{attrs:{index:"/home/all_change"}},[n("i",{staticClass:"el-icon-coin"}),n("span",{attrs:{slot:"title"},slot:"title"},[t._v("全局充值")])]):t._e(),1==t.type?n("el-menu-item",{attrs:{index:"/home/set"}},[n("i",{staticClass:"el-icon-setting"}),n("span",{attrs:{slot:"title"},slot:"title"},[t._v("系统配置")])]):t._e()],1)],1),n("el-container",[n("el-header",{staticStyle:{background:"#fcfcfc"},attrs:{height:"45px"}},[n("i",{staticClass:"el-icon-s-fold",staticStyle:{"font-size":"2rem","text-align":"center"},on:{click:function(e){t.isCollapse=!t.isCollapse}}}),n("div",{staticClass:"notice"},[t._v("后台管理系统")]),n("el-button",{attrs:{type:"warning",size:"small",plain:""},on:{click:t.log_out}},[t._v("登出")])],1),n("el-main",[n("router-view")],1)],1)],1)],1)},p=[],f=(n("ac1f"),n("5319"),{name:"home",components:{},data:function(){return{isCollapse:!1,type:0}},methods:{log_out:function(){this.$api.do(this.$path.logout,{},function(t){Object(a["a"])(this,this),this.$router.replace("/login")}.bind(this))}},mounted:function(){this.$api.do(this.$path.user,{},function(t){Object(a["a"])(this,this),this.type=t.data.type}.bind(this)),this.$router.replace("/home/sta")}}),b=f,_=(n("ee90"),Object(r["a"])(b,m,p,!1,null,null,null)),v=_.exports,y=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"order"}},[n("div",{staticClass:"menu"},[n("el-button",{attrs:{type:"primary",size:"mini",icon:"el-icon-refresh"},on:{click:function(e){return t.change_page(t.page)}}})],1),n("el-table",{staticStyle:{width:"100%"},attrs:{"my-class":"order_table",stripe:"",border:"",height:"600px","row-class-name":t.tableRowClassName,data:t.tableData}},[n("el-table-column",{attrs:{prop:"id",label:"id",width:"80"}}),n("el-table-column",{attrs:{prop:"uid",label:"客户id",width:"80"}}),n("el-table-column",{attrs:{prop:"trade_no",label:"单号",width:"180"}}),n("el-table-column",{attrs:{prop:"money",label:"金额",width:"180"}}),t._e(),n("el-table-column",{attrs:{prop:"time",label:"创建"}}),n("el-table-column",{attrs:{prop:"finish_time",label:"完成",width:"160"}}),n("el-table-column",{attrs:{prop:"sta",label:"状态",formatter:t.sta_format}}),t._e(),t._e()],1),n("el-pagination",{attrs:{"page-size":t.page_size,layout:"prev, pager, next",total:t.total},on:{"current-change":t.change_page}})],1)},g=[],k={name:"order",data:function(){return{page:1,page_size:40,total:1,tableData:[]}},methods:{change_page:function(t){this.$api.do(this.$path.orders,{page:t},function(t){Object(a["a"])(this,this),this.tableData=t.data,this.total=t.count}.bind(this))},tableRowClassName:function(t){var e=t.row;t.rowIndex;return 1==e.sta?"success-row":-1==e.sta||-2==e.sta?"warning-row":0==e.sta?"":void 0},js_format:function(t){return 0==t.js?"否":"是"},sta_format:function(t){return 0==t.sta?"发起":1==t.sta?"成功":void 0},del:function(t){this.$confirm("删除后不可恢复, 是否继续?","警告",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){Object(a["a"])(this,this),this.$api.do(this.$path.del,{day:t},function(){Object(a["a"])(this,this),this.change_page(1)}.bind(this))}.bind(this)).catch(function(){Object(a["a"])(this,this)}.bind(this))}},mounted:function(){this.change_page(1)}},x=k,w=(n("5bd9"),Object(r["a"])(x,y,g,!1,null,"50959d80",null)),$=w.exports,j=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"set"}},[n("ul",[n("el-form",[n("el-form-item",{staticClass:"area",attrs:{label:"通知内容"}},[n("el-input",{attrs:{type:"textarea"},model:{value:t.notice,callback:function(e){t.notice=e},expression:"notice"}})],1),n("el-form-item",[n("el-button",{attrs:{type:"primary"},on:{click:function(e){return t.ok("key-notice",t.notice)}}},[t._v("确定")])],1)],1),n("el-form",{ref:"form",staticStyle:{"text-align":"left"},attrs:{"label-width":"180px","label-position":"right",model:t.sizeForm,size:"mini"}},[n("br"),n("el-form-item",{attrs:{label:"正版扣量概率,0.1表示10%"}},[n("el-input",{attrs:{placeholder:"正版扣量概率"},model:{value:t.kl_fee,callback:function(e){t.kl_fee=e},expression:"kl_fee"}})],1),n("el-form-item",{attrs:{label:"盗版扣量概率,0.1表示10%"}},[n("el-input",{attrs:{placeholder:"盗版扣量概率"},model:{value:t.kl_fee1,callback:function(e){t.kl_fee1=e},expression:"kl_fee1"}})],1),n("el-form-item",[n("el-button",{attrs:{type:"primary"},on:{click:function(e){return t.save()}}},[t._v("保存")])],1)],1)],1)])},C=[],O={name:"set",data:function(){return{notice:"",kl:0,kl_fee:0,kl_fee1:0,kl_link:""}},methods:{ok:function(t,e){this.$api.do(this.$path.set_set,{k:t,v:e})},save:function(){this.$api.do(this.$path.save_kl,{kl:this.kl,kl_fee:this.kl_fee,kl_fee1:this.kl_fee1,kl_link:this.kl_link})}},mounted:function(){this.$api.do(this.$path.set_get,{},function(t){Object(a["a"])(this,this),this.notice=t.data.notice,this.kl=t.data.kl,this.kl_fee=t.data.kl_fee,this.kl_fee1=t.data.kl_fee1,this.kl_link=t.data.kl_link}.bind(this))}},S=O,E=(n("2b04"),Object(r["a"])(S,j,C,!1,null,null,null)),N=E.exports,P=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"channel"}},[n("ul",{attrs:{id:"left"}},[n("div",[t._v("通道列表")]),t._l(t.channels,(function(e){return n("li",{class:["channel",t.channel.id==e.id?"active":""]},[n("span",{staticClass:"channel_name",on:{click:function(n){return t.select_channel(e)}}},[t._v(t._s(e.name))]),n("i",{directives:[{name:"show",rawName:"v-show",value:t.channel.id==e.id,expression:"channel.id==vo.id"}],staticClass:"el-icon-circle-plus",on:{click:function(n){return t.to_add(e)}}})])}))],2),n("div",{attrs:{id:"right"}},[n("div",{directives:[{name:"show",rawName:"v-show",value:1==t.type,expression:"type==1"}]},[n("accounts")],1),n("div",{directives:[{name:"show",rawName:"v-show",value:2==t.type,expression:"type==2"}]},[n("fix_account")],1)]),n("el-dialog",{attrs:{title:"通道设置",visible:t.set_show}})],1)},T=[],z=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"accounts"}},[n("div",{staticClass:"title"},[t._v(t._s(this.$parent.channel.name)+"账号列表")]),n("el-table",{staticStyle:{width:"100%"},attrs:{border:"",data:t.tableData,height:"80vh"}},[n("el-table-column",{attrs:{prop:"id",label:"id","show-tooltip-when-overflow":!0,"show-overflow-tooltip":!0,width:"80"}}),n("el-table-column",{attrs:{prop:"name",label:"收款账号id",width:"100"}}),n("el-table-column",{attrs:{prop:"note",label:"备注",width:"160"}}),n("el-table-column",{attrs:{prop:"num",label:"总收入"}}),n("el-table-column",{attrs:{prop:"max",label:"最高限制"}}),n("el-table-column",{attrs:{prop:"sta",label:"开启状态",formatter:t.format_sta}}),n("el-table-column",{attrs:{fixed:"right",label:"操作",width:"120"},scopedSlots:t._u([{key:"default",fn:function(e){return[n("el-button",{attrs:{type:"danger",size:"mini"},on:{click:function(n){return t.del(e.row)}}},[t._v("删除")]),n("el-button",{attrs:{type:"text",size:"mini"},on:{click:function(n){return t.edit(e.row)}}},[t._v("编辑")])]}}])})],1)],1)},B=[],A={name:"accounts",data:function(){return{tableData:[]}},methods:{getAccounts:function(){this.$api.do(this.$path.accounts,{channel_id:this.$parent.channel.id},function(t){Object(a["a"])(this,this),this.tableData=t.data}.bind(this))},del:function(t){this.$confirm("删除后不可恢复, 是否继续?","警告",{confirmButtonText:"确定",cancelButtonText:"取消",type:"warning"}).then(function(){Object(a["a"])(this,this),this.$parent.on_del(t)}.bind(this)).catch(function(){Object(a["a"])(this,this)}.bind(this))},edit:function(t){this.$parent.on_edit(t)},format_sta:function(t,e,n,a){return 1==n?"开启":"暂停"},format_num:function(t,e,n,a){}},mounted:function(){}},D=A,L=(n("1a97"),Object(r["a"])(D,z,B,!1,null,"a4956260",null)),M=L.exports,J=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"fix_accounts"}},[n("div",{staticClass:"title"},[t._v(t._s(t.channel.name)+"通道:"+t._s(t.type)+"账号")]),n("div",{staticClass:"title"},[t._v(t._s(t.channel.note)+",支持金额:"+t._s(t.channel.money))]),n("el-form",{attrs:{"label-position":"top","label-width":"80px",model:t.account}},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.account.id,expression:"account.id"}],attrs:{name:"id",hidden:""},domProps:{value:t.account.id},on:{input:function(e){e.target.composing||t.$set(t.account,"id",e.target.value)}}}),n("input",{directives:[{name:"model",rawName:"v-model",value:t.account.cid,expression:"account.cid"}],attrs:{name:"cid",hidden:""},domProps:{value:t.account.cid},on:{input:function(e){e.target.composing||t.$set(t.account,"cid",e.target.value)}}}),n("el-form-item",{attrs:{label:"账号备注"}},[n("el-input",{model:{value:t.account.note,callback:function(e){t.$set(t.account,"note",e)},expression:"account.note"}})],1),n("el-form-item",{attrs:{label:"收款账号id"}},[n("el-input",{model:{value:t.account.name,callback:function(e){t.$set(t.account,"name",e)},expression:"account.name"}})],1),n("el-form-item",{attrs:{label:"收款金额限制(超过后不能继续收款)"}},[n("el-input",{model:{value:t.account.max,callback:function(e){t.$set(t.account,"max",e)},expression:"account.max"}})],1),n("el-form-item",{attrs:{label:"登录账号ck"}},[n("el-input",{model:{value:t.account.ck,callback:function(e){t.$set(t.account,"ck",e)},expression:"account.ck"}})],1),n("el-form-item",{attrs:{label:"开启状态"}},[n("el-select",{attrs:{placeholder:"请选择"},model:{value:t.account.sta,callback:function(e){t.$set(t.account,"sta",e)},expression:"account.sta"}},[n("el-option",{attrs:{label:"开启",value:"1"}}),n("el-option",{attrs:{label:"暂停",value:"0"}})],1)],1),n("el-form-item",{staticClass:"tm",attrs:{label:"商品设置"}},t._l(t.e1_obj,(function(e,a){return n("div",[t._v("商品"+t._s(a+1)+" 数量"),n("input",{directives:[{name:"model",rawName:"v-model",value:e.count,expression:"vo.count"}],staticClass:"num",attrs:{type:"number"},domProps:{value:e.count},on:{input:function(n){n.target.composing||t.$set(e,"count",n.target.value)}}}),t._v(" 金额 "),n("input",{directives:[{name:"model",rawName:"v-model",value:e.money,expression:"vo.money"}],staticClass:"mn",attrs:{type:"number"},domProps:{value:e.money},on:{input:function(n){n.target.composing||t.$set(e,"money",n.target.value)}}}),t._v(" 链接"),n("input",{directives:[{name:"model",rawName:"v-model",value:e.link,expression:"vo.link"}],staticClass:"link",attrs:{type:"text"},domProps:{value:e.link},on:{input:function(n){n.target.composing||t.$set(e,"link",n.target.value)}}}),t._v("总金额"+t._s(Math.round(e.count*e.money))+" ")])})),0),n("el-button",{attrs:{type:"primary"},on:{click:function(e){return t.to_fix()}}},[t._v("确认提交")])],1)],1)},R=[],q=(n("b0c0"),{name:"fix_accounts",data:function(){return{channel:{},account:{id:0,cid:0,name:"",note:"",money:"",sta:1,max:0,num:0,ck:"",e1:"",e2:"",e3:"",e4:""},e1_obj:[{},{},{},{}],type:"添加"}},methods:{add:function(t,e){this.channel=t,this.account=e,e?(this.e1_obj=JSON.parse(e.e1),null!=this.e1_obj&&4==this.e1_obj.length||(this.e1_obj=[{},{},{},{}]),this.type="修改",this.channel&&(this.account.cid=this.channel.id)):this.account={id:0,cid:this.channel?this.channel.id:0,name:"",note:"",money:"",max:0,num:0,sta:1,ck:"",e1:"",e2:"",e3:"",e4:""}},to_fix:function(){this.check_filed()&&this.$api.do(this.$path.fix_account,this.account,function(t){Object(a["a"])(this,this),this.$parent.select_channel(this.channel)}.bind(this))},check_filed:function(){if(null==this.e1_obj||4!=this.e1_obj.length)return this.$message("商品必须为4个(可重复)"),!1;for(var t=0;t<this.e1_obj.length;t++)if(""==this.e1_obj[t].money||0==this.e1_obj[t].money)return this.$message("商品价格必须设置"),!1;return this.account.e1=JSON.stringify(this.e1_obj),""!=this.account.name&&""!=this.account.note&&0!=this.account.max||(this.$message("收款账号id,备注,收款金额限制 为必填项"),!1)}}}),F=q,I=(n("4894"),Object(r["a"])(F,J,R,!1,null,null,null)),U=I.exports,H={name:"channel",components:{accounts:M,fix_account:U},data:function(){return{channels:[],channel:{},type:1,set_show:!1}},methods:{select_channel:function(t){this.type=1,this.channel=t,this.$children[0].getAccounts()},to_add:function(t){this.type=2,this.$children[1].add(t)},on_del:function(t){this.$api.do(this.$path.del_account,{id:t.id},function(t){Object(a["a"])(this,this),this.select_channel(this.channel)}.bind(this))},on_edit:function(t){this.type=2,this.$children[1].add(this.channel,t)},set_money:function(t){this.$prompt("(当前通道支持金额"+t.money+")","请设置该通道金额,用-分开,例如:998-798-98",{confirmButtonText:"确定",cancelButtonText:"取消",inputValue:t.money}).then(function(t){var e=t.value;Object(a["a"])(this,this),this.$api.do(this.$path.set_money,{cid:this.channel.id,money:e},function(){Object(a["a"])(this,this),this.getChannels()}.bind(this))}.bind(this)).catch(function(){Object(a["a"])(this,this)}.bind(this))},getChannels:function(){this.$api.do(this.$path.channels,{},function(t){Object(a["a"])(this,this),this.channels=t.data,this.channels.length>0&&this.select_channel(this.channels[0])}.bind(this))}},mounted:function(){this.getChannels()}},K=H,V=(n("396a"),Object(r["a"])(K,P,T,!1,null,"4823a9e6",null)),G=V.exports,Q=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{attrs:{id:"sta"}},[n("div",{staticClass:"notice"},[t._v(" 通知 "),n("pre",[t._v(t._s(t.notice))])]),n("div",{staticClass:"top"},[n("ul",[n("li",{staticClass:"item"},[n("span",[t._v("用户名称:")]),n("span",[t._v(t._s(t.name))])]),n("li",{staticClass:"item"},[n("span",[t._v("剩余金额:")]),n("span",[t._v(t._s(t.money))])]),n("li",{staticClass:"item"},[n("span",[t._v("当前费率:")]),n("span",[t._v(t._s(t.fee))])])]),n("ul",[n("li",{staticClass:"item"},[n("span",[t._v("今天总额:")]),n("span",[t._v(t._s(t.day0))])]),n("li",{staticClass:"item"},[n("span",[t._v("昨天总额:")]),n("span",[t._v(t._s(t.day1))])]),n("li",{staticClass:"item"},[n("span",[t._v("前天总额:")]),n("span",[t._v(t._s(t.day2))])]),n("li",{staticClass:"item"},[n("span",[t._v("大前天总额:")]),n("span",[t._v(t._s(t.day3))])]),n("li",{staticClass:"item"},[n("span",[t._v("历史总额:")]),n("span",[t._v(t._s(t.all))])])])]),n("el-form",{ref:"form",staticStyle:{"text-align":"left"},attrs:{"label-position":"left","label-width":"220px",size:"mini"}},[n("el-form-item",{attrs:{label:"通道id"}},[n("el-input",{attrs:{placeholder:"通道id"},model:{value:t.channel_id,callback:function(e){t.channel_id=e},expression:"channel_id"}})],1),n("br"),n("el-form-item",{attrs:{label:"通道key"}},[n("el-input",{attrs:{placeholder:"通道key"},model:{value:t.channel_key,callback:function(e){t.channel_key=e},expression:"channel_key"}})],1),n("el-form-item",{attrs:{label:"通道网关"}},[n("el-input",{attrs:{placeholder:"通道网关"},model:{value:t.host,callback:function(e){t.host=e},expression:"host"}})],1),n("el-form-item",{attrs:{label:"金额设置,例如 911-701-502-304 必须设置4个值,并且用-分割,金额要从大到小,并且相邻金额的差值要大于50"}},[n("el-input",{attrs:{placeholder:"金额设置"},model:{value:t.moneys,callback:function(e){t.moneys=e},expression:"moneys"}})],1),n("el-form-item",[n("el-button",{attrs:{type:"primary"},on:{click:function(e){return t.save()}}},[t._v("保存")])],1)],1)],1)},W=[],X={name:"sta",data:function(){return{day0:0,day1:0,day2:0,day3:0,all:0,name:"",fee:0,money:0,notice:"",channel_key:"",channel_id:"",host:"",moneys:""}},methods:{sta:function(){this.$api.do(this.$path.sta,{},function(t){Object(a["a"])(this,this),this.day0=t.data.day0,this.day1=t.data.day1,this.day2=t.data.day2,this.day3=t.data.day3,this.all=t.data.all,this.name=t.data.name,this.money=t.data.money,this.fee=t.data.fee,this.notice=t.data.notice,this.channel_key=t.data.channel_key,this.channel_id=t.data.channel_id,this.host=t.data.host,this.moneys=t.data.moneys}.bind(this))},save:function(t){this.$api.do(this.$path.user_ch,{id:this.channel_id,key:this.channel_key,moneys:this.moneys,host:this.host},function(t){Object(a["a"])(this,this)}.bind(this))}},mounted:function(){this.sta()}},Y=X,Z=(n("9555"),Object(r["a"])(Y,Q,W,!1,null,"2ccc4449",null)),tt=Z.exports;i["default"].use(d["a"]);var et=[{path:"/",redirect:"/home/sta"},{path:"/home",name:"home",component:v,children:[{path:"/home/set",name:"set",component:N},{path:"/home/order",name:"order",component:$},{path:"/home/sta",name:"sta",component:tt},{path:"/home/all_sta",name:"all_sta",component:function(){return Object(a["a"])(this,this),n.e("chunk-350d1b36").then(n.bind(null,"2672"))}.bind(void 0)},{path:"/home/channel",name:"channel",component:G},{path:"/home/all_order",name:"all_order",component:function(){return Object(a["a"])(this,this),n.e("chunk-78bd3595").then(n.bind(null,"8921"))}.bind(void 0)},{path:"/home/user",name:"user",component:function(){return Object(a["a"])(this,this),n.e("chunk-b115cbfe").then(n.bind(null,"1511"))}.bind(void 0)},{path:"/home/change",name:"change",component:function(){return Object(a["a"])(this,this),n.e("chunk-4e090bf7").then(n.bind(null,"6be9"))}.bind(void 0)},{path:"/home/all_change",name:"all_change",component:function(){return Object(a["a"])(this,this),n.e("chunk-761652f2").then(n.bind(null,"6aeb"))}.bind(void 0)},{path:"/home/my_sta",name:"my_sta",component:function(){return Object(a["a"])(this,this),n.e("chunk-421ecf58").then(n.bind(null,"da0b"))}.bind(void 0)}]},{path:"/login",name:"login",component:function(){return Object(a["a"])(this,this),n.e("chunk-3849b418").then(n.bind(null,"a55b"))}.bind(void 0)}],nt=new d["a"]({routes:et}),at=nt,it=n("bc3a"),st=n.n(it),ot=n("5c96"),lt=n.n(ot),ct=st.a.create({timeout:4e4,withCredentials:!0,baseURL:8080==window.location.port?"http://127.0.0.1:8000":""});function rt(t,e){lt.a.Message({showClose:!1,message:t,duration:e?1e3:3e3,type:e?"success":"error"})}var ut=null;ct.do=function(t,e,n){ut=lt.a.Loading.service(),ct.post(t,e).then(function(t){Object(a["a"])(this,this);var e=t.data;if(-1==e.code)at.replace("/login"),rt(e.msg+" 错误码:"+e.code);else if(0!=e.code)rt(e.msg+" 错误码:"+e.code);else{if(n)try{n(e)}catch(i){console.error(i.toLocaleString())}rt(e.msg,1)}ut.close()}.bind(this)).catch(function(t){Object(a["a"])(this,this),rt("网络错误"),ut.close()}.bind(this))};var ht=ct,dt={orders:"/admin/orders",channels:"/admin/channels",accounts:"/admin/accounts",accounts1:"/admin/accounts1",account_sta:"/admin/account_sta",fix_account:"/admin/fix_account",del_account:"/admin/del_account",login:"/admin/login",logout:"/admin/logout",set_money:"/admin/set_money",del:"/admin/del",sta:"/admin/sta",all_sta:"/admin/all_sta",user:"/admin/user",users:"/admin/users",add_user:"/admin/add_user",del_user:"/admin/del_user",fix_user:"/admin/fix_user",set_get:"/admin/set_get",set_set:"/admin/set_set",all_orders:"/admin/all_orders",changes:"/admin/changes",all_changes:"/admin/all_changes",users1:"/admin/users1",user_sta:"/admin/user_sta",user_ch:"/admin/user_ch",save_kl:"/admin/save_kl"},mt=dt;n("0fae");i["default"].config.productionTip=!1,i["default"].prototype.$api=ht,i["default"].prototype.$path=mt,i["default"].use(lt.a),i["default"].prototype.$bus=new i["default"],new i["default"]({router:at,render:function(t){return Object(a["a"])(this,this),t(h)}.bind(void 0)}).$mount("#app")},"58f8":function(t,e,n){},"5bd9":function(t,e,n){"use strict";n("58f8")},8114:function(t,e,n){},"85ec":function(t,e,n){},"88bc":function(t,e,n){},"949b":function(t,e,n){},9555:function(t,e,n){"use strict";n("8114")},e2c1:function(t,e,n){},ee90:function(t,e,n){"use strict";n("e2c1")}});