class NavBarAcessoRestrito 
{
    static create(elemento)
    {
        elemento.innerHTML = `
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="logo" href="index.html">
                  <img id="logo" src="../src/img/logo.svg" alt="Logo" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav md-auto d-md-flex">
                        <li class="nav-item">
                            <a class="nav-link" href="listar_imoveis.html"><i class="fas fa-user"></i> Imoveis</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="listar_clientes.html"><i class="fas fa-user"></i> Clientes </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="listar_funcionario.html"><i class="fas fa-key"></i> Funcionario</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="listar_solicitacoes.html"><i class="fas fa-key"></i> Solicitações</a>
                        </li>

                        <li class="nav-item" onClick="logout();">
                            <a class="nav-link" href="#"><i class="fas fa-key"></i> Sair</a>
                        </li>
                    </ul>

                </div>

            </div>
        </nav>
        `
    }
}
