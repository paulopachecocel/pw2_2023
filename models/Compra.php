<?php
require_once "models\Usuario.php";

class Compra
{
    private $id;
    private $dt_hora;

    public function __construct($id, $dt_hora)
    {
        $this->id = $id;
        $this->dt_hora = $dt_hora;
    }

    public function getDataHora()
    {
        return $this->dt_hora;
    }

    public function setDataHora($dt_hora)
    {
        $this->dt_hora = $dt_hora;
        return $this;
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
}
