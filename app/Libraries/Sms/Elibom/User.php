<?php namespace Victorem\Libraries\Sms\Elibom;

    class UserElibom extends Resource{

        public function getAll() {
            $client = new Client($this->user, $this->token);
            $response = $client->get('users');

            return $response;
        }

        public function get($id) {
            $client = new Client($this->user, $this->token);
            $response = $client->get('users/' . $id);

            return $response;
        }
    }
?>