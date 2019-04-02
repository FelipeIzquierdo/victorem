<?php namespace Victorem\Libraries\Sms\Elibom;

    class Resource {

        protected $user;
        protected $token;

        function __construct($u=null, $t=null) {
            $this->user = $u;
            $this->token = $t;
        }

        
    }
?>