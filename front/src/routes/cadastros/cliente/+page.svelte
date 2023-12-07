<script>
  import { onMount } from "svelte";
  import { serviceGetCliente, serviceCadastrarCliente } from "../../../services/cliente.js";
  import { imask, MaskedInput } from 'svelte-imask';

  let cliente = {
    endereco: [],
    idCliente: null,
 
  }; 

  const cpfMask = { 
		mask: '000.000.000-00' 
	};
 
   onMount(async () => {
    if (sessionStorage.getItem('idCliente')) {
      let idCliente = JSON.parse(sessionStorage.getItem('idCliente'));
      getCliente(idCliente);
      if(cliente.endereco == null){
          cliente.endereco = [];
        }   
  
     } 
  });

  const getCliente = async (idCliente) => {
    cliente = await serviceGetCliente(idCliente);
  };

  const verificaCamposObrigatorios = () => {
    const camposNaoPreenchidos = [];

    // Verifica cada campo obrigatório
    if (!cliente.Nome || cliente.Nome.trim() === '') {
        camposNaoPreenchidos.push('Nome');
    }
    if (!cliente.Data_Nascimento || cliente.Data_Nascimento.trim() === '') {
        camposNaoPreenchidos.push('Data de Nascimento');
    }
    if (!cliente.Cpf || cliente.Cpf.trim() === '') {
        camposNaoPreenchidos.push('CPF');
    }
    if (!cliente.Rg || cliente.Rg.trim() === '') {
        camposNaoPreenchidos.push('RG');
    }
    if (!cliente.Telefone || cliente.Telefone.trim() === '') {
        camposNaoPreenchidos.push('Telefone');
    }

    if (cliente.endereco.length > 0) {
        cliente.endereco.forEach((endereco, index) => {
          const camposEnderecoNaoPreenchidos = [];

          let flag = false;
            if (!endereco.Cep || endereco.Cep.trim() === '') {
              camposEnderecoNaoPreenchidos.push('CEP');
                flag= true;
            }
            if (!endereco.Logradouro || endereco.Logradouro.trim() === '') {
              camposEnderecoNaoPreenchidos.push('Logradouro');
                flag= true;
            }
            if (!endereco.Numero || endereco.Numero.trim() === '') {
              camposEnderecoNaoPreenchidos.push('Número');
                flag= true;
            }
            if (!endereco.Complemento || endereco.Complemento.trim() === '') {
              camposEnderecoNaoPreenchidos.push('Complemento');
                flag= true;
            }
            if (!endereco.Bairro || endereco.Bairro.trim() === '') {
                camposEnderecoNaoPreenchidos.push('Bairro');
                flag= true;
            }
            if (!endereco.Cidade || endereco.Cidade.trim() === '') {
                camposEnderecoNaoPreenchidos.push('Cidade');
                flag= true;
            }
            if (!endereco.Estado || endereco.Estado.trim() === '') {
                camposEnderecoNaoPreenchidos.push('Estado');
                flag= true;
            }
           
           
 
            if(flag){
               camposNaoPreenchidos.push(`Endereço ${index + 1}: ${camposEnderecoNaoPreenchidos.join(', ')}`); 
            }
         });
    }


    if (camposNaoPreenchidos.length > 0) {
        alert(`Campos obrigatórios não preenchidos: ${camposNaoPreenchidos.join(', ')}`);
        return false;
    }

   

    return true;
};



const cadastrar = async () => {
    if (verificaCamposObrigatorios()) {
        if (cliente.idCliente != null) {
            cliente.acao = "atualizar";
        } else {
            cliente.acao = "cadastrar";
        }

        try {
            let res = await serviceCadastrarCliente(cliente);

            if (res) {
                 mostrarMensagemSucesso(cliente.acao === "cadastrar" ? "Cliente cadastrado com sucesso!" : "Cliente atualizado com sucesso!"); 
                 sessionStorage.removeItem('idCliente');
                 sessionStorage.setItem('idCliente', JSON.stringify(res.data.idCliente)); 
                // window.location.reload();
            }
        } catch (error) {
             mostrarMensagemErro(`Erro ao cadastrar/atualizar cliente: ${error.message}`);
        }
    }
};

 
 const mostrarMensagemSucesso = (mensagem) => {
     alert(mensagem);
};

// Função para mostrar mensagem de erro
const mostrarMensagemErro = (mensagem) => {
     alert(mensagem);
};


  const adicionarEndereco = () => {
    let novo_endereco = {
      idCliente: null,
      Logradouro: null,
      Numero: null,
      Complemento: null,
      Bairro: null,
      Cidade: null,
      Estado: null,
      Cep: null,
    };
    cliente.endereco = [...cliente.endereco, novo_endereco];
  };

  const removeEndereco = (i) => {
    const shouldRemove = window.confirm("Tem certeza que deseja remover este endereço?");
    
    if (shouldRemove) {
        cliente.endereco.splice(i, 1);
        cliente.endereco = [...cliente.endereco];  
    }
};


  const buscarEnderecoPorCEP = async (cep, index) => {
    console.log(index)
    cep = cep.replace(/\D/g, ''); // Remove caracteres não numéricos

    // Verifica se o CEP tem o formato correto
    if (cep.length !== 8) {
      alert('CEP inválido. Informe um CEP com 8 dígitos.');
      return;
    }

    // Faz a requisição a API de consulta de CEP 
    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    const data = await response.json();
     if (!data.erro) {
      cliente.endereco[index].Logradouro = data.logradouro ;
      cliente.endereco[index].Numero = '';
      cliente.endereco[index].Complemento = data.complemento || '';
      cliente.endereco[index].Bairro = data.bairro || '';
      cliente.endereco[index].Cidade = data.localidade || '';
      cliente.endereco[index].Estado = data.uf || '';

     } else {
      alert('CEP não encontrado. Verifique se o CEP está correto.');
    }
   
  };
</script>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro de novo cliente</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</head>
<body>
  <nav class="navbar">
    <ul class="nav-list">
      <li><a href="/home">Voltar</a></li>
    </ul>
  </nav> 
  <div class="tela">
		<main role="main" id="main" class="col  bg-light pt-4 pl-0 pl-md-4 pr-md-4 pl-pr-4 pr-0 mb-4">
          <div class="col-12 col-md-12 text-center text-md-left" style="margin-bottom: 20px;">
            <h1 class="text-secondary  h4 font-weight-bold ">
              <div class="text-cadastro">Cadastro/Edição de Cliente</div>
            </h1>
        </div> 
         <section>
             <div class="row"> 
              <div class="col-12 col-md-4"> 
                <div class="form-group form-outline">
                  <label class="form-group form-outline" for="Nome" >Nome*</label>
                  <input bind:value={cliente.Nome} id="Nome" type="text"   class="form-control form-control-lg">
                </div>
              </div>
                <div class="col-12 col-md-4">
                  <div class="form-group form-outline"> 
                    <label class="form-group form-outline" for="Data_Nascimento">Data Nascimento*</label>
                    <input bind:value={cliente.Data_Nascimento} id="Data_Nascimento" type="Date"  class="form-control form-control-lg">
                  </div> 
                </div>
                <div class="col-12 col-md-4"> 
                  <div class="form-group form-outline">
                    <label class="form-group form-outline" for="cpf">CPF*</label>
                    <input  use:imask={cpfMask}   bind:value={cliente.Cpf} id="cpf" type="text"   class="form-control form-control-lg"  >
                  </div>
                </div>
             </div>
             <div class="row">
                <div class="col-12 col-md-4"> 
                  <div class="form-group form-outline">
                    <label class="form-group form-outline" for="rg">Rg*</label>
                    <input bind:value={cliente.Rg} id="rg" type="text"   class="form-control form-control-lg"  >
                  </div>
                </div>
                <div class="col-12 col-md-4"> 
                  <div class="form-group form-outline">
                    <label class="form-group form-outline" for="rg">Telefone*</label>
                    <input bind:value={cliente.Telefone} id="Telefone" type="text"   class="form-control form-control-lg"  >
                  </div>
                </div>
             </div>
        </section> 
        <section style="margin-top: 20px;"> 
             {#each cliente.endereco as end, i } 
            <div class="row"> 
              <div class="col-12 col-md-4"  style="margin-bottom: 20px; margin-top: 10px;">
                <h1 class="text-secondary label-texto-cadastro h4 font-weight-bold mr-0 mr-md-5 mb-3 mb-md-4 mb-lg-0">
                  <div class="text-cadastro">Endereço {i+1}          
                    <button  type="button" on:click={() => removeEndereco(i)} class="btn btn-danger btn-sm btnRemoverResponsavel">X</button> 
                  </div> 
                </h1>
              </div>   
            </div>
            <div class="row"> 
              <div class="col-12 col-md-4">
                <div class="form-group form-outline">
                  <label for="CEP">CEP*</label>
                  <input bind:value={end.Cep} id="CEP" type="text" class="form-control form-control-lg" on:blur={() => buscarEnderecoPorCEP(cliente.endereco[i].Cep, i)}>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group form-outline">
                  <label for="Logradouro">Logradouro*</label>
                  <input bind:value={end.Logradouro} id="Logradouro" type="text" class="form-control form-control-lg">
                </div>
              </div>
              
              <div class="col-12 col-md-4">
                <div class="form-group form-outline">
                  <label for="Numero">Número*</label>
                  <input bind:value={end.Numero} id="Numero" type="number" class="form-control form-control-lg">
                </div>
              </div>
              
              <div class="col-12 col-md-4">
                <div class="form-group form-outline">
                  <label for="Complemento">Complemento*</label>
                  <input bind:value={end.Complemento} id="Complemento" type="text" class="form-control form-control-lg">
                </div>
              </div>
              
              <div class="col-12 col-md-4">
                <div class="form-group form-outline">
                  <label for="Bairro">Bairro*</label>
                  <input bind:value={end.Bairro} id="Bairro" type="text" class="form-control form-control-lg">
                </div>
              </div>
              
              <div class="col-12 col-md-4">
                <div class="form-group form-outline">
                  <label for="Cidade">Cidade*</label>
                  <input bind:value={end.Cidade} id="Cidade" type="text" class="form-control form-control-lg">
                </div>
              </div>
              
              <div class="col-12 col-md-4">
                <div class="form-group form-outline">
                  <label for="Estado">Estado*</label>
                  <input bind:value={end.Estado} id="Estado" type="text" class="form-control form-control-lg">
                </div>
              </div>
              
              <div class="col-12 col-md-2">
                <div class="form-group form-outline">
                </div>
            </div>
            </div>
           
        {/each} 
       </section> 
      <div class="d-flex justify-content-center" style="margin-top: 10px;">
        <button type="button" on:click={() => adicionarEndereco()} class="btn btn-sm btn-outline-info pt-2 pb-2 border-dashed mr-2">Adicionar Endereço</button>
        <button type="button" on:click={() => cadastrar()} class="btn btn-primary text-white pt-2 pb-2">Salvar</button> 
      </div>
      
      
      </main>
      
    </div>
 </body>


<style  > 

  body {
    margin: 0;
    padding: 0;
    font-family: "Arial", sans-serif;
  }
 
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #0060b1;
    color: white;
    padding: 10px 20px;
  }

  .nav-list {
    list-style: none;
   }

  .nav-list a {
    text-decoration: none;
    color: white;
   }

   .tela {
    width: 80vw;  
    max-width: 1200px;  
    margin: 0 auto;  
  }

 

  
</style>
