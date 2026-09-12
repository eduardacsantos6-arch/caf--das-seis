<?php

namespace Controller;

use Model\Pedido;

class CafeController
{
    private $pedidoModel;

    public function __construct()
    {
        $this->pedidoModel = new Pedido();
    }


    /**
     * Verifica se o funcionário é válido
     */
    private function verifyFuncionario($id_funcionario)
    {
        if ($id_funcionario <= 0) {
            return "O funcionário selecionado é inválido.";
        }

        return null;
    }


    /**
     * Verifica se o valor do pedido é válido
     */
    private function verifyValor($valor_total)
    {
        if ($valor_total < 0) {
            return "O valor do pedido não pode ser negativo.";
        }

        return null;
    }


    /**
     * Valida os dados do pedido
     */
    public function validatePedido($id_funcionario, $valor_total)
    {
        $funcionarioValidation = $this->verifyFuncionario(
            $id_funcionario
        );

        if ($funcionarioValidation !== null) {
            return $funcionarioValidation;
        }


        $valorValidation = $this->verifyValor(
            $valor_total
        );

        if ($valorValidation !== null) {
            return $valorValidation;
        }

        return null;
    }


    /**
     * Salva um novo pedido
     */
    public function savePedido($id_funcionario, $valor_total)
    {
        $validation = $this->validatePedido(
            $id_funcionario,
            $valor_total
        );

        if ($validation !== null) {
            return false;
        }

        $data_pedido = date("Y-m-d H:i:s");
        $status = "Pendente";

        return $this->pedidoModel->createPedido(
            $id_funcionario,
            $data_pedido,
            $status,
            $valor_total
        );
    }


    /**
     * Busca todos os pedidos
     */
    public function getPedidos()
    {
        return $this->pedidoModel->getPedidos();
    }


    /**
     * Busca os pedidos de um funcionário
     */
    public function getPedidoHistory($id_funcionario)
    {
        return $this->pedidoModel->getPedidoHistory(
            $id_funcionario
        );
    }


    /**
     * Exclui um pedido
     */
    public function deletePedido($id_pedido)
    {
        if ($id_pedido <= 0) {
            return false;
        }

        return $this->pedidoModel->deletePedido(
            $id_pedido
        );
    }


    /**
     * Atualiza o status do pedido
     */
    public function updatePedidoStatus(
        $id_pedido,
        $status
    )
    {
        if ($id_pedido <= 0) {
            return false;
        }

        if (empty($status)) {
            return false;
        }

        return $this->pedidoModel->updatePedidoStatus(
            $id_pedido,
            $status
        );
    }
}