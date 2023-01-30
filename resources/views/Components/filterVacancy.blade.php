 @isRole(['Employer'])    

<form action="{{route('vacancy.index')}}" method="GET" class="mt-2 d-flex w-100 justify-content-center align-items-center"> 
      
    <div class="input-group w-50">

      <select name="type" id="type" >
        <option value=0>Tipo de Contratação</option>
        @foreach ($types as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>      
        @endforeach
      </select>


    <select name="status" id="status" >
      <option value=0>Status</option>
      @foreach ($status as $item)
      <option value="{{$item->id}}">{{$item->name}}</option>      
      @endforeach
    </select>

    <input type="text" name="search" id="search" placeholder="Pesquisar por cliente,codigo de pedido" class="form-control">
    <button class="btn btn-outline-primary">Pesquisar</button>
    
    </div>
  
  </form>

  @endisRole

  @isRole(['Admin'])  

  <form action="{{route('vacancy.all')}}" method="GET" class="mt-2 d-flex w-100 justify-content-center align-items-center"> 
      
    <div class="input-group w-50">

      <select name="type" id="type" >
        <option value=0>Tipo de Contratação</option>
        @foreach ($types as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>      
        @endforeach
      </select>


    <select name="status" id="status" >
      <option value=0>Status</option>
      @foreach ($status as $item)
      <option value="{{$item->id}}">{{$item->name}}</option>      
      @endforeach
    </select>

    <input type="text" name="search" id="search" placeholder="Pesquisar por cliente,codigo de pedido" class="form-control">
    <button class="btn btn-outline-primary">Pesquisar</button>
    
    </div>
  
  </form>



  @endisRole