<?php
class Articulos_m extends Model
{
    public function __construct()
    {
        // Llamada al constructor del padre para conectar a la BBDD
        parent::__construct();
    }

    public function articulos_carousel()
    {
        $cadSQL = "select articulos.*,articulos_imagenes.camino FROM articulos inner join articulos_imagenes on articulos.referencia = articulos_imagenes.referencia WHERE articulos.oferta=1 and articulos_imagenes.principal=1";
        // llamamos al metodo consultar que lo que hace es preparar la sentencia
        $this->consultar($cadSQL);
        // En esta consulta no enlazamos parametros porque no tiene
        // con lo que llamamos a el metodo resultado
        return $this->resultado();
    }
    public function leerCatalogo()
    {
        $cadSQL = "select articulos.*,familias.descripcion as descfam,articulos_imagenes.camino FROM articulos inner JOIN articulos_imagenes on articulos.referencia=articulos_imagenes.referencia INNER JOIN familias on articulos.familia = familias.id WHERE articulos_imagenes.principal=1 and (articulos.precioVenta between :desp and :hasp) and (descripCorta like :busq or descripLarga like :busq)";
        if (!empty($_POST['fam'])) {
            $cadSQL .= " and articulos.familia = :fam";
        }
        $this->consultar($cadSQL);
        // Enlazar parametros
        if (!empty($_POST['fam'])) $this->enlazar(":fam", $_POST['fam']);
        $this->enlazar(":desp", $_POST['desp']);
        $this->enlazar(":hasp", $_POST['hasp']);
        $this->enlazar(":busq", "%$_POST[busq]%");

        return $this->resultado();
    }
}
