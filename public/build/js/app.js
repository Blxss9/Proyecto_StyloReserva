let paso=1;const pasoInicial=1,pasoFinal=4,cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}async function consultarAPI(){try{const e="/api/servicios",t=await fetch(e),o=await t.json();o.error?(console.error(o.error),mostrarAlerta("Error al cargar los servicios","error")):mostrarServicios(o)}catch(e){console.error(e),mostrarAlerta("Error al cargar los servicios","error")}}function mostrarServicios(e){const t=document.querySelector("#servicios");t?(t.innerHTML="",e.forEach(e=>{const{id:o,nombre_servicio:r,precio:a}=e,n=parseInt(a).toLocaleString("es-CL"),s=document.createElement("DIV");s.classList.add("servicio"),s.dataset.idServicio=o,s.innerHTML=`\n            <p class="nombre-servicio">${r}</p>\n            <p class="precio-servicio">$${n}</p>\n        `,s.onclick=()=>seleccionarServicio(e),t.appendChild(s)})):console.error("El contenedor de servicios no existe")}function paginaSiguiente(){const e=document.querySelector("#siguiente");e&&e.addEventListener("click",()=>{paso>=4||(1!==paso||validarServicios())&&(2!==paso||validarFecha())&&(paso++,mostrarSeccion(),botonesPaginador(),mostrarResumen())})}function paginaAnterior(){const e=document.querySelector("#anterior");e&&e.addEventListener("click",()=>{paso<=1||(paso--,mostrarSeccion(),botonesPaginador())})}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");e&&t&&(1===paso?(e.classList.add("opacity-50"),e.disabled=!0):(e.classList.remove("opacity-50"),e.disabled=!1),4===paso?(t.classList.add("opacity-50"),t.textContent="Confirmar",t.disabled=!0):(t.classList.remove("opacity-50"),t.disabled=!1,t.textContent="Siguiente »"))}function mostrarSeccion(){const e=document.querySelector(".seccion:not(.hidden)");e&&e.classList.add("hidden");const t="#paso-"+paso,o=document.querySelector(t);o&&o.classList.remove("hidden");const r=document.querySelector(".step-button.bg-blue-500");r&&(r.classList.remove("bg-blue-500","text-white"),r.classList.add("bg-gray-300","text-gray-600"));const a=document.querySelector(`[data-paso="${paso}"]`);a&&(a.classList.remove("bg-gray-300","text-gray-600"),a.classList.add("bg-blue-500","text-white"));const n=document.querySelector("#progress");n&&(n.style.width=paso/4*100+"%")}function mostrarAlerta(e,t){if("undefined"==typeof Swal)return console.error("SweetAlert2 no está cargado"),void alert(e);Swal.fire({icon:t,title:"error"===t?"Error":"Éxito",text:e})}function tabs(){document.querySelectorAll(".step-button").forEach(e=>{e.addEventListener("click",(function(e){const t=parseInt(e.target.dataset.paso);if(t<paso)return paso=t,mostrarSeccion(),void botonesPaginador();(1!==paso||validarServicios())&&(2!==paso||validarFecha())&&(t-paso==1?(paso=t,mostrarSeccion(),botonesPaginador()):mostrarAlerta("Por favor, complete los pasos en orden","error"))}))})}function validarServicios(){return 0!==cita.servicios.length||(mostrarAlerta("Debes seleccionar al menos un servicio","error"),!1)}function validarFecha(){return!(""===document.querySelector("#fecha").value||!cita.hora)||(mostrarAlerta("Debes seleccionar fecha y hora","error"),!1)}function validarResumen(){return!Object.values(cita).includes("")||(mostrarAlerta("Faltan datos por confirmar","error"),!1)}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,r=document.querySelector(`[data-id-servicio="${t}"]`);o.some(e=>e.id===t)?(cita.servicios=o.filter(e=>e.id!==t),r.classList.remove("seleccionado")):(cita.servicios=[...o,e],r.classList.add("seleccionado")),mostrarResumen()}function idCliente(){const e=document.querySelector("#id");e&&(cita.id=e.value)}function nombreCliente(){const e=document.querySelector("#nombre");e&&(cita.nombre=e.value)}function seleccionarFecha(){const e=document.querySelector("#fecha"),t=document.querySelector("#horas-disponibles");if(!e||!t)return void console.error("No se encontraron los elementos necesarios");const o=new Date,r=`${o.getFullYear()}-${(o.getMonth()+1).toString().padStart(2,"0")}-${o.getDate().toString().padStart(2,"0")}`;e.min=r,e.addEventListener("input",(function(e){const o=new Date(e.target.value+"T00:00:00");if(o<new Date(r+"T00:00:00"))e.target.value="",mostrarAlerta("No puedes seleccionar fechas pasadas","error"),t.classList.add("hidden"),cita.fecha="",cita.hora="";else{const r=o.getUTCDay();[6,0].includes(r)?(e.target.value="",mostrarAlerta("Fines de semana no permitidos","error"),t.classList.add("hidden"),cita.fecha="",cita.hora=""):(cita.fecha=e.target.value,mostrarHorasDisponibles())}mostrarResumen()}))}function mostrarHorasDisponibles(){const e=document.querySelector("#horas-disponibles");if(!e)return void console.error("No se encontró el contenedor de horas disponibles");e.classList.remove("hidden");const t={"mañana":["10:00","10:50","11:40"],tarde:["12:30","15:00","15:50","16:40","17:30"],noche:["18:20","19:10"]};["mañana","tarde","noche"].forEach(e=>{const o=document.querySelector("#horas-"+e);o?(o.innerHTML="",t[e].forEach(e=>{const t=document.createElement("BUTTON");t.type="button",t.classList.add("px-4","py-2","text-sm","border","rounded","hover:bg-blue-500","hover:text-white"),cita.hora===e&&t.classList.add("bg-blue-500","text-white"),t.textContent=e,t.onclick=function(){document.querySelectorAll('button[type="button"]').forEach(e=>{e.classList.remove("bg-blue-500","text-white")}),this.classList.add("bg-blue-500","text-white"),cita.hora=e,mostrarResumen()},o.appendChild(t)})):console.error("No se encontró el contenedor para "+e)})}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t<10||t>18?(e.target.value="",mostrarAlerta("Hora no válida","error")):cita.hora=e.target.value}))}function mostrarResumen(){const e=document.querySelector("#resumen-cita");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return;const{nombre:t,fecha:o,hora:r,servicios:a}=cita,n=document.createElement("DIV");n.classList.add("p-6","space-y-6");const s=document.createElement("P");s.innerHTML='<span class="font-bold">Nombre:</span> '+t,s.classList.add("text-lg");const c=document.createElement("DIV");c.classList.add("space-y-3");const i=document.createElement("H3");i.textContent="Servicios Seleccionados:",i.classList.add("font-bold","text-lg","mb-3"),c.appendChild(i),a.forEach(e=>{const{nombre_servicio:t,precio:o}=e,r=document.createElement("P"),a=new Intl.NumberFormat("es-CL",{style:"currency",currency:"CLP"}).format(o);r.textContent=`${t} - ${a}`,c.appendChild(r)});const l=new Date(o).toLocaleDateString("es-CL",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),d=l.charAt(0).toUpperCase()+l.slice(1),u=document.createElement("P");u.innerHTML='<span class="font-bold">Fecha:</span> '+d,u.classList.add("text-lg");const m=document.createElement("P");m.innerHTML=`<span class="font-bold">Hora:</span> ${r} hrs`,m.classList.add("text-lg");const p=a.reduce((e,t)=>e+parseFloat(t.precio),0),h=new Intl.NumberFormat("es-CL",{style:"currency",currency:"CLP"}).format(p),v=document.createElement("P");v.innerHTML='<span class="font-bold">Total:</span> '+h,v.classList.add("text-xl","mt-6"),n.appendChild(s),n.appendChild(c),n.appendChild(u),n.appendChild(m),n.appendChild(v),e.appendChild(n)}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));
//# sourceMappingURL=app.js.map
