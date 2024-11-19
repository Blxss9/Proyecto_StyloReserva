let paso=1;const pasoInicial=1,pasoFinal=4,cita={id:"",nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarAPI(),idCliente(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}async function consultarAPI(){try{const e="/api/servicios",t=await fetch(e),o=await t.json();o.error?(console.error(o.error),mostrarAlerta("Error al cargar los servicios","error")):mostrarServicios(o)}catch(e){console.error(e),mostrarAlerta("Error al cargar los servicios","error")}}function mostrarServicios(e){const t=document.querySelector("#servicios");t?(t.innerHTML="",e.forEach(e=>{const{id:o,nombre_servicio:r,precio:n}=e,a=parseInt(n).toLocaleString("es-CL"),c=document.createElement("DIV");c.classList.add("servicio"),c.dataset.idServicio=o,c.innerHTML=`\n            <p class="nombre-servicio">${r}</p>\n            <p class="precio-servicio">$${a}</p>\n        `,c.onclick=()=>seleccionarServicio(e),t.appendChild(c)})):console.error("El contenedor de servicios no existe")}function paginaSiguiente(){const e=document.querySelector("#siguiente");e&&e.addEventListener("click",()=>{if(paso>=4)return;let e=!0;3===paso?e=validarResumen():2===paso?e=validarFecha():1===paso&&(e=validarServicios()),e&&(paso++,mostrarSeccion(),botonesPaginador())})}function paginaAnterior(){const e=document.querySelector("#anterior");e&&e.addEventListener("click",()=>{paso<=1||(paso--,mostrarSeccion(),botonesPaginador())})}function botonesPaginador(){const e=document.querySelector("#anterior"),t=document.querySelector("#siguiente");e&&t&&(1===paso?(e.classList.add("opacity-50"),e.disabled=!0):(e.classList.remove("opacity-50"),e.disabled=!1),4===paso?(t.classList.add("opacity-50"),t.textContent="Confirmar",t.disabled=!0):(t.classList.remove("opacity-50"),t.disabled=!1,t.textContent="Siguiente »"))}function mostrarSeccion(){const e=document.querySelector(".seccion:not(.hidden)");e&&e.classList.add("hidden");const t="#paso-"+paso,o=document.querySelector(t);o&&o.classList.remove("hidden");const r=document.querySelector(".step-button.bg-blue-500");r&&(r.classList.remove("bg-blue-500","text-white"),r.classList.add("bg-gray-300","text-gray-600"));const n=document.querySelector(`[data-paso="${paso}"]`);n&&(n.classList.remove("bg-gray-300","text-gray-600"),n.classList.add("bg-blue-500","text-white"));const a=document.querySelector("#progress");a&&(a.style.width=paso/4*100+"%")}function mostrarAlerta(e,t){if("undefined"==typeof Swal)return console.error("SweetAlert2 no está cargado"),void alert(e);Swal.fire({icon:t,title:"error"===t?"Error":"Éxito",text:e})}function tabs(){document.querySelectorAll(".step-button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function validarServicios(){return 0!==cita.servicios.length||(mostrarAlerta("Debes seleccionar al menos un servicio","error"),!1)}function validarFecha(){const e=document.querySelector("#fecha").value,t=document.querySelector("#hora").value;return""!==e&&""!==t||(mostrarAlerta("Debes seleccionar fecha y hora","error"),!1)}function validarResumen(){return!Object.values(cita).includes("")||(mostrarAlerta("Faltan datos por confirmar","error"),!1)}function seleccionarServicio(e){const{id:t}=e,{servicios:o}=cita,r=document.querySelector(`[data-id-servicio="${t}"]`);o.some(e=>e.id===t)?(cita.servicios=o.filter(e=>e.id!==t),r.classList.remove("seleccionado")):(cita.servicios=[...o,e],r.classList.add("seleccionado"))}function idCliente(){const e=document.querySelector("#id").value;cita.id=e}function nombreCliente(){const e=document.querySelector("#nombre").value;cita.nombre=e}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",(function(e){const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlerta("Fines de semana no permitidos","error")):cita.fecha=e.target.value}))}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":")[0];t<10||t>18?(e.target.value="",mostrarAlerta("Hora no válida","error")):cita.hora=e.target.value}))}function mostrarResumen(){const e=document.querySelector("#resumen-cita");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return;const{nombre:t,fecha:o,hora:r,servicios:n}=cita,a=document.createElement("H3");a.textContent="Resumen de Servicios",e.appendChild(a),n.forEach(t=>{const{nombre:o,precio:r}=t,n=document.createElement("DIV");n.classList.add("contenedor-servicio");const a=document.createElement("P");a.textContent=o;const c=document.createElement("P");c.innerHTML="<span>Precio:</span> $"+r,n.appendChild(a),n.appendChild(c),e.appendChild(n)});const c=document.createElement("H3");c.textContent="Resumen de Cita",e.appendChild(c);const i=document.createElement("P");i.innerHTML="<span>Nombre:</span> "+t;const s=new Date(o).toLocaleDateString("es-ES",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),l=document.createElement("P");l.innerHTML="<span>Fecha:</span> "+s;const d=document.createElement("P");d.innerHTML=`<span>Hora:</span> ${r} Horas`,e.appendChild(i),e.appendChild(l),e.appendChild(d)}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));
//# sourceMappingURL=app.js.map
