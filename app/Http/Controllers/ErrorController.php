<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\ErrorService;
use App\Services\ProfileService;
use App\ViewModels\ErrorViewModel;
use Illuminate\Http\Request;

/**
 * Class ErrorController
 * @package App\Http\Controllers
 */
class ErrorController extends LayoutController
{
    /**
     * @var ErrorService
     */
    protected $errorService;

    /**
     * ErrorController constructor.
     * @param ProfileService $profileService
     * @param ErrorService $errorService
     */
    public function __construct(ProfileService $profileService, ErrorService $errorService)
    {
        parent::__construct($profileService);

        $this->errorService = $errorService;
    }

    /**
     * show error page
     * @param $error
     * @param string $language
     * @return mixed
     */
    public function index($error, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new ErrorViewModel('error', $language, $error);

        $this->errorService->fill($model);

        return response()->view("errors.$error", compact('model'), $error);
    }
}
