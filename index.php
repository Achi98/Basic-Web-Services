<?php
require_once "modelo/clientes.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id'])) {
            echo json_encode(ClienteApi::mostrarCliente($_GET['id']));
        }else {
            echo json_encode(ClienteApi::mostrarClientes());
        }

        break;
        
        case 'POST':
                $datos = json_decode(file_get_contents('php://input'));
                if ($datos != null) {
                    if (ClienteApi::insertarCliente($datos->nombres, $datos->apellidos, $datos->dni, $datos->celular, $datos->correo, $datos->direccion, $datos->pack_internet, $datos->pago, $datos->fecha_pago)) {
                        http_response_code(200);
                    }else {
                        http_response_code(400);
                    }
                }else {
                    http_response_code(405);
                }
            break;

        case 'PUT':
            $datos = json_decode(file_get_contents('php://input'));
            if ($datos != null) {
                if (ClienteApi::actualizarCliente($datos->id, $datos->nombres, $datos->apellidos, $datos->dni, $datos->celular, $datos->correo, $datos->direccion, $datos->pack_internet, $datos->pago, $datos->fecha_pago)) {
                    http_response_code(200);
                    echo "funciona";
                }else {
                    http_response_code(400);
                    echo "no funciona";
                }
            }else {
                http_response_code(405);
            }
            break;
        case 'DELETE':
                if (isset($_GET['id'])) {
                    if (ClienteApi::eliminarCliente($_GET['id'])) {
                        http_response_code(200);
                        echo 'Funiona!, Cliente eliminado';
                    }else {
                        http_response_code(400);
                        echo 'No funciona!, Cliente no encontrado';
                    }
                }else {
                    http_response_code(405);
                }
            break;
    default:
        # code...
        break;
}