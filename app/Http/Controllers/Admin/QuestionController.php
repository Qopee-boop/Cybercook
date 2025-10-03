<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuestionController extends Controller {
  public function index(Module $module){
    $questions = $module->questions()->latest()->paginate(15);
    return view('admin.questions.index', compact('module','questions'));
  }
  public function create(Module $module){ return view('admin.questions.create', compact('module')); }
  public function store(Request $r, Module $module){
    $data = $r->validate([
      'type'=>'required|in:mcq,truefalse,fib',
      'difficulty'=>'required|integer|min:1|max:5',
      'stem'=>'required|string',
      'options'=>'nullable|array',
      'answer'=>'required',
      'explanation'=>'nullable|string',
      'is_active'=>'nullable|boolean'
    ]);
    // normalize MCQ fields
    if($data['type']==='mcq'){
      $data['options'] = array_values(array_filter($data['options'] ?? []));
      if(!is_array($data['answer'])) $data['answer'] = [(string)$data['answer']];
    }
    if($data['type']==='truefalse'){ $data['answer'] = [ $data['answer'] ? 'true' : 'false' ]; }
    if($data['type']==='fib'){ $data['answer'] = [ trim((string)$data['answer']) ]; }

    $data['is_active'] = $r->boolean('is_active');
    $data['module_id'] = $module->id;
    Question::create($data);
    return redirect()->route('admin.modules.questions.index',$module)->with('ok','Question created.');
  }
  public function edit(Module $module, Question $question){
    return view('admin.questions.edit', compact('module','question'));
  }
  public function update(Request $r, Module $module, Question $question){
    $data = $r->validate([
      'type'=>'required|in:mcq,truefalse,fib',
      'difficulty'=>'required|integer|min:1|max:5',
      'stem'=>'required|string',
      'options'=>'nullable|array',
      'answer'=>'required',
      'explanation'=>'nullable|string',
      'is_active'=>'nullable|boolean'
    ]);
    if($data['type']==='mcq'){
      $data['options'] = array_values(array_filter($data['options'] ?? []));
      if(!is_array($data['answer'])) $data['answer'] = [(string)$data['answer']];
    }
    if($data['type']==='truefalse'){ $data['answer'] = [ $data['answer'] ? 'true' : 'false' ]; }
    if($data['type']==='fib'){ $data['answer'] = [ trim((string)$data['answer']) ]; }

    $data['is_active'] = $r->boolean('is_active');
    $question->update($data);
    return redirect()->route('admin.modules.questions.index',$module)->with('ok','Question updated.');
  }
  public function destroy(Module $module, Question $question){
    $question->delete();
    return back()->with('ok','Question deleted.');
  }
}

