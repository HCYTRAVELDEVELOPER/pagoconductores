$(document).ready(function() {
    // Mostrar el modal cuando se hace clic en el botón
    $('#btnModal').on('click', function() {
        $('#myModal').css('display', 'block');
    });

    // Cerrar el modal cuando se hace clic en la X
    $('.close').on('click', function() {
        $('#myModal').css('display', 'none');
    });

    // Actualizar el valor masivamente cuando se hace clic en el botón
    $('#btnActualizarMasivamente').on('click', function() {
        var nuevoValor = $('#nuevoValorMasivo').val().trim();

        if (nuevoValor !== '') {
            $('.valor-pesos').each(function() {
                var booking = $(this).data('booking');

                $.ajax({
                    type: 'POST',
                    url: 'actualizar_valor_pesos.php',
                    data: {
                        booking: booking,
                        valor: nuevoValor
                    },
                    success: function(response) {
                        if (response === 'success') {
                            alert('Valor actualizado masivamente correctamente.');
                        } else {
                            alert('Error al actualizar el valor masivamente.');
                        }
                    }
                });
            });

            // Cerrar el modal después de actualizar
            $('#myModal').css('display', 'none');
        } else {
            alert('Ingrese un nuevo valor.');
        }
    });

    // Actualizar el valor cuando se pierde el foco
    $('.valor-pesos').on('blur', function() {
        var booking = $(this).data('booking');
        var nuevoValor = $(this).text().trim();

        $.ajax({
            type: 'POST',
            url: 'actualizar_valor_pesos.php',
            data: {
                booking: booking,
                valor: nuevoValor
            },
            success: function(response) {
                if (response === 'success') {
                    alert('Valor actualizado correctamente.');
                } else {
                    alert('Error al actualizar el valor.');
                }
            }
        });
    });
});

setInterval(updateValue, 2000);