<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimeMasterController extends Controller
{
    public function skill(Request $request)
    {
        $group = collect([
            'http://aligenie.vaiwan.com/lotties/13950-perchick-at-tgsticker-sticker-30.json',
            'http://aligenie.vaiwan.com/lotties/46472-lurking-cat.json',
            'http://aligenie.vaiwan.com/lotties/82726-cute-cat.json',
            'http://aligenie.vaiwan.com/lotties/77317-cute-cat.json',
        ]);
        $group1 = collect([
            'http://aligenie.vaiwan.com/lotties/36413-cat-loading.json',
            'http://aligenie.vaiwan.com/lotties/78069-dog-tail-wag.json',
            'http://aligenie.vaiwan.com/lotties/101336-toucan.json',
            'http://aligenie.vaiwan.com/lotties/lf20_scrpsgm1.json',
            'http://aligenie.vaiwan.com/lotties/52886-cow-eating-grass.json',
        ]);
        if ($request->input('intentName') == 'Next') {
            return $this->response(
                '好的，马上更换！',
                [
                    'lottie' => true,
                    'path' => $group->random(),
                    'path1' => $group1->random(),
                    'repeatCount' => -1,
                    'autoPlay' => true,
                ]
            );
        } elseif ($request->input('intentName') == 'Quit') {
            return $this->response(
                '好的，再见！下次要玩，记得对我说打开动画小天才',
                [],
                false,
                true
            );
        } elseif ($request->input('intentName') == 'Default') {
            return $this->response(
                '欢迎来到动画小天才，你可以用动画片段来组装一个大型动画，现在对我说：换一个。',
                [
                    'lottie' => true,
                    'path' => $group->random(),
                    'path1' => $group1->random(),
                    'repeatCount' => -1,
                    'autoPlay' => true,
                ]
            );
        }
    }

    public function response(string $text, array $data = [], bool $openMic = false, bool $end = false): array
    {
        if (!$data) {
            $data = ['key' => 'value'];
        }
        $view = [
            'commandDomain' => 'AliGenie.Screen',
            'commandName' => 'Render',
            'payload' => [
                'pageType' => 'TPL.RenderDocument',
                'data' => [
                    'pageTitle' => '动画小天才',
                    'dataSource' => $data,
                    'config' => [
                        'header' => [
                            'enabled' => false,
                            'height' => '100rpx',
                            'foregroundColor' => '#FF7383A2',
                            'backgroundColor' => '#FFFFFFFF',
                        ],
                        'body' => [
                            'backgroundColor' => 'linear-gradient(180deg, #5BD7CD 0%, #3DBAD3 100%)',
                        ],
                    ],
                ],
            ],
        ];
        $speak = [
            'commandDomain' => 'AliGenie.Speaker',
            'commandName' => 'Speak',
            'payload' => [
                'type' => 'text',
                'text' => $text,
                'expectSpeech' => $openMic,
            ]
        ];
        if ($openMic) {
            $speak['payload']['wakeupType'] = 'continuity';
        }
        $control = [
            'commandDomain' => 'AliGenie.System.Control',
            'commandName' => 'Suspend'
        ];
        if ($end) {
            $view = $control = [
                'commandDomain' => 'AliGenie.System.Control',
                'commandName'   => 'Exit',
            ];
        }
        return [
            'returnCode' => 0,
            'returnErrorSolution' => '',
            'returnMessage' => 'success',
            'returnValue' => [
                'resultType' => $end ? 'RESULT' : 'ASK_INF',
                'askedInfos' => [],
                'gwCommands' => [
                    $view,
                    $speak,
                    $control
                ]
            ],
            'sessionEntries' => []
        ];
    }
}
