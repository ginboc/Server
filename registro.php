<?php
$host = "localhost";
$dbName = "server";
$username = "giussep";
$password = "Andrea.12";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "INSERT INTO usuarios (username, password) VALUES (:username, :password)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    
    try {
        $stmt->execute();
       $message = "Datos ingresados correctamente en la base de datos.";
    } catch(PDOException $e) {
        $message = "Error al ingresar los datos: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Página de Registro</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container h2 {
            text-align: center;
        }
        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        .container input[type="submit"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #45a049;
        }
        .container input[type="button"] {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            background-color: #FF0000;
            color: #FFF;
            border: none;
            cursor: pointer;
        }
        .container input[type="submit"]:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <form method="POST">
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <input type="submit" value="Registrarse">
  	 <?php if (isset($message)) { ?>
            <p><?php echo $message; ?></p>
        <?php } ?>


        </form>
    </div>
</body>
</html>