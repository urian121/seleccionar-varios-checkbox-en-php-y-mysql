
/**
 * Función para actualizar el total de habilidades de un desarrollador específico.
 */

 export function actualizarTotalHabilidades(idDev, totalHabilidades) {
  document.querySelector(
    `#total_habilidades_${idDev}`
  ).textContent = `${totalHabilidades} habilidades`;
}
