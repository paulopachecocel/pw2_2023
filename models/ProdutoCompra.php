<?php
require_once "models\Produto.php";
require_once "models\Compra.php";

class ProdutoCompra
{
    private $id;

    private $preco_custo;

    private $qtde;

    private $produto;

    private $compra;

    private $usuario;

    public function __construct($id, $preco_custo, $qtde, Produto $produto, Compra $compra, Usuario $usuario)
    {
        $this->id = $id;
        $this->preco_custo = $preco_custo;
        $this->qtde = $qtde;
        $this->produto = $produto;
        $this->compra = $compra;
        $this->usuario = $usuario;
    }



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of produto
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set the value of produto
     *
     * @return  self
     */
    public function setProduto(Produto $produto)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get the value of compra
     */
    public function getCompra()
    {
        return $this->compra;
    }

    /**
     * Set the value of compra
     *
     * @return  self
     */
    public function setCompra(Compra $compra)
    {
        $this->compra = $compra;

        return $this;
    }

    /**
     * Get the value of preco_custo
     */
    public function getPrecoCusto()
    {
        return $this->preco_custo;
    }

    /**
     * Set the value of preco_custo
     *
     * @return  self
     */
    public function setPrecoCusto($preco_custo)
    {
        $this->preco_custo = $preco_custo;

        return $this;
    }

    /**
     * Get the value of qtde
     */
    public function getQtde()
    {
        return $this->qtde;
    }

    /**
     * Set the value of qtde
     *
     * @return  self
     */
    public function setQtde($qtde)
    {
        $this->qtde = $qtde;

        return $this;
    }

    /**
     * Get the value of usuario
     */
    public function getUsuairo()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */
    public function setUsuairo(Usuario $usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
}
