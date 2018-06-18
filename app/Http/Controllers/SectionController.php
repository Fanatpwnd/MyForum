<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;

class SectionController extends Controller
{
    public function addSection(Request $request) {
        $section = $request->all()['section_name'];
        Section::insert(['section_name' => $section, 
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")]);
        return view('testing', ['content' => 'Topic created']); //TODO: change view
    }

    public function deleteSection(Request $request)
    {
        $section_id = $request->all()['id'];
        Section::where('section_id', '=', $section_id)->delete();
        return view('testing', ['content' => 'Section deleted']); //TODO: change view
    }

    public static function getSections()
    {
        $content = Section::all();
        return view('testmainpage', ['content' => $content]);
    }
}
