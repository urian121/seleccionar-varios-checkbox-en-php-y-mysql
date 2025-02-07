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
 * Función para limpiar los checkboxes y radios de la página.
 */
function limpiarCheckboxesAndRadios() {
  let inputs = document.querySelectorAll(
    "input[type='checkbox'], input[type='radio']"
  );

  inputs.forEach((input) => {
    input.checked = false; // Deselecciona todos los checkboxes y radios
  });

  document.querySelector("#seleccionarTodos").disabled = true;
  console.log("Todos los checkboxes y radios han sido deseleccionados.");
}

/**
 * Función para seleccionar o deseleccionar todos los checkboxes (Habilidades).
 */
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
    })
    .catch((error) => {
      console.error("Error en la solicitud:", error);
    });

  console.log("Habilidades seleccionadas:", habilidadesSeleccionadas);
}

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
              .then((response) => response.text())
              .then((data) => {
                console.log(data);
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

