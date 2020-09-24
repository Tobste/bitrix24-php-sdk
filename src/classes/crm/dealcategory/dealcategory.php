<?php

namespace Bitrix24\CRM;

use Bitrix24\Bitrix24Entity;

class Dealcategory extends Bitrix24Entity
{
    public function getList($order = array(), $filter = array(), $select = array())
    {
        $fullResult = $this->client->call(
            'crm.dealcategory.list',
            array(
                'order' => $order,
                'filter' => $filter,
                'select' => $select                
            )
        );
        return $fullResult;
    }   


}
