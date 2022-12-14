<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $contacts = Contact::where('user_id', auth()->id())->paginate($request->input('per_page', 30));
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), $th->getCode());
        }

        return $this->success($contacts, 'Contacts retrieved successfully!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attr = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'country_code' => 'required|string|max:4',
            'phone_number' => 'required|numeric',
            'profile_picture' => 'nullable|string'
        ]);

        try {
            $contact = Contact::create([
                'user_id' => auth()->id(),
                'first_name' => $attr['first_name'],
                'last_name' => $attr['last_name'],
                'country_code' => $attr['country_code'],
                'phone_number' => $attr['phone_number'],
                'profile_picture' => $attr['profile_picture'],
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), $th->getCode());
        }

        return $this->success([], 'Contact created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
