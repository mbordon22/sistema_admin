$(document).ready(function () {
  $(function () {
    $("#registro").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "language": {
        paginate: {
          next: "Sigiente",
          previous: "Anterior",
          last: "Último",
          firts: "Primero"
        },
        info: "Mostrando _START_ de _END_ resultados de _TOTAL_",
        empyTable: "No hay Registros",
        infoEmpy: "0 Registros",
        search: "Buscar:"
      }
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  /* $("#btn-form-admin").attr("disabled", true);

  $("#GastoPagado").on("input", function () {
    var GastoPagado = $("#GastoPagado").val();
    if ($(this).val() < $("#GastoTotal").val()) {
      $("#resultado_password").text("Correcto");
      $("#resultado_password").css({
        "color": "green"
      });
      $("#btn-form-admin").attr("disabled", false);
    } else {
      $("#resultado_password").text("No son iguales!");
      $("#resultado_password").css({
        "color": "red"
      });
    }
  });*/

  $("#btnCerrar-sesion").on("click", function (e) {
    e.preventDefault();

    Swal.fire({
      title: '¿Quieres cerrar sesión?',
      text: "Deberas iniciar sesión nuevamente para ingresar",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, seguro',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          'Hasta luego!!',
          "",
          'success'
        )

        setTimeout(function () {
          window.location.href = "login.php?cerrar_sesion=true";
        }, 1000);
      }

    });
  });

  $("#icono").iconpicker();
  $("#icono").on("click", function () {
    $(".iconpicker-popover").toggleClass("op");
  });

});