<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Thread;

class SectionController extends Controller
{
    public function addSection(Request $request) {
        $section = $request->all()['section_name'];
        Section::insert(['section_name' => $section, 
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")]);
        
        return $this->getSections();
    }

    public function deleteSection(Request $request)
    {
        $section_id = $request->all()['id'];
        Section::where('section_id', '=', $section_id)->delete();
        
        return $this->getSections();
    }

    public static function getSections()
    {
        $sections = Section::all();
        foreach ($sections as &$item) {
            $item['count'] = Thread::where('section_id', $item['section_id'])->where('is_delete', false)->count();
        }
        unset($item); 
        //http://php.net/manual/ru/control-structures.foreach.php
        return view('main', ['content' => $sections, 'type_page' => 'sections']);
    }
}
