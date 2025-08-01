<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;
use App\Models\CarBooking;
use App\Models\CustomTourRequest;
use App\Models\TaxiBooking;
use App\Models\TourBooking;

use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function contactStats()
    {
        $totalContacts = Contact::count();
        $readContacts = Contact::where('status', 'seen')->count();
        $unreadContacts = Contact::where('status', 'unseen')->count();
        $todayContacts = Contact::whereDate('created_at', Carbon::today())->count();

        return response()->json([
            'total' => $totalContacts,
            'read' => $readContacts,
            'unread' => $unreadContacts,
            'today' => $todayContacts,
        ]);
    }

    public function fetchPaginated(Request $request)
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        return response()->json($contacts);
    }

    //delete contact
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully']);
    }

    //Change status contact 
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:seen,unseen,reply'
        ]);
    
        $contact = Contact::find($id);
    
        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }
    
        $contact->status = $request->status;
        $contact->save();
    
        return response()->json(['message' => 'Contact status updated']);
    }

    

}
