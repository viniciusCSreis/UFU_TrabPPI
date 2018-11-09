
class Modal_cadastrar_funcionario
{
    constructor(elemento)
    {
        this._elemento = elemento;
    }
    create()
    {
        this._elemento.innerHTML = `

        <div class="modal fade" id="cadastrarFuncionario" tabindex="-1" role="dialog" aria-labelledby="Funcionario" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Funcionario">Cadastrar Funcionario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cadastrarFuncionario" class="" action=${window.urlApi.funcionario} method="POST">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email</label>
                                <input name="email" type="email" class="form-control form-control-sm" id="inputEmail4" placeholder="Digite seu Email">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Senha</label>
                                <input name="senha" type="password" class="form-control form-control-sm" id="inputPassword4" placeholder="Digite sua senha">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cliente_nome">Nome:</label>
                                <input name="nome" type="text" class="form-control form-control-sm" id="cliente_nome">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cliente_cpf">CPF:</label>
                                <input name="cpf" type="text" class="form-control form-control-sm" id="cliente_cpf">
                            </div>
                        </div>

                        <div id="formEndereco2"></div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telefone">Telefone Residencial</label>
                                <input name="telefone" type="text" class="form-control form-control-sm" placeholder="0000-0000" id="telefone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="celular">Telefone Celular</label>
                                <input name="celular" type="text" class="form-control form-control-sm" placeholder="00000-0000" id="celular">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="dt_inicio">Data Inicio</label>
                                <input name="dataInicio" type="date" class="form-control form-control-sm" id="dt_inicio">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cargo">Cargo: </label>
                                <select class="form-control form-control-sm" id="cargo" name="cargo">
                                        <option value="1">Gerente</option>
                                        <option value="11627" selected>Corretor</option>
                                        <option value="fachineiro" >Fachineiro</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <input type="submit" class="center_block btn btn-primary float-right"  value="Adicicionar">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                            </div>
                        </div>

                    </form>
            </div>
        </div>
        </div>


        `
    }
    show()
    {
        $('#cadastrarFuncionario').modal('show');
    }
}
