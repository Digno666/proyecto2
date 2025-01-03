import{T as d,c as u,w as t,o as _,f as l,a as s,b as o,t as i,u as r,n as f}from"./app-DO-5RY2c.js";import{_ as g}from"./FormSection-DjWJPcds.js";import{_ as v}from"./InputError-Cks6H7iq.js";import{_ as n}from"./InputLabel-C5GsanNI.js";import{_ as h}from"./PrimaryButton-C4XANzFw.js";import{_ as $}from"./TextInput-DU9BnTFW.js";import"./SectionTitle-C4uZM_v5.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const T={class:"col-span-6"},b={class:"flex items-center mt-2"},w=["src","alt"],V={class:"ms-4 leading-tight"},x={class:"text-gray-900"},y={class:"text-sm text-gray-700"},C={class:"col-span-6 sm:col-span-4"},U={__name:"CreateTeamForm",setup(B){const a=d({name:""}),p=()=>{a.post(route("teams.store"),{errorBag:"createTeam",preserveScroll:!0})};return(m,e)=>(_(),u(g,{onSubmitted:p},{title:t(()=>e[1]||(e[1]=[l(" Team Details ")])),description:t(()=>e[2]||(e[2]=[l(" Create a new team to collaborate with others on projects. ")])),form:t(()=>[s("div",T,[o(n,{value:"Team Owner"}),s("div",b,[s("img",{class:"object-cover size-12 rounded-full",src:m.$page.props.auth.user.profile_photo_url,alt:m.$page.props.auth.user.name},null,8,w),s("div",V,[s("div",x,i(m.$page.props.auth.user.name),1),s("div",y,i(m.$page.props.auth.user.email),1)])])]),s("div",C,[o(n,{for:"name",value:"Team Name"}),o($,{id:"name",modelValue:r(a).name,"onUpdate:modelValue":e[0]||(e[0]=c=>r(a).name=c),type:"text",class:"block w-full mt-1",autofocus:""},null,8,["modelValue"]),o(v,{message:r(a).errors.name,class:"mt-2"},null,8,["message"])])]),actions:t(()=>[o(h,{class:f({"opacity-25":r(a).processing}),disabled:r(a).processing},{default:t(()=>e[3]||(e[3]=[l(" Create ")])),_:1},8,["class","disabled"])]),_:1}))}};export{U as default};
