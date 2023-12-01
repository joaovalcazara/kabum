import axios from 'axios';
//var host = import.meta.env.VITE_HOST;
var host = "http://localhost/KABUM/back/api";



export const cadastarUser = async (user) => { 
     try {
        let res = await axios.post('http://localhost/KABUM/back/api/usuarios.php', user, {
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
       let res = await axios.post('http://localhost/KABUM/back/api/usuarios.php', user, {
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