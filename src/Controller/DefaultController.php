<?php

/**
 * Default Controller.
 */
class DefaultController extends Base
{
    /**
     * Get Help.
     *
     * @return array
     */
    public function getHelp($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $message = ['help' => [
            'tasks' => 'Ver Tareas: /tasks',
            'users' => 'Ver Usuarios: /users',
            'version' => 'Ver Version: /version',
        ]];

        return $this->jsonResponse('success', $message, 200);
    }

    /**
     * Get Api Version.
     *
     * @return array
     */
    public function getVersion($request, $response, $args)
    {
        $this->setParams($request, $response, $args);
        $version = ['api_version' => self::API_VERSION];

        return $this->jsonResponse('success', $version, 200);
    }
}
