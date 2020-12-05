# ofi_curl
Package for HTTP Support (GET, POST, UPDATE, DELETE) to REST API Server

# Instalation
use composer <code>composer require ofi/ofi_curl</code> and then load this package like this <code>use ofi\ofi_curl\HttpSupport;</code>

# Usage

<code>
  /**
     * Example when you want to GET or POST data to other API
     * server
     */

    public function Http()
    {
        // In this code sample
        // I'm use https://webhook.site/ as REST API Cathcer

        $url = "https://webhook.site/88f55dae-79f0-40f3-abe4-fba4f83e4e38?app=ofi%20php%20framework";

        $http = new HttpSupport();

        // GET (Default is GET)
        $get = $http -> url($url) -> execute();

        // POST 
        
        // $post = $http -> PUT()
        // $post = $http -> PATCH()
        // $post = $http -> DELETE()
        // $post = $http -> GET()

        $post = $http -> POST()
                -> url($url)
                
                // Header as array
                ->header([
                    'App: OFI PHP Framework',
                    'key: 123'
                ])

                // Body as Array
                -> body([
                    'App'       => 'OFI PHP Framework',
                    'Author'    => 'Teguh Rijanandi'
                ]) -> execute();

        // PUT 

        // $put = $http -> method("PATCH") 
        $put = $http -> PUT($url)
                ->header([
                    'App: OFI PHP Framework',
                    'key: 123'
                ])
                -> body([
                    'App'       => 'New Data : OFI PHP Framework',
                    'Author'    => 'New Data : Teguh Rijanandi'
                ]) -> execute();

        // DELETE 
        $delete = $http -> method("DELETE") 
                -> url($url . '&id=1')
                ->header([
                    'App: OFI PHP Framework',
                    'key: 123'
                ])
                -> body([
                    'App'       => 'New Data : OFI PHP Framework',
                    'Author'    => 'New Data : Teguh Rijanandi'
                ])  -> execute();

        // Print the result
        
        // print_r($get);

        // print_r($post);

        print_r($delete);
    }
</code>

# Features
We have a unique process id to easily the developer to debug they request

![Request ID](https://user-images.githubusercontent.com/43981051/93305310-86abae80-f828-11ea-9215-194fd345a3e3.png)
