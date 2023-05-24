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

function login($username, $password, $db) {
    $query = "SELECT * FROM usuarios WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if ($user) {
    
        if ($password === $user['password']) {
            return true;
        }
    }

    return false;
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (login($username, $password, $db)) {
        $message = "Datos Correctos.";
    } else {
        $message = "Datos Incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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

	a {
            padding: 10px;
            box-sizing: border-box;
            background-color: #FF0000;
            color: #FFF;	
        }
    </style>
</head>


<body>

    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="">
            <label for="username">Usuario:</label>
            <input type="text" name="username" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" required><br><br>
            
            <input type="submit" name="submit" value="ingreso"> <br><br>
	    <a href="registro.php">Registrarse</a>
        </form>
        
        <?php if (isset($message)) { ?>
            <p><?php echo $message; ?></p>
        <?php } ?>

    </div>
</body>
</html>