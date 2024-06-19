<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Auto-sugerencias</title>
    <style>
        .suggestions {
            border: 1px solid #ccc;
            max-height: 150px;
            overflow-y: auto;
            position: absolute;
            background: white;
            z-index: 1000;
        }
        .suggestion-item {
            padding: 10px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <form>
        <label for="nombre_conductor">Buscar:</label>
        <input type="text" id="nombre_conductor" autocomplete="off">
        <div id="suggestions" class="suggestions"></div>
        
        <label for="correo">Campo 1:</label>
        <input type="text" id="correo" readonly>
        
        <label for="telefono">Campo 2:</label>
        <input type="text" id="telefono" readonly>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#nombre_conductor').on('input', function() {
                let query = $(this).val();
                if (query.length > 2) {
                    $.ajax({
                        url: 'search.php',
                        method: 'GET',
                        data: { q: query },
                        success: function(data) {
                            let suggestions = $('#suggestions');
                            suggestions.empty();
                            let results = JSON.parse(data);
                            results.forEach(item => {
                                let suggestionItem = $('<div class="suggestion-item"></div>').text(item.nombre_conductor);
                                suggestionItem.on('click', function() {
                                    $('#nombre_conductor').val(item.nombre_conductor);
                                    $('#correo').val(item.correo);
                                    $('#telefono').val(item.telefono);
                                    suggestions.empty();
                                });
                                suggestions.append(suggestionItem);
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error('Error en la solicitud AJAX:', textStatus, errorThrown);
                        }
                    });
                } else {
                    $('#suggestions').empty();
                }
            });
        });
    </script>
</body>
</html>
