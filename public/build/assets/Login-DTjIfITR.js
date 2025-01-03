import{T as w,d,b as t,u as o,w as m,F as b,o as n,Z as x,t as k,e as u,a,c as y,f,i as V,n as v,h as $}from"./app-DO-5RY2c.js";import{A as h}from"./AuthenticationCard-C9ScA57k.js";import{_ as B}from"./AuthenticationCardLogo-BT6E5Uq1.js";import{_ as C}from"./Checkbox-BO3ijmvK.js";import{_ as c}from"./InputError-Cks6H7iq.js";import{_ as p}from"./InputLabel-C5GsanNI.js";import{_ as F}from"./PrimaryButton-C4XANzFw.js";import{_ as g}from"./TextInput-DU9BnTFW.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const N={key:0,class:"mb-4 font-medium text-sm text-green-600"},q={class:"mt-4"},L={class:"block mt-4"},P={class:"flex items-center"},R={class:"flex items-center justify-end mt-4"},Z={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(l){const e=w({email:"",password:"",remember:!1}),_=()=>{e.transform(i=>({...i,remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(i,s)=>(n(),d(b,null,[t(o(x),{title:"Log in"}),t(h,null,{logo:m(()=>[t(B)]),default:m(()=>[l.status?(n(),d("div",N,k(l.status),1)):u("",!0),a("form",{onSubmit:$(_,["prevent"])},[a("div",null,[t(p,{for:"email",value:"Email"}),t(g,{id:"email",modelValue:o(e).email,"onUpdate:modelValue":s[0]||(s[0]=r=>o(e).email=r),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),t(c,{class:"mt-2",message:o(e).errors.email},null,8,["message"])]),a("div",q,[t(p,{for:"password",value:"Password"}),t(g,{id:"password",modelValue:o(e).password,"onUpdate:modelValue":s[1]||(s[1]=r=>o(e).password=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password"},null,8,["modelValue"]),t(c,{class:"mt-2",message:o(e).errors.password},null,8,["message"])]),a("div",L,[a("label",P,[t(C,{checked:o(e).remember,"onUpdate:checked":s[2]||(s[2]=r=>o(e).remember=r),name:"remember"},null,8,["checked"]),s[3]||(s[3]=a("span",{class:"ms-2 text-sm text-gray-600"},"Remember me",-1))])]),a("div",R,[l.canResetPassword?(n(),y(o(V),{key:0,href:i.route("password.request"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:m(()=>s[4]||(s[4]=[f(" Forgot your password? ")])),_:1},8,["href"])):u("",!0),t(F,{class:v(["ms-4",{"opacity-25":o(e).processing}]),disabled:o(e).processing},{default:m(()=>s[5]||(s[5]=[f(" Log in ")])),_:1},8,["class","disabled"])])],32)]),_:1})],64))}};export{Z as default};
