@extends('principal')
@section('contenido')
  <template v-if="menu==0">
    <inicio></inicio>
  </template>
  <template v-if="menu==1">
    <gallo></gallo>
  </template>
  <template v-if="menu==2">
    <gallina></gallina>
  </template>
  <template v-if="menu==3">
    <cria></cria>
  </template>
  
@endsection