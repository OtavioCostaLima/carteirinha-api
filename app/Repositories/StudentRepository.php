<?php 

namespace App\Repositories;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class StudentRepository {

private $student;

	public function __construct(Student $student) {
		$this->student = $student;
	}


	public function generateRegistration() {

		$max = $this->student->max('id');
 		if (is_null($max)) {
     $newId = Carbon::now()->year . (++$max);
    return $newId;
		}
     return ++$max;
	}

	public function create($data) {
		return $this->student->create($data);
	}

	public function update($data, $id) {
    try{
        $student = $this->student->find($id);
        $student->update($data);
        $student->parent->update($data['parent']);
        return $student;
  } catch(QueryException $e){
    return 'errors';
  }
        
	}

	public function delete($id, $class_id) {
	 try{
	     $student = $this->student->find($id);
       if(!is_null($student)){
       		$student->delete();
          return ["DETETADO COM SUCESSO", 'status' => 200];
        } else {
          return ['errors' => "Aluno não encontrado!", 'status' => 404];
        }
      } catch(QueryException $e){
        return ['errors'=>"Esse aluno não pode ser deletado!", 'status' => 400];
      }
	}

	  public function getStudentsToday($data){
   		$date=$data->data;
   		$present = $data->present;
   		$count = $data->count;
   		$class_id = $data->class_id;

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
     
     if($present == self::STUDENT_PRESENT) {
          $students = $class->students()->whereIn('student_id',$student_id)->get();
      }  
      if($present == self::STUDENT_NOT_PRESENT) {
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
