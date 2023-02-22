<?php
class Articulos_c extends Controller
{
    private $articulos_m; // Modelo articulos

    public function __construct()
    {
        // Instanciamos el modelo articulos en la propiedad
        $this->articulos_m = $this->load_model("Articulos_m");
    }

    public function index()
    {
    }

    public function genCatalogo()
    {
        // Este metodo es llamado por AJAX
        // Recibimos una serie de parametros para filtrar la busqueda
        $datos = $this->articulos_m->leerCatalogo($_POST);
        echo json_encode($datos);
    }
    public function catalogo()
    {
        // Cargar modelo familias para filtro
        $familias_m = $this->load_model("Familias_m");
        $datos['familias'] = $familias_m->leerTodas();

        // Visualizar la pagina de catalogo
        $contenido = "catalogo_v";
        $this->load_view("plantilla/cabecera");
        $this->load_view("plantilla/menu");
        $this->load_view($contenido, $datos);
        $this->load_view("plantilla/pie");
    }
}
