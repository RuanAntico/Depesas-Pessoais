<?php
require_once __DIR__ . '/../model/GerenciarModel.php';

class GerenciarController {
    private $model;

    public function __construct() {
        $this->model = new GerenciarModel();
    }

    public function index() {
        if (!isset($_SESSION['codUsuario'])) {
            header('Location: login.php');
            exit;
        }

        $codUsuario = $_SESSION['codUsuario'];
        $despesas = $this->model->listarDespesas($codUsuario);
        include __DIR__ . '/../view/gerenciarView.php';
    }

    public function adicionar() {
        if (!isset($_SESSION['codUsuario'])) {
            header('Location: login.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codUsuario = $_SESSION['codUsuario'];
            $dados = [
                'nome' => $_POST['nome'],
                'descricao' => $_POST['descricao'],
                'valor' => $_POST['valor'],
                'data_pag' => $_POST['data_pag']
            ];

            if ($this->model->adicionarDespesa($codUsuario, $dados)) {
                $_SESSION['mensagem'] = 'Despesa adicionada com sucesso!';
                $_SESSION['tipo_mensagem'] = 'sucesso';
            } else {
                $_SESSION['mensagem'] = 'Erro ao adicionar despesa!';
                $_SESSION['tipo_mensagem'] = 'erro';
            }

            header('Location: gerenciar.php');
            exit;
        }

        include __DIR__ . '/../view/adicionarDespesaView.php';
    }

    public function editar($codDespesa) {
        if (!isset($_SESSION['codUsuario'])) {
            header('Location: login.php');
            exit;
        }

        $codUsuario = $_SESSION['codUsuario'];
        $despesa = $this->model->obterDespesa($codDespesa, $codUsuario);

        if (!$despesa) {
            $_SESSION['mensagem'] = 'Despesa não encontrada!';
            $_SESSION['tipo_mensagem'] = 'erro';
            header('Location: gerenciar.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'nome' => $_POST['nome'],
                'descricao' => $_POST['descricao'],
                'valor' => $_POST['valor'],
                'data_pag' => $_POST['data_pag']
            ];

            if ($this->model->atualizarDespesa($codDespesa, $codUsuario, $dados)) {
                $_SESSION['mensagem'] = 'Despesa atualizada com sucesso!';
                $_SESSION['tipo_mensagem'] = 'sucesso';
            } else {
                $_SESSION['mensagem'] = 'Erro ao atualizar despesa!';
                $_SESSION['tipo_mensagem'] = 'erro';
            }

            header('Location: gerenciar.php');
            exit;
        }

        include __DIR__ . '/../view/editarDespesaView.php';
    }

    public function excluir($codDespesa) {
        if (!isset($_SESSION['codUsuario'])) {
            header('Location: login.php');
            exit;
        }

        $codUsuario = $_SESSION['codUsuario'];

        if ($this->model->excluirDespesa($codDespesa, $codUsuario)) {
            $_SESSION['mensagem'] = 'Despesa excluída com sucesso!';
            $_SESSION['tipo_mensagem'] = 'sucesso';
        } else {
            $_SESSION['mensagem'] = 'Erro ao excluir despesa!';
            $_SESSION['tipo_mensagem'] = 'erro';
        }

        header('Location: gerenciar.php');
        exit;
    }
}
?>