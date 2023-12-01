<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteCreateRequest;
use App\Http\Resources\NoteCreateResource;
use App\Http\Resources\ShowNoteResource;
use App\Models\Notes;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{

    /**
     * @param NoteCreateRequest $request
     * @return NoteCreateResource|Response
     */
    public function store(NoteCreateRequest $request):NoteCreateResource|Response
    {
        try {
            DB::beginTransaction();
            $note = new Notes();
            $note->name = $request->name;
            $note->user_id = Auth::user()->id;
            $note->category_id = $request->category_id;
            $note->addMedia($request->file('image'))->toMediaCollection(Notes::IMAGE_COLLECTION_NAME);
            $note->save();
            DB::commit();
            return new NoteCreateResource($note);
        }catch (\Exception $exception){
            DB::rollBack();
             return response($exception);
        }
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function show(): AnonymousResourceCollection
    {
        $notes = Notes::query()->where('user_id',Auth::user()->id)->get();

        if (!empty(Auth::user()->role)) {
            if (Auth::user()->role == User::USER_MANAGER){
                $manager = User::query()->find(Auth::user()->id);
                $user_ids = [];
                foreach ($manager->employee as $value){
                    $user_ids[] = $value->id;
                }
                $notes= Notes::query()->whereIn('user_id',$user_ids)->get();
            }
        }
        return  ShowNoteResource::collection($notes);
    }
}
