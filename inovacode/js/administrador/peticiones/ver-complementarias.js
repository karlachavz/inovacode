//----PETICIONES DE ver-complementarias.php-----//

//funcion que actualiza la hora al mover la hora en el select
function actualizarHoraFin(numeroDia) {
  const inicioSelect = document.getElementById("hora_inicio" + numeroDia);
  const finSelect = document.getElementById("hora_fin" + numeroDia);

  // Obtener el valor seleccionado
  const inicio = inicioSelect.value;

  // Si no hay valor seleccionado, salir
  if (!inicio || inicio === "") {
    return;
  }

  // Convertir la hora a número y sumar 1 hora
  const [horaStr, minutoStr] = inicio.split(":");
  let hora = parseInt(horaStr);

  // Sumar 1 hora
  hora += 1;

  // Formatear a 2 dígitos
  const horaFin = hora.toString().padStart(2, "0");
  const nuevaHoraFin = horaFin + ":" + minutoStr;

  // Buscar y seleccionar la opción correspondiente en hora_fin
  for (let i = 0; i < finSelect.options.length; i++) {
    if (finSelect.options[i].value === nuevaHoraFin) {
      finSelect.selectedIndex = i;
      break;
    }
  }
}

//funcion que muestra los campos ocultos de la card al activar la checkbox
function mostrarCampos() {
  const contenedor = document.getElementById("campos-ocultos");
  const check = document.getElementById("tiene_segundo_dia");

  contenedor.style.display = check.checked ? "block" : "none";
}

// Inicializar campos ocultos como ocultos al cargar la página
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("campos-ocultos").style.display = "none";
});

//funcion que valida que no exitan horas negativas a momento de seleccionar el horario
function validarHoras(numeroDia) {
  const inicio = document.getElementById("hora_inicio" + numeroDia);
  const fin = document.getElementById("hora_fin" + numeroDia);

  if (!inicio.value || !fin.value) return;

  const inicioMin = convertirAMinutos(inicio.value);
  const finMin = convertirAMinutos(fin.value);

  if (finMin <= inicioMin) {
    alert("La hora de término debe ser mayor a la hora de inicio");
    fin.value = "";
  }
}

//funcion que convierte la hora al formato apropiado
function convertirAMinutos(hora) {
  const [h, m] = hora.split(":").map(Number);
  return h * 60 + m;
}

//funcion para recargar la tabla luego de cambiar el select de periodo_filtro
function recargar_tabla(id_periodo, id_complementaria) {

  console.log("Periodo:", id_periodo);
  console.log("Tipo:", typeof id_periodo);

  let url = "/inovacode/administrador/ver-complementarias.php";

  if (Number(id_periodo) === 0) {


    window.location.href =
      url + "?ID=" + id_complementaria;

  } else {

    window.location.href =
      url + "?ID=" + id_complementaria + "&periodo=" + id_periodo;
  }
}


  

/*function mostrarCampos() {
            const contenedor = document.getElementById("campos-ocultos");

            const check = document.getElementById("tiene_segundo_dia");

            if (check.checked === false) {
                contenedor.style.display = "none";
            }
            if (check.checked) {
                contenedor.style.display = "block";
            }
        }*/
