<?php
session_start();
require "../conexion.php";

header('Content-Type: application/json');

try {
    // Obtener datos JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    if (!$data || !isset($data['descriptor'])) {
        throw new Exception("Datos faciales no válidos");
    }
    
    $descriptorUsuario = $data['descriptor'];
    
    // Conectar a la base de datos
    $CON = conectar();
    
    // Buscar administrador con rostro registrado
    $stmt = $CON->prepare("SELECT id_admin, rostro FROM administrador WHERE rostro IS NOT NULL");
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $CON->error);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception("No hay administradores con rostro registrado");
    }
    
    $accesoConcedido = false;
    $adminId = null;
    $minDistancia = PHP_FLOAT_MAX;
    
    // Comparar con cada administrador
    while ($admin = $result->fetch_assoc()) {
        $rostroBD = json_decode($admin['rostro'], true);
        
        if (!is_array($rostroBD) || count($rostroBD) !== 128) {
            continue; // Saltar si el formato no es correcto
        }
        
        // Calcular distancia euclidiana
        $distancia = 0;
        for ($i = 0; $i < 128; $i++) {
            if (isset($rostroBD[$i]) && isset($descriptorUsuario[$i])) {
                $distancia += pow($descriptorUsuario[$i] - $rostroBD[$i], 2);
            } else {
                // Si falta algún valor, usar distancia grande
                $distancia += 1;
            }
        }
        $distancia = sqrt($distancia);
        
        // Umbral de similitud (ajustable)
        if ($distancia < 0.6 && $distancia < $minDistancia) {
            $minDistancia = $distancia;
            $adminId = $admin['id_admin'];
            $accesoConcedido = true;
        }
    }
    
    if ($accesoConcedido) {
        $_SESSION['admin'] = $adminId;
        echo json_encode([
            "acceso" => true,
            "admin_id" => $adminId,
            "distancia" => $minDistancia
        ]);
    } else {
        echo json_encode([
            "acceso" => false,
            "error" => "Rostro no reconocido",
            "distancia_minima" => $minDistancia
        ]);
    }
    
} catch (Exception $e) {
    echo json_encode([
        "acceso" => false,
        "error" => $e->getMessage()
    ]);
}
?>