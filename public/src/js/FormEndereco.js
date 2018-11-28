function loadCep(cep){
  if(cep.length == 8){
    $.ajax({
      url:window.urlApi.cep,
      type:"GET",
      dataType:"json",
      data:"cep="+cep,

      success: function(result) {

        let inputCidades;
        inputCidades = $('[name=cidade]');
        for(i=0;i<inputCidades.length;i++)inputCidades[i].value = result.cidade;

        inputCidades = $('[name=rua]');
        for(i=0;i<inputCidades.length;i++)inputCidades[i].value = result.rua;


        inputCidades = $('[name=bairro]');
        for(i=0;i<inputCidades.length;i++)inputCidades[i].value = result.bairro;


        inputCidades = $('[name=bairro]');
        for(i=0;i<inputCidades.length;i++)inputCidades[i].value = result.bairro;


        inputCidades = $('[name=uf]');
        for(i=0;i<inputCidades.length;i++)inputCidades[i].value = result.estado;
      },

      error: function(xhr, status, error){
        console.log(xhr);
        console.log(status);
        console.log(error);
      },

    })
  }
}

class FormEndereco {
    constructor(elemento,classname)
    {
        this._elemento = elemento;
        this._classname = classname;
        if(classname==null)
            this._classname='formEndereco';
    }
    create()
    {
        this._elemento.innerHTML= `

      <form method="get" action=".">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="cep">CEP</label>
                <input id="inputCep" type="text" onkeyup='loadCep(this.value)' class="form-control form-control-sm ${this._classname} cep" placeholder="00000-000" name="cep" >
            </div>

            <div class="form-group col-md-6">
                <label for="cidade">Cidade</label>
                <input id="inputCidade" type="text" class="form-control form-control-sm ${this._classname} cidade" name="cidade" >
            </div>
            <div class="form-group col-md-4">
                <label for="uf">Estado</label>
                <input id="inputEstado" type="text" class="form-control form-control-sm ${this._classname} uf" name="uf" >
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="rua">Rua</label>
                <input id="inputRua" type="text" class="form-control form-control-sm ${this._classname} rua" name="rua" placeholder="Rua">
            </div>
            <div class="form-group col-md-2" >
                <label for="numero">Número</label>
                <input type="text" class="form-control form-control-sm ${this._classname} numero" name= "numero" placeholder="n°">
            </div>
            <div class="form-group col-md-4 ">
                <label for="bairro">Bairro</label>
                <input id="inputBairro"type="text" class="form-control form-control-sm ${this._classname} bairro" name="bairro" placeholder="bairro">
            </div>
        </div>
    </form>
        `
    }
}
