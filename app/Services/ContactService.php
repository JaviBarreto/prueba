<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ContactService
{
    protected $contactModel;

    public function __construct(Contact $contactModel)
    {
        $this->contactModel = $contactModel;
    }

    public function createContact($data)
    {
        $contact = Contact::create([
            'co' => $data['co'],
            'user_id' => $data['user_id']
            // 'email' => $data['email'],
        ]);

        return [
            'contact' => $contact,
        ];
    }

    public function showContact($id)
    {
        return Contact::find($id);
    }

    public function listContacts($perPage = 10, $page = 1)
    {
        return Contact::paginate($perPage, ['*'], 'page', $page);
    }

    public function updateContact($data, $id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return null;
        }

        if (isset($data['co']) && $data['co'] !== '') {
            $contact->co = $data['co'];
        }

        if (isset($data['password']) && $data['password'] !== '') {
            $contact->password = Hash::make($data['password']);
        }

        $contact->save();

        return $contact;
    }

    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return null;
        }

        $contact->delete();

        return $contact;
    }
}
