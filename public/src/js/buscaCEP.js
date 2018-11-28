
 // Registra o evento blur do campo "cep", ou seja, quando o usuário sair do campo "cep" faremos a consulta dos dados
 $("#inputCep").blur(function(){

     // Remove todas as mascaras
     var cep = this.value.replace(/[^0-9]/, "");

     // Aki utilizo o webservice "viacep.com.br" para buscar as informações do CEP fornecido pelo usuário.
     // A url consiste no endereço do webservice ("http://viacep.com.br/ws/"), mais o cep que o usuário
     // informou e também o tipo de retorno que desejamos, podendo ser "xml", "piped", "querty" ou o que
     // iremos utilizar, que é "json"
     var url = "http://viacep.com.br/ws/"+cep+"/json/";

     // Aqui fazemos uma requisição ajax ao webservice, tratando o retorno com try/catch para que caso ocorra algum
     // erro (o cep pode não existir, por exemplo) o usuário não seja afetado, assim ele pode continuar preenchendo os campos
     $.getJSON(url, function(dadosRetorno){
         try{

             var erro = dadosRetorno.erro;
             console.log(erro);
             if (!erro) {
                 // Insere os dados em cada campo
                 $("#inputCidade").val(dadosRetorno.localidade)
                 $("#inputEstado").val(dadosRetorno.uf);
                 $("#inputRua").val(dadosRetorno.logradouro);
                 $("#inputBairro").val(dadosRetorno.bairro);

             } else {
                 console.log("Algo de  errado aconteceu");
             }
         }catch(ex){
             console.log("aff deu muito ruim");
         }
     });
 });
