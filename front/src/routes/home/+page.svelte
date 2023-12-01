<script>
  let clientes = [
    { Nome: 'Cliente 1', Endereco: 'Rua A, 123' },
    { Nome: 'Cliente 2', Endereco: 'Rua B, 456' },
    { Nome: 'Cliente 3', Endereco: 'Rua C, 789' },
    { Nome: 'Cliente 4', Endereco: 'Rua D, 101' },
    { Nome: 'Cliente 5', Endereco: 'Rua E, 112' }
  ];
  </script>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciamento Kabum</title>
 </head>
<body>

  <nav class="navbar">
 
    <ul class="nav-list">
      <li><a href="/home">Home</a></li>
      <li><a href="/home">Cadastrar novo cliente</a></li>
      <li><a href="/">Perfil</a></li>
     </ul>
    <div class="search-bar">
      <input type="text" placeholder="Pesquisar cliente">
      <button>Buscar</button>
    </div>
  </nav>
  
  

  <!-- Conteúdo da página aqui -->

</body> 
  <div class="client-list">
    <div class="tab-pane fade show active" id="nav-clientes" role="tabpanel" aria-labelledby="nav-clientes-tab" tabindex="0">
      <!-- <div class="row">
          <div class="col-12 mb-3" style="display: flex; place-content: space-between;">
              <h2><b>Clientes</b></h2>

          </div>
      </div> -->
      <div class="col-12">
        <table class="table table-bordered table-striped" width="100%" style="box-shadow: 0 10px 40px #00000056;">
            <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">Endereço</th>
                     <th class="text-center">#</th>
                </tr>
            </thead>
            <tbody>
                {#each clientes as cliente, i(cliente)}
                    <tr>
                        <td style="text-align: center;">{cliente.Nome}</td>
                        <td style="text-align: center;">{cliente.Endereco}</td>
                        <td style="text-align: center;">  
                            <button  class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></button>
                            <button   class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button> 
                        </td>
                    </tr>
                {/each}
            </tbody>
        </table>
    </div>
    </div>
  </div>

<style>
    body {
  margin: 0;
  padding: 0;
  font-family: 'Arial', sans-serif;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #0060b1;
  color: white;
  padding: 10px 20px;
}

.logo {
  font-size: 24px;
  font-weight: bold;
}

.nav-list {
  list-style: none;
  display: flex;
  gap: 20px;
}

.nav-list a {
  text-decoration: none;
  color: white;
}

.search-bar {
  display: flex;
  align-items: center;
}

.search-bar input {
  padding: 8px;
  border: none;
  border-radius: 5px;
}

.search-bar button {
  margin-left: 10px;
  background-color: #f58220;
  color: white;
  padding: 8px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  
}
 

 
.client-list {
  max-width: 800px;
  margin: auto;
  padding: 20px;
}




 

</style>
 
