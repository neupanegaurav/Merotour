<?php

class TodoController extends BaseController {
    
    
    protected $layout = 'backend.layouts.default';
    
    public function getIndex() {
        
        $entries = Todos::paginate(10);
        
        $this->layout->content = View::make('backend.todo.index', compact('entries'));
        
       
    }
    
    public function show($id)
    {
        try {
            $entry = Todos::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return App::abort(404);

        }
        
        $this->layout->content = View::make("backend.todo.show", compact('entry'));
        
    }
    
    
    
    
}
