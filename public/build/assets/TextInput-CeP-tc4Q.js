import{r as n,o as s,e as l,m as d}from"./app-GV3W-rpa.js";const c=["value"],m={__name:"TextInput",props:{modelValue:String},emits:["update:modelValue"],setup(u,{expose:o}){const e=n(null);return s(()=>{e.value.hasAttribute("autofocus")&&e.value.focus()}),o({focus:()=>e.value.focus()}),(t,r)=>(l(),d("input",{ref_key:"input",ref:e,class:"border-neutral-300 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300 focus:border-red-500 dark:focus:border-red-600 focus:ring-red-500 dark:focus:ring-red-600 rounded-md shadow-sm",value:u.modelValue,onInput:r[0]||(r[0]=a=>t.$emit("update:modelValue",a.target.value))},null,40,c))}};export{m as _};