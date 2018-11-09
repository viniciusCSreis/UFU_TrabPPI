
class Modal_cadastrar_cliente
{
    constructor(elemento)
    {
        this._elemento = elemento;
    }
    create()
    {
        this._elemento.innerHTML = `

        <div class="modal fade" id="cadastrarCliente" tabindex="-1" role="dialog" aria-labelledby="Cliente" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Cliente">Cadastrar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="cadastrarCliente" class="" action=${window.urlApi.cliente} method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cliente_nome">Nome:</label>
                            <input type="text" class="form-control form-control-sm" id="cliente_nome" name="nome">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cliente_cpf">CPF:</label>
                            <input type="text" class="form-control form-control-sm" id="cliente_cpf" name="cpf">
                        </div>
                    </div>

                    <div id="formEndereco2"></div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cliente_profissao">Profissão:</label>
                            <input type="text" class="form-control form-control-sm" id="cliente_profissao" name="profissao">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cliente_email">Email</label>
                            <input type="email" class="form-control form-control-sm" id="cliente_email" name="email">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="cliente_genero">Gênero:</label>
                            <select class="form-control form-control-sm" id="cliente_genero" name="genero">
                            <option value="masculino" selected>Masculino</option>
                            <option value="feminino">Feminino</option>
                            <option value="outro">Outro</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="cliente_estado_civil">Estado Civil:</label>
                            <select class="form-control form-control-sm" id="cliente_estado_civil" name="estadoCivil">
                            <option value="casado">Casado</option>
                                    <option value="divorciado">Divorciado</option>
                                    <option value="viuvo">Viúvo</option>    
                                    <option value="solteiro" selected>Solteiro</option>  
                            </select>
                        </div>
                    </div>



                    <div class="modal-footer">
                        <input type="submit" class="center_block btn btn-primary float-right"  value="Cadastrar">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                </form>
            </div>
        </div>
        </div>


        `
    }
    show()
    {
        $('#cadastrarCliente').modal('show');
    }
}
