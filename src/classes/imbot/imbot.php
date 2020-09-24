<?php
/**
 * This file is part of the bitrix24-php-sdk package.
 *
 * © Mesilov Maxim <mesilov.maxim@gmail.com> and contributors
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bitrix24\Imbot;
use Bitrix24\Bitrix24Entity;
use Bitrix24\Bitrix24Exception;
use Bitrix24\Exceptions\Bitrix24ApiException;
use Bitrix24\Exceptions\Bitrix24EmptyResponseException;
use Bitrix24\Presets\Im\Fields as B24ImFields;
use Bitrix24\Im\Attach\Attach;

/**
 * Class Chat
 * @package Bitrix24\Im
 */
class Imbot extends Bitrix24Entity
{
    /**
     * create new bot
     *
     * @param $code Строковой идентификатор бота, уникальный в рамках вашего приложения (обяз.)
     * @param string $type Тип бота, B - чат-бот, ответы поступают сразу, H - человек, ответы поступают с задержкой от 2-х до 10 секунд, O - чат-бот для Открытых линий, S - чат-бот с повышенными привилегиями (supervisor)
     * @param $eventHandler Ссылка на обработчик событий поступивших от сервера, см. Обработчики событий ниже (обяз).
     * @param string $openLine Включение режима поддержки Открытых линий, можно не указывать, если TYPE = 'O'
     * @param string $clientId строковый идентификатор чат-бота, используется только в режиме Вебхуков
     * @param $name Имя чат-бота (обязательное одно из полей NAME или LAST_NAME)
     * @param string $lastName Фамилия чат-бота (обязательное одно из полей NAME или LAST_NAME)
     * @param string $color chat color in Bitrix24\Presets\Im\iChatColor for mobile
     * @param string $email E-mail для связи. НЕЛЬЗЯ использовать e-mail, дублирующий e-mail реальных пользователей
     * @param string $birthday День рождения в формате YYYY-mm-dd
     * @param string $workPosition Занимаемая должность, используется как описание чат-бота
     * @param string $personalWWW Ссылка на сайт
     * @param string $gender Пол чат-бота, допустимые значения M -  мужской, F - женский, пусто, если не требуется указывать
     * @param string $photo Аватар чат-бота - base64
     * @return array
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
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
    public function add($code, $type = 'B', $eventHandler, $openLine = 'N', $clientId = '', $name, $lastName = '', $color = 'GREEN', $email = '', $birthday = '2016-03-11', $workPosition = '',$personalWWW = '',$gender = '',$photo ='')
    {
        $arParams = array(
            'CODE' => $code, //
            'TYPE' => $type, //
            'EVENT_HANDLER' => $eventHandler, //
            'OPENLINE' => $openLine, //
            'CLIENT_ID' => $clientId, //
            'PROPERTIES' => Array( // Личные данные чат-бота (обяз.)
                'NAME' => $name, //
                'LAST_NAME' => $lastName, //
                'COLOR' => $color, //
                'EMAIL' => $email, //
                'PERSONAL_BIRTHDAY' => $birthday, //
                'WORK_POSITION' => $workPosition, //
                'PERSONAL_WWW' => $personalWWW, //
                'PERSONAL_GENDER' => $gender, //
                'PERSONAL_PHOTO' => $photo, //
        )
    );
        return $this->client->call('imbot.register', $arParams);
    }

    /**
     * delete bot
     *
     * @param $botId
     * @param string $clientId
     * @return array
     *
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
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
    public function delete($botId, $clientId ='')
    {
        return $this->client->call('imbot.unregister', array(
            'BOT_ID' => $botId, // числовой идентификатор бота
            'CLIENT_ID' => $clientId // строковый идентификатор чат-бота, используется только в режиме Вебхуков
        ));
    }

    /**
     * get bots list
     *
     * @return array
     *
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
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
        return $this->client->call('imbot.bot.list', array(
        ));
    }


    /**
     * @param $boId
     * @param string $clientId
     * @param array $fields
     * @return array
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
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
    public function update($boId, $clientId = '', $fields = array())
    {
        return $this->client->call('imbot.update', array(
            'BOT_ID' => $boId, // Идентификатор чат-бота, которого нужно изменить (обяз.)
            'CLIENT_ID' => $clientId, // строковый идентификатор чат-бота, используется только в режиме Вебхуков
            'FIELDS' => $fields
        ));
    }

    /**
     * @param $botId Идентификатор чат-бота, от которого идет запрос
     * @param $dialogId Идентификатор диалога, это либо USER_ID пользователя, либо chatXX - где XX идентификатор чата, передается в событии ONIMBOTMESSAGEADD и ONIMJOINCHAT
     * @param $message Текст сообщения
     * @param string $attach Вложение, необязательное поле
     * @param string $keyboard Клавиатура, необязательное поле
     * @param string $menu Контекстное меню, необязательное поле
     * @param string $system Отображать сообщения в виде системного сообщения, необязательное поле, по умолчанию 'N'
     * @param string $urlPreview Преобразовывать ссылки в rich-ссылки, необязательное поле, по умолчанию 'Y'
     * @return array
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
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
    public function messageAdd($botId, $dialogId, $message, $attach = '', $keyboard = array(), $menu = '', $system = 'N', $urlPreview = 'Y')
    {
        return $this->client->call('imbot.message.add', Array(

            'BOT_ID' => $botId,
            'DIALOG_ID' => $dialogId,
            'MESSAGE' => $message,
            'ATTACH' => $attach,
            'KEYBOARD' => $keyboard,
            'MENU' => $menu,
            'SYSTEM' => $system,
            'URL_PREVIEW' => $urlPreview

        ));
    }

    /**
     * @param $botId Идентификатор чат-бота владельца команды
     * @param $command Текст команды, которую пользователь будет вводить в чатах
     * @param $titleEn описание команды
     * @param $titleRu описание команды
     * @param $eventCommandAdd Ссылка на обработчик для команд
     * @param false $common Если указан Y, то команда доступна во всех чатах, если N - то доступна только в тех, где присутствует чат-бот
     * @param false $hidden Скрытая команда или нет - по умолчанию N
     * @param false $extranetSupport Доступна ли команда пользователям Экстранет, по умолчанию N
     * @param string $clientId строковый идентификатор чат-бота, используется только в режиме Вебхуков
     * @param string $paramsEn какие данные после команды нужно вводить
     * @param string $paramsRu какие данные после команды нужно вводить
     * @return array
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
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
    public function commandAdd($botId, $command, $titleEn, $titleRu, $eventCommandAdd, $common = false, $hidden = false, $extranetSupport = false, $clientId = '', $paramsEn = 'some text', $paramsRu = 'some text')
    {
        return $this->client->call('imbot.command.register', Array(

                'BOT_ID' => $botId, //
                'COMMAND' => $command, //
                'COMMON' => $common == true ? 'Y' : 'N', //
                'HIDDEN' => $hidden == true ? 'Y' : 'N', //
                'EXTRANET_SUPPORT' => $extranetSupport == true ? 'Y' : 'N', //
                'CLIENT_ID' => $clientId, //
                'LANG' => Array( // Массив переводов, обязательно указывать, как минимум, для RU и EN
                    Array('LANGUAGE_ID' => 'en', 'TITLE' => $titleEn, 'PARAMS' => $paramsEn), // Язык, описание команды, какие данные после команды нужно вводить.
                    Array('LANGUAGE_ID' => 'ru', 'TITLE' => $titleRu, 'PARAMS' => $paramsRu)
                ),
                'EVENT_COMMAND_ADD' => $eventCommandAdd, // Ссылка на обработчик для команд

        ));
    }

    /**
     * @param $commandId Идентификатор команды для удаления
     * @param string $clientId Строковый идентификатор чат-бота, используется только в режиме Вебхуков
     * @return array
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
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
    public function commandDelete($commandId, $clientId = '')
    {
        return $this->client->call('imbot.command.unregister', Array(
            'COMMAND_ID' => $commandId,
            'CLIENT_ID' => $clientId,
            ));
    }

    /**
     * @param $commandId Идентификатор команды
     * @param $eventCommandId Ссылка на обработчик команд
     * @param false $hidden Скрытая команда или нет
     * @param false $extranetSupport Доступна ли команда пользователям Экстранет
     * @param string $clientId Строковый идентификатор чат-бота, используется только в режиме Вебхуков
     * @param array $lang Массив переводов (обязательно указывать, как минимум, для RU и EN)
     * @return array
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
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
    public function commandUpdate($commandId, $eventCommandId, $hidden = false, $extranetSupport = false, $clientId = '', $lang = array())
    {
        return $this->client->call('imbot.command.update', Array(
            'COMMAND_ID' => $commandId,
            'FIELDS' => Array(
                'EVENT_COMMAND_ADD' => $eventCommandId,
                'HIDDEN' => $hidden == true ? 'Y' : 'N',
                'EXTRANET_SUPPORT' => $extranetSupport == true ? 'Y' : 'N',
                'CLIENT_ID' => $clientId,
                'LANG' => $lang
            )
        ));
    }


    /**
     * @param $botId Идентификатор чат-бота, от которого идет запрос
     * @param $messageId Идентификатор сообщения
     * @param null $message Текст сообщения, необязательное поле, если передать пустое значение - сообщение будет удалено
     * @param null $attach Вложение, необязательное поле
     * @param null $keyboard Клавиатура, необязательное поле
     * @param null $menu Контекстное меню, необязательное поле
     * @param null $urlPreview Преобразовывать ссылки в rich-ссылки, необязательное поле
     * @return array
     * @throws Bitrix24ApiException
     * @throws Bitrix24EmptyResponseException
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
    public function messageUpdate($botId, $messageId, $message = null, $attach = null, $keyboard = null, $menu = null, $urlPreview = null)
    {
        $fields = [
            'BOT_ID' => $botId,
            'MESSAGE_ID' => $messageId, //
        ];
        if($message != null) {
            $fields['MESSAGE'] = $message; //
        }
        if($attach != null) {
            $fields['ATTACH'] = $attach; //
        }
        if($keyboard != null) {
            $fields['KEYBOARD'] = $keyboard; //
        }
        if($menu != null) {
            $fields['MENU'] = $menu; //
        }
        if($urlPreview != null) {
            $fields['URL_PREVIEW'] = $urlPreview == true? 'Y' : 'N'; //
        }
        return $this->client->call('imbot.message.update', $fields);
    }
}