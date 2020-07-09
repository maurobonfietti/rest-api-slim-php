<?php

declare(strict_types=1);

namespace App\Controller\Note;

use Slim\Http\Request;
use Slim\Http\Response;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $page = $request->getQueryParam('page', null);
        $perPage = $request->getQueryParam('perPage', self::DEFAULT_PER_PAGE_PAGINATION);

        if ($page) {
            $notes = $this->getServiceFindNote()->getNotesByPage((int) $page, (int) $perPage);
        } else {
            $notes = $this->getServiceFindNote()->getAll();
        }

        return $this->jsonResponse($response, 'success', $notes, 200);
    }
}
