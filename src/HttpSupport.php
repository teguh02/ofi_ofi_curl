<?php

namespace ofi\ofi_curl;

use Exception;

use ofi\ofi_curl\Curl\PUTS;
use ofi\ofi_curl\Curl\DELETE;
use ofi\ofi_curl\Curl\GET;
use ofi\ofi_curl\Curl\POST;

class HttpSupport {

    /**
     * Define selected HTTP Methods is null
     */

    protected $selected_http_method = "GET";

    /**
     * Define Http methods Support is turn on
     */
    protected $http = false;

    /**
     * Define null array for http headers value
     * Note : This value sended when this classes execute the CURL
     */

    protected $http_headers_array = [];


    /**
     * Define null data to CURL POSTFIELDS
     */

    protected $body_data = [];

    /**
     * Define null URL detsination
     */

    protected $url_destination = null;

    /**
     * Define HTTP Methods
     * Default is GET HTTP Methods
     */

    public function method(String $method = "GET")
    {
        $this->selected_http_method = $method;
        $this->http = true;
        return $this;
    }

    /**
     * To set selected method is POST
     * Alternative use method
     */

    public function POST($url = null)
    {
        $this->url_destination = $url;
        $this->selected_http_method = "POST";
        $this->http = true;

        return $this;
    }

    /**
     * To set selected method is PUT
     * Alternative use method
     */

    public function PUT($url = null)
    {
        $this->url_destination = $url;
        $this->selected_http_method = "PUT";
        $this->http = true;

        return $this;
    }

    /**
     * To set selected method is DELETE
     * Alternative use method
     */

    public function DELETE($url = null)
    {
        $this->url_destination = $url;
        $this->selected_http_method = "PUT";
        $this->http = true;

        return $this;
    }

    /**
     * To set selected method is GET
     * Alternative use method
     */

    public function GET($url = null)
    {
        $this->url_destination = $url;
        $this->selected_http_method = "GET";
        $this->http = true;

        return $this;
    }

    /**
     * To set selected method is PATCH
     * Alternative use method
     */

    public function PATCH($url = null)
    {
        $this->url_destination = $url;
        $this->selected_http_method = "PATCH";
        $this->http = true;

        return $this;
    }

    /**
     * Set array value for headers CURL
     */

    public function header(Array $array) 
    {
        /**
         * Penulisan array pada penggunan nantinya
         * array(
         *     "key: your-api-key"
         *   ),
         */

        if ($this->http) {
            $this->http_headers_array = $array;
            return $this;
        } else {
            throw new Exception("Please start HTTP class first! ", 1);
        }
    }

    /**
     * URL Destination
     */

    public function url(String $url)
    {
        $this->http = true;
        if (isset($url)) {
            $this->url_destination = $url;
            return $this;
        } else {
            throw new Exception("URL can't blank", 1);
        }
    }

    /**
     * HTTP Body
     */

    public function body(Array $data)
    {
        if (strtoupper($this->selected_http_method) == 'GET') { 
            throw new Exception("You can't use body methods with this HTTP Methods", 500);
            die();
        }

        $this->body_data = $data;
        return $this;
    }

    /**
     * To start execute this CURL
     */

    public function execute()
    {
        if ($this->http) {

        switch (strtoupper($this->selected_http_method)) {
            case 'GET':

                $get = new GET();
                $execute = $get->GET(
                                        $this->url_destination, 
                                        $this->http_headers_array
                                    );
                break;

            case 'POST':

                $body = http_build_query($this->body_data);

                $post = new POST();
                $execute = $post->POST(
                                        $this->url_destination, 
                                        $body,
                                        $this->http_headers_array
                );
                break;

            case 'PUT':
                $body = http_build_query($this->body_data);

                $put = new PUTS();
                $execute = $put->PUTS(
                                        $this->url_destination, 
                                        $body,
                                        $this->http_headers_array,
                                        "PUT"
                );
                break;

            case 'PATCH':
                    $body = http_build_query($this->body_data);
                
                    $put = new PUTS();
                    $execute = $put->PUTS(
                                            $this->url_destination, 
                                            $body,
                                            $this->http_headers_array,
                                            "PATCH"
                    );
                    break;

            case 'DELETE':
        
                $delete = new DELETE();
                $execute = $delete->DELETE(
                                    $this->url_destination, 
                                    $this->http_headers_array,
                                );
                break;
            
            default:
                throw new Exception($this->selected_http_method . ' HTTP Methods not found!', 1);
                break;
        }
            
        } else {
            throw new Exception("Please start HTTP class first! ", 1);
        }
    }

}