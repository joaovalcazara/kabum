<script>
    import { isAuthenticated } from '../auth';
  
    // Check authentication on layout load
    isAuthenticated();
  </script>
  
 
  <main>
    <slot />
  </main>
  
  <style>
    /* Your layout styles here */
  </style>