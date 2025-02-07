import { miToast } from "./toast.js";
import { actualizarTotalHabilidades } from "./actualizar_total_habilidades.js";

/**
 * Función para seleccionar o deseleccionar todos los checkboxes (Habilidades).
 */
let BtnseleccionarTodos = document.querySelector("#seleccionarTodos");
BtnseleccionarTodos.addEventListener("click", seleccionarTodos);

function seleccionarTodos() {
  let btn_seleccionarTodos = document.querySelector("#seleccionarTodos");
  let id_dev_seleccionado = document.querySelector(
    "input[type='radio']:checked"
  ).value;
  let checkboxes = document.querySelectorAll(
    '#div_respuesta input[type="checkbox"]'
  );

  let todosSeleccionados = Array.from(checkboxes).every((chk) => chk.checked);
  let habilidadesSeleccionadas = [];

  checkboxes.forEach((chk) => {
    chk.checked = !todosSeleccionados;

    if (chk.checked) {
      habilidadesSeleccionadas.push(chk.value);
    }
  });

  // Cambiar texto del botón
  btn_seleccionarTodos.textContent = todosSeleccionados
    ? "Seleccionar Todos"
    : "Deseleccionar Todos";

  // Enviar los datos con fetch
  fetch("procesar_habilidad.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: new URLSearchParams({
      action: "desmarcar_marcar_todos",
      id_habilidad: JSON.stringify(habilidadesSeleccionadas),
      id_dev: id_dev_seleccionado,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Respuesta del servidor:", data);
      actualizarTotalHabilidades(id_dev_seleccionado, data.total_habilidades);
      
      // Mostrar la notificación
      miToast(data.mensaje, "success");
    })
    .catch((error) => {
      console.error("Error en la solicitud:", error);
    });

  console.log("Habilidades seleccionadas:", habilidadesSeleccionadas);
}
