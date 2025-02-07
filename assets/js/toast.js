import { toast } from "https://unpkg.com/nextjs-toast-notify@1.35.0/dist/nextjs-toast-notify.js";
/**
 *  Función para mostrar notificaciones con la libreria nextjs-toast-notify
 *  👉 https://www.npmjs.com/package/nextjs-toast-notify
 *  👉 https://www.nextjstoastnotify.com/
 */

export function miToast(msj, type) {
  toast[type](msj, {
    duration: 5000, // Duración de la notificación en ms
    position: "top-right", // Posición de la notificación
    transition: "swingInverted", // Tipo de transición para la entrada
    icon: "",
    sound: true, // Reproducir sonido
  });
}
