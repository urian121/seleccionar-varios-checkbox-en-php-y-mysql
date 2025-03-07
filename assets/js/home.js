import { miToast } from "./toast.js";
import { limpiarCheckboxesAndRadios } from "./limpiar_checkbox_radios.js";
import { actualizarTotalHabilidades } from "./actualizar_total_habilidades.js";

document.addEventListener("DOMContentLoaded", function () {
  //Código para limpiar checkboxes y radios al cargar la página
  limpiarCheckboxesAndRadios();

  const items = document.querySelectorAll(".dev-item");
  //console.log(items); // Muestra todos los elementos <li>

  items.forEach((item) => {
    item.addEventListener("click", () => {
      // Remover la clase activa de todos los <li>
      items.forEach((el) => el.classList.remove("active"));

      //console.log(item); // Muestra el <li> seleccionado

      // Marcar el input radio correspondiente
      const radio = item.querySelector("input[type='radio']");
      if (radio) radio.checked = true;

      item.classList.add("active");

      //console.log("Id del desarrollador:", item.id);

      // Habilitar el botón "Seleccionar Todos"
      document.querySelector("#seleccionarTodos").disabled = false;

      getHabilidadesDev(item.id);
    });
  });
});

/**
 *  Función para obtener las habilidades de un desarrollador específico.
 */
function getHabilidadesDev(idDev) {
  console.log("Id del dev seleccionado:", idDev);

  try {
    let div_respuesta = document.querySelector("#div_respuesta");
    let url = `habilidades_dev.php?id_dev=${idDev}`;

    if (url) {
      $(div_respuesta).load(url, function () {
        console.log("Se han cargado las habilidades del desarrollador.");

        let habilidad_checkbox = div_respuesta.querySelectorAll(
          "input[type='checkbox']"
        );

        habilidad_checkbox.forEach((checkbox) => {
          checkbox.addEventListener("change", function () {
            console.log("ID de habilidad seleccionada:", this.value);

            fetch("procesar_habilidad.php", {
              method: "POST",
              headers: {
                "Content-Type": "application/x-www-form-urlencoded",
              },
              body: new URLSearchParams({
                action: "agregar_habilidad",
                id_habilidad: this.value,
                id_dev: idDev,
              }),
            })
              .then((response) => response.json())
              .then((data) => {
                console.log(data);
                actualizarTotalHabilidades(idDev, data.total_habilidades);

                // Mostrar mensaje de toast
                miToast(data.mensaje, "success");
              })
              .catch((error) => {
                console.error("Error al enviar la solicitud:", error);
              });
          });
        });
      });
    }
  } catch (error) {
    console.error("Error al procesar la solicitud:", error);
  }
}
