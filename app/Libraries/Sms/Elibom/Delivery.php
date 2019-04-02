<?php namespace Victorem\Libraries\Sms\Elibom;

    class Delivery extends Resource{

        public function get($id) {
            $client = new Client($this->user, $this->token);
            $response = $client->get('messages/' . $id);

            return $response;
        }
    }
?>