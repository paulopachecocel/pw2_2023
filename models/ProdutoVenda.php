                                     <?php
require_once "models\Produto.php";
require_once "models\Venda.php";

class ProdutoVenda
{
    private $id;

    private $usuario;

    private $produto;

    private $venda;
    
    private $qtde;
    
    private $valor_unitario;

    private $valor_total;

    public function __construct($id, Usuario $usuario, Produto $produto, Venda $venda, $qtde, $valor_unitario, $valor_total)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->produto = $produto;
        $this->venda = $venda;
        $this->qtde = $qtde;
        $this->valor_unitario = $valor_unitario;
        $this->valor_total = $valor_total;
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
     * Get the value of usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set the value of usuario
     *
     * @return  self
     */
    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;

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
     * Get the value of venda
     */
    public function getVenda()
    {
        return $this->venda;
    }

    /**
     * Set the value of venda
     *
     * @return  self
     */
    public function setVenda(Venda $venda)
    {
        $this->venda = $venda;

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
     * Get the value of valor_unitario
     */
    public function getValorUnitario()
    {
        return $this->valor_unitario;
    }

    /**
     * Set the value of valor_unitario
     *
     * @return  self
     */
    public function setValorUnitario($valor_unitario)
    {
        $this->valor_unitario = $valor_unitario;

        return $this;
    }

    

    /**
     * Get the value of valor_total
     */
    public function getValorTotal()
    {
        return $this->valor_total;
    }

    /**
     * Set the value of valor_total
     *
     * @return  self
     */
    public function setValorTotal($valor_total)
    {
        $this->valor_total = $valor_total;

        return $this;
    }
}
