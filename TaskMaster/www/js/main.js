
const datoNombre = document.querySelector('#datoNombre');
// const datoMensaje = document.querySelector('#datoMensaje');
const datotelefono = document.querySelector('#datotelefono');
const btnEnviar = document.querySelector('#btnEnviar');

var mensaje;

function enviar (){
    mensaje = `https://api.whatsapp.com/send?phone=34${datotelefono.value}&text=${datoNombre.value}
`;
    btnEnviar.href= mensaje;
}