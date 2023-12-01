
<script>
     const goToLogin = () => {
   
  };
</script>

<svelte:head>
    <link rel="shortcut icon" href="/geo-alt.svg" >
    <title>Administração Kabum</title> 
</svelte:head>
 
  <main>
    <header>
        <a href="/login">Ir para Login</a>
    </header>
  
    <div class="carousel">
      <img src="kabum1.jpeg" alt="Imagem 1" />
      <img src="kabum1.jpeg" alt="Imagem 1" />

      <img src="kabum1.jpeg" alt="Imagem 1" />
      <img src="kabum1.jpeg" alt="Imagem 1" />
      <img src="kabum1.jpeg" alt="Imagem 1" />
      <img src="kabum1.jpeg" alt="Imagem 1" />

       <!-- Adicione mais imagens conforme necessário -->
    </div>
  </main>


  
  <style>
  header {
      background-color: #0060b1;
      padding: 1rem;
      text-align: center;
    }
  
    a {
      background-color: #f58220;
      color: white;
      padding: 0.5rem;
      cursor: pointer;
    }
  
    /* Estilos do carrossel (altere conforme necessário) */
    .carousel {
      display: flex;
      overflow-x: scroll;
      scroll-snap-type: x mandatory;
    }
  
    .carousel img {
      scroll-snap-align: center;
      max-width: 100%;
      height: auto;
    }
  </style>