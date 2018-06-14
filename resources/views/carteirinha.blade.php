<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
	<title>Carteirinha</title>
	</head>


<style type="text/css">


.carteirinha {
  width: 11.5cm;
  height:7cm;
  min-height: 5.96cm;
  min-width: 9.52cm;
  
}

.container {
  display: inline-block;
  margin-right: 0.4cm;
  margin-bottom: 0.4cm;
  min-height: 5.96cm;
  min-width: 9.52cm;
  width: 11.5cm;
  height:7cm;
  z-index: 0;
}

img {
   position: absolute;
   width: 11.5cm;
   height:7cm;
}

#nome {
  position: absolute;
  margin-left: 4.5cm;
  margin-top: 2.9cm;
  z-index: 1;
  font: bold;
  font-size: 16pt;
}

#turma {
  position: absolute;
   margin-left: 4.5cm;
  margin-top: 3.65cm;
  font-size: 14pt;
}

#ano {
  position: absolute;
   margin-left: 10cm;
  margin-top: 6cm;
  font-size: 18pt;


}

#matriculaBarCode {
  font-family: 'Code 128';
  position: absolute;
  margin-left: 25%;
  margin-top: 4.9cm;
  font-size: 36px;
}

#matriculaNumber {
  position: absolute;
  margin-left: calc(50% - 75px);
  margin-top: 3.5cm;
  font-size: 36px;
}
</style>


<body >
@if (isset($students))
@foreach($students as $student)
<div class="container">
  <img src="{{public_path().'/reports/galeria/carteirinha.png'}}" alt="Paris" class="carteirinha">
  <div id="nome">{{$student->nome}}</div>
  <div id="turma">2 ano</div>
  <div id="ano">2017</div>
  <div id="matriculaBarCode">{{$student->id}}</div>
  </div>
@endforeach
@endif
</body>
</html>