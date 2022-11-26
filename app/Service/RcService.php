<?php
namespace App\Service;

class RcService extends CommonService {

    public function __construct()
    {
        $value =  [
            "primary_key"=>[
                "cloudun_audit" => "caid"
            ],
            'defaultEmpty'=>[
                'cloudun_audit.riskLoanLevelEnum',
            ]
        ];
        $this->setDefaultValue($value);
    }

}
