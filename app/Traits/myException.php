<?php

namespace App\Traits;

use Exception;
use Illuminate\Console\View\Components\Error;
use Illuminate\Support\Facades\Log;
use PHPUnit\Event\Code\Throwable;

trait myException
{
    public function exception( $exception, $errorDescription = 'Xəta yarandı!')
    {
        alert()->error('Xəta!', $errorDescription);

        if ($exception->getCode() == 400)
        {
            return redirect()
                ->back()
                ->withErrors(['slug' => $exception->getMessage()])
                ->withInput();
        }

        Log::error($exception->getMessage(), [$exception->getTraceAsString()]);
        return redirect()->back();
    }

}
