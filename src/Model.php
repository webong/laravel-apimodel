<?php   
namespace Wisdomanthoni\ApiModel;

use Jenssegers\Model\Model as MOD;

class Model extends MOD {
    
    protected $endpoint;

    function __construct($headers = null, $endpoint)
    {
        $this->endpoint = $endpoint;
    }

    public function save($method)
    {
        return Rest::set($method, $this->endpoint , $this->attributes);
    }

    // public function get()
    // {
    //     return Rest::set('get',$this->endpoint, $this->attributes);
    // }

}