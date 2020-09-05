<?php
namespace Bitrix24\Task;
use Bitrix24\Bitrix24Entity;
use Bitrix24\Bitrix24Exception;

/**
 * Class Item
 * @package Bitrix24\Task
 */
class Task extends Bitrix24Entity
{
    
    /**
	 * add new task
	 * @link http://dev.1c-bitrix.ru/rest_help/tasks/task/item/add.php
	 * @link http://dev.1c-bitrix.ru/rest_help/tasks/fields.php
	 * @param array $taskData
	 * @return array new task ID
	 * @throws Bitrix24Exception
	 */
	public function add($taskData)
	{
		$result = $this->client->call('tasks.task.add', ['fields' => $taskData]);
		return $result;
    }
    
    public function get($taskId, $selectData)
	{
        $result = $this->client->call('tasks.task.get',
    ['taskId'=> $taskId,
    'select' => $selectData]
    );
		return $result;
    }
    
    public function update($taskId, $fields)
	{
        $result = $this->client->call('tasks.task.update', ['taskId'=> $taskId, 'fields' => $fields]);
		return $result;
    }


    public function getList($order = array(), $filter = array(), $select = array(), $start = 0)
    {
        $fullResult = $this->client->call(
            'tasks.task.list',
            array(
                'order' => $order,
                'filter' => $filter,
                'select' => $select,
                'start' => $start
            )
        );
        return $fullResult;
    }
}