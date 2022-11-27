<?php
namespace App\Service;

class OldService extends CommonService {

    public function __construct()
    {
        $value =  [
            'defaultEmpty'=>[
                'sg_appsflyer_push.customer_user_id',
                'sg_appsflyer_push.advertising_id',
                'sg_appsflyer_push.event_name',
                'sg_appsflyer_push.media_source',
                'sg_appsflyer_push.appsflyer_id',
                'sg_appsflyer_push.af_channel',
                'sg_appsflyer_push.partner',
                'sg_appsflyer_push.campaign',
                'sg_appsflyer_push.campaign_type',
                'sg_appsflyer_push.conversion_type',
            ]
        ];
        $this->setDefaultValue($value);
    }

}
