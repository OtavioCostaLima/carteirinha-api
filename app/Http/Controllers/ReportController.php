<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class ReportController extends Controller
{
        public function pointsReport(Request $request){
         $class_id = $request->class_id;
         $date=$request->data;
         $present = $request->present;
         $title = "Alunos";
         $class = \App\Models\Classs::find($class_id);

               //pega o id dos alunos em uma turma especificada
         if(!is_null($date) && isset($date) && !is_null($class_id) && isset($class_id)  && $class_id>0){
           $students_ids = $class->students()->select('student_id')->get();
           $array = array();

            foreach ($students_ids as $id => $value) {
              array_push($array,$value->student_id);
            }

              $ids = \App\Models\Ponto::select('student_id')->whereIn('student_id',$array)->whereDate('created_at', '=', $date)->get();
              $students = $class->students();
              
              if(!is_null($present) && isset($present) && $present==0){

              $students = $students->whereNotIn('student_id',$ids)->get();
              $title ="Alunos ausentes";
              }else{
                $students = $students->whereIn('student_id',$ids)->get();
                $title ="Alunos presentes";
              }

           $dados = ['classs' => $class,
           'students'=> $students];

         $output = public_path() . '/reports/pdf.pdf';
         $pdf = \DomPDF::loadView('points', compact('dados','title'))->save($output);
        return $this->runPdf($output,'alunos');

       }
}


       public function carteirinhaReport(Request $request){
        $student_ids = $request->student_id;
        $class_id = $request->class_id;
        $student_ids = explode(',', $request->student_id);

        $class = \App\Models\Classs::find($class_id);
        $students = $class->students->whereIn('id',$student_ids);
        $output = public_path() . '/filename.pdf';
        $pdf = \PDF::saveFromView(view('carteirinha', compact('students')), 'filename.pdf');
        return $this->runPdf($output,'filename');
}




  public function runPdf($path,$nameFile = 'pdf'){
    $file = $path;
    if (!file_exists($file)) {
    return response()->json(['errors'=>'Ocorreu um erro!'],400);
    }
    $file = file_get_contents($file);
    unlink($path);
    return response($file, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', "inline; filename=$nameFile.pdf");
  }

}
