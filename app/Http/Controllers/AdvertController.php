<?php

namespace App\Http\Controllers;

use App\Mail\OwnerContact;
use App\Models\Advert;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Inertia\Inertia as Inertia;
use phpDocumentor\Reflection\Types\Object_;

class AdvertController extends Controller
{
    public function index ($city, $category, $subCategory = null) {
        if(!$subCategory) {
            $adverts = Advert::where([
                ['city_slug', $city],
                ['category_slug', $category],
                ['is_masked', '=', '0']])
                ->paginate(4);
                $cat=  Category::where('slug', $category)->get();
            $title = $cat[0]['name'];
        }

        else {
            $adverts = Advert::where([
                ['city_slug', $city],
                ['category_slug', $category],
                ['sub_category_slug', $subCategory],
                ['is_masked', '=', '0']])
                ->paginate(4);
                $sub=  SubCategory::where('slug', $subCategory)->get();
                $title = $sub[0]['name'];
        }


        return Inertia::render('Category', [
            'title' => $title,
            'subCategory' => $subCategory,
            'adverts' => $adverts,
        ]);

    }


    public function show ($city, $category, $subOrAdvert, $advert = null ) {
        if(!$advert) {
            $TheAdvert = Advert::where([
                ['city_slug', $city],
                ['category_slug', $category],
                ['slug', $subOrAdvert],
                ['is_masked', '=', '0']])
                ->with('user')
                ->first();

        }

        else {
            $TheAdvert = Advert::where([
                ['city_slug', $city],
                ['category_slug', $category],
                ['sub_category_slug', $subOrAdvert],
                ['slug', $advert],
                ['is_masked', '=', '0']])
                ->first()->load('user');
        }



        return Inertia::render('Advert', [
            'advert' => $TheAdvert,
        ]);
    }

    public function search ($search){

            $adverts = Advert::orderBy('created_at', 'DESC')
                ->where([
                ['title', 'like', '%' . $search . '%'],
                ['is_masked', '=', '0']])
                ->paginate(20);

        return Inertia::render('Search', [
            'title' => $search,
            'adverts' => $adverts,
        ]);

    }

    public function contact(Request $request) {
        $objet = $request->all();
        $contact= (object) [
            'mail' => $objet['mail'],
            'message' => $objet['message'],
            'OwnerName' => $objet['ad']['user']['name'],
            'OwnerMail' => $objet['ad']['user']['email']
        ];

        Mail::to($contact->OwnerMail)->send(new OwnerContact($contact));

        $data = (object) [
            'msg' => 'yay c\'est tout bon Mail envoyé !',
        ];

        return response()->json($data);

    }

    public function  addToFav() {

    }
 }
