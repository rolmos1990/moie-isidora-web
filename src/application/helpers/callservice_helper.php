<?php

class callservicehelper {
    private $caller;

    const URL_PRODUCT = "https://moie2.lucymodas.com/product";
    const URL_CATEGORY = "https://moie2.lucymodas.com/category";
    const URL_LOGIN = "https://moie2.lucymodas.com/user/login";

    function __constructor(){
    }

    //function getToken(){
    //    return "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MSwidXNlcm5hbWUiOiJhZG1pbiIsImlhdCI6MTY1OTIwNzMyMiwiZXhwIjozMzE4NDE3MDI5fQ.N-JzEqASc5yDiYpNYdlCdqH39t6b6YGnn_EDFmhG8-k";
    //}

    function callPost($url, $fields, $public = false) {
        //$fields_string = http_build_query($fields);
        $payload = json_encode( $fields );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json'
        ));
        if(!$public) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: ' . self::getToken(),
                'Content-Type:application/json'
            ));
        }
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    function callGet($url, $queryParams) {
        $fields_string = http_build_query($queryParams);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "?" . $fields_string);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: ' . self::getToken(),
        ));
        $data = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);
        return $data;
    }

    function getToken(){
        
        $fields = [
            "username" => "admin",
            "password" => "Moie123."
        ];
        $result = $this->callPost(self::URL_LOGIN, $fields, true);
        $result = json_decode($result, true);

        return $result["token"];

    }

    function getProducts($limit, $page, $conditional = null){

        if(!$conditional) {
            $queryParams = array("limit" => $limit, "offset" => $page, "conditional" => "published::1", "order" => "orden", "orderType" => "asc");
        } else {
            $queryParams = array("limit" => $limit, "offset" => $page, "conditional" => $conditional, "order" => "orden", "orderType" => "asc");
        }

        $result = $this->callGet(self::URL_PRODUCT, $queryParams);

        $resultData = json_decode($result, true);

        return $resultData;
    }

    function getProduct($reference){

        $queryParams = array("limit" => 1, "conditional" => "reference::" . $reference);
        $result = $this->callGet(self::URL_PRODUCT, $queryParams);
        $resultData = json_decode($result, true);

        $product = $resultData["data"];

        return $product[0];
    }

    function getCategories($limit, $page, $conditional = null){
        if(!$conditional) {
            $queryParams = array("limit" => $limit, "offset" => $page, "conditional" => "status::1");
        } else {
            $queryParams = array("limit" => $limit, "offset" => $page, "conditional" => $conditional);
        }
        $result = $this->callGet(self::URL_CATEGORY, $queryParams);
        $resultData = json_decode($result, true);
        return $resultData;
    }

    function getCategory($category){

        $queryParams = array("limit" => 1, "conditional" => "id::" . $category);
        $result = $this->callGet(self::URL_CATEGORY, $queryParams);
        $resultData = json_decode($result, true);

        $product = $resultData["data"];

        return $product[0];
    }

}
