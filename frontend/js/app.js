// Carrusel básico automático
document.addEventListener('DOMContentLoaded', () => {
const carrusel = document.querySelector('.carrusel');
const imagenes = carrusel.querySelectorAll('img');
let index = 0;

function mostrarImagenActual() {
imagenes.forEach((img, idx) => {
img.style.display = (idx === index) ? 'block' : 'none';
});
}

function siguienteImagen() {
index = (index + 1) % imagenes.length;
mostrarImagenActual();
}

mostrarImagenActual();
setInterval(siguienteImagen, 4000); // Cambia de imagen cada 4 segundos
});
