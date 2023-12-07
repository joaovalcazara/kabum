<script>
   import { cadastarUser} from '../../../services/user.js';


    let userCadastro = {}
    let returnCadastro

    const cadastrar = async () => {
      returnCadastro = null
      userCadastro.acao = "cadastrar";
      returnCadastro = await cadastarUser(userCadastro);

    };


  </script>
  
 
  <body> 
    <div class="page">
      <form class="formCadastrar">
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