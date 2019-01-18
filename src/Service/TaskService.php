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
        return $this->getTaskRepository()->checkTask($taskId);
    }

    /**
     * Get all tasks.
     *
     * @return array
     */
    public function getTasks()
    {
        return $this->getTaskRepository()->getTasks();
    }

    /**
     * Get one task by id.
     *
     * @param int $taskId
     * @return object
     */
    public function getTask($taskId)
    {
        return $this->checkTask($taskId);
    }

    /**
     * Search tasks by name.
     *
     * @param string $tasksName
     * @return array
     */
    public function searchTasks($tasksName)
    {
        return $this->getTaskRepository()->searchTasks($tasksName);
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

        return $this->getTaskRepository()->createTask($data);
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

        return $this->getTaskRepository()->updateTask($data, $taskId);
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

        return $this->getTaskRepository()->deleteTask($taskId);
    }
}
