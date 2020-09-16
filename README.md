# ofi_curl
Package for HTTP Support (GET, POST, UPDATE, DELETE) to REST API Server

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

        // GET Code Example
        $get = $http -> method('GET') -> url($url) -> execute();

        // POST Code example

        $post = $http -> method("POST") 
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

        // PUT Code Example

        // $put = $http -> method("PATCH") 
        $put = $http -> method("PUT") 
                -> url($url)
                ->header([
                    'App: OFI PHP Framework',
                    'key: 123'
                ])
                -> body([
                    'App'       => 'New Data : OFI PHP Framework',
                    'Author'    => 'New Data : Teguh Rijanandi'
                ]) -> execute();

        // DELETE Code Method
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
