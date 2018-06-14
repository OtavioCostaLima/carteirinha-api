<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classs;
use Illuminate\Database\QueryException;
class ClassController extends Controller
{
  private $classs;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct(Classs $classs){
        $this->classs = $classs;
     }

    public function index()
    {
      $class = $this->classs->all();
     return $class;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $dados = $request->all();
      $turma = $this->classs->create($dados);
      if($turma){
          return response()->json('Salvo com Sucesso!');
      }else{
          return response()->json(['errors'=>'Erro ao salvar!'],404);
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
      try{
      $turma= $this->classs->find($id);
      $delete = $turma->delete();
        return response(200);
      }catch(QueryException $e){
          return response()->json(['errors' => 'Essa turma não pode ser deletada!'], 400);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function addStundent(Request $request){
$class = new Classs;
$class = $class->find($request->class_id);
    }

    public function getStudentsByClass($id){
      $turma = $this->classs->find($id);
      if(!is_null($turma)){
         $students = $turma->students;
         return response()->json($students,200);
      }
      return response()->json(['errors'=> 'Turma não encontrada!'],404);
    }
}
