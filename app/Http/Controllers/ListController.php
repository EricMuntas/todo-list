<?php

namespace App\Http\Controllers;

use App\Models\TODOList;
use Illuminate\Cache\RedisTagSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Bool_;



class ListController extends Controller
{

   public function index()
   {



      // $list = TODOList::orderBy('id', 'desc')->paginate();
      if (Auth::check()) {
         $list = TODOList::orderBy('id', 'desc')->where('username', Auth::user()->username)->paginate(7);
         $fullList = $list = TODOList::orderBy('id', 'desc')->where('username', Auth::user()->username)->paginate(7);;
      } else {
         // Si l'usuari no està autenticat
         $list = TODOList::orderBy('id', 'desc')->paginate(7);
      }

      return view('list.index', compact('list', 'fullList'));
   }

   public function create()
   {

      return view('list.create');
   }

   public function store(Request $request)
   {

       $validated = $request->validate([
           'title' => 'required|max:255',
           'description' => 'required',
       ], [
           'title.required' => 'The field "title" is required.',
           'title.max' => 'The title cannot have more than 255 characters.',
           'description.required' =>  'The "description" field is required.',
       ]);
   
       $list = new TODOList();
       $list->username = Auth::user()->username;
      //  $list->title = $request->title; --- Anterior
       $list->title = $validated['title'];
       $list->description = $validated['description'];
       $list->dueTo = $request->dueTo;
       $list->checked = false;
       $list->category = $request->category;
       $list->priority = $request->priority;
       $list->save();

       return redirect()->route('list.index')->with('success', 'Llista creada correctament!');
   }

   public function show(TODOList $list)
   {
      if (Auth::user()->username !== $list->username) {
         abort(403, 'You do not have permission to access this list.');
      }
      return view('list.show', compact('list'));
   }


   public function destroy(TODOList $list)
   {


      $list->delete();

      return redirect()->route('list.index');
   }


   

   public function edit(TODOList $list)
   {
      if (Auth::user()->username !== $list->username) {
         abort(403, 'You do not have permission to edit this list.');
      }
      return view('list.edit', compact('list'));
   }

   public function update(Request $request, TODOList $list)
   {

      $validated = $request->validate([
         'title' => 'required|max:255',
         'description' => 'required',
     ], [
         'title.required' => 'The field "title" is required.',
         'title.max' => 'The title cannot have more than 255 characters.',
         'description.required' =>  'The "description" field is required.',
     ]);
 
     $list->title = $validated['title'];
     $list->description = $validated['description'];
     $list->dueTo = $request->dueTo;
     $list->category = $request->category;
     $list->priority = $request->priority;
      // $list->title = $request->title;
      // $list->description = $request->description;

      $list->save();

      return redirect()->route('list.show', $list);
   }


   public function updateChecked(Request $request, TODOList $list)
   {

      $list->checked = $request->input('checked', 0);

      $list->save();

      return redirect()->route('list.index');
   }

   public function checkAll($value)
   {

      // $list = TODOList::orderBy('id', 'desc')->paginate();
      if (Auth::check()) {
         $list = TODOList::orderBy('id', 'desc')->where('username', Auth::user()->username)->paginate(7);

         foreach ($list as $item) {
            $item->checked = (bool) $value;
            $item->save();
         }
      }

      return redirect()->route('list.index');
   }

   public function filter(Request $request)
   {

      $searchQuery = $request->input('searchThis', '');
      $sortByDone = $request->boolean('sortByDone');
      $sortByOldest = $request->boolean('sortByOldest');
      $category = $request->input('category', '');


      $query = TODOList::where('username', Auth::user()->username);

      if (!empty($searchQuery)) {
         $query->where('title', 'like', '%' . $searchQuery . '%');
      }

      if ($sortByDone) {
         $query->where('checked', true);
      }

      if ($category == 'priority') {
         // Si la categoría es 'priority', también filtramos por 'important'
         $query->where('priority', 'important');
     } else {
         // Si no es 'priority', filtramos solo por la categoría
         $query->where('category', $category);
     }
         
     
      $query->orderBy('created_at', $sortByOldest ? 'asc' : 'desc');

      $list = $query->paginate(7);

      $fullList = TODOList::where('username', Auth::user()->username)->get();

    

      return view('list.index', compact('list', 'fullList', 'category' ));
   }
}
