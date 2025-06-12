<?php

namespace App\Http\Controllers\API;

use App\Enums\CardStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Http\Requests\ValidateCardRequest;
use App\Http\Resources\CardResource;
use App\Services\CardService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CardController extends Controller
{
    /**
     * @var CardService
     */
    protected CardService $cardService;

    /**
     * DummyModel Constructor
     *
     * @param CardService $cardService
     *
     */
    public function __construct(CardService $cardService)
    {
        $this->cardService = $cardService;
    }

    public function index(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CardResource::collection($this->cardService->getMeCards($request->user()->id));
    }

    public function store(CardRequest $request): CardResource|\Illuminate\Http\JsonResponse
    {
        try {
            return new CardResource($this->cardService->save($request->validated()));
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function validate(ValidateCardRequest $request)
    {
        $code = $request->input("code");
        if ($code != "1234") {
            return response()->json(['message' => 'Invalid code'], Response::HTTP_BAD_REQUEST);
        }
        $this->cardService->updateMeCard(["status" => CardStatusEnum::ACTIVE], $request->input("card_id"), $request->user()->id);
        return response()->json(['message' => 'Validated successfully'], Response::HTTP_OK);
    }

    public function show(Request $request, int $id): CardResource
    {
        return CardResource::make($this->cardService->getMeCard($id, $request->user()->id));
    }

    public function update(CardRequest $request, int $id)
    {
        return response(status: Response::HTTP_METHOD_NOT_ALLOWED);
    }

    public function destroy(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        try {
            $this->cardService->deleteByIdMeCard($id, $request->user()->id);
            return response()->json(['message' => 'Deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $exception) {
            report($exception);
            return response()->json(['error' => 'There is an error.'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
