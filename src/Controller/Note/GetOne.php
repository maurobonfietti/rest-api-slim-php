<?php

declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetOne extends Base
{
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $note = $this->getServiceFindNote()->getOne((int) $args['id']);
//        var_dump($note->getData2()); exit;
//        var_dump($note, $note->getData(), $note->getData2()); exit;

        return $this->jsonResponse($response, 'success', $note->getData3(), 200);
    }
}
