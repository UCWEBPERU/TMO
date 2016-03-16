<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('cargarDatosCategoriasPrincipales')) {

    function cargarDatosCategoriasPrincipales() {
        $CI =& get_instance();
        return $CI->M_Store->getPrimaryCategories($CI->uri->segment(2));
    }

}

// ------------------------------------------------------------------------

if ( ! function_exists('cargarDatosCategoriasPrincipales')) {

    function cargarDatosSubCategorias($id_categoria_superior) {
        $CI =& get_instance();
        $dataSubCategorias = $CI->M_Store->getSubCategories(
            array(
                "id_empresa"            => $CI->uri->segment(2),
                "id_categoria_superior" => $id_categoria_superior
            )
        );
        return $dataSubCategorias;
    }

}

// ------------------------------------------------------------------------

if ( ! function_exists('cargarDatosCategoriasPrincipales')) {

    function cargarDatosProductos($id_categoria) {
        $CI =& get_instance();
        $dataProductos = $CI->M_Store->getProducts(
            array(
                "id_empresa"    => $CI->uri->segment(2),
                "id_tienda"     => $CI->uri->segment(4),
                "id_categoria"  => $id_categoria
            )
        );
        return $dataProductos;
    }

}

// ------------------------------------------------------------------------

if ( ! function_exists('cargarDatosCategoriasPrincipales')) {

    function cargarGaleriaPorProducto($producto) {
        $CI =& get_instance();
        $geleriaProducto = $CI->M_Store->getGalleryByProduct(
            array(
                "id_producto"    => $producto->id_producto
            )
        );

        if (sizeof($geleriaProducto) > 0) {
            $producto->galeria_producto = $geleriaProducto;
        } else {
            $galeria = new stdClass();
            $galeria->url_archivo = base_url().PATH_RESOURCE_ADMIN."img/image_not_found.png";
            $producto->galeria_producto = array($galeria);
        }
        return $producto;
    }

}

// ------------------------------------------------------------------------

if ( ! function_exists('cargarDatosCategoriasPrincipales')) {

    function validarListaCategorias($listaCategorias) {
        $CI =& get_instance();
        $listaCategorias = explode(".", $listaCategorias);
        foreach ($listaCategorias as $categoria) {
            $dataCategoria = $CI->M_Store->getCategorygetCategory(
                array(
                    "id_categoria"  => $categoria,
                    "id_empresa"    => $CI->uri->segment(2)
                )
            );
        }
    }

}

// ------------------------------------------------------------------------

if ( ! function_exists('cargarDatosCategoriasPrincipales')) {

    function generarNavegacionSubCategorias($url_store, $listaIdCategorias) {
        $CI =& get_instance();
        $lista = array();
        $urlIdCategorias = "";

        for ($c = 0; $c < sizeof($listaIdCategorias); $c++) {
            $dataCategoria = $CI->M_Store->getCategory(
                array(
                    "id_categoria"  => $listaIdCategorias[$c],
                    "id_empresa"    => $CI->uri->segment(2)
                )
            );

            if ($c == 0) {
                $urlIdCategorias .= $listaIdCategorias[$c];
            } else {
                $urlIdCategorias .= ".".$listaIdCategorias[$c];
            }

            if (sizeof($dataCategoria) > 0) {
                $dataCategoria[0]->url_id_categorias = $url_store."/categories/".$urlIdCategorias;
                array_push($lista, $dataCategoria[0]);
            } else {
                $lista = array();
                break;
            }

        }
        return $lista;
    }

}

// ------------------------------------------------------------------------

if ( ! function_exists('cargarDatosCategoriasPrincipales')) {

    function generarUrlSubCategoria($url_store, $id_categoria, $id_categoria_superior) {
        $CI =& get_instance();
        $idCategoria         = $id_categoria;
        $idCategoriaSuperior = $id_categoria_superior;
        $urlIdCategorias     = intval($idCategoria);

        while ( $idCategoriaSuperior != 0 ) {
            $dataCategoria = $CI->M_Store->getCategory(
                array(
                    "id_categoria"          => $idCategoriaSuperior,
                    "id_empresa"            => $CI->uri->segment(2)
                )
            );

            if ( sizeof($dataCategoria) > 0 ) {
                $idCategoria            = intval($dataCategoria[0]->id_categoria);
                $idCategoriaSuperior    = intval($dataCategoria[0]->id_categoria_superior);
                $urlIdCategorias        = $idCategoria.".".$urlIdCategorias;
            } else {
                $urlIdCategorias = substr($urlIdCategorias, 1);
                $idCategoriaSuperior = 0;
            }
        }

        $urlIdCategorias = $url_store."/categories/".$urlIdCategorias;

        return $urlIdCategorias;
    }

}