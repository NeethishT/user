<?php

namespace App\Http\Controllers\Sone;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Collections\SoneContent;
use App\Http\Requests\SoneContentAddRequest;
use App\Http\Requests\SoneContentEditRequest;
use Carbon\Carbon;

class SoneContentController extends Controller
{
    protected $content;
    protected Request $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->content = new SoneContent();
    }
    public function list(Request $request)
    {
        $query = empty($request->q) === false ? $request->q : '';
        $list = SoneContent::when($query != '',function($list) use ($query) {
            return $list->Where('slug', 'LIKE', "%{$query}%");
        })->orderBy('updated_at','desc')->paginate($this->perPageCount());
        return view('sone.content.list',compact('list'));
    }

    public function add()
    {
        return view('sone.content.add');
    }

    public function save(SoneContentAddRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['is_active'] = (empty($request->is_active) === false && $request->is_active == 'on') ? 1 : 0;
        if($this->content::create($validatedData)){
            return redirect()->route('cms.sone.content.list')->with('success', 'Shriram-One Content Added Successfully');
        }
        return redirect()->route('cms.sone.content.list')->with('error', 'Failed to save');
    }

    public function edit($id)
    {
        $data = SoneContent::where('_id',$id)->first();
        $content = empty($data->content) === false ? json_encode(json_decode($data->content,true),JSON_PRETTY_PRINT) : '';
        return view('sone.content.edit',compact('data','content'));
    }

    public function update($id,SoneContentEditRequest $request)
    {
        $soneContent = SoneContent::where('_id',$id)->first();
        if(empty($soneContent) === false) {
            $content = empty($request->content) === false ? $request->content : null; 
            $soneContent->content = $content;
            $soneContent->is_active = (empty($request->is_active) === false && $request->is_active == 'on') ? 1 : 0;
            $soneContent->updated_at = Carbon::now();
            $soneContent->save();
            return redirect()->route('cms.sone.content.list')->with('success', 'Shriram-One Content Updated Successfully');
        } else {
            return redirect()->route('cms.sone.content.list')->with('error', 'Shriram-One Content Not Found');
        }
    }

    public function status($id, $type)
    {
        $soneContent = SoneContent::where('_id', '=', $id)->firstOrFail();
        if($type == 'active'){
            $soneContent->is_active = 1;
            $soneContent->updated_at = Carbon::now();
            $soneContent->save();
            return redirect()->route('cms.sone.content.list')->with('success', 'SoneContent has been activated successfully.');
        } 
        if($type == 'inactive') {
            $soneContent->is_active = 0;
            $soneContent->updated_at = Carbon::now();
            $soneContent->save();
            return redirect()->route('cms.sone.content.list')->with('success', 'SoneContent has been disabled successfully.');
        }
        return redirect()->route('cms.sone.content.list')->with('error', 'Oops! SoneContent status change has been failed. Try again later.');
    }

    public function addContent()
    {
        return view('soneContent.add');
    }
}
