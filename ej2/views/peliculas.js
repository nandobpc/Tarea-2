let url = "../controllers/peliculas.controllers.php?op=";

function init() {
  $("#peliculaForm").on("submit", function (e) {
    insertarActualizar(e);
  });
}

$().ready(() => {
  listarPeliculas();
});

var listarPeliculas = () => {
  var html = "";
  $.get(url + "todos", (peliculas) => {
    peliculas = JSON.parse(peliculas);
    $.each(peliculas, (index, pelicula) => {
      html += `<tr>
        <td>${index + 1}</td>
        <td>${pelicula.titulo}</td>
        <td>${pelicula.director}</td>
        <td>${pelicula.anio_estreno}</td>
        <td>${pelicula.genero}</td>
        <td>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#peliculaModal" onclick="verUno(${pelicula.id})">Editar</button>
            <button class="btn btn-danger" onclick="eliminar(${pelicula.id})">Eliminar</button>
            <button class="btn btn-success" onclick="verDetalles(${pelicula.id})">Ver</button>
        </td>
    </tr>`;
    });
    $("#listaPeliculas").html(html);
  });
};

var insertarActualizar = (e) => {
  e.preventDefault();
  var formData = new FormData($("#peliculaForm")[0]);
  var id = $("#id").val();
  var accion = "";

  if (id == "" || id == undefined) {
    accion = url + "insertar";
  } else {
    accion = url + "actualizar";
  }

  $.ajax({
    url: accion,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: (datos) => {
      datos = JSON.parse(datos);
      if (datos) {
        $("#peliculaForm")[0].reset();
        listarPeliculas();
        $("#peliculaModal").modal("hide");
        Swal.fire("Peliculas", "Se guardó con éxito", "success");
      } else {
        $("#peliculaForm")[0].reset();
        listarPeliculas();
        $("#peliculaModal").modal("hide");
        Swal.fire("Peliculas", "Error al guardar", "error");
      }
    },
  });
};

var verUno = (id) => {
  $.post(url + "uno", { id: id }, (pelicula) => {
    pelicula = JSON.parse(pelicula);
    $("#id").val(pelicula.id);
    $("#titulo").val(pelicula.titulo);
    $("#director").val(pelicula.director);
    $("#anio_estreno").val(pelicula.anio_estreno);
    $("#genero").val(pelicula.genero);
    $("#sinopsis").val(pelicula.sinopsis);
  });
};

var verDetalles = (id) => {
  $.post(url + "uno", { id: id }, (pelicula) => {
    pelicula = JSON.parse(pelicula);
    $("#labelDetalles").html(`<strong>Título:</strong> ${pelicula.titulo}<br><strong>Director:</strong> ${pelicula.director}<br><strong>Año de Estreno:</strong> ${pelicula.anio_estreno}<br><strong>Género:</strong> ${pelicula.genero}<br><strong>Sinopsis:</strong> ${pelicula.sinopsis}`);
    $("#detallesModal").modal("show"); 
  });
};

var eliminar = (id) => {
  Swal.fire({
    title: "Peliculas",
    text: "Está seguro de eliminar la película",
    icon: "error",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(url + "eliminar", { id: id }, (datos) => {
        datos = JSON.parse(datos);
        if (datos) {
          listarPeliculas();
          $("#peliculaModal").modal("hide");
          Swal.fire("Peliculas", "Se eliminó con éxito", "success");
        } else {
          $("#peliculaModal").modal("hide");
          Swal.fire("Peliculas", "Error al eliminar", "error");
        }
      });
    }
  });
};

init();
