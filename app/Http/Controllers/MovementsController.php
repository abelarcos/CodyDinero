<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMovement;
use App\Category;
use App\Movement;
use Illuminate\Support\Facades\Storage;
class MovementsController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $title = 'Movimientos';

        $movements = Movement::where('user_id', auth()->user()->id);

        if($request->has('type')){

            $movements = $movements->where('type', $request->get('type'));
            $title = 'Movimientos de ' . $request->get('type');
        }
        
        $movements = $movements->orderBy('movement_date', 'desc')->paginate();

        return view('movements.index', compact('movements', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //traigo las categorias ordenadas por nombre y
         //con el metodo pluck el name para el value  y el id para el select de la vista
        //orderBy('name')->pluck('name', 'id');
         $categories = Category::all();
         $movements = Movement::all();

        return view('movements.create', compact('categories', 'movements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( StoreMovement $request)
    {

        //dd($request->all() );//verificar si estan llegando los datos correctos
        //$movement = Movement::create( $request->all() );//otra forma de crear un nuevo movimiento
        $movement = new  Movement( $request->all() );

        $movement->money = $request->get('money') * 100;

        $category = $request->get('category_id');

        if(!is_numeric($category)){
            $newcategory = Category::firstOrCreate(['name' => ucwords( $category)] );
            $movement->category_id = $newcategory->id;
        }

        $movement->user_id = Auth()->user()->id;

        //if($request->hasfile('image')){ //verifico si existe la image que nos llega
            
            //$image = $request->file('image');
            //$file = $image->store('public'); 
        	//$file = $image->Storage::disk('public');
            //$movement->image = $file;
        //}
        
        //otra forma
        if($request->hasfile('image')){//verifico si el request tiene el name image

            $img = $request->file('image');
            $file_route = $img->getClientOriginalName();
            Storage::disk('public')->put($file_route, file_get_contents($img->getRealPath() ));
            $movement->image = $file_route;
        }
        


        // Guardar IMAGEN 
        //uso de put para crear la carpeta donde se van almacenar las imagenes
    	//if($request->file('image')){
    		//$url = Storage::disk('public')->put('imgDinero', $request->file('image'));
    		//$movement->fill(['image' => asset($url)])->save();
    	//}
        $movement->save();

        return redirect()->route('movements.show', $movement);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movement = Movement::where('user_id', auth()->user()->id)//verifico al user autenticado
                            ->where('id', $id)//donde el id sea al id que recibimos en $movement
                            ->first();//y obtengo los primeros registros de ese usuario logueado
       
        return view('movements.show', compact('movement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //$categories = Category::orderBy('name')->pluck('name', 'id');
        $categories = Category::all();
        $movement = Movement::where('user_id', auth()->user()->id )
            ->where('id', $id)
            ->first();

        return view('movements.edit', compact('categories', 'movement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMovement $request, $id)
    {
        $movement = Movement::where('user_id', auth()->user()->id )
            ->where('id', $id)
            ->first();

        $movement->type = $request->get('type');
        $movement->movement_date = $request->get('movement_date');
        $movement->money = $request->get('money');
        $movement->description = $request->get('description');

        $category = $request->get('category_id');

        // Aseguro la existencia de la categoría en la BD
        if (!is_numeric($category)) {
            $newCategory = Category::firstOrCreate(['name' => ucwords($category)]);
            $movement->category_id = $newCategory->id;
        }

        if($request->hasfile('image')){//verifico si el request tiene el name image

            $img = $request->file('image');
            $file_route = $img->getClientOriginalName();
            Storage::disk('public')->put($file_route, file_get_contents($img->getRealPath() ));
            $movement->image = $file_route;
        }

    
        //guardo en la BD
        $movement->save();

        return redirect()->route('movements.show', $movement);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
