function escolherArquivo(event,index){
  event.preventDefault();
  document.getElementById('fileUpload'+index).click();
}
function enviarArquivo(index)
{
    
    var formData = new FormData(document.getElementById('formImage'+index));
    console.log(index);
    $.ajax({
        url:window.urlApi.arquivo,
        type: 'POST',
        data: formData,
        success: function(data) {
          console.log(index);
          if(document.getElementById('fotosEnviadas'+index).value == '')
          {
            let json = {fotos:[]};
            json.fotos.push(data);
            document.getElementById('foto1_'+index).src="http://"+data;
            document.getElementById('fotosEnviadas'+index).value=JSON.stringify(json);
          }
          else
          {
            json =  document.getElementById('fotosEnviadas'+index).value;
            json = JSON.parse(json);
            document.getElementById('foto'+(json.fotos.length+1)+'_'+index).src="http://"+data;
            json.fotos.push(data);
            document.getElementById('fotosEnviadas'+index).value=JSON.stringify(json);

          }
          
        },
        contentType: false,
        processData: false,
    });
    
}
function salvarArquivo(index){
  enviarArquivo(index);
}
function listenInputFileUpload(index){
  $("#fileUpload"+index).change(function() {
    document.getElementById('fotos_label'+index).innerText = document.getElementById("fileUpload"+index).value;
  });
  
}
function createFormArquivo(index){
  return `
    <form id=${"formImage"+index} style="display:none">
      <input type="file" id=${"fileUpload"+index} name="fileUpload" >
   </form>
   `;
   
}

function createCarouselFotos(index){
  return `
<div id=${"galeriaImagens"+index} class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
      <li data-target=${"#galeriaImagens"+index} data-slide-to="0" class="active"></li>
      <li data-target=${"#galeriaImagens"+index} data-slide-to="1"></li>
      <li data-target=${"#galeriaImagens"+index} data-slide-to="2"></li>
      <li data-target=${"#galeriaImagens"+index} data-slide-to="3"></li>
      <li data-target=${"#galeriaImagens"+index} data-slide-to="4"></li>
      <li data-target=${"#galeriaImagens"+index} data-slide-to="5"></li>

  </ol>
  <div class="carousel-inner">
      <div class="carousel-item active">
          <img class="d-block w-100" id=${'foto1_'+index} src="../src/img/imagem-1.svg" alt="First slide">
      </div>

      <div class="carousel-item">
          <img class="d-block w-100" id=${'foto2_'+index} src="../src/img/imagem-2.svg" alt="Second slide">
      </div>

      <div class="carousel-item">
          <img class="d-block w-100" id=${'foto3_'+index} src="../src/img/imagem-3.svg" alt="Third slide">
      </div>

      <div class="carousel-item">
          <img class="d-block w-100" id=${'foto4_'+index} src="../src/img/imagem-4.svg" alt="Third slide">
      </div>

      <div class="carousel-item">
          <img class="d-block w-100" id=${'foto5_'+index} src="../src/img/imagem-5.svg" alt="Third slide">
      </div>

      <div class="carousel-item">
          <img class="d-block w-100" id=${'foto6_'+index} src="../src/img/imagem-3.svg" alt="Third slide">
      </div>
  </div>
  <a class="carousel-control-prev" href=${"#galeriaImagens"+index} role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href=${"#galeriaImagens"+index} role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
  </a>
</div>
  `;
}

function createInputTipoAnuncio(){
	return `
    <div class="row">
      <label class="col-lg-12">
            Tipo Anuncio:
        </label>
    </div>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-light btn-sm active">
            <input type="radio" name="tipoAnuncio" value='Alugar' autocomplete="off" checked>Alugar
        </label>
        <label class="btn btn-light btn-sm">
            <input type="radio" name="tipoAnuncio" value='Venda' autocomplete="off">Vender
        </label>
    </div>
	`;
}
function createInputDataConstrucao(index){
	return `
	  <label for="cadastrar_imovel_data">Data de Construção:</label>
    <input id=${'cadastrar_imovel_data'+index} class="form-control form-control-sm" type="date" name='dataConstrucao'>
  `;
}
function createInputArea(index){
  return `
    <label for="cadastrar_imovel_area">Área:</label>
    <input id=${'cadastrar_imovel_area'+index} class="form-control form-control-sm" type="number" min="0" name='area' placeholder="Área em M²">
  `;
}
function createInputQtdVagasGaragem(index){
  return `

    <label for="cadastrar_imovel_nro_vaga_garagem">Vagas de Garagem:</label>
    <input id=${'cadastrar_imovel_nro_vaga_garagem'+index} type="number" min="0" class="form-control form-control-sm" name='qtdVagasGaragem'>

  `;
}
function createInputQtdSalaJantar(index){
  return `
    <label for="cadastrar_imovel_qtd_sala_jantar">Quantidade de Sala de Jantar:</label>
    <input id=${'cadastrar_imovel_qtd_sala_jantar'+index} type="number" min="0" class="form-control form-control-sm" name='qtdSalaJantar'>
  `;
}
function createInputQtdSalaEstar(index){
  return `
    <label for="cadastrar_imovel_qtd_sala_estar">Sala de Estar:</label>
    <input id=${'cadastrar_imovel_qtd_sala_estar'+index} type="number" min="0" class="form-control form-control-sm" name='qtdSalaEstar'>
  `;
}
function createInputQtdSuites(index){
  return `
    <label for="cadastrar_imovel_qtd_suite">Suítes:</label>
    <input id=${'cadastrar_imovel_qtd_suite'+index} type="number" min="0" class="form-control form-control-sm" name='qtdSuites'>
  `;
}
function createInputQtdQuartos(index){
  return `
    <label for="cadastrar_imovel_qtd_quartos">Quartos:</label>
    <input id=${'cadastrar_imovel_qtd_quartos'+index}  type="number" min="0" class="form-control form-control-sm" name='qtdQuartos'>
  `;
}
function createInputArmarioEmbutido(){
  return `
  <div class="row">
    <label class="col-md-12">
        Armario Embutido:
    </label>
  </div>
  <div class="btn-group btn-group-toggle" data-toggle="buttons">
    <label class="btn btn-light btn-sm active">
        <input type="radio" name="armarioEmbutido" value='1' autocomplete="off" checked>Sim
    </label>
    <label class="btn btn-light btn-sm">
        <input type="radio" name="armarioEmbutido" value='0' autocomplete="off">Nao
    </label>
  </div>
  `;
}
function createInputTipoImovel(){
  return `
  <div class="row">
  <label class="col-md-12">
      Tipo de Imóvel:
  </label>
</div>

<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-light btn-sm active" onclick="$('.cadastrar_imovel_apartamento').collapse('hide');">
      <input type="radio" name="tipoImovel"  value='Casa' autocomplete="off" checked>Casa
  </label>
  <label class="btn btn-light btn-sm" onclick="$('.cadastrar_imovel_apartamento').collapse('show');">
      <input type="radio" name="tipoImovel"  value='Apartamento' autocomplete="off">Apartamento
  </label>
</div>
  `
}
function createInputAndar(){
  return `
  <label for="cadastrar_imovel_nro_andar">Andar:</label>
  <input type="number" min="0" class="form-control form-control-sm" name='andar'>
  `;
}
function createInputValorCondominio(){
  return`
  <label for="cadastrar_imovel_valor_condominio">Valor de condomínio:</label>
  <input type="number" min="0" class="form-control form-control-sm" name='valorCondominio'>
  `;
}
function createInputDescricao(index){
  return `
  <label for="cadastrar_imovel_descricao">Descrição:</label>
  <textarea id=${'cadastrar_imovel_descricao'+index} class="form-control form-control-sm" name='descricao'></textarea>
  `
}
function createInputPorteiro24h(){
  return`
  <div class="row">
  <label class="col-md-12">
      Apartamento tem Porteiro 24h:
  </label>
</div>

<div class="btn-group btn-group-toggle" data-toggle="buttons">
  <label class="btn btn-light btn-sm active">
      <input type="radio" name="porteiro24h" value='1' autocomplete="off" checked>Sim
  </label>
  <label class="btn btn-light btn-sm">
      <input type="radio" name="porteiro24h" value='0' autocomplete="off">Nao
  </label>
</div>
  `;
}
function createInputCpfCliente(){
  return `
  <label for="cadastrar_imovel_descricao">Selecionar Cliente:</label>
  <select class="form-control form-control-sm" name='cpfCliente'><option value='12'>a2</option></select>
  `;
}
function createInputValorImovel(index){
  return `
  <label for="valor">Valor do Imóvel:</label>
  <div class="input-group input-group-sm mb-3">
      <div class="input-group-prepend">
          <span class="input-group-text" >R$</span>
      </div>

      <input id=${'valor'+index} type="number" name='valorImovel'class="form-control form-control-sm" min="0"  placeholder="0,00">
  </div>
  `;
}
function createBtAdicionar(index){
  return `
    <input type="submit" class="center_block btn btn-success"  value="Adicicionar">
  `;
}
function createModalCadastrarImovel(elemento,index,method,adiciona){
		console.log(elemento);
        elemento.innerHTML = `

        <div class="modal fade" id=${"cadastrarImovel"+index} tabindex="-1" role="dialog" aria-labelledby="Imovel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" >Cadastrar Imovel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="container fundo" action=${window.urlApi.imovel} method='${method}'>
                        <div class="form-row">
                            <div class="form-group col-md-3">                               
                                ${createInputTipoAnuncio(index)}
                            </div>

                            <div class="form-group col-md-5">
                                ${createInputArea(index)}
                            </div>

                            <div class="form-group col-md-4">
                                ${createInputDataConstrucao(index)}
                            </div>
                        </div>

                        <div id=${"formEndereco"+index}></div>

                        <div class="form-row">                           
                              <div class="form-group col-md-4" >
                                  ${createInputQtdVagasGaragem(index)}
                              </div>
                              <div class="form-group col-md-4">
                                  ${createInputQtdSalaJantar(index)}
                              </div>                              
                              <div class="form-group col-md-4">
                                  ${createInputQtdSalaEstar(index)}
                              </div>
                          </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                ${createInputQtdSuites(index)}
                            </div>
                            <div class="form-group col-md-3">
                              ${createInputQtdQuartos(index)}
                            </div>
                            <div class="form-group col-md-3">                                
                              ${createInputArmarioEmbutido(index)}
                            </div>
                            <div class="form-group col-md-3">                               
                              ${createInputTipoImovel(index)}
                            </div>
                        </div>
                        <div class="form-row collapse cadastrar_imovel_apartamento">
                            <div class="form-group col-md-4">
                                ${createInputAndar(index)}
                            </div>
                            <div class="form-group col-md-4">
                                ${createInputValorCondominio(index)}
                            </div>
                            <div class="form-group col-md-4">                                
                              ${createInputPorteiro24h(index)}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8">
                              ${createInputCpfCliente(index)}
                            </div>
                            <div class="form-group col-md-4">
                                ${createInputValorImovel(index)}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                ${createInputDescricao(index)}
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary" type="button" onClick="salvarArquivo('${index}')">Enviar</button>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id=${'fotos'+index} onClick="escolherArquivo(event,'${index}');"value='fotos'>
                                    <label class="custom-file-label" for=${'fotos'+index} id=${'fotos_label'+index}>adicionar fotos ao Imóvel</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for=${'fotosEnviadas'+index}>Fotos:</label>
                                <textarea class="form-control form-control-sm" name='fotos' id=${'fotosEnviadas'+index} disabled></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-12">
                          ${createCarouselFotos(index)}    
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-12">
                                ${adiciona==true ? createBtAdicionar(index): ""}
                            </div>
                        </div>
                    </form>
                    ${createFormArquivo(index)}

            </div>
        </div>
        </div>


        `;
        loadClientesInModalCadastrar();
        listenInputFileUpload(index);
       
}
function showModalCadastrarImovel(index){
	$('#cadastrarImovel'+index).modal('show');
}
function openModalById(id,index){
	$('#cadastrar_imovel_area'+index)[0].value=window.imoveis[id].area;
	$('#cadastrar_imovel_data'+index)[0].value=window.imoveis[id].dataConstrucao;
	$('#cadastrar_imovel_nro_vaga_garagem'+index)[0].value=window.imoveis[id].qtdVagasGaragem;
	$('#cadastrar_imovel_qtd_sala_jantar'+index)[0].value=window.imoveis[id].qtdSalaJantar;
	$('#cadastrar_imovel_qtd_sala_estar'+index)[0].value=window.imoveis[id].qtdSalaEstar;
	$('#cadastrar_imovel_qtd_suite'+index)[0].value=window.imoveis[id].qtdSuites;
	$('#cadastrar_imovel_qtd_quartos'+index)[0].value=window.imoveis[id].qtdQuartos;
	$('#valor'+index)[0].value=window.imoveis[id].valorImovel;
  $('#cadastrar_imovel_descricao'+index)[0].value=window.imoveis[id].descricao;
  for(i=0;i<window.imoveis[id].fotos.length;i++)
  {
    document.getElementById('foto'+(i+1)+'_'+index).src="http://"+window.imoveis[id].fotos[i];
  }
  

	$('.cep')[1].value = window.imoveis[id].Endereco.cep;
  $('.cidade')[1].value = window.imoveis[id].Endereco.cidade;
  $('.uf')[1].value = window.imoveis[id].Endereco.estado;
  $('.rua')[1].value = window.imoveis[id].Endereco.rua;
  $('.numero')[1].value = window.imoveis[id].Endereco.numero;
  $('.bairro')[1].value = window.imoveis[id].Endereco.bairro;       	
  window.id = id;
  $('#cadastrarImovel'+index).modal("show");
}
function loadClientesInModalCadastrar(){
	$.ajax({
        url:window.urlApi.cliente,
        type:"GET",
        dataType:"json",

        success: function(result) {
        	
        	let html = "";
        	result.forEach((cliente, index) => {
        		html += `<option value=${cliente.cpf}>${cliente.nome}</option>`;
        	})
        	$( "[name='cpfCliente']" ).empty();
        	$( "[name='cpfCliente']" ).append( html );
        },

        error: function(xhr, status, error){
          console.log(xhr);
          console.log(status);
          console.log(error);
        },

      })
}
