<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait ApiControllerTrait
{

    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $limit = $request->all()['limit'] ?? 20;

    $order = $request->all()['order'] ?? null;

    if($order !== null){
      $order = explode(',', $order);
    }
    $order[0] = $order[0] ?? 'id';
    $order[1] = $order[1] ?? 'asc';

$where = $request->all()['where'] ?? [];

$like = $request->all()['like'] ?? null;

if($like){
$like = explode(',', $like);
$like[1] = '%'.$like[1].'%';
  }

      $results = $this->model
      ->where($where)
      ->where(function($query) use ($like){
if($like){
return $query->where($like[0], 'like',$like[1]);
}
      })
      ->orderBy($order[0],$order[1])
      ->paginate($limit);


      return response()->json($results);
    //return view('point');
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
  $id=$request->student_id;
  if(isset($id) && !is_null($id)){
    $dados = ['student_id' => $id ,'tipo'=>$request->tipo];
    $aluno = Student::find($id);
      if(!is_null($aluno) && $aluno->id>0){
      $poit = $this->model->create($dados);
      $class = $aluno->classes->where('ano','=',date('Y'))->first();
      return response()->json(['student'=> [
        'id' => $poit->student_id,
        'nome' => $poit->student->nome,
        'created_at' => Carbon::parse($poit->created_at)->format('d/m/Y'),
    'class' => $class->descricao .' '. $class->ano. ' ' .$class->sigla
        ]]);
}else{

      return response()->json(['errors'=> 'Aluno não encontrado'],404);
    }
  }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $result = $this->model->find($id);
    return response()->json($result);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

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
    $result = $this->model->find($id);
    $result->update($request->all());
    return response()->json($result);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $result = $this->model->findOrFail($id);
    $result->delete($request->all());
    return response()->json($result);
  }
}
