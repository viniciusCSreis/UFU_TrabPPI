class Modal_imovel_informacao
{
    constructor(elemento)
    {
        this._elemento = elemento;
    }
    create()
    {
        this._elemento.innerHTML = `

        <div class="modal fade" id="informacaoModal" tabindex="-1" role="dialog" aria-labelledby="Informacao" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="Informacao">Detalhes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="galeriaImagens" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#galeriaImagens" data-slide-to="0" class="active"></li>
                                            <li data-target="#galeriaImagens" data-slide-to="1"></li>
                                            <li data-target="#galeriaImagens" data-slide-to="2"></li>
                                            <li data-target="#galeriaImagens" data-slide-to="3"></li>
                                            <li data-target="#galeriaImagens" data-slide-to="4"></li>
                                            <li data-target="#galeriaImagens" data-slide-to="5"></li>

                                        </ol>
                                  <div class="carousel-inner">
                                    <div class="carousel-item active">
                                      <img class="d-block w-100" src="src/img/casa-exemplo1.jpg" src="../src/img/logo.svg" alt="First slide">
                                    </div>

                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="src/img/casa-exemplo2.jpg" src="../src/img/logo.svg" alt="Second slide">
                                    </div>

                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="src/img/casa-exemplo3.jpg" src="../src/img/logo.svg" alt="Third slide">
                                    </div>

                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="src/img/casa-exemplo4.jpg" src="../src/img/logo.svg" alt="Third slide">
                                    </div>

                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="src/img/casa-exemplo5.jpg" src="../src/img/logo.svg" alt="Third slide">
                                    </div>

                                    <div class="carousel-item">
                                      <img class="d-block w-100" src="src/img/casa-exemplo6.jpg" src="../src/img/logo.svg" alt="Third slide">
                                    </div>
                                  </div>
                                  <a class="carousel-control-prev" href="#galeriaImagens" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#galeriaImagens" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <li  class="list-group-item">Area: <span id="inf-area"></span>m²</li>
                            <li  class="list-group-item">Data Anuncio: <span id="inf-dtAnuncio"></span></li>
                            <li  class="list-group-item">Bairro: <span id="inf-bairro"></span></li>
                            <li  class="list-group-item">Cidade: <span id="inf-cidade"></span></li>
                            <li  class="list-group-item">Valor: <span id="inf-valor"></span></li>
                            <li  class="list-group-item">nroª: <span id="inf-nro"></span></li>
                            <li  class="list-group-item">nroª de sala de estar: <span id="inf-nroSalaEstar"></span></li>
                        </div>
                        <div class="col-md-6 ">
                                <ul class="list-group">
                                    <li  class="list-group-item">nroª de sala de jantar: <span id="inf-nroSalaJantar"></span></li>
                                    <li  class="list-group-item">nroª de quartos: <span id="inf-nroQuarto"></span></li>
                                    <li  class="list-group-item">nroª de suites: <span id="inf-suite"></span></li>
                                    <li  class="list-group-item">nroª de vagas na garagem: <span id="inf-garagem"></span></li>
                                    <li  class="list-group-item">possui armario embutido: <span id="inf-armario"></span></li>
                                    <li  class="list-group-item"> Descrição: <span id="inf-descricao"></span></li>
                                </ul>
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>

            </div>
        </div>
        </div>
        `
    }
    show()
    {
        $('#informacaoModal').modal('show');
    }
}
