<?php
namespace Bitrix24\CRM\Company;
use Bitrix24\Bitrix24Entity;
use Bitrix24\Bitrix24Exception;

/**
 * Class Company
 * @package Bitrix24\CRM
 */
class Contact extends Bitrix24Entity
{
    /**
     * Get list of company items.
     * @link http://www.bitrixsoft.com/rest_help/crm/company/crm_company_list.php
     * @param array $order - order of task items
     * @param array $filter - filter array
     * @param array $select - array of collumns to select
     * @param integer $start - entity number to start from (usually returned in 'next' field of previous 'crm.company.list' API call)
     * @return array
     * @throws Bitrix24Exception
     */
    public function getList($companyId, $sort = null, $roleId = null, $isPrimary = null)
    {
        $fullResult = $this->client->call(
            'crm.company.contact.items.get',
            array(
                'id' => $companyId,
                'SORT'=> $sort,
                'ROLE_ID'=> $roleId,
                'IS_PRIMARY'=> $isPrimary
            )
        );
        return $fullResult;
    }
}