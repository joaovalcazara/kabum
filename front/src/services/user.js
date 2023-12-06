import axios from 'axios';
var host = import.meta.env.VITE_HOST;
//var host = "http://localhost/KABUM/back/api";



export const cadastarUser = async (user) => { 
     try {
        let res = await axios.post(host+'/usuarios.php', user, {
            headers: {
                'Content-Type': 'application/json'
            }
        });
       return res
    } catch (error) {
        console.log("cadastro: "+ error);
        return error.response
    }
};

export const login = async (user) => { 
    try {
        let res = await axios.post(host+'/usuarios.php', user, {
            headers: {
                'Content-Type': 'application/json',
            },
            withCredentials: true  
        });
        return res;
    } catch (error) {
        console.log("cadastro: " + error);
        return error.response;
    }
};


export const serviceLogout = async () => {
    try {
       const res = await axios.post(`${host}/logout.php`);
       sessionStorage.removeItem('user');
       window.location.href = '/login'; 
      if (res.data.success) {
         
       } else {
        return false;
      }
    } catch (error) {
      console.error("Erro ao fazer logout:", error);
      throw error;
    }
  };
  