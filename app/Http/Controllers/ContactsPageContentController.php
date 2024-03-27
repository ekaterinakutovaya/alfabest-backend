<?php

namespace App\Http\Controllers;

use App\Models\CompanyPhone;
use App\Models\ContactsPageContent;
use Illuminate\Http\Request;

class ContactsPageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data_phones = [];

        $default_locale = 'ru';
        $locale = app()->getLocale();

        $tmp = ContactsPageContent::all();
        $phones = CompanyPhone::all();

        if ($locale === $default_locale) {
            $data['title'] = $tmp[0]['title'];
            $data['text'] = $tmp[0]['text'];
            $data['address'] = $tmp[0]['address'];
            $data['email'] = $tmp[0]['email'];
            $data['image'] = str_replace('\\', '/', $tmp[0]['image']);
        }
        else {
            $tmp->load('translations');

            $data['title'] = $tmp[0]->translations[2]['value'];
            $data['text'] = $tmp[0]->translations[1]['value'];
            $data['address'] = $tmp[0]->translations[0]['value'];
            $data['email'] = $tmp[0]['email'];
            $data['image'] = str_replace('\\', '/', $tmp[0]['image']);
        }

        foreach ($phones as $key) {
            $data_phones[] = $key['phone_number'];
        }

        $data['company_phones'] = $data_phones;

        return response()->json(['status' => 200, 'data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ContactsPageContent $contactsPageContent
     * @return \Illuminate\Http\Response
     */
    public function show(ContactsPageContent $contactsPageContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ContactsPageContent $contactsPageContent
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactsPageContent $contactsPageContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ContactsPageContent $contactsPageContent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactsPageContent $contactsPageContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ContactsPageContent $contactsPageContent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactsPageContent $contactsPageContent)
    {
        //
    }
}
