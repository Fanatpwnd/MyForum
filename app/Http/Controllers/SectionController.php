<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Thread;

class SectionController extends Controller
{
    public function addSection(Request $request) {
        Section::create([   'name'      => $request['section_name'], 
                            'desc'      => $request['desc'],
                            'is_hide'   => false]);
        return $this->getSections();
    }

    public function deleteSection(Request $request)
    {
        Section::where('id', '=', $request['id'])->update(['is_hide' => true]);
        return $this->getSections();
    }

    public static function getSections()
    {
        $sections = Section::where('is_hide', false)->get();
        return view('main', ['content' => $sections, 'type_page' => 'sections']);
    }

    public function editSection(Request $request)
    {
        $section = Section::find($request['id'])->update(['name' => $request['name'], 'desc' => $request['desc']]);
        return $this->getSections(); 
    }
}
