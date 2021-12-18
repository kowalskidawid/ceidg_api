<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyResource;
use App\Models\ApiLog;
use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function company(string $nip, Request $request)
    {
        $company = Company::where('nip', $nip)->first();
        ApiLog::create([
            'ip' => $request->ip(),
            'nip' => $nip,
            'http_code' => !is_null($company) ? 200 : 404
        ]);
        if (empty($company)) {
            abort(404);
        }

        return CompanyResource::make($company);
    }
}
