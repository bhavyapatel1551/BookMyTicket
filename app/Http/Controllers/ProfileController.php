<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show Profile Page of the user with his/her persnal info
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()

    {
        $user = User::find(Auth::id());

        return view('userProfile.UserProfile', compact('user'));
    }

    /**
     * Update the Pernnal info of the user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        /**
         * Validate the input field from the form
         */
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'location' => 'max:255',
            'phone' => 'numeric',
            'aboutyou' => 'max:255',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
        ]);

        $user = User::find(Auth::id());

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'phone' => $request->phone,
            'about' => $request->aboutyou,
        ]);
        return back()->with("success", "Profile updated successfully!");
    }

    /**
     * Show Upload Profile Photo page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showprofilephotoform()
    {

        return view('userProfile.UpdateProfilePhoto');
    }


    /**
     * Update Profile Photo
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function updateprofilephoto(Request $request)
    {


        /**
         * Validate the image type and size of the image
         */
        $data = $request->validate([
            'photo' => 'mimes:jpeg,png,jpg,gif|max:10240',
        ]);
        /**
         * If the image is not null then store the image in the public folder and get the path of the image
         */
        if ($request->hasFile('photo')) {
            $imagepath = $request->file('photo')->getClientOriginalName();
            $request->file('photo')->storeAs('pfp', $imagepath, 'public');
            $imagepath = 'pfp/' . $imagepath;
        } else {
            $imagepath = null;
        }

        $user = User::find(Auth::id());
        $user->update([
            'pfp' => $imagepath
        ]);
        return redirect('/user/profile')->with("success", "Photo uploaded successfully!");
    }
}
