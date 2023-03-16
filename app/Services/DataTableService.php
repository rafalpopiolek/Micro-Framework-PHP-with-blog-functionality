<?php

declare(strict_types = 1);

namespace App\Services;

use App\DataObjects\DataTableParametersDto;
use App\Request;

class DataTableService
{
    public function getQueryParameters(Request $request): DataTableParametersDto
    {
        $params = $request->getQueryParameters();

        $orderBy = $params['columns'][$params['order'][0]['column']]['data'];
        $orderDir = $params['order'][0]['dir'];

        return new DataTableParametersDto(
            start: (int)$params['start'],
            length: (int)$params['length'],
            orderBy: $orderBy,
            orderDir: $orderDir,
            search: $params['search']['value'],
            draw: (int)$params['draw'],
        );
    }
}