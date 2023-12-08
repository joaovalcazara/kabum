<script>
   import { cadastrarUsuario} from '../../../services/user.js';
   import { goto } from "$app/navigation";


    let userCadastro = {}
    let returnCadastro

    const cadastrar = async () => {
    const camposNaoPreenchidos = verificaCamposObrigatorios();

    if (camposNaoPreenchidos.length > 0) {
      const mensagem = `Campos não preenchidos: ${camposNaoPreenchidos.join(', ')}`;
      alert(mensagem);
      return;
    }

    try {
      userCadastro.acao = "cadastrar";
      const returnCadastro = await cadastrarUsuario(userCadastro);
      console.log(returnCadastro)
      if (returnCadastro.data.idUsuario == -1) {
        alert("E-mail já cadastrado!");
      } else if (returnCadastro.data.idUsuario) {
        alert("Cadastro realizado com sucesso!");
        goto("/login");

        
      } else {
        alert(`Erro no cadastro: ${returnCadastro.message}`);
      }
    } catch (error) {
      console.error("Erro inesperado:", error);
      alert("Ocorreu um erro durante o cadastro. Por favor, tente novamente.");
    }
  };
  const verificaCamposObrigatorios = () => {
    const camposNaoPreenchidos = [];

    // Verifica cada campo obrigatório
    if (!userCadastro.nome || userCadastro.nome.trim() === '') {
      camposNaoPreenchidos.push('Nome');
    }
    if (!userCadastro.email || userCadastro.email.trim() === '') {
      camposNaoPreenchidos.push('Email');
    }
    if (!userCadastro.senha || userCadastro.senha.trim() === '') {
      camposNaoPreenchidos.push('Senha');
    }

    return camposNaoPreenchidos;
  };
</script>


 
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastrar usuário</title>
  </head>
 
  <body> 
    <div class="page">
      <form class="formCadastrar">
        <a href="/login">Voltar</a>
        <h1>Cadastro de usuário</h1>

        <label for="nome">Nome:</label>
        <input type="text" id="nome" bind:value={userCadastro.nome} required />
    
        <label for="email">Email:</label>
        <input type="email" id="email" bind:value={userCadastro.email} required />
    
        <label for="senha">Senha:</label>
        <input type="password" id="senha" bind:value={userCadastro.senha} required />
    
        <button on:click={() => cadastrar()}>Cadastrar</button>
 
      </form>
    </div>
  </body>
  

  <style>
    /* Adicione estilos conforme necessário */
    body {
    font-family: "Inter", sans-serif;
    margin: 0;
    padding: 0;
    color: #023047;
  }
  .page {
    display: flex;
    flex-direction: column;
    align-items: center;
    align-content: center;
    justify-content: center;
    width: 100%;
    height: 100vh;
    background-color: #ffffff;
  }

  .formCadastrar {
    display: flex;
    flex-direction: column;
    background-color: #fff;
    border-radius: 7px;
    padding: 40px;
    box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.4);
    gap: 5px;
  }
  .formCadastrar h1 {
    padding: 0;
    margin: 0;
    font-weight: 500;
    font-size: 2.3em;
  }

  .formCadastrar input {
    padding: 15px;
    font-size: 14px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    margin-top: 5px;
    border-radius: 4px;
    transition: all linear 160ms;
    outline: none;
  }
   
  
  button {
    background-color: #f58220;
    color: #ffffff;
    font-size: 14px;
    font-weight: 600;
    border: none !important;
    transition: all linear 160ms;
    cursor: pointer;
    margin: 0 !important;
    padding: 15px 30px; /* Ajuste o tamanho conforme necessário */

  }
  
  button:hover {
    transform: scale(1.05);
    background-color: #e99a55;
  }
  </style>