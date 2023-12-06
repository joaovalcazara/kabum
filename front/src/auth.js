export const isAuthenticated = () => {
    if (typeof window !== 'undefined' && sessionStorage.getItem('user')) {
      return true;
    }
  
     if (typeof window !== 'undefined' && window.location.pathname !== '/login') {
      window.location.href = '/login';
    }
  
    return false;
  };
  