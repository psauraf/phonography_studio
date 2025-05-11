document.addEventListener('DOMContentLoaded', () => {
    cargarReservas();
  
    // Confirmación al enviar el formulario de reserva
    const form = document.getElementById('form-reserva');
    form.addEventListener('submit', (e) => {
      const confirmar = confirm("¿Estás seguro que quieres realizar esta reserva?");
      if (!confirmar) {
        e.preventDefault();
      } else {
        mostrarSnackbar("Reserva realizada");
      }
    });
  });
  
  // Función para cargar reservas
  function cargarReservas() {
    fetch('backend/reservas.php')
      .then(response => response.json())
      .then(data => {
        const contenedor = document.getElementById('lista-reservas');
        contenedor.innerHTML = '';
  
        if (data.length === 0) {
          contenedor.innerHTML = '<p class="text-center text-muted">No tienes reservas registradas.</p>';
          return;
        }
  
        data.forEach(reserva => {
          const div = document.createElement('div');
          div.classList.add('reserva-item');
  
          div.innerHTML = `
            <p><strong>Fecha:</strong> ${reserva.fecha}</p>
            <p><strong>Servicio:</strong> ${reserva.servicio}</p>
            <span class="eliminar" onclick="eliminarReserva(${reserva.id})">×</span>
          `;
  
          contenedor.appendChild(div);
        });
      })
      .catch(error => {
        console.error('Error al cargar reservas:', error);
      });
  }
  
  // Eliminar reserva con confirmación
  function eliminarReserva(id) {
    if (confirm("¿Estás seguro que deseas eliminar esta reserva?")) {
      fetch(`backend/eliminar-reserva.php?id=${id}`, { method: 'GET' })
        .then(res => {
          if (res.ok) {
            mostrarSnackbar("Reserva eliminada");
            cargarReservas();
          }
        })
        .catch(err => console.error("Error eliminando:", err));
    }
  }
  
  // Snackbar visual
  function mostrarSnackbar(mensaje) {
    const snackbar = document.getElementById("snackbar");
    snackbar.textContent = mensaje;
    snackbar.classList.add("show");
    setTimeout(() => snackbar.classList.remove("show"), 3000);
  }
  