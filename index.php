<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Miniweb de Videojuegos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .descripcion { display: none; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Videojuegos Favoritos</h1>
    <div class="row">
        <?php
        $sql = "SELECT * FROM videojuegos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
        ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <?php if (!empty($row['imagen_url'])): ?>
                    <img src="<?= $row['imagen_url'] ?>" class="card-img-top" alt="<?= $row['titulo'] ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['titulo'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?= $row['plataforma'] ?> (<?= $row['anio'] ?>)</h6>
                        <button class="btn btn-sm btn-primary toggle-desc">Mostrar descripción</button>
                        <p class="descripcion mt-2"><?= $row['descripcion'] ?></p>
                    </div>
                </div>
            </div>
        <?php
            endwhile;
        else:
            echo "<p>No hay videojuegos para mostrar.</p>";
        endif;

        $conn->close();
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function(){
        $(".toggle-desc").click(function(){
            $(this).siblings(".descripcion").slideToggle();
            $(this).text(function(i, text){
                return text === "Mostrar descripción" ? "Ocultar descripción" : "Mostrar descripción";
            });
        });
    });
</script>
</body>
</html>
