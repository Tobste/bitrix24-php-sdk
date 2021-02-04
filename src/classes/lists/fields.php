<?php

namespace Bitrix24\Lists;

use Bitrix24\Bitrix24Entity;
use Bitrix24\Bitrix24Exception;

class Fields extends Bitrix24Entity {

    public function getList($iblockTypeId, $iblockId, $socnetGroupId = null, $fieldId = []) {
        if($iblockTypeId == ListsType::LISTS_SOCNET && !$socnetGroupId){
            return false;
        }
        $params = [];
        $params['IBLOCK_TYPE_ID'] = $iblockTypeId;
        $params['IBLOCK_ID'] = $iblockId;
        
        if($iblockTypeId == ListsType::LISTS_SOCNET){
            $params['SOCNET_GROUP_ID'] = $socnetGroupId;
        }
        
        if($fieldId){
            $params['FIELD_ID'] = $fieldId;
        }
        
        $fullResult = $this->client->call(
                'lists.field.get',
                $params
        );
        return $fullResult;
    }


}
