<?php

namespace Bitrix24\Bizproc;

use Bitrix24\Bitrix24Entity;

/**
 * Class Robot
 *
 * @package Bitrix24\Placement
 */
class Robot extends Bitrix24Entity
{
    /**
     * @param $code
     * @param $handler
     * @param $userId
     * @param $arName
     * @param $arProps
     * @param $arReturnProps
     * @param $isUseSubscription
     * @param $isUsePlacement
     *
     * @return mixed
     * @throws \Bitrix24\Exceptions\Bitrix24ApiException
     * @throws \Bitrix24\Exceptions\Bitrix24EmptyResponseException
     * @throws \Bitrix24\Exceptions\Bitrix24Exception
     * @throws \Bitrix24\Exceptions\Bitrix24IoException
     * @throws \Bitrix24\Exceptions\Bitrix24MethodNotFoundException
     * @throws \Bitrix24\Exceptions\Bitrix24PaymentRequiredException
     * @throws \Bitrix24\Exceptions\Bitrix24PortalDeletedException
     * @throws \Bitrix24\Exceptions\Bitrix24PortalRenamedException
     * @throws \Bitrix24\Exceptions\Bitrix24SecurityException
     * @throws \Bitrix24\Exceptions\Bitrix24TokenIsExpiredException
     * @throws \Bitrix24\Exceptions\Bitrix24TokenIsInvalidException
     * @throws \Bitrix24\Exceptions\Bitrix24WrongClientException
     */
    //test23422222
    //вавававав
    public function add($code, $handler, $arName, $userId = null, $arProps = null, $arReturnProps = null, $isUsePlacement = null, $isUseSubscription = null)
    {
        $robot_data =  array(
                'CODE'              => $code,
                'HANDLER'           => $handler,
                'NAME'              => $arName,
            );
        if($userId)
            $robot_data['AUTH_USER_ID'] = $userId;
        if($arProps)
            $robot_data['PROPERTIES'] = $arProps;
        if($arReturnProps)
            $robot_data['RETURN_PROPERTIES'] = $arReturnProps;
        if($isUsePlacement)
            $robot_data['USE_PLACEMENT'] = $isUsePlacement === true ? 'Y' : 'N';
        if($isUseSubscription)
            $robot_data['USE_SUBSCRIPTION'] = $isUseSubscription === true ? 'Y' : 'N';  
        $arResult = $this->client->call('bizproc.robot.add', $robot_data);

        return $arResult['result'];
    }

    /**
     * delete activity
     *
     * @param $code string
     *
     * @return array
     * @throws \Bitrix24\Exceptions\Bitrix24WrongClientException
     * @throws \Bitrix24\Exceptions\Bitrix24TokenIsInvalidException
     * @throws \Bitrix24\Exceptions\Bitrix24TokenIsExpiredException
     * @throws \Bitrix24\Exceptions\Bitrix24SecurityException
     * @throws \Bitrix24\Exceptions\Bitrix24PortalDeletedException
     * @throws \Bitrix24\Exceptions\Bitrix24PaymentRequiredException
     * @throws \Bitrix24\Exceptions\Bitrix24MethodNotFoundException
     * @throws \Bitrix24\Exceptions\Bitrix24IoException
     * @throws \Bitrix24\Exceptions\Bitrix24Exception
     * @throws \Bitrix24\Exceptions\Bitrix24EmptyResponseException
     * @throws \Bitrix24\Exceptions\Bitrix24ApiException
     * @see https://dev.1c-bitrix.ru/rest_help/bizproc/bizproc_robot/robotdelete.php
     *
     */
    public function delete($code)
    {
        $arResult = $this->client->call(
            'bizproc.robot.delete',
            array(
                'code' => $code,
            )
        );

        return $arResult['result'];
    }

    /**
     * get list of robots
     *
     * @see https://dev.1c-bitrix.ru/rest_help/bizproc/bizproc_robot/robotlist.php
     *
     * @return mixed
     * @throws \Bitrix24\Exceptions\Bitrix24ApiException
     * @throws \Bitrix24\Exceptions\Bitrix24EmptyResponseException
     * @throws \Bitrix24\Exceptions\Bitrix24Exception
     * @throws \Bitrix24\Exceptions\Bitrix24IoException
     * @throws \Bitrix24\Exceptions\Bitrix24MethodNotFoundException
     * @throws \Bitrix24\Exceptions\Bitrix24PaymentRequiredException
     * @throws \Bitrix24\Exceptions\Bitrix24PortalDeletedException
     * @throws \Bitrix24\Exceptions\Bitrix24PortalRenamedException
     * @throws \Bitrix24\Exceptions\Bitrix24SecurityException
     * @throws \Bitrix24\Exceptions\Bitrix24TokenIsExpiredException
     * @throws \Bitrix24\Exceptions\Bitrix24TokenIsInvalidException
     * @throws \Bitrix24\Exceptions\Bitrix24WrongClientException
     */
    public function getList()
    {
        $arResult = $this->client->call(
            'bizproc.robot.list',
            array()
        );

        return $arResult['result'];
    }
}