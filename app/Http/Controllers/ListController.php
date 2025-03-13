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

      $PAGE_COUNT = 20;

      if (Auth::check()) {
         $list = TODOList::orderBy('id', 'desc')->where('username', Auth::user()->username)->paginate( $PAGE_COUNT)->appends(request()->query());
         // $fullList = $list = TODOList::orderBy('id', 'desc')->where('username', Auth::user()->username)->paginate( $PAGE_COUNT)->appends(request()->query());
         // $fullListCount = TODOList::where('username', Auth::user()->username)->get();

         $commonData = $this->getCommonData();
         $totalAmountOfLists = $commonData['totalAmountOfLists'];  // Total de tasques
         $totalAmountOfListsDone = $commonData['totalAmountOfListsDone'];  // Tasques fetes
         $totalAmountOfListsToDo = $commonData['totalAmountOfListsToDo'];
         $fullList = $commonData['fullList'];
         $fullListCount = $commonData['fullListCount'];
 
         return view('list.index', compact('list', 'fullList', 'fullListCount', 'totalAmountOfLists', 'totalAmountOfListsDone', 'totalAmountOfListsToDo'));

      } else {
         // Si l'usuari no està autenticat
         $list = TODOList::orderBy('id', 'desc')->paginate($PAGE_COUNT);
         $fullList = $list = TODOList::orderBy('id', 'desc')->paginate( $PAGE_COUNT);

         return view('list.index', compact('list', 'fullList'));
      }

   }

   public function create()
   {

      $PAGE_COUNT = 20;


      // Mejorar
      if (Auth::check()) {
         $list = TODOList::orderBy('id', 'desc')->where('username', Auth::user()->username)->paginate($PAGE_COUNT)->appends(request()->query());
         // $fullList = $list = TODOList::orderBy('id', 'desc')->where('username', Auth::user()->username)->paginate($PAGE_COUNT)->appends(request()->query());
         // $fullListCount = TODOList::where('username', Auth::user()->username)->get();

         $commonData = $this->getCommonData();
         $totalAmountOfLists = $commonData['totalAmountOfLists'];  // Total de tasques
         $totalAmountOfListsDone = $commonData['totalAmountOfListsDone'];  // Tasques fetes
         $totalAmountOfListsToDo = $commonData['totalAmountOfListsToDo'];
         $fullList = $commonData['fullList'];
         $fullListCount = $commonData['fullListCount'];

         return view('list.create', compact('list', 'fullList', 'fullListCount', 'totalAmountOfLists', 'totalAmountOfListsDone', 'totalAmountOfListsToDo'));
      } 
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
      $list->due_to = $request->due_to;
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
      else {

        
         $commonData = $this->getCommonData();
         $totalAmountOfLists = $commonData['totalAmountOfLists'];  // Total de tasques
         $totalAmountOfListsDone = $commonData['totalAmountOfListsDone'];  // Tasques fetes
         $totalAmountOfListsToDo = $commonData['totalAmountOfListsToDo'];
         $fullList = $commonData['fullList'];
         $fullListCount = $commonData['fullListCount'];
   
         return view('list.show', compact('list', 'totalAmountOfLists', 'totalAmountOfListsDone', 'totalAmountOfListsToDo', 'fullList', 'fullListCount'));

      }
      
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
      } else {

         $commonData = $this->getCommonData();
         $totalAmountOfLists = $commonData['totalAmountOfLists'];  // Total de tasques
         $totalAmountOfListsDone = $commonData['totalAmountOfListsDone'];  // Tasques fetes
         $totalAmountOfListsToDo = $commonData['totalAmountOfListsToDo'];
         $fullList = $commonData['fullList'];
         $fullListCount = $commonData['fullListCount'];

         return view('list.edit', compact('list', 'totalAmountOfLists','totalAmountOfListsDone', 'totalAmountOfListsToDo', 'fullList', 'fullListCount'));
      }
     
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
      $list->due_to = $request->due_to;
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
      // return redirect()->route('list.index');
      return redirect()->back();
      
   }

   public function filter(Request $request)
   {
      $PAGE_COUNT = 20;
      // Esto
      $commonData = $this->getCommonData();
      $totalAmountOfLists = $commonData['totalAmountOfLists'];  // Total de tasques
      $totalAmountOfListsDone = $commonData['totalAmountOfListsDone'];  // Tasques fetes
      $totalAmountOfListsToDo = $commonData['totalAmountOfListsToDo'];

      $fullListCount = TODOList::where('username', Auth::user()->username)->get();
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
if (!empty($category)) {
      if ($category == 'priority') {
         // Si la categoría es 'priority', también filtramos por 'important'
         $query->where('priority', 'important');
      } else {
         // Si no es 'priority', filtramos solo por la categoría
         $query->where('category', $category);
      }
   }
   
      $query->orderBy('created_at', $sortByOldest ? 'asc' : 'desc');
  
      // request()->query() obtiene todos los parámetros actuales de la URL.
      // append los añade al principio de la url y al final lo de la pagina
      $list = $query->paginate($PAGE_COUNT)->appends(request()->query());

      $fullList = TODOList::where('username', Auth::user()->username)->get();



      return view('list.index', compact('list', 'fullList', 'category', 'fullListCount', 'totalAmountOfLists', 'totalAmountOfListsDone', 'totalAmountOfListsToDo'));
   }

   public function deleteDone()
   {

      if (Auth::check()) {

         $list = TODOList::where('username', Auth::user()->username)->where('checked', true)->delete();

      }

      return redirect()->back();
   }

public function deleteAll()
   {

      if (Auth::check()) {

         $list = TODOList::where('username', Auth::user()->username)->delete();

      }

      return redirect()->back();
   }

   public function checkAll() {

      if (Auth::check()) {

         $list = TODOList::where('username', Auth::user()->username)->update(['checked' => true]);

      }

      return redirect()->back();
   }
   public function uncheckAll() {

      if (Auth::check()) {

         $list = TODOList::where('username', Auth::user()->username)->update(['checked' => false]);;
      }

      return redirect()->back();
   }

   private function getCommonData()
   {
      if (Auth::check()) {
         $PAGE_COUNT = 20;

         $query = TODOList::where('username', Auth::user()->username);
        
         // clone para crear una copia de la query
         return [
            'totalAmountOfLists' => $query->count(),
            'totalAmountOfListsDone' => (clone $query)->where('checked', true)->count(),
            'totalAmountOfListsToDo' => (clone $query)->where('checked', false)->count(),
            'fullList' => TODOList::orderBy('id', 'desc')->where('username', Auth::user()->username)->paginate( $PAGE_COUNT)->appends(request()->query()),
            'fullListCount' => TODOList::where('username', Auth::user()->username)->get(),
         ];
      }
      return [
         'totalAmountOfLists' => 0,
         'totalAmountOfListsDone' => 0,
         'totalAmountOfListsToDo' => 0,
      ];
   }
}
