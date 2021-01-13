<?php

namespace App\Http\Controllers;

use App\Card;
use App\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    // Middleware so that a user must be logged in to use any of the functions in this controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Send the user to the cards.create page
    public function create()
    {
        $data = array(
            'statuses' => $statuses = Status::all()
        );
        return view('cards.create')->with($data);
    }

    // Store a newly created card in the database
    public function store(Request $request)
    {
        //Validate from data
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'cardcontent' => 'required',
            'status' => 'required'
        ]);

        //Check if the card already exists, if it doesnt create a new one
        $card = Card::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status_id' => $request->status,
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'content' => $request->cardcontent
            ]
        );
        return redirect(route('dashboard'))->with('message', 'Card has been created!');;
    }

    // Send the user to the cards.edit page
    public function edit(Card $card)
    {
        $data = array(
            'card' => $card,
            'statuses' => $statuses = Status::all()
        );
        return view('cards.edit')->with($data);
    }

    // Update the selected card with the new values
    public function update(Request $request, Card $card)
    {
        //Validate form data
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'cardcontent' => 'required',
            'status' => 'required'
        ]);

        //TODO replace with laravel update function
        $card->status_id = $request->status;
        $card->title = $request->title;
        $card->subtitle = $request->subtitle;
        $card->content = $request->cardcontent;

        $card->save();

        return redirect(route('dashboard'))->with('message', 'Card has been updated!');;
    }

    // Change the status of the selected card to finished
    public function finish(Card $card)
    {
        $card->update(['status_id' => 3]);
        return back()->with('message', 'Card has been moved to finished!');
    }

    // Send the user to the cards.finished page
    public function finished()
    {
        $data = array(
            'cards' => $cards = Card::where('status_id', 3)->get()
        );
        return view('cards.finished')->with($data);
    }

    // Send user to the cards.trash page
    public function trash()
    {
        $data = array(
            'cards' => $cards = Card::onlyTrashed()->get()
        );
        return view('cards.trash')->with($data);
    }

    // Soft delete the selected card
    public function softdelete(Card $card)
    {
        $card->delete();
        return back()->with('message', 'Card has been moved to the trash!');;
    }

    // Restore softdeleted cards
    public function restore($id)
    {
        $card = Card::withTrashed()->find($id);
        $card->restore();
        $card->status_id = 1;
        $card->save();

        return back()->with('message', 'Card has been restored!');;
    }

    // Remove card from database
    public function destroy($id)
    {
        $card = Card::where('id', $id);
        $card->forceDelete();
        return back()->with('message', 'Card has been deleted!');;
    }

    // Swap between waiting and active card status
    public function swapStatus(Card $card)
    {
        switch ($card->status_id) {
            case 1:
                $card->status_id = 2;
                $card->save();
                break;
            case 2:
                $card->status_id = 1;
                $card->save();
                break;
        }
        return back()->with('message', 'Card status has been changed!');;
    }

    //Choose what status a card should have
    public function chooseStatus(Card $card, $status)
    {
        $card->status_id = $status;
        $card->save();
        return back()->with('message', 'Card has been returned to waiting!');;
    }
}
