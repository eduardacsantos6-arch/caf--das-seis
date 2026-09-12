<?php

namespace Model;

require_once __DIR__ . "/../Model/Connection.php";

use PDO;
use PDOException;

class Turno
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }


    /**
     * Busca todos os turnos cadastrados
     *
     * @return array
     */
    public function getTurnos(): array
    {
        try {

            $sql = "SELECT id_turno, nome_turno, horario_inicio, horario_fim
                    FROM turnos
                    ORDER BY horario_inicio ASC";

            $stmt = $this->db->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            error_log(
                "Erro ao buscar turnos: " .
                $error->getMessage()
            );

            return [];
        }
    }
}
