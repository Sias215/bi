<?php
namespace App\Service;

use Com\Alibaba\Otter\Canal\Protocol\EntryType;
use Com\Alibaba\Otter\Canal\Protocol\EventType;
use Com\Alibaba\Otter\Canal\Protocol\RowChange;
use Illuminate\Support\Facades\DB;

class DataService extends CommonService {
    public function __construct()
    {
        $value =  [
            'defaultEmpty'=>[
                'sg_user_channel_flow_buried.channel_name',
                'sg_user_channel_flow_buried.uuid',
                'tb_admin_user.access_token',
                'tb_loan_collection.ext_number',
                'tb_loan_collection.tag',
                'tb_loan_collection.device',
                'tb_loan_collection.opeId',
                'tb_loan_collection.password',
                'tb_loan_collection.group_call',
                'tb_loan_collection.call_account',
                'tb_loan_collection.call_password',
                'tb_loan_collection.sti_call_account',
                'tb_loan_collection.sti_call_password',
                'tb_loan_collection_order.batch',
                'tb_loan_collection_order.dispatch_tag',
                'tb_loan_collection_order.collection_result',
                'tb_loan_collection_order.tag',
                'tb_loan_collection_order.real_name',
                'tb_loan_collection_order.mobile',
                'tb_loan_collection_order.app_source',
                'tb_loan_collection_order_dispatch_log.user_loan_order_id',
                'tb_loan_collection_order_dispatch_log.current_collection_real_name',
                'tb_loan_collection_order_dispatch_log.remark',
                'order_user_info.real_name',
                'order_user_info.mobile_phone',
                'order_user_info.user_whatsapp',
                'order_user_info.email',
                'order_user_info.family_addr',
                'order_user_info.company_name',
                'order_user_info.work_phone',
                'order_user_info.company_addr',
            ],
        ];
        $this->setDefaultValue($value);
    }
}
