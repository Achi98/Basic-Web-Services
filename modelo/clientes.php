<?php

require_once "conexion.php";

class ClienteApi{

	/*=============================================
	INSERTAR CLIENTE
	=============================================*/

	static public function insertarCliente($nombres, $apellidos, $dni, $celular, $correo, $direccion, $paquete_internet, $monto_pago, $fecha_pago){

		$stmt = Conexion::conectar()->prepare("INSERT INTO clientes (nombres, apellidos, dni, celular, correo, direccion, paquete_internet, monto_pago, fecha_pago) 
                                               VALUES ('".$nombres."', '".$apellidos."', $dni, $celular, '".$correo."', '".$direccion."', '".$paquete_internet."', $monto_pago, '".$fecha_pago."')");

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

    /*=============================================
	 MOSTRAR CLIENTES
	=============================================*/

	static public function mostrarClientes(){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM clientes");
        $stmt -> execute();
        $datos = [];
        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datos [] = [
                    'id' => $row['id'],
                    'nombres' => $row['nombres'],
                    'apellidos' => $row['apellidos'],
                    'dni' => $row['dni'],
                    'celular' => $row['celular'],
                    'correo' => $row['correo'],
                    'direccion' => $row['direccion'],
                    'pack_internet' => $row['paquete_internet'],
                    'pago' => $row['monto_pago'],
                    'fecha_pago' => $row['fecha_pago']
                ];
            }
            return $datos;
        }
        return $datos;
		$stmt -> close();
		$stmt = null;
    }

	/*=============================================
	 MOSTRAR CLIENTE
	=============================================*/

	static public function mostrarCliente($id){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE id = $id");
        $stmt -> execute();
        $datos = [];
        if ($stmt->rowCount()) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datos [] = [
                    'id' => $row['id'],
                    'nombres' => $row['nombres'],
                    'apellidos' => $row['apellidos'],
                    'dni' => $row['dni'],
                    'celular' => $row['celular'],
                    'correo' => $row['correo'],
                    'direccion' => $row['direccion'],
                    'pack_internet' => $row['paquete_internet'],
                    'pago' => $row['monto_pago'],
                    'fecha_pago' => $row['fecha_pago']
                ];
            }
            return $datos;
        }
        return $datos;
		$stmt -> close();
		$stmt = null;
    }

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function actualizarCliente($id, $nombres, $apellidos, $dni, $celular, $correo, $direccion, $paquete_internet,        $monto_pago,$fecha_pago){

        $stmt = Conexion::conectar()->prepare("UPDATE  clientes SET nombres = '$nombres', apellidos = '$apellidos', dni = '$dni', celular = '$celular', correo = '$correo', direccion = '$direccion', paquete_internet = '$paquete_internet', monto_pago = '$monto_pago', fecha_pago = '$fecha_pago' WHERE id=$id");

        if($stmt->execute()){

            return "ok";

        }else{

            return "error";

        }

        $stmt->close();
        $stmt = null;

	}

	/*=============================================
    ELIMINAR CLIENTE
	=============================================*/

	static public function eliminarCliente($id){

		$stmt = Conexion::conectar()->prepare("DELETE FROM clientes WHERE id = $id");

		if($stmt -> execute()){

			return "ok";
        
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}

