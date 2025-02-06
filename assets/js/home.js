document.addEventListener("DOMContentLoaded", function () {
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

      getHabilidadesDev(item.id);
    });
  });
});

function getHabilidadesDev(idDev) {
    console.log("Id del dev seleccionado:", idDev);
    
  try {
    let div_respuesta = document.querySelector("#div_respuesta");
    let url = `habilidades_dev.php?id_dev=${idDev}`;
    if (url) {
      $(div_respuesta).load(url, function () {
        console.log("Se ha cargado las habilidades del desarrollador.");

          
          let habilidad_checkbox =
            document.querySelectorAll(".custom_checkbox");

          habilidad_checkbox.forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                console.log("ID de habilidad seleccionada:", this.value);
                
                fetch("procesar_habilidad.php", {
                  method: "POST",
                  headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                  },
                  body: "id_habilidad=" + this.value + "&id_dev=" + idDev,
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
