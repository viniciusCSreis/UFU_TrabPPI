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
                            <li class="list-group-item">Area: 100m²</li>
                            <li class="list-group-item">Data Anuncio: 11/11/2011</li>
                            <li class="list-group-item">Bairro: Santa Monica</li>
                            <li class="list-group-item">Cidade: Uberlândia</li>
                            <li class="list-group-item">Valor: R$1.000.000</li>
                            <li class="list-group-item">nroª: 1</li>
                            <li class="list-group-item">nroª de sala de estar: 1</li>
                        </div>
                        <div class="col-md-6 ">
                                <ul class="list-group">

                                    <li class="list-group-item">nroª de sala de jantar: 1</li>
                                    <li class="list-group-item">nroª de quartos: 1</li>
                                    <li class="list-group-item">nroª de quartos: 1</li>
                                    <li class="list-group-item">nroª de vagas na garagem: 1</li>
                                    <li class="list-group-item">possui armario embutido: sim</li>
                                    <li class="list-group-item">Descrição: Esta casa é muito bonita, tem banheiro, piscina, quartos, é muito da hora</li>
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
