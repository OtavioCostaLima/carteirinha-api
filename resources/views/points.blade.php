<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Alunos</title>
  </head>
  <body>
    <style media="screen">

.image-logo{
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 50px;
  display: block;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

img{
   width: 100%;
}

    h1{
        text-align: left;
        color: rgb(199, 57, 48);
      }

.table {
        position: relative;
        width: 100%;
        border-collapse: collapse;
      }

td, th {
    border: 1px solid #dddddd;
    padding: 8px;
}

td{
  font-size: 13px;
  padding-bottom: 0.5em;
  padding-top: 0.5em;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

th,td {
    text-align: center;
}
.center{
  text-align: center;
}
    </style>

  <div class="container center">
    <img src="{{public_path().'/reports/galeria/logo.png'}}" class="image-logo">
    <div class="center">
      <h1>{{$title}}</h1>
    </div>
    @if (isset($dados['students']) && !is_null($dados['students']))
    <table class="table">
      <thead >
        <tr>
          <th>Matricula</th>
          <th>Nome</th>
          <th>Turma</th>
          <th>telefone</th>
        </tr>
      </thead>
      <tbody>
    @foreach ($dados['students'] as $student)
    <tr>
      <td>{{$student->id}}</td>
      <td>{{$student->nome}}</td>
      <td>{{$dados['classs']->descricao ." ". $dados['classs']->turno . " - ".$dados['classs']->ano}}</td>
      <td>{{$student->telefone}}</td>
    </tr>
      @endforeach

      </tbody>
    </table>
    @endif
  </div>
  </body>
</html>
