<script>
  import { goto } from "$app/navigation";
  import { login } from "../../services/user.js";
  import { onMount } from "svelte";

  let loading = false;
  let usuario = {};

  onMount(async () => {
    if (sessionStorage.getItem("user")) goto("/home");
  });

  const logar = async () => {
    usuario.acao = "login";
    loading = true;
    try {

      let returnLogin = await login(usuario);
      if (returnLogin.status == 200) {
        var userReturn = {
          Nome: returnLogin?.data?.Nome,
          Email: returnLogin?.data?.Email,
          id: returnLogin?.data?.idUsuario,
        };
        console.log(returnLogin);
        sessionStorage.setItem("user", JSON.stringify(userReturn));
        setTimeout(() => {
          goto("/home");
        }, 2000);
      }
    }finally {
      loading = false;
    }
  };
</script>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
</head>
<body>
  <div class="page">
    
    <form class="formLogin"> 
      <h1>Login</h1>  
      <p>Digite os seus dados de acesso no campo abaixo.</p>
      <label for="email">E-mail</label>
      <input
        type="email"
        placeholder="Digite seu e-mail"
         bind:value={usuario.email}
        required
      />
      <label for="password">Senha</label>
      <input
        type="password"
        placeholder="Digite sua senha"
        bind:value={usuario.senha}
        required
      />
       <button class="btn" value="Acessar" on:click={()=>logar()}  >
        Acessar
       </button>
       <a class="botao-cadastrar" href="/cadastros/usuario">Não tem cadastro? Cadastrar agora</a>

    </form>
  </div>
</body>

 
<style>
  @import url("https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap");

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
    background-color: #7532e2;
  }

  .formLogin {
    display: flex;
    flex-direction: column;
    background-color: #fff;
    border-radius: 7px;
    padding: 40px;
    box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.4);
    gap: 5px;
  }

  .areaLogin img {
    width: 420px;
  }

  .formLogin h1 {
    padding: 0;
    margin: 0;
    font-weight: 500;
    font-size: 2.3em;
  }

  .formLogin p {
    display: inline-block;
    font-size: 14px;
    color: #666;
    margin-bottom: 25px;
  }

  .formLogin input {
    padding: 15px;
    font-size: 14px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    margin-top: 5px;
    border-radius: 4px;
    transition: all linear 160ms;
    outline: none;
  }

  .formLogin input:focus {
    border: 1px solid #f58220;
  }

  .formLogin label {
    font-size: 15px;
  }

  .formLogin a {
    display: inline-block;
    margin-bottom: 20px;
    font-size: 13px;
    color: #555;
    transition: all linear 160ms;
  }

 

  .btn {
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

  .btn:hover {
    transform: scale(1.05);
    background-color: #e99a55;
  }
</style>
