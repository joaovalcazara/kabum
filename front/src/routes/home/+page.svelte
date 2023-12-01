 
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciamento Kabum</title>
 </head>
<body>

  <nav class="navbar">
     <img>
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
    <h2>Clientes Cadastrados</h2>
  
    <!-- Verifica se há clientes cadastrados -->
    <ul>
      <!-- Exemplo de cliente cadastrado -->
      <li>Nome do Cliente 1</li>
      <li>Nome do Cliente 2</li>
 
      <li class="empty-message">Nenhum cliente cadastrado no momento.</li>
    </ul>
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

/* ... (estilos do navbar) ... */

.client-list {
  max-width: 800px;
  margin: auto;
  padding: 20px;
}

.client-list h2 {
  font-size: 18px;
  margin-bottom: 10px;
}

.client-list ul {
  list-style: none;
  padding: 0;
}

.client-list li {
  margin-bottom: 8px;
}

.client-list .empty-message {
  color: #777;
  font-style: italic;
}

/* ... (restante dos estilos) ... */


</style>
 
