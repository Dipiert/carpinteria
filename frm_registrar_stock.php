<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gestión de Stock de maderas">
    <meta name="keywords" content="Madera, Stock">
    <meta name="author" content="Damián Rotta">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="">
    <script src="./script/validar_frm.js"></script>
    <title>Registrar nuevo Stock</title>
</head>
<body>
<form action="registrar_stock.php" method="post" onsubmit="return sonCamposValidos()">
    <div class="campo">
        <label>Ancho (cm):</label>
        <input type="text" id="in_ancho" name="ancho" size="1" maxlength="5">
    </div>
    <div class="campo">
        <label>Alto (cm):</label>
        <input type="text" id="in_alto" name="alto" size="1" maxlength="5">
    </div>
    <div class="campo">

        <label>Tipo:</label>
        <select>
            <option>Otro...</option>
        </select>    
    </div>
    <div class="campo">
        <input type="submit" value="Registrar" id="btn_registrar">
    </div>
</form>
</body>
</html>

<style>
    
#btn_registrar {
    width:160px;
}

.campo {  
  display: inline-block;
  width: 200px;
  text-align: right;
  margin-left: 40%;
  margin-right: 50%;
}

#in_ancho {
    width: 40px;
}

#in_alto {
    width: 40px;
}

</style>