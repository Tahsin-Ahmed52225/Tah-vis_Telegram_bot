<?php

namespace App\Http\Controllers;

use App\Service\WebView\TaskManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class WebAppController extends Controller
{
    private object $manager;

    /**
     * Getting all tasks
     */
    public function getTasks(Request $request): JsonResponse
    {
        $this->manager = new TaskManager($request->user_id);
        $response = $this->manager->getTasks();

        return JsonApiResponse(Response::HTTP_OK, 'success', $response);
    }

    /**
     * Update task
     */
    public function updateTask(Request $request): JsonResponse
    {
        $this->manager = new TaskManager($request->user_id);
        $response = $this->manager->updateTask($request->task);
        return JsonApiResponse(Response::HTTP_OK, 'success', $response);
    }
}
