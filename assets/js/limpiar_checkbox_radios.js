
/**
 * Función para limpiar los checkboxes y radios de la página.
 */

  export function limpiarCheckboxesAndRadios() {
    let inputs = document.querySelectorAll(
      "input[type='checkbox'], input[type='radio']"
    );

    inputs.forEach((input) => {
      input.checked = false; // Deselecciona todos los checkboxes y radios
    });

    let checkboxes = document.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach((checkbox) => {
      checkbox.disabled = true; // Deshabilita todos los checkboxes
    });

    document.querySelector("#seleccionarTodos").disabled = true;
    console.log("Todos los checkboxes y radios han sido deseleccionados.");
  }
