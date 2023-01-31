<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registro";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo '
<form action="" method="post">
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre">
    </div>
    <div>
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido">
    </div>
    <div>
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad">
    </div>
    <div>
        <label for="estado_civil">Estado Civil:</label>
        <select id="estado_civil" name="estado_civil">
            <option value="Casado">Casado</option>
            <option value="Soltero">Soltero</option>
            <option value="Viudo">Viudo</option>
        </select>
    </div>
    <div>
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo">
            <option value="Hombre">Hombre</option>
            <option value="Mujer">Mujer</option>
        </select>
    </div>
    <div>
        <label for="salario">Salario:</label>
        <select id="salario" name="salario">
            <option value="Menor a 1000$">Menor a 1000$</option>
            <option value="Entre 1000$ y 2500$">Entre 1000$ y 2500$</option>
            <option value="Mas de 2500$">Más de 2500$</option>
        </select>
    </div>
    <div>
        <input type="submit" name="submit" value="Submit">
    </div>
</form>';

if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $estado_civil = $_POST['estado_civil'];
    $sexo = $_POST['sexo'];
    $salario = $_POST['salario'];

    $data = [
        'nombre' => $nombre,
        'apellido' => $apellido,
        'edad' => $edad,
        'estado_civil' => $estado_civil,
        'sexo' => $sexo,
        'salario' => $salario,
    ];


    // Insert data into database
    $sql = "INSERT INTO usuarios (nombre, apellido, edad, estado_civil, sexo, salario) 
    VALUES ('$nombre', '$apellido', '$edad', '$estado_civil', '$sexo', '$salario')";
    if (mysqli_query($conn, $sql)) {
        echo "Registro ingresado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Select data from database
$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

// Print data in table
echo "<table>";
echo "<tr>";
echo "<th>Nombre</th>";
echo "<th>Apellido</th>";
echo "<th>Edad</th>";
echo "<th>Estado Civil</th>";
echo "<th>Sexo</th>";
echo "<th>Salario</th>";
echo "</tr>";

if (mysqli_num_rows($result) > 0) {
    // Output data for each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["apellido"] . "</td>";
        echo "<td>" . $row["edad"] . "</td>";
        echo "<td>" . $row["estado_civil"] . "</td>";
        echo "<td>" . $row["sexo"] . "</td>";
        echo "<td>" . $row["salario"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}

echo "</table>";

mysqli_close($conn);




?>

