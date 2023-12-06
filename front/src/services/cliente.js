import axios from 'axios';
var host = import.meta.env.VITE_HOST;

//const host = "http://localhost/KABUM/back/api";

export const serviceGetClientes = async () => { 
    try {
        let res = await axios.get(`${host}/clientes.php`, {
            params: {
                acao: "listarClientes"
            } ,
            withCredentials: true  
        });

        // Se você achar necessário desconverter manualmente
         return res.data;
    } catch (error) {
        console.error("Erro ao obter clientes:", error);
        throw error;  
    }
};

export const serviceGetCliente = async (idCliente) => {
    try {
        // Utilizando axios.get corretamente
        let res = await axios.get(`${host}/clientes.php`, {
            params: {
                acao: "getCliente",
                idCliente: idCliente  
            },
            withCredentials: true  
        });
        return res.data;
    } catch (error) {
        console.error("Erro ao obter clientes:", error);
        throw error;
    }
};


export const serviceCadastrarCliente = async (cliente) => { 
        if(cliente.acao == "cadastrar"){ 
            try {
                let res = await axios.post(`${host}/clientes.php`, cliente, {
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    withCredentials: true  
                });
                return res
            } catch (error) {
                console.error('Error post:', error);
            }
    }else{
        try {
            let res = await axios.put(`${host}/clientes.php`, cliente, {
                headers: {
                'Content-Type': 'application/json'
                },
                withCredentials: true  
            });
            return res;
            } catch (error) {
            console.error('Erro na requisição PUT:', error);
            throw error; // Rejeita a Promise com o erro para quem chamou a função
            }
        
        }
       
   
}; 
export const serviceDeleteCliente = async (idCliente) => {
     try {
      const res = await axios.delete(`${host}/clientes.php`, {
        data: {
          idCliente: idCliente,
        },
      });
  
      if (res.data.success) {
        return true;
      } else {
        return false;
      }
    } catch (error) {
      console.error("Erro ao deletar cliente:", error);
      throw error;
    }
  };

 

