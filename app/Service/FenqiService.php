<?php
namespace App\Service;

use Com\Alibaba\Otter\Canal\Protocol\EntryType;
use Com\Alibaba\Otter\Canal\Protocol\EventType;
use Com\Alibaba\Otter\Canal\Protocol\RowChange;
use Illuminate\Support\Facades\DB;

class FenqiService extends CommonService {
    public function __construct()
    {
        $value =  [
            'defaultEmpty'=>[
                'order_user_info.real_name',
                'order_user_info.mobile_phone',
                'order_user_info.user_whatsapp',
                'order_user_info.email',
                'order_user_info.family_addr',
                'order_user_info.company_name',
                'order_user_info.work_phone',
                'order_user_info.company_addr',
                'user_info.real_name',
                'user_info.mobile',
                'user_info.id_number',
                'user_info.email',
                'user_info.birthday',
                'user_info.corporate_flow',
                'user_info.live_longitude',
                'user_info.live_latitude',
                'user_info.gps_location',
                'user_info.reg_ip',
                'user_info.reg_source',
                'user_info.household_address',
                'user_info.avg_income',
                'user_info.max_repay',
                'user_info.social_security',
                'user_info.credit_card_id',
                'user_info.first_name',
                'user_info.first_mobile',
                'user_info.two_name',
                'user_info.two_mobile',
                'user_info.company_name',
                'user_info.company_phone',
                'user_info.company_address',
                'user_info.user_whatsapp',
                'user_info.user_backup_phone',
                'user_info.app_from',
            ],
        ];
        $this->setDefaultValue($value);
    }
}
