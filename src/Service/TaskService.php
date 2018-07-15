<?php

namespace App\Service;

use App\Exception\TaskException;
use App\Repository\TaskRepository;
use App\Validation\TaskValidation as vs;

/**
 * Tasks Service.
 */
class TaskService extends BaseService
{
    /**
     * @var TaskRepository
     */
    protected $taskRepository;

    /**
     * @param TaskRepository $taskRepository
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return TaskRepository
     */
    protected function getTaskRepository()
    {
        return $this->taskRepository;
    }

    /**
     * Check if the task exists.
     *
     * @param int $taskId
     * @return object
     */
    protected function checkTask($taskId)
    {
        $task = $this->getTaskRepository()->checkTask($taskId);

        return $task;
    }

    /**
     * Get all tasks.
     *
     * @return array
     */
    public function getTasks()
    {
        $tasks = $this->getTaskRepository()->getTasks();

        return $tasks;
    }

    /**
     * Get one task by id.
     *
     * @param int $taskId
     * @return object
     */
    public function getTask($taskId)
    {
        $task = $this->checkTask($taskId);

        return $task;
    }

    /**
     * Search tasks by name.
     *
     * @param string $tasksName
     * @return array
     */
    public function searchTasks($tasksName)
    {
        $tasks = $this->getTaskRepository()->searchTasks($tasksName);

        return $tasks;
    }

    /**
     * Create a task.
     *
     * @param array $input
     * @return object
     */
    public function createTask($input)
    {
        $data = vs::validateInputOnCreateTask($input);
        $task = $this->getTaskRepository()->createTask($data);

        return $task;
    }

    /**
     * Update a task.
     *
     * @param array $input
     * @param int $taskId
     * @return object
     */
    public function updateTask($input, $taskId)
    {
        $checkTask = $this->checkTask($taskId);
        if (!isset($input['name']) && !isset($input['status'])) {
            throw new TaskException(TaskException::TASK_INFO_REQUIRED, 400);
        }
        $data = [];
        $data['name'] = vs::validateNameOnUpdateTask($input, $checkTask);
        $data['status'] = vs::validateStatusOnUpdateTask($input, $checkTask);
        $task = $this->getTaskRepository()->updateTask($data, $taskId);

        return $task;
    }

    /**
     * Delete a task.
     *
     * @param int $taskId
     * @return string
     */
    public function deleteTask($taskId)
    {
        $this->checkTask($taskId);
        $response = $this->getTaskRepository()->deleteTask($taskId);

        return $response;
    }
}
