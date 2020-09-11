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
     * @param $code
     * @param string $type
     * @param $eventHandler
     * @param string $openLine
     * @param string $clientId
     * @param $name
     * @param string $lastName
     * @param string $color chat color in Bitrix24\Presets\Im\iChatColor for mobile
     * @param string $email
     * @param string $birthday
     * @param string $workPosition
     * @param string $personalWWW
     * @param string $gender
     * @param string $photo
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
            'CODE' => $code, // Строковой идентификатор бота, уникальный в рамках вашего приложения (обяз.)
            'TYPE' => $type, // Тип бота, B - чат-бот, ответы поступают сразу, H - человек, ответы поступают с задержкой от 2-х до 10 секунд, O - чат-бот для Открытых линий, S - чат-бот с повышенными привилегиями (supervisor)
            'EVENT_HANDLER' => $eventHandler, // Ссылка на обработчик событий поступивших от сервера, см. Обработчики событий ниже (обяз).
            'OPENLINE' => $openLine, // Включение режима поддержки Открытых линий, можно не указывать, если TYPE = 'O'
            'CLIENT_ID' => $clientId, // строковый идентификатор чат-бота, используется только в режиме Вебхуков
            'PROPERTIES' => Array( // Личные данные чат-бота (обяз.)
                'NAME' => $name, // Имя чат-бота (обязательное одно из полей NAME или LAST_NAME)
                'LAST_NAME' => $lastName, // Фамилия чат-бота (обязательное одно из полей NAME или LAST_NAME)
                'COLOR' => $color, // Цвет чат-бота для мобильного приложения RED, GREEN, MINT, LIGHT_BLUE, DARK_BLUE, PURPLE, AQUA, PINK, LIME, BROWN,  AZURE, KHAKI, SAND, MARENGO, GRAY, GRAPHITE
                'EMAIL' => $email, // E-mail для связи. НЕЛЬЗЯ использовать e-mail, дублирующий e-mail реальных пользователей
                'PERSONAL_BIRTHDAY' => $birthday, // День рождения в формате YYYY-mm-dd
                'WORK_POSITION' => $workPosition, // Занимаемая должность, используется как описание чат-бота
                'PERSONAL_WWW' => $personalWWW, // Ссылка на сайт
                'PERSONAL_GENDER' => $gender, // Пол чат-бота, допустимые значения M -  мужской, F - женский, пусто, если не требуется указывать
                'PERSONAL_PHOTO' => $photo, // Аватар чат-бота - base64
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
     * update bot
     *
     * @param $boId
     * @param string $clientId
     * @param array $fields
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
    public function update($boId,$clientId = '',$fields = array())
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
    public function messageAdd($botId, $dialogId, $message, $attach = '', $keyboard = '', $menu = '', $system = 'N', $urlPreview = 'Y')
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
}