import{Q as H,T as w,r as C,d as r,b as n,w as s,e as c,o as a,f as i,a as o,u as l,F as T,g as R,n as v,t as y,y as J}from"./app-DO-5RY2c.js";import{_ as K}from"./ActionMessage-Cmh_WM3q.js";import{_ as z}from"./ActionSection-0Or9Reho.js";import{_ as A}from"./ConfirmationModal-C7id_gMF.js";import{_ as B}from"./DangerButton-DmbVFwrd.js";import{_ as W}from"./DialogModal-BtuL29he.js";import{_ as X}from"./FormSection-DjWJPcds.js";import{_ as F}from"./InputError-Cks6H7iq.js";import{_ as L}from"./InputLabel-C5GsanNI.js";import{_ as P}from"./PrimaryButton-C4XANzFw.js";import{_ as h}from"./SecondaryButton-93s-o9ns.js";import{S}from"./SectionBorder-tTLppyz6.js";import{_ as Y}from"./TextInput-DU9BnTFW.js";import"./SectionTitle-C4uZM_v5.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./Modal-CxjrqT9w.js";const Z={key:0},ee={class:"col-span-6 sm:col-span-4"},te={key:0,class:"col-span-6 lg:col-span-4"},se={class:"relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer"},oe=["onClick"],le={class:"flex items-center"},ne={key:0,class:"ms-2 size-5 text-green-400",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},re={class:"mt-2 text-xs text-gray-600 text-start"},ae={key:1},ie={class:"space-y-6"},me={class:"text-gray-600"},de={class:"flex items-center"},ue=["onClick"],ce={key:2},ve={class:"space-y-6"},fe={class:"flex items-center"},be=["src","alt"],ye={class:"ms-4"},ge={class:"flex items-center"},pe=["onClick"],ke={key:1,class:"ms-2 text-sm text-gray-400"},xe=["onClick"],we={key:0},Ce={class:"relative z-0 mt-1 border border-gray-200 rounded-lg cursor-pointer"},Te=["onClick"],Re={class:"flex items-center"},Me={key:0,class:"ms-2 size-5 text-green-400",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},$e={class:"mt-2 text-xs text-gray-600"},De={__name:"TeamMemberManager",props:{team:Object,availableRoles:Array,userPermissions:Object},setup(m){const p=m,V=H(),d=w({email:"",role:null}),f=w({role:null}),M=w({}),$=w({}),k=C(!1),_=C(null),x=C(!1),g=C(null),N=()=>{d.post(route("team-members.store",p.team),{errorBag:"addTeamMember",preserveScroll:!0,onSuccess:()=>d.reset()})},O=u=>{J.delete(route("team-invitations.destroy",u),{preserveScroll:!0})},E=u=>{_.value=u,f.role=u.membership.role,k.value=!0},I=()=>{f.put(route("team-members.update",[p.team,_.value]),{preserveScroll:!0,onSuccess:()=>k.value=!1})},U=()=>{x.value=!0},D=()=>{M.delete(route("team-members.destroy",[p.team,V.props.auth.user]))},Q=u=>{g.value=u},q=()=>{$.delete(route("team-members.destroy",[p.team,g.value]),{errorBag:"removeTeamMember",preserveScroll:!0,preserveState:!0,onSuccess:()=>g.value=null})},j=u=>p.availableRoles.find(e=>e.key===u).name;return(u,e)=>(a(),r("div",null,[m.userPermissions.canAddTeamMembers?(a(),r("div",Z,[n(S),n(X,{onSubmitted:N},{title:s(()=>e[7]||(e[7]=[i(" Add Team Member ")])),description:s(()=>e[8]||(e[8]=[i(" Add a new team member to your team, allowing them to collaborate with you. ")])),form:s(()=>[e[10]||(e[10]=o("div",{class:"col-span-6"},[o("div",{class:"max-w-xl text-sm text-gray-600"}," Please provide the email address of the person you would like to add to this team. ")],-1)),o("div",ee,[n(L,{for:"email",value:"Email"}),n(Y,{id:"email",modelValue:l(d).email,"onUpdate:modelValue":e[0]||(e[0]=t=>l(d).email=t),type:"email",class:"mt-1 block w-full"},null,8,["modelValue"]),n(F,{message:l(d).errors.email,class:"mt-2"},null,8,["message"])]),m.availableRoles.length>0?(a(),r("div",te,[n(L,{for:"roles",value:"Role"}),n(F,{message:l(d).errors.role,class:"mt-2"},null,8,["message"]),o("div",se,[(a(!0),r(T,null,R(m.availableRoles,(t,b)=>(a(),r("button",{key:t.key,type:"button",class:v(["relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500",{"border-t border-gray-200 focus:border-none rounded-t-none":b>0,"rounded-b-none":b!=Object.keys(m.availableRoles).length-1}]),onClick:G=>l(d).role=t.key},[o("div",{class:v({"opacity-50":l(d).role&&l(d).role!=t.key})},[o("div",le,[o("div",{class:v(["text-sm text-gray-600",{"font-semibold":l(d).role==t.key}])},y(t.name),3),l(d).role==t.key?(a(),r("svg",ne,e[9]||(e[9]=[o("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1)]))):c("",!0)]),o("div",re,y(t.description),1)],2)],10,oe))),128))])])):c("",!0)]),actions:s(()=>[n(K,{on:l(d).recentlySuccessful,class:"me-3"},{default:s(()=>e[11]||(e[11]=[i(" Added. ")])),_:1},8,["on"]),n(P,{class:v({"opacity-25":l(d).processing}),disabled:l(d).processing},{default:s(()=>e[12]||(e[12]=[i(" Add ")])),_:1},8,["class","disabled"])]),_:1})])):c("",!0),m.team.team_invitations.length>0&&m.userPermissions.canAddTeamMembers?(a(),r("div",ae,[n(S),n(z,{class:"mt-10 sm:mt-0"},{title:s(()=>e[13]||(e[13]=[i(" Pending Team Invitations ")])),description:s(()=>e[14]||(e[14]=[i(" These people have been invited to your team and have been sent an invitation email. They may join the team by accepting the email invitation. ")])),content:s(()=>[o("div",ie,[(a(!0),r(T,null,R(m.team.team_invitations,t=>(a(),r("div",{key:t.id,class:"flex items-center justify-between"},[o("div",me,y(t.email),1),o("div",de,[m.userPermissions.canRemoveTeamMembers?(a(),r("button",{key:0,class:"cursor-pointer ms-6 text-sm text-red-500 focus:outline-none",onClick:b=>O(t)}," Cancel ",8,ue)):c("",!0)])]))),128))])]),_:1})])):c("",!0),m.team.users.length>0?(a(),r("div",ce,[n(S),n(z,{class:"mt-10 sm:mt-0"},{title:s(()=>e[15]||(e[15]=[i(" Team Members ")])),description:s(()=>e[16]||(e[16]=[i(" All of the people that are part of this team. ")])),content:s(()=>[o("div",ve,[(a(!0),r(T,null,R(m.team.users,t=>(a(),r("div",{key:t.id,class:"flex items-center justify-between"},[o("div",fe,[o("img",{class:"size-8 rounded-full object-cover",src:t.profile_photo_url,alt:t.name},null,8,be),o("div",ye,y(t.name),1)]),o("div",ge,[m.userPermissions.canUpdateTeamMembers&&m.availableRoles.length?(a(),r("button",{key:0,class:"ms-2 text-sm text-gray-400 underline",onClick:b=>E(t)},y(j(t.membership.role)),9,pe)):m.availableRoles.length?(a(),r("div",ke,y(j(t.membership.role)),1)):c("",!0),u.$page.props.auth.user.id===t.id?(a(),r("button",{key:2,class:"cursor-pointer ms-6 text-sm text-red-500",onClick:U}," Leave ")):m.userPermissions.canRemoveTeamMembers?(a(),r("button",{key:3,class:"cursor-pointer ms-6 text-sm text-red-500",onClick:b=>Q(t)}," Remove ",8,xe)):c("",!0)])]))),128))])]),_:1})])):c("",!0),n(W,{show:k.value,onClose:e[2]||(e[2]=t=>k.value=!1)},{title:s(()=>e[17]||(e[17]=[i(" Manage Role ")])),content:s(()=>[_.value?(a(),r("div",we,[o("div",Ce,[(a(!0),r(T,null,R(m.availableRoles,(t,b)=>(a(),r("button",{key:t.key,type:"button",class:v(["relative px-4 py-3 inline-flex w-full rounded-lg focus:z-10 focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500",{"border-t border-gray-200 focus:border-none rounded-t-none":b>0,"rounded-b-none":b!==Object.keys(m.availableRoles).length-1}]),onClick:G=>l(f).role=t.key},[o("div",{class:v({"opacity-50":l(f).role&&l(f).role!==t.key})},[o("div",Re,[o("div",{class:v(["text-sm text-gray-600",{"font-semibold":l(f).role===t.key}])},y(t.name),3),l(f).role==t.key?(a(),r("svg",Me,e[18]||(e[18]=[o("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1)]))):c("",!0)]),o("div",$e,y(t.description),1)],2)],10,Te))),128))])])):c("",!0)]),footer:s(()=>[n(h,{onClick:e[1]||(e[1]=t=>k.value=!1)},{default:s(()=>e[19]||(e[19]=[i(" Cancel ")])),_:1}),n(P,{class:v(["ms-3",{"opacity-25":l(f).processing}]),disabled:l(f).processing,onClick:I},{default:s(()=>e[20]||(e[20]=[i(" Save ")])),_:1},8,["class","disabled"])]),_:1},8,["show"]),n(A,{show:x.value,onClose:e[4]||(e[4]=t=>x.value=!1)},{title:s(()=>e[21]||(e[21]=[i(" Leave Team ")])),content:s(()=>e[22]||(e[22]=[i(" Are you sure you would like to leave this team? ")])),footer:s(()=>[n(h,{onClick:e[3]||(e[3]=t=>x.value=!1)},{default:s(()=>e[23]||(e[23]=[i(" Cancel ")])),_:1}),n(B,{class:v(["ms-3",{"opacity-25":l(M).processing}]),disabled:l(M).processing,onClick:D},{default:s(()=>e[24]||(e[24]=[i(" Leave ")])),_:1},8,["class","disabled"])]),_:1},8,["show"]),n(A,{show:g.value,onClose:e[6]||(e[6]=t=>g.value=null)},{title:s(()=>e[25]||(e[25]=[i(" Remove Team Member ")])),content:s(()=>e[26]||(e[26]=[i(" Are you sure you would like to remove this person from the team? ")])),footer:s(()=>[n(h,{onClick:e[5]||(e[5]=t=>g.value=null)},{default:s(()=>e[27]||(e[27]=[i(" Cancel ")])),_:1}),n(B,{class:v(["ms-3",{"opacity-25":l($).processing}]),disabled:l($).processing,onClick:q},{default:s(()=>e[28]||(e[28]=[i(" Remove ")])),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}};export{De as default};
