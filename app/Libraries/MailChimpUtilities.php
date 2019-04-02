<?php namespace Victorem\Libraries;

use Victorem\Entities\Location;
use Victorem\Libraries\Campaing;

use Drewm\MailChimp;
use Exception;

class MailChimpUtilities
{
	public static function subscribeMailChimp($data)
    {
        if(!empty($data['email']))
        {
            $mail = new MailChimp(Campaing::getMailchimpApiKey());
        
            $location = Location::find($data['location_id']);
                        
            $dataMailchimp = [
                'id' => Campaing::getMailchimpIdList(),
                'email' => ['email' => $data['email']],
                'double_optin' => false,
                'update_existing' => true,
                'replace_interests' => false,
                'send_welcome' => true,
                'merge_vars' => ['NAME' => $data['name'], 'LOCATION' => $location->name, 'SEX' => $data['sex'] ]
            ];

            if(!empty($data['date_of_birth']))
            {
                list($year, $mounth, $day) = explode('-', $data['date_of_birth']);

                $dataMailchimp['merge_vars']['BIRTHDAY'] = $mounth.'/'.$day;
            }

            try {
                $result = $mail->call('lists/subscribe', $dataMailchimp); 
            } catch (Exception $e) {
                // Save in logs
            }
            
        }       
    }
}

?>