<?php

if ( ! function_exists('base_catalog_url'))
{
    function base_catalog_url($uri = '')
    {
        return "https://moie-core.isidoramodas.com/./uploads/" . $uri;
    }
}

if ( ! function_exists('base_product_catalog_url'))
{
    function base_product_catalog_url($uri = '')
    {
        return "https://moie-core.isidoramodas.com/" . $uri;
    }
}
