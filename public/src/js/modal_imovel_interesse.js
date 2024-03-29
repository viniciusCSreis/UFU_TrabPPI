class Modal_imovel_interesse
{
    constructor(elemento)
    {
        this._elemento = elemento;
    }
    create()
    {
        this._elemento.innerHTML = `

        <div class="modal fade" id="interesseModal" tabindex="-1" role="dialog" aria-labelledby="Interessado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Interessado">Tenho Interesse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="interesseForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputNome">Nome Completo</label>
                                <input type="text" class="form-control" name="nome" placeholder="Digite seu Nome completo">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail">E-mail</label>
                                <input type="email" class="form-control" name="email" placeholder="Digite seu E-mail">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telefone">Telefone Residencial</label>
                                <input type="text" class="form-control" placeholder="0000-0000" name="telefoneR">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="celular">Telefone Celular</label>
                                <input type="text" class="form-control" placeholder="00000-0000" name="telefoneC">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Sua Proposta</span>
                                </div>
                                <textarea class="form-control" aria-label="Sua Proposta" name="proposta"></textarea>
                                </div>
                        </div>
                        <input type="hidden" name="idImovel">
                        <div class="alert alert-success" role="alert" id="infoModalInteresse"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick="sendInteresse()">Solicitar Interesse</button>

                </div>

            </div>
        </div>
        </div>
        `
    }

}
