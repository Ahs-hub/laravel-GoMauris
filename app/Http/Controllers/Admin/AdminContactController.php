<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;

use Illuminate\Support\Carbon;

class AdminContactController extends Controller
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

    //fetching by 20
    public function fetchPaginated(Request $request)
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(20);
        return response()->json($contacts);
    }

    //delete 
    public function destroy($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], 404);
        }

        $contact->delete();

        return response()->json(['message' => 'Contact deleted successfully']);
    }

    //Change status 
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

    //Update comment
    public function updateComment(Request $request, $id)
    {
        $request->validate([
            'admin_comment' => 'nullable|string',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->admin_comment = $request->input('admin_comment');
        $contact->save();

        return response()->json(['success' => true]);
    }

}
