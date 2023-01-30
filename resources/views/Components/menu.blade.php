<header>
    <nav class="navbar navbar-expand-lg  navbar-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/dashboard">Início</a>
              </li>    
             
   

            @isRole(['Admin'])
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/applicant">Candidato</a>
              </li>            
              @endisRole

              @isRole(['Admin'])
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/employer">Empregador</a>
              </li>
              @endisRole

              @isRole(['Employer'])
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/vacancy">Vagas</a>
              </li>    
              @endisRole
            
              @isRole(['Admin'])
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/vacancy/all">Vagas</a>
              </li>    
              @endisRole

              
              @isRole(['Applicant','Admin'])
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/vacancy/catalog">Catalogo de Vagas</a>
              </li>     
              @endisRole  

              @isRole(['Applicant'])
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/applicant/applications">Minhas Vagas</a>
              </li>    
              @endisRole 

              @isRole(['Applicant'])
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/applicant/profile">Perfil</a>
              </li>    
              @endisRole 
              
                </ul>
                <div class="navbar-nav ">
                  <a class="nav-link" aria-current="page" href="/logout">Sair</a>
                </div>
            
          </div>
        </div>
      </nav>
    </header>