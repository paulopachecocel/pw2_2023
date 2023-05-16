<?php
require_once "Marca.php";
require_once "Categoria.php";

class Produto
{
    private $id;
    private $nome;
    private $percentual_lucro;
    private $categoria;
    private $marca;

    public function __construct($id, $nome, $percentual_lucro, Categoria $categoria, Marca $marca)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->percentual_lucro = $percentual_lucro;
        $this->categoria = $categoria;
        $this->marca = $marca;
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
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of percentual_lucro
     */
    public function getPercentualLucro()
    {
        return $this->percentual_lucro;
    }

    /**
     * Set the value of percentual_lucro
     *
     * @return  self
     */
    public function setPercentualLucro($percentual_lucro)
    {
        $this->percentual_lucro = $percentual_lucro;

        return $this;
    }

    /**
     * Get the value of categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */
    public function setCategoria(Categoria $categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of marca
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set the value of marca
     *
     * @return  self
     */
    public function setMarca(Marca $marca)
    {
        $this->marca = $marca;

        return $this;
    }
}
