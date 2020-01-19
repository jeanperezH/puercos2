@extends('principal')
@section('contenido')
  <template v-if="menu==0">
    <inicio></inicio>
  </template>
  <template v-if="menu==1">
    <gallo :ruta="ruta"></gallo>
  </template>
  <template v-if="menu==2">
    <gallina :ruta="ruta"></gallina>
  </template>
  <template v-if="menu==3">
    <cria :ruta="ruta"></cria>
  </template>
  
@endsection