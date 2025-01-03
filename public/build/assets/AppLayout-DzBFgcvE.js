import{o as r,d as a,a as e,Q as D,r as _,B as F,n as m,e as g,t as w,h as $,C as N,D as P,j as C,m as c,E as M,u as h,k as z,z as T,b as p,w as l,G as E,c as b,i as j,Z as O,f,F as x,g as L,y as B}from"./app-DO-5RY2c.js";import{_ as V}from"./_plugin-vue_export-helper-DlAUqK2U.js";const I={},R={viewBox:"0 0 48 48",fill:"none",xmlns:"http://www.w3.org/2000/svg"};function G(d,i){return r(),a("svg",R,i[0]||(i[0]=[e("path",{d:"M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z",fill:"#6875F5"},null,-1),e("path",{d:"M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z",fill:"#6875F5"},null,-1)]))}const H=V(I,[["render",G]]),Q={class:"max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8"},U={class:"flex items-center justify-between flex-wrap"},Z={class:"w-0 flex-1 flex items-center min-w-0"},q={key:0,class:"size-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},J={key:1,class:"size-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},K={class:"ms-3 font-medium text-sm text-white truncate"},W={class:"shrink-0 sm:ms-3"},X={__name:"Banner",setup(d){const i=D(),o=_(!0),u=_("success"),s=_("");return F(async()=>{var t,n;u.value=((t=i.props.jetstream.flash)==null?void 0:t.bannerStyle)||"success",s.value=((n=i.props.jetstream.flash)==null?void 0:n.banner)||"",o.value=!0}),(t,n)=>(r(),a("div",null,[o.value&&s.value?(r(),a("div",{key:0,class:m({"bg-indigo-500":u.value=="success","bg-red-700":u.value=="danger"})},[e("div",Q,[e("div",U,[e("div",Z,[e("span",{class:m(["flex p-2 rounded-lg",{"bg-indigo-600":u.value=="success","bg-red-600":u.value=="danger"}])},[u.value=="success"?(r(),a("svg",q,n[1]||(n[1]=[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1)]))):g("",!0),u.value=="danger"?(r(),a("svg",J,n[2]||(n[2]=[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"},null,-1)]))):g("",!0)],2),e("p",K,w(s.value),1)]),e("div",W,[e("button",{type:"button",class:m(["-me-1 flex p-2 rounded-md focus:outline-none sm:-me-2 transition",{"hover:bg-indigo-600 focus:bg-indigo-600":u.value=="success","hover:bg-red-600 focus:bg-red-600":u.value=="danger"}]),"aria-label":"Dismiss",onClick:n[0]||(n[0]=$(v=>o.value=!1,["prevent"]))},n[3]||(n[3]=[e("svg",{class:"size-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18L18 6M6 6l12 12"})],-1)]),2)])])])],2)):g("",!0)]))}},Y={class:"relative"},A={__name:"Dropdown",props:{align:{type:String,default:"right"},width:{type:String,default:"48"},contentClasses:{type:Array,default:()=>["py-1","bg-white"]}},setup(d){const i=d;let o=_(!1);const u=n=>{o.value&&n.key==="Escape"&&(o.value=!1)};N(()=>document.addEventListener("keydown",u)),P(()=>document.removeEventListener("keydown",u));const s=C(()=>({48:"w-48"})[i.width.toString()]),t=C(()=>i.align==="left"?"ltr:origin-top-left rtl:origin-top-right start-0":i.align==="right"?"ltr:origin-top-right rtl:origin-top-left end-0":"origin-top");return(n,v)=>(r(),a("div",Y,[e("div",{onClick:v[0]||(v[0]=S=>M(o)?o.value=!h(o):o=!h(o))},[c(n.$slots,"trigger")]),z(e("div",{class:"fixed inset-0 z-40",onClick:v[1]||(v[1]=S=>M(o)?o.value=!1:o=!1)},null,512),[[T,h(o)]]),p(E,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:l(()=>[z(e("div",{class:m(["absolute z-50 mt-2 rounded-md shadow-lg",[s.value,t.value]]),style:{display:"none"},onClick:v[2]||(v[2]=S=>M(o)?o.value=!1:o=!1)},[e("div",{class:m(["rounded-md ring-1 ring-black ring-opacity-5",d.contentClasses])},[c(n.$slots,"content")],2)],2),[[T,h(o)]])]),_:3})]))}},ee={key:0,type:"submit",class:"block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"},te=["href"],k={__name:"DropdownLink",props:{href:String,as:String},setup(d){return(i,o)=>(r(),a("div",null,[d.as=="button"?(r(),a("button",ee,[c(i.$slots,"default")])):d.as=="a"?(r(),a("a",{key:1,href:d.href,class:"block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"},[c(i.$slots,"default")],8,te)):(r(),b(h(j),{key:2,href:d.href,class:"block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"},{default:l(()=>[c(i.$slots,"default")]),_:3},8,["href"]))]))}},se={__name:"NavLink",props:{href:String,active:Boolean},setup(d){const i=d,o=C(()=>i.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out");return(u,s)=>(r(),b(h(j),{href:d.href,class:m(o.value)},{default:l(()=>[c(u.$slots,"default")]),_:3},8,["href","class"]))}},re=["href"],y={__name:"ResponsiveNavLink",props:{active:Boolean,href:String,as:String},setup(d){const i=d,o=C(()=>i.active?"block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out":"block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out");return(u,s)=>(r(),a("div",null,[d.as=="button"?(r(),a("button",{key:0,class:m([o.value,"w-full text-start"])},[c(u.$slots,"default")],2)):d.as=="a"?(r(),a("a",{key:1,class:m([o.value,"w-full text-start"]),href:d.href},[c(u.$slots,"default")],10,re)):(r(),b(h(j),{key:2,href:d.href,class:m(o.value)},{default:l(()=>[c(u.$slots,"default")]),_:3},8,["href","class"]))]))}},oe={class:"min-h-screen bg-gray-100"},ne={class:"bg-white border-b border-gray-100"},ae={class:"max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"},ie={class:"flex justify-between h-16"},le={class:"flex"},ue={class:"shrink-0 flex items-center"},de={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},pe={class:"hidden sm:flex sm:items-center sm:ms-6"},ge={class:"ms-3 relative"},fe={class:"inline-flex rounded-md"},me={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"},ce={class:"w-60"},ve=["onSubmit"],he={class:"flex items-center"},be={key:0,class:"me-2 size-5 text-green-400",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},ye={class:"ms-3 relative"},we={key:0,class:"flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"},ke=["src","alt"],xe={key:1,class:"inline-flex rounded-md"},$e={type:"button",class:"inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"},_e={class:"-me-2 flex items-center sm:hidden"},Ce={class:"size-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},je={class:"pt-2 pb-3 space-y-1"},Me={class:"pt-4 pb-1 border-t border-gray-200"},Se={class:"flex items-center px-4"},ze={key:0,class:"shrink-0 me-3"},Te=["src","alt"],Le={class:"font-medium text-base text-gray-800"},Be={class:"font-medium text-sm text-gray-500"},Ae={class:"mt-3 space-y-1"},De=["onSubmit"],Fe={class:"flex items-center"},Ne={key:0,class:"me-2 size-5 text-green-400",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},Pe={key:0,class:"bg-white shadow"},Ee={class:"max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"},Ie={__name:"AppLayout",props:{title:String},setup(d){const i=_(!1),o=s=>{B.put(route("current-team.update"),{team_id:s.id},{preserveState:!1})},u=()=>{B.post(route("logout"))};return(s,t)=>(r(),a("div",null,[p(h(O),{title:d.title},null,8,["title"]),p(X),e("div",oe,[e("nav",ne,[e("div",ae,[e("div",ie,[e("div",le,[e("div",ue,[p(h(j),{href:s.route("dashboard")},{default:l(()=>[p(H,{class:"block h-9 w-auto"})]),_:1},8,["href"])]),e("div",de,[p(se,{href:s.route("dashboard"),active:s.route().current("dashboard")},{default:l(()=>t[1]||(t[1]=[f(" Dashboard ")])),_:1},8,["href","active"])])]),e("div",pe,[e("div",ge,[s.$page.props.jetstream.hasTeamFeatures?(r(),b(A,{key:0,align:"right",width:"60"},{trigger:l(()=>[e("span",fe,[e("button",me,[f(w(s.$page.props.auth.user.current_team.name)+" ",1),t[2]||(t[2]=e("svg",{class:"ms-2 -me-0.5 size-4",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"})],-1))])])]),content:l(()=>[e("div",ce,[t[8]||(t[8]=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Team ",-1)),p(k,{href:s.route("teams.show",s.$page.props.auth.user.current_team)},{default:l(()=>t[3]||(t[3]=[f(" Team Settings ")])),_:1},8,["href"]),s.$page.props.jetstream.canCreateTeams?(r(),b(k,{key:0,href:s.route("teams.create")},{default:l(()=>t[4]||(t[4]=[f(" Create New Team ")])),_:1},8,["href"])):g("",!0),s.$page.props.auth.user.all_teams.length>1?(r(),a(x,{key:1},[t[6]||(t[6]=e("div",{class:"border-t border-gray-200"},null,-1)),t[7]||(t[7]=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Switch Teams ",-1)),(r(!0),a(x,null,L(s.$page.props.auth.user.all_teams,n=>(r(),a("form",{key:n.id,onSubmit:$(v=>o(n),["prevent"])},[p(k,{as:"button"},{default:l(()=>[e("div",he,[n.id==s.$page.props.auth.user.current_team_id?(r(),a("svg",be,t[5]||(t[5]=[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1)]))):g("",!0),e("div",null,w(n.name),1)])]),_:2},1024)],40,ve))),128))],64)):g("",!0)])]),_:1})):g("",!0)]),e("div",ye,[p(A,{align:"right",width:"48"},{trigger:l(()=>[s.$page.props.jetstream.managesProfilePhotos?(r(),a("button",we,[e("img",{class:"size-8 rounded-full object-cover",src:s.$page.props.auth.user.profile_photo_url,alt:s.$page.props.auth.user.name},null,8,ke)])):(r(),a("span",xe,[e("button",$e,[f(w(s.$page.props.auth.user.name)+" ",1),t[9]||(t[9]=e("svg",{class:"ms-2 -me-0.5 size-4",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M19.5 8.25l-7.5 7.5-7.5-7.5"})],-1))])]))]),content:l(()=>[t[13]||(t[13]=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Account ",-1)),p(k,{href:s.route("profile.show")},{default:l(()=>t[10]||(t[10]=[f(" Profile ")])),_:1},8,["href"]),s.$page.props.jetstream.hasApiFeatures?(r(),b(k,{key:0,href:s.route("api-tokens.index")},{default:l(()=>t[11]||(t[11]=[f(" API Tokens ")])),_:1},8,["href"])):g("",!0),t[14]||(t[14]=e("div",{class:"border-t border-gray-200"},null,-1)),e("form",{onSubmit:$(u,["prevent"])},[p(k,{as:"button"},{default:l(()=>t[12]||(t[12]=[f(" Log Out ")])),_:1})],32)]),_:1})])]),e("div",_e,[e("button",{class:"inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out",onClick:t[0]||(t[0]=n=>i.value=!i.value)},[(r(),a("svg",Ce,[e("path",{class:m({hidden:i.value,"inline-flex":!i.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),e("path",{class:m({hidden:!i.value,"inline-flex":i.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),e("div",{class:m([{block:i.value,hidden:!i.value},"sm:hidden"])},[e("div",je,[p(y,{href:s.route("dashboard"),active:s.route().current("dashboard")},{default:l(()=>t[15]||(t[15]=[f(" Dashboard ")])),_:1},8,["href","active"])]),e("div",Me,[e("div",Se,[s.$page.props.jetstream.managesProfilePhotos?(r(),a("div",ze,[e("img",{class:"size-10 rounded-full object-cover",src:s.$page.props.auth.user.profile_photo_url,alt:s.$page.props.auth.user.name},null,8,Te)])):g("",!0),e("div",null,[e("div",Le,w(s.$page.props.auth.user.name),1),e("div",Be,w(s.$page.props.auth.user.email),1)])]),e("div",Ae,[p(y,{href:s.route("profile.show"),active:s.route().current("profile.show")},{default:l(()=>t[16]||(t[16]=[f(" Profile ")])),_:1},8,["href","active"]),s.$page.props.jetstream.hasApiFeatures?(r(),b(y,{key:0,href:s.route("api-tokens.index"),active:s.route().current("api-tokens.index")},{default:l(()=>t[17]||(t[17]=[f(" API Tokens ")])),_:1},8,["href","active"])):g("",!0),e("form",{method:"POST",onSubmit:$(u,["prevent"])},[p(y,{as:"button"},{default:l(()=>t[18]||(t[18]=[f(" Log Out ")])),_:1})],32),s.$page.props.jetstream.hasTeamFeatures?(r(),a(x,{key:1},[t[24]||(t[24]=e("div",{class:"border-t border-gray-200"},null,-1)),t[25]||(t[25]=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Team ",-1)),p(y,{href:s.route("teams.show",s.$page.props.auth.user.current_team),active:s.route().current("teams.show")},{default:l(()=>t[19]||(t[19]=[f(" Team Settings ")])),_:1},8,["href","active"]),s.$page.props.jetstream.canCreateTeams?(r(),b(y,{key:0,href:s.route("teams.create"),active:s.route().current("teams.create")},{default:l(()=>t[20]||(t[20]=[f(" Create New Team ")])),_:1},8,["href","active"])):g("",!0),s.$page.props.auth.user.all_teams.length>1?(r(),a(x,{key:1},[t[22]||(t[22]=e("div",{class:"border-t border-gray-200"},null,-1)),t[23]||(t[23]=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Switch Teams ",-1)),(r(!0),a(x,null,L(s.$page.props.auth.user.all_teams,n=>(r(),a("form",{key:n.id,onSubmit:$(v=>o(n),["prevent"])},[p(y,{as:"button"},{default:l(()=>[e("div",Fe,[n.id==s.$page.props.auth.user.current_team_id?(r(),a("svg",Ne,t[21]||(t[21]=[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1)]))):g("",!0),e("div",null,w(n.name),1)])]),_:2},1024)],40,De))),128))],64)):g("",!0)],64)):g("",!0)])])],2)]),s.$slots.header?(r(),a("header",Pe,[e("div",Ee,[c(s.$slots,"header")])])):g("",!0),e("main",null,[c(s.$slots,"default")])])]))}};export{Ie as _};
