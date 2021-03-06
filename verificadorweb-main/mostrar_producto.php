<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script type="text/javascript">
        setTimeout(function() {
            window.location.href = "index.html";
        }, 5000);
    </script>

    <script type="text/javascript">

      if (window.addEventListener) {
      var codigo = "";
      window.addEventListener("keydown", function (e) {
          codigo += String.fromCharCode(e.keyCode);
          if (e.keyCode == 13) {
              window.location = "mostrar_producto.php?codigo=" + codigo;
              codigo = "";
          }
      }, true);
}
</script>

<style>
        body {
            background-image: url('https://wallpapercave.com/wp/wp2557268.png');
            font-family: 'Manrope', sans-serif;
            background-size: cover;
        }
        div {
           height: 270px;
           width: 270px;
           margin:auto;
           margin-top:20px;
    
        }

        img {
            object-fit:contain;
            width: 100%;
            height: 100%;
            
        }

        h1 {
            font-size: 30px;
            margin: 60px;
        }
        b{
          font-size:34px;
          font-family: 'Lemonada';
        }
        p{
          margin-bottom:0px;
          margin-top:0px;
        }
        vacio{}
		
    </style>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />

</head>

<link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@300&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
<body>
  <h1 style='text-align: center'>
    <?php
        include ("./inc/settings.php");
                
        try {
            $conn = new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM productos WHERE producto_codigo = ".$_GET["codigo"]);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
            $renglones=$stmt->rowCount();
            
            if ($renglones==1) {
              echo "<b class='animate__animated animate__fadeIn'>Producto: ".$result["producto_nombre"]."</b><br>";
              echo "<p class='animate__animated animate__fadeIn'>Precio: ".$result["producto_precio"]."</p><br>";
              echo "<p class='animate__animated animate__fadeIn'>Stock: ".$result["producto_cantidad"]."</p>";
              
              echo "<br><div><img class='animate__animated animate__fadeInUpBig' src='".$result["producto_imagen"]."' width='150px' height='150px'></div>";
            }
            else{
              echo "No se encuentra el producto <br>";
              echo "<div> <img class='animate__animated animate__shakeX' src='img/error.png' alt='' width='50%' height='50%'> </div>";
            }
            
            
          } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
          }
    ?>
  </h1>
</body>
</html>