<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class PontoController extends Controller
{
private $point;

public function __construct(\App\Models\Ponto $point){
      $this->point=$point;

}
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

        $results = $this->point->where($where)
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
    public function store(Request $request) {
      $student_id=$request->student_id;
      $dataPoint = ['student_id' => $student_id ,'tipo'=>$request->tipo];
     
     try {
        $student = \App\Models\Student::find($student_id);

      if($student){
        $poit = $this->point->create($dataPoint);
        $class = $student->classes->where('ano','=',date('Y'))->first();
        if ($class) {
          $dados = array([
          'id' => $poit->student_id, 
          'nome' => $student->nome,
          'created_at' => Carbon::parse($poit->created_at)->format('d/m/Y'),
          'class' => $class->descricao .' '. $class->ano
          ]);
           return response()->json($dados, 200);
        }
        return response()->json(['errors'=> 'Esse aluno não está vinculado a uma turma!'], 400);
     }else{
        return response()->json(['errors'=> 'Aluno não encontrado'], 401);
      }
     } catch (QueryException $e) {
         return response()->json(['errors'=> 'Desculpe-me mas aconteceu um erro. \n Verifique se se os dados estão corretos!'], 400);
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
      $result = $this->point->find($id);
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
      $result = $this->point->find($id);
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
      $result = $this->point->findOrFail($id);
      $result->delete($request->all());
      return response()->json($result);
    }


}
