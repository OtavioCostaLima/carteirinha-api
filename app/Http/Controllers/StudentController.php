<?php
namespace App\Http\Controllers;

use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Repositories\ParentRepository;
class StudentController extends Controller
{
  private $student;
  private const STUDENT_PRESENT = 1;
  private const STUDENT_NOT_PRESENT = 0;
  private $studentRepository;
  private $parentRepository;

public function __construct(\App\Models\Student $student, StudentRepository $studentRepository,
  ParentRepository $parentRepository){
    $this->student=$student;
    $this->studentRepository = $studentRepository;
    $this->parentRepository = $parentRepository;
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $alunos = $this->student->all();
      return  response($alunos,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
 
      $class_id = $request->student['class_id'];
      if(!is_null($class_id)){

          $dataParent = [
          'nome' => $request->student['parent']['nome'],
          'telefone' => $request->student['parent']['telefone'],
          'email' => $request->student['parent']['email'],
          'cpf' => $request->student['parent']['cpf']
          ];

          $parent = $this->parentRepository->create($dataParent);

          $dataStudent = [
          'id' => $this->studentRepository->generateRegistration(),
          'nome' => $request->student['nome'],
          'telefone' => $request->student['telefone'],
          'email' => $request->student['email'],
          'parent_id' => $parent['id']
          ];

          $student = $this->studentRepository->create($dataStudent);

          $classe = \App\Models\Classs::find($class_id);

          $classe->students()->attach([$student->id]);

        return response(200);
      }
    return response()->json(['errors'=> 'Verifique se todos os campos estão preechidos corretamente!'], 400);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if(!is_null($id)){
        $alunos = $this->student->find($id);
        $parent = $alunos->parent;
        return  response()->json($alunos,200);
      }
        return response()->json(['errors'=> 'O aluno não foi encontrado!'], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    { 
        $data = $request->all();
        $id = $request->id;
        $update = $this->studentRepository->update($data, $id);
        return response()->json($update, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request) {
     $class_id = $request->class_id;
     $delete = $this->studentRepository->delete($id, $class_id);
        return response()->json($delete, $delete['status']);
    }



    public function getStudents(){
    $id_presentes = \App\Models\Ponto::select('student_id')->whereDate('created_at', '=', date('Y-m-d'))->where('tipo','=', 'ENTRADA')->distinct()->get();
     $ausentes = \App\Models\Student::whereNotIn('id',$id_presentes)->count();
     $presentes =  \App\Models\Student::whereIn('id',$id_presentes)->count();
     $total = \App\Models\Student::all()->count();
         return response()->json(['presentes'=>$presentes,'ausentes'=>$ausentes,'total'=>$total]);
    }



  public function getStudentsToday(Request $request){
   $date=$request->data;
   $present = $request->present;
   $count = $request->count;
   $class_id = $request->class_id;

  if (is_null($date) || is_null($present) || is_null($class_id)) {
    return response()->json(['errors' => "Algo não está certo. Certifique-se que todos os campos estão preenchidos."], 400);
  }

    $class = \App\Models\Classs::find($class_id);

  if(!is_null($date) && !is_null($class)){
    try {
      //pega o id dos alunos em uma turma especificada
     $students_id = $class->students()->select('student_id')->get();
     $array = array();
      foreach ($students_id as $id => $value) {
       array_push($array,$value->student_id);
     }

     $student_id = \App\Models\Ponto::select('student_id')->whereIn('student_id',$array)->whereDate('created_at', '=', $date)->get();
     
     if(!is_null($present) && $present == self::STUDENT_PRESENT) {
          $students = $class->students()->whereIn('student_id',$student_id)->get();
      }  
      if(!is_null($present) && $present == self::STUDENT_NOT_PRESENT) {
          $students = $class->students()->whereNotIn('student_id',$student_id)->get();
      }

        if(!is_null($count) && isset($count)){
            return $students->count();
          }

    $dados = ['students'=> $students,'classs' => $class ];

    return response()->json($dados,200);

    } catch (QueryException $e) {
      return response()->json(['errors' => "Algo não está certo. Certifique-se que todos os campos estão preenchidos."], 400);
    }

  }

}
}
