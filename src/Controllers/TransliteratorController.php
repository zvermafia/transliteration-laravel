<?php

namespace Zvermafia\TransliterationLaravel\Controllers;

use Exception;
use Zvermafia\Transliteration\Interfaces\TransliteratorInterface;
use Zvermafia\TransliterationLaravel\Requests\TransliteratorRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;

class TransliteratorController extends Controller
{
    /** @var TransliteratorInterface */
    private $transliterator;

    /**
     * Create a controller instance.
     *
     * @param TransliteratorInterface $transliterator
     */
    public function __construct(TransliteratorInterface $transliterator)
    {
        $this->transliterator = $transliterator;
    }

    /**
     * Text transliteration request handler.
     *
     * @param TransliteratorRequest $request]
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TransliteratorRequest $request)
    {
        $data = [
            'code' => 200,
            'text' => $request->input('text'),
            'to_cyrillic' => $request->input('to_cyrillic'),
        ];

        try {
            $this->transliterator->setText($request->input('text'));

            if ($request->input('to_cyrillic')) {
                $this->transliterator->toCyrillic();
            } else {
                $this->transliterator->toLatin();
            }

            $data['result'] = $this->transliterator->translit()->getResult();
        } catch (Exception $e) {
            Log::error('Someting went wrong in ' . __CLASS__ . '::' . __METHOD__, array_merge($data, [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]));

            $data = [
                'code' => 503,
                'message' => 'Whoops, something went wrong...',
            ];
        }

        return response()->json(
            $data,
            $data['code']
        );
    }
}
