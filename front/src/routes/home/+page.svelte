<script>
  import { serviceGetClientes,serviceDeleteCliente } from "../../services/cliente.js";
  import { serviceLogout} from "../../services/user.js";

  import { onMount } from "svelte";
  import { goto } from "$app/navigation";
  import '@fortawesome/fontawesome-free/css/all.css';

  let clientes = [

  ];

  onMount(async () => {
    getClientes();
  }); 
  const getClientes = async () => {
    try {
      clientes = await serviceGetClientes();
      console.log("Clientes:", clientes);
    } catch (error) {
      console.error("Erro ao obter clientes:", error);
    }
  };

  const editCliente = async (cliente) => {
    if (cliente) sessionStorage.setItem('idCliente', JSON.stringify(cliente.idCliente));
    else sessionStorage.removeItem('idCliente'); 
    goto("/cadastros/cliente");
  };

  const deleteCliente = async (cliente) => {
  const isConfirmed = window.confirm("Você tem certeza que deseja excluir o cliente: " + cliente.Nome);
  if (isConfirmed) {
     let res = await serviceDeleteCliente(cliente.idCliente); 
      if(!res){
        alert("Erro ao deletar cliente: " + cliente.Nome)
      }
     getClientes();
    }
};

  const deslogar = ()=> {
    serviceLogout(); 
    window.location.reload();
   };
 
</script>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciamento Kabum</title>
</head>

<body>
  <nav class="navbar">
    <div class="nav-container">
    
      <ul class="nav-list">
        <li><a href="/home" style="color: darkcyan;">Home</a></li>
        <li><a on:click={() => editCliente()}>Cadastrar novo cliente</a></li>
        <li><a on:click={() => deslogar()}>Deslogar</a></li>

       </ul>
      <div class="search-bar">
        <input type="text" placeholder="Pesquisar cliente CPF" />
        <button>Buscar</button>
      </div>
    </div>
  </nav>

  <!-- Conteúdo da página aqui -->
</body>

<div class="client-list">
  <div class="tab-pane fade show active" id="nav-clientes" role="tabpanel" aria-labelledby="nav-clientes-tab" tabindex="0">
    <div class="col-12">
      <table class="table table-bordered table-striped" width="100%">
        <thead>
          <tr>
            <th class="text-center">Nome</th>
            <th class="text-center">Cpf</th>
            <th class="text-center"></th>
          </tr>
        </thead>
        <tbody>
          {#if clientes.length > 0}
            {#each clientes as cliente (cliente.idCliente)}
              {#if cliente}
                <tr class="client-row">
                  <td style="text-align: center;">{cliente.Nome}</td>
                  <td style="text-align: center;">{cliente.Cpf}</td>
                  <td style="text-align: center;">
                    <button on:click={() => editCliente(cliente)}>
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button on:click={() => deleteCliente(cliente)}>
                      <i class="fas fa-trash" style="color: red;"></i>
                    </button>
                  </td>
                </tr>
              {/if}
            {/each}
          {:else}
            <tr  class="client-row">
              <td colspan="2" style="text-align: center;">Nenhum cliente encontrado.</td>
            </tr>
          {/if}
        </tbody>
        
      </table>
    </div>
  </div>
</div>

<style>
  .client-row {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
  }

  .client-row:hover {
    box-shadow: 0 8px 16px rgba(12, 12, 12, 0.2);
  }

  body {
    margin: 0;
    padding: 0;
    font-family: "Arial", sans-serif;
  }

 
  .client-list {
    max-width: 100%;
    margin: auto;
    padding: 20px;
  }

  table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
  }

  .client-list {
    max-width: 100%;
    margin: auto;
    padding: 20px;
  }

  .client-row button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    border-radius: 10px;
  }

  .client-row button i {
    vertical-align: middle;
  }

  .navbar {
    background-color: #0060b1;
    color: white;
    padding: 10px 20px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  }

  .nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
 
  .nav-list {
    list-style: none;
    display: flex;
    gap: 20px;
  }

  .nav-list a {
    text-decoration: none;
    color: white;
     cursor: pointer;
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

  @media (max-width: 648px) {
    .nav-list {
      display: flex;  
    }

    .search-bar {
      flex: 1; 
      margin-left: 20px;  
    }

    .search-bar input {
      width: 100%;  
    }

    .search-bar button { 
      padding: 8px 5px;
    }
  }
  @media (max-width: 500px) {
    .nav-list {
      flex-direction: column;  
      gap: 10px;  
    }
    .search-bar button{ 
      flex-direction: column;  
      gap: 10px;  
    }
  }
</style>
