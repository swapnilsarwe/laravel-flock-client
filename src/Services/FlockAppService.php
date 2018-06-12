<?php

namespace SwapnilSarwe\LaravelFlockClient\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SwapnilSarwe\LaravelFlockClient\Repositories\FlockAppRepository;

class FlockAppService
{
    const FLOCK_API_URL = 'https://api.flock.co/v1/chat.sendMessage';

    private $flockAppRepository;

    public function __construct()
    {
        $this->flockAppRepository = new FlockAppRepository();
    }

    public function index()
    {
        return ["status" => "OK"];
    }

    public function configuration(Request $request)
    {
        Log::debug($request);
    }

    public function getUserToken($userId)
    {
        $userDetails = $this->flockAppRepository->getUserDetails($userId);
        return $userDetails->user_token;
    }

    public function listenEvents($requestParams, $callback)
    {
        $eventName = array_get($requestParams, 'name');
        switch ($eventName) {
            case "app.install":
                // on install we get a following details
//                  'userToken' => '',
//                  'token' => '',
//                  'name' => 'app.install',
//                  'userId' => '',

                $this->flockAppRepository->install($requestParams);

                break;
            case "app.uninstall":
                // on uninstall we get a following details
//                'name' => 'app.uninstall',
//                'userId' => '',
                $this->flockAppRepository->uninstall($requestParams);
                break;

            case "client.slashCommand":
                // on slash command we get a following details
//                'chat' => 'g:2c59ecee6e7f4622b8a0e9f5c6a484d0',
//                  'name' => 'client.slashCommand',
//                  'chatName' => 'Swapnil\'s Home',
//                  'text' => 'Swapnil Sarwe',
//                  'userName' => 'Swapnil Sarwe',
//                  'locale' => 'en-us',
//                  'userId' => 'u:gr8vhto97t4otub2',
//                  'command' => 'icndb',
                $callback($eventName, $requestParams);
                break;
        }
    }


    public function sendMessage($to, $from, $message, $onBehalfOf = '')
    {
        $client = new Client();
        $arrQueryParams = [
            'to' => $to,
            'text' => $message,
            'token' => $from
        ];
        if (!empty($onBehalfOf)) {
            $arrQueryParams['onBehalfOf'] = $onBehalfOf;
        }
        $response = $client->get(config('flock-config.appUrl') . config('flock-config.sendMessageMethod') . '?' . http_build_query($arrQueryParams));
        $response = (string)$response->getBody();
        return $response;
    }
}
