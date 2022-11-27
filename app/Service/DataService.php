<?php
namespace App\Service;

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
                'tb_auto_call_collection_call_log.state_code',
                'tb_auto_call_collection_call_log.messageid',
                'tb_loan_collection_record_new_bak.current_overdue_group',
                'tb_loan_collection_record_new_bak.content',
                'tb_loan_collection_record_new_bak.collection_result',
                'tb_loan_collection_record_new_bak.user_loan_order_id',
                'tb_loan_collection_user_company.location',
                'tb_loan_collection_user_company.address',
                'tb_loan_collection_user_company.contact_name',
                'tb_loan_collection_user_company.contact_phone',
                'tb_loan_collection_user_company.contact_email',
                'tb_loan_collection_user_company.tag',
                'tb_loan_collection_user_company.product_ids',
                'tb_loan_collection_user_company.api_code',
                'tb_loan_collection_group.group_name',
            ],
        ];
        $this->setDefaultValue($value);
    }
}
