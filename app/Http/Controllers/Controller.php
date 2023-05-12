<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function uploadOrReturnDefault(string $fileKey, ?string $default, string $folder, $disk = 'public'): ?string
    {
        if (!request()->hasFile($fileKey)) {
            return $default;
        }

        $default && Storage::disk($disk)->delete($default);

        return request()->file($fileKey)->store($folder, [
            'disk' => $disk,
        ]);
    }
}
