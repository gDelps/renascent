<?php
        require_once ('FotoObra.php');

class Obra
{
        private $titulo, $descricao, $autor, $dataObra, $classificacao, $periodo, $pais, $funcionario, $dataCadastro;

        public function getTitulo()
        {
                return $this->titulo;
        }
        public function setTitulo($titulo)
        {
                $this->titulo = $titulo;
                return $this;
        }
        public function getDescricao()
        {
                return $this->descricao;
        }
        public function setDescricao($descricao)
        {
                $this->descricao = $descricao;
                return $this;
        }
        public function getAutor()
        {
                return $this->autor;
        }
        public function setAutor($autor)
        {
                $this->autor = $autor;
                return $this;
        }
        public function getDataObra()
        {
                return $this->dataObra;
        }
        public function setDataObra($dataObra)
        {
                $this->dataObra = $dataObra;
                return $this;
        }
        public function getClassificacao()
        {
                return $this->classificacao;
        }
        public function setClassificacao($classificacao)
        {
                $this->classificacao = $classificacao;
                return $this;
        }
        public function getPeriodo()
        {
                return $this->periodo;
        }
        public function setPeriodo($periodo)
        {
                $this->periodo = $periodo;
                return $this;
        }
        public function getPais()
        {
                return $this->pais;
        }
        public function setPais($pais)
        {
                $this->pais = $pais;
                return $this;
        }
        public function getFuncionario()
        {
                return $this->funcionario;
        }
        public function setFuncionario($funcionario)
        {
                $this->funcionario = $funcionario;
                return $this;
        }
        public function getDataCadastro()
        {
                return $this->dataCadastro;
        }
        public function setDataCadastro($dataCadastro)
        {
                $this->dataCadastro = $dataCadastro;
                return $this;
        }

        function __construct()
        {
                $this->funcionario = 1;
                $this->dataCadastro = date('Y-m-d');
        }
        public function cadastrarObra($obra)
        {
                $con = Conexao::getConexao();
                $insert = $con->prepare("INSERT INTO tbobra(tituloObra,descricaoObra,idAutor,dataObra,
                idClassificacao,paisObra,idFuncionario,dataCadastro)
                 values(?,?,?,?,?,?,?,?)");
                $insert->bindValue(1, $obra->getTitulo());
                $insert->bindValue(2, $obra->getDescricao());
                $insert->bindValue(3, $obra->getAutor());
                $insert->bindValue(4, $obra->getDataObra());
                $insert->bindValue(5, $obra->getClassificacao());
                $insert->bindValue(6, $obra->getPais());
                $insert->bindValue(7, $obra->getFuncionario());
                $insert->bindValue(8, $obra->getDataCadastro());
                $insert->execute();
                return "<script>alert('Obra cadastrada com sucesso');
                        window.location.href = '../views/cadastro-obra.php';</script>";
        }
        public function listarObras()
        {
                $con = Conexao::getConexao();
                $select = "select idObra,tituloObra,descricaoObra,nomeAutor,
                dataObra,descricaoClassificacao,paisObra,tbautor.idAutor,tbclassificacao.idClassificacao from tbobra 
                join tbautor on tbautor.idAutor = tbobra.idAutor 
                join tbclassificacao on tbclassificacao.idClassificacao = tbobra.idClassificacao";
                $res = $con->query($select);
                $lista = $res->fetchAll();
                /*nao devem ter reparado 
                        mas tem um inner join nessa linha
                        pra pega o nome do autor, nome da categoria tlgd
                */
                //pegar todos os dados allllllllll
                return $lista;
        }

        public function deleteObra($idObra){
                try{
                        
                        $foto = new FotoObra();
                        $foto->deletarFoto($idObra);
                        $con = Conexao::getConexao();
                        $query = $con->prepare('delete from tbobra where idObra = ?');
                        $query->bindValue(1, $idObra);
                        $query->execute();
                        return 'success';
                }catch(Exception $e){
                        return $e;
                }
               
        }
       
        public function ListarUltimoID(){
                $con = Conexao::getConexao();
                $select = "select max(idObra) as total from tbobra";
                $res = $con->query($select);
                $res = $res->fetch();
                //ja que eu so quero uma linha
                //isso?
                //tipo? num tendi

                //aqui eu retorno  a ultima obra

                //retorn o fetch
                // o alias
                return $res['total'];
        }

                
        public function getObra($lista,$idObra){

                        foreach ($lista as $row) {
                        if($row['idObra'] == $idObra){
                                return $row;
                        }
                }
        }
        public function editarObra($obra,$idObra){
                $con = Conexao::getConexao();
                $query = $con->prepare('update tbobra set tituloObra = ?,descricaoObra = ?,idAutor = ?,
                        dataObra = ?,idClassificacao = ?,paisObra = ?,dataCadastro = ? where idObra = ?');
                $query->bindValue(1, $obra->getTitulo());
                $query->bindValue(2, $obra->getDescricao());
                $query->bindValue(3, $obra->getAutor());
                $query->bindValue(4, $obra->getDataObra());
                $query->bindValue(5, $obra->getClassificacao());
                $query->bindValue(6, $obra->getPais());
                $query->bindValue(7, $obra->getDataCadastro());
                $query->bindValue(8, $idObra);
                $query->execute();
                return "confirma phpMyAdmin";
        }

}
